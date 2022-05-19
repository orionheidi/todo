<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DailyList extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'date', 'user_id'];

    //One To many relationship (belongsTo)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //One To many relationship (has many)
    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Task::class);
    }
}
