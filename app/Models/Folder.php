<?php

namespace App\Models;

use App\Models\Traits\Logable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Folder extends Model
{
    use HasApiTokens, HasFactory, Logable;

    protected $fillable = ['title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
