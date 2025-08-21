<?php

namespace App\Utilities;

use Illuminate\Support\Facades\DB;

/**
 * Class DbSchemaManager
 *
 * Contains all of the Business logic to install the app. Either through the CLI or the `/install` web UI.
 *
 * @package App\Utilities
 */
class DbSchemaManager
{

    public static function getTableNames()
    {
        $dbName = env('DB_DATABASE', 'dlvhealth_base');
        $tableNames = [];
        try {
            $result = DB::select("SELECT t.TABLE_NAME from INFORMATION_SCHEMA.TABLES t WhERE t.TABLE_SCHEMA = '" . $dbName . "' AND t.TABLE_TYPE = 'BASE TABLE';");
            foreach ($result as $v) {
                if (!is_null($v->TABLE_NAME)) {
                    $parnts = self::getTableParents($dbName, $v);
                    foreach ($parnts as $p) {
                        $tableNames[] = $p;
                    }
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        $collect = [];

        foreach ($tableNames as $tbl) {
            $nam = $tbl['Name'];
            if (sizeof($tbl['Parents']) > 0) {
                foreach ($tbl['Parents'] as $p) {
                    if (!key_exists($p, $collect)) {
                        $collect[$p] = ['Name' => $p, 'childs' => []];
                    }
                    if (!in_array($nam, $collect[$p]['childs'])) {
                        $collect[$p]['childs'][] = $nam;

                    }

                }

            } else {

                if (!key_exists($nam, $collect)) {
                    $collect[$nam] = ['Name' => $nam, 'childs' => []];
                }

            }
        }
        $collect = collect($collect)->values()->toArray();

        /*    $collect = collect($collect)->values()->map(function ($sys)  {
        $lst = [];
        if (sizeof($sys['childs']) > 0) {
        foreach ($sys['childs'] as $ch) {
        $lst[] = ['Name' => $ch, 'parent' => $sys['Name']];
        }
        }
        $lst[] = ['Name' => $sys['Name'], 'parent' => null];
        return $lst;
        })->toArray(); */

        dd($collect);
        return $tableNames;
    }
    public static function getTableParents($dbName, $tbl)
    {
        $tableNames = [];
        try {
            $result = DB::select("SELECT K.REFERENCED_TABLE_NAME TABLE_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE AS K WHERE K.TABLE_SCHEMA = '" . $dbName . "' AND K.TABLE_NAME='" . $tbl->TABLE_NAME . "'");
            $tableNames[] = self::fillTableData($dbName, $tbl, $result);
            foreach ($result as $v) {
                if (!is_null($v->TABLE_NAME)) {
                    $parnts = self::getTableParents($dbName, $v);
                    foreach ($parnts as $p) {
                        $tableNames[] = $p;
                    }
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return $tableNames;
    }
    public static function fillTableData($dbName, $tbl, $parnts)
    {
        $table = [];
        try {
            if (!is_null($tbl->TABLE_NAME)) {
                $table = ['Name' => $tbl->TABLE_NAME, 'Parents' => []];
                if (sizeof($parnts) > 0) {
                    foreach ($parnts as $p) {
                        if (!is_null($p->TABLE_NAME)) {
                            $table['Parents'][] = $p->TABLE_NAME;
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return $table;
    }
    public static function getTableNames1()
    {
        $tableNames = [];
        $dbName = env('DB_DATABASE', 'dlvhealth_base');
        $result = collect(DB::select("SELECT k.REFERENCED_TABLE_NAME, GROUP_CONCAT(k.TABLE_NAME) AS childrens FROM information_schema.key_column_usage k WHERE k.TABLE_SCHEMA = '" . $dbName . "' AND k.REFERENCED_COLUMN_NAME IS NOT NULL GROUP BY k.REFERENCED_TABLE_NAME ORDER BY k.ORDINAL_POSITION;"));
        // $gro = $result->groupBy(['REFERENCED_TABLE_NAME']);
        dd($result->toArray());
        foreach ($result as $v) {
            if (!is_null($v->REF_TABLE_NAME) && !in_array($v->REF_TABLE_NAME, $tableNames)) {
                $tableNames[] = $v->REF_TABLE_NAME;
            }
            if (!in_array($v->TABLE_NAME, $tableNames)) {
                $tableNames[] = $v->TABLE_NAME;
            }
        }
        $result = DB::select("SELECT t.TABLE_NAME from INFORMATION_SCHEMA.TABLES t WhERE t.TABLE_SCHEMA = '" . $dbName . "' AND t.TABLE_TYPE = 'BASE TABLE';");
        foreach ($result as $v) {
            if (!in_array($v->TABLE_NAME, $tableNames)) {
                $tableNames[] = $v->TABLE_NAME;

            }
        }
        return $tableNames;
    }

}
