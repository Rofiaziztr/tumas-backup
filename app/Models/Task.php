<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'course',
        'deadline',
        'priority',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
