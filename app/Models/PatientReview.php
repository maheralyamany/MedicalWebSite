<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientReview extends BaseModel
{
    protected $table = 'patient_reviews';
    protected $fillable = ['appointment_id', 'next_review_date','review_statu'];
    public static function laratablesCustomAction($patient_review)
    {
        return view('patient_reviews.actions', compact('patient_review'))->render();
    }
    public function appointment()
    {
        return $this->belongsTo(Appointments::class, 'appointment_id');
    }
}
