<?php

namespace App\Models;

use App\Filters\TaskFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Task extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['title', 'description', 'status', 'folder_id'];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter(Builder $builder, array $params)
    {
        return (new TaskFilter($builder))->apply($params);
    }
}
