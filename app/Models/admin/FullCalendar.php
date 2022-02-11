<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FullCalendar extends Model
{
    protected $table = 'full_calendar';
    use HasFactory;
    protected $fillable = [
        'title', 'start', 'end', 'color', 'textColor'
    ];
}
