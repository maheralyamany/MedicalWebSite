<?php
namespace App\Console\Commands;

use App\Utilities\MFormatter;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup DataBase';
    protected $dbName;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->dbName = env('DB_DATABASE', 'dlvhealth_base');

    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    /*    public function handle(){
    $this->comment('Starting backup...');
    $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".gz";
    $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . storage_path() . "/app/backup/" . $filename;
    $returnVar = NULL;
    $output  = NULL;
    exec($command, $output, $returnVar);699999999999999999999
    } */
    public function handle()
    {
        $this->comment('Starting backup...');

        $tableNames = $this->getTableNames();
        //$this->line(json_encode($tableNames));

        $content = '';
        $dataFormat = new MFormatter();

        foreach ($tableNames as $tbl) {
            $query = 'SHOW CREATE TABLE ' . $tbl;
            $slect = 'SELECT * FROM ' . $this->dbName . '.' . $tbl;
            $result = DB::select($slect);

            $rows_num = sizeof($result);
            if ($rows_num > 0) {
                $dataFormat->line('-- ' . $tbl);
                 $dataFormat->line(sprintf("DELETE FROM `%s`;", $tbl));
                
                foreach ($result as $row) {
                    $row = (array) $row;
                    $keys = [];
                    $values = [];

                    foreach ($row as $key => $value) {
                        // $value = str_replace("\t", '\\t', addslashes($value));
                        if (isset($value) && !is_null($value)) {
                            if (is_string($value)) {
                                $values[] = sprintf("'%s'", $value);
                            } else {
                                $values[] = sprintf("%s", $value);

                            }
                        } else {
                            $values[] = "''";
                        }

                        $keys[] = sprintf("`%s`", $key);
                    }
                    $keys = implode(',', $keys);
                    $values = implode(',', $values);
                    $dataFormat->line(sprintf("INSERT INTO `%s` (%s) VALUES(%s);", $tbl, $keys, $values));

                }

                $dataFormat->line('');
            }

            $tables = DB::select($query);
            foreach ($tables as $t) {
                $t = (array) $t;
                //  $this->line(json_encode($t));
                $table = $t["Create Table"];
                //$table = str_replace('\n', '', $table);
                $table = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS ', $table);
                $table = $this->deleteAutoIncrement($table);
                $table = $this->addColumnsComment($table);
                $content .= $table;
                $content .= ";\n\n";
            }
        }
        //  dd($dataFormat->render());

        //$content = str_replace('\n', '', $content);
        $disk = Storage::build([
            'driver' => 'local',
            'root' => base_path() . '/database_schema/',
        ]);
        $schemaFilename = "backup_" . $this->dbName . "_schema_" . Carbon::now()->format('Y_m_d_H') . ".sql";
        $dataFilename = "backup_" . $this->dbName . "_data_" . Carbon::now()->format('Y_m_d_H') . ".sql";
        if ($disk->exists($schemaFilename)) {
            $disk->delete($schemaFilename);
        }
        if ($disk->exists($dataFilename)) {
            $disk->delete($dataFilename);
        }
        $dataContent = $dataFormat->render();
        $disk->put($dataFilename, $dataContent);
        $disk->put($schemaFilename, $content);
        $this->line('Backup completed!');
        return 0;
    }

    public function getTableNames()
    {
        $tableNames = [];
        try {
            $result = DB::select("SELECT t.TABLE_NAME from INFORMATION_SCHEMA.TABLES t WhERE t.TABLE_SCHEMA = '" . $this->dbName . "' AND t.TABLE_TYPE = 'BASE TABLE';");
            foreach ($result as $v) {
                if (!is_null($v->TABLE_NAME)) {
                    $parnts = $this->getTableParents($v->TABLE_NAME);
                    if (sizeof($parnts) > 0) {
                        foreach ($parnts as $p) {
                            if (!is_null($p) && !in_array($p, $tableNames)) {
                                $tableNames[] = $p;
                            }
                        }
                    }
                    if (!in_array($v->TABLE_NAME, $tableNames)) {
                        $tableNames[] = $v->TABLE_NAME;
                    }
                }

            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return $tableNames;
    }
    public function getTableParents($tableName)
    {
        $tableNames = [];
        try {
            $result = DB::select("SELECT K.REFERENCED_TABLE_NAME TABLE_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE AS K WHERE K.TABLE_SCHEMA = '" . $this->dbName . "' AND K.TABLE_NAME='" . $tableName . "'");
            foreach ($result as $v) {
                if (!is_null($v->TABLE_NAME)) {
                    $parnts = $this->getTableParents($v->TABLE_NAME);
                    if (sizeof($parnts) > 0) {
                        foreach ($parnts as $p) {
                            if (!is_null($p) && !in_array($p, $tableNames)) {
                                $tableNames[] = $p;
                            }
                        }
                    }
                    if (!in_array($v->TABLE_NAME, $tableNames)) {
                        $tableNames[] = $v->TABLE_NAME;
                    }
                }

            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return $tableNames;
    }
    public function getTableNames1()
    {
        $tableNames = [];

        $result = collect(DB::select("SELECT TABLE_NAME, REFERENCED_TABLE_NAME as REF_TABLE_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = '" . $this->dbName . "' ORDER BY REF_TABLE_NAME;"));

        foreach ($result as $v) {
            if (!is_null($v->REF_TABLE_NAME) && !in_array($v->REF_TABLE_NAME, $tableNames)) {
                $tableNames[] = $v->REF_TABLE_NAME;
            }
            if (!in_array($v->TABLE_NAME, $tableNames)) {
                $tableNames[] = $v->TABLE_NAME;
            }
        }
        $result = DB::select("SELECT t.TABLE_NAME from INFORMATION_SCHEMA.TABLES t WhERE t.TABLE_SCHEMA = '" . $this->dbName . "' AND t.TABLE_TYPE = 'BASE TABLE';");
        foreach ($result as $v) {
            if (!in_array($v->TABLE_NAME, $tableNames)) {
                $tableNames[] = $v->TABLE_NAME;
                $this->line($v->TABLE_NAME);
            }
        }
        return $tableNames;
    }
    public function deleteAutoIncrement($table)
    {
        try {
            if (str_contains($table, 'AUTO_INCREMENT=')) {
                $arry = explode("AUTO_INCREMENT=", $table);
                $tbl = $arry[0];
                $arry = explode("DEFAULT CHARSET", $arry[1]);
                $tbl .= " DEFAULT CHARSET" . $arry[1];
                return $tbl;
            }
        } catch (\Exception $th) {
            //throw $th;
        }
        return $table;
    }
    protected $commentColumns = [
        '`name_ar`' => " COMMENT 'الاسم عربي'",
        '`name_en`' => " COMMENT 'الاسم إنجليزي'",
        '`status`' => " COMMENT 'يعمل/موقف'",
        '`facility_id`' => " COMMENT 'رقم المرفق'",
        '`activity_id`' => " COMMENT 'رقم النشاط'",
        '`factyp_id`' => " COMMENT 'رقم نوع المرفق'",
        '`id_card`' => " COMMENT 'رقم الهوية'",
        '`birth_date`' => " COMMENT 'تاريخ الميلاد'",
        '`address`' => " COMMENT 'العنوان'",
        '`nationality_id`' => " COMMENT 'رقم الجنسية'",
        '`email`' => " COMMENT 'الايميل'",
        '`phone_no`' => " COMMENT 'رقم الجوال'",
        '`gender`' => " COMMENT 'الجنس'",
        '`path`' => " COMMENT 'مسار الصورة/الملف'",
    ];
    protected $explodeD = [
        "AUTO_INCREMENT,",
        "NOT NULL,",
    ];
    public function addColumnsComment($table)
    {
        try {
            $arry = explode(",
  ", $table);
            $tbl = '';
            foreach ($arry as $i => $v) {
                if (!str_contains($v, 'COMMENT')) {
                    foreach ($this->commentColumns as $key => $value) {
                        if (!str_contains($v, 'COMMENT') && str_starts_with(trim($v), $key)) {
                            $v .= $value;
                        }
                    }
                }
                if ($i < sizeof($arry) - 1) {
                    $tbl .= $v . ",\n";
                } else {
                    $tbl .= $v;
                }
            }
            return $tbl;
        } catch (\Exception $th) {
            //throw $th;
        }
        return $table;
    }
}
