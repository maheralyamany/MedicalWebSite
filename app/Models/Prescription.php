<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends BaseModel
{
    
    protected $table = 'prescriptions';
    protected $fillable = [ 'appointment_id', 'start_date', 'drug_id', 'dosage', 'quantity', 'unit_id', 'take_way_id', 'interval_id', 'unit_size', 'note', 'status',];
    public static function laratablesCustomAction($prescription)
    {
        return view('prescriptions.actions', compact('prescription'))->render();
    }
    public function appointment()
    {
        return $this->belongsTo(Appointments::class, 'appointment_id');
    }
    public function drug()
    {
        return $this->belongsTo(Drug::class, 'drug_id');
    }
}