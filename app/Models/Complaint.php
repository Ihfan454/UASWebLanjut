<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'nim', 'email', 'phone', 'category', 
        'location', 'description', 'photo', 'status', 'priority'
    ];
}