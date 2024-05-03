<?php

namespace App\Models;
use App\Http\Controllers\TaskUserController;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    use HasFactory;
    protected $table = 'task_user';

}
