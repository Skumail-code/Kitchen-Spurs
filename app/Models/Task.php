<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user')->withTimestamps();
    }
      protected $fillable = [
        'title', 'description', 'status', // Add any other attributes here
    ];
}