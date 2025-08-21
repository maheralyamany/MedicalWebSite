<?php

namespace App\Models;

  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Navbar extends BaseModel
{
    
    use HasFactory;
    protected $table = 'navbars';
    public $timestamps = false;
    protected $fillable = [
        'name', 'route', 'role','icon','ordering'
    ];
}
