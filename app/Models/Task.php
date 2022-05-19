<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'deadline', 'done', 'daily_list_id'];

    //One To many relationship (belongsTo)
    public function dailyList()
    {
        return $this->belongsTo(DailyList::class);
    }
}
