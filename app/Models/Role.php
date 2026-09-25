<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;
    protected $fillable = ['name', 'code'];
    public function users() { return $this->belongsToMany(User::class); }
}
