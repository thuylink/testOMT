<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\User;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    public $timestamps = true;
    protected $fillable = [
        'name',
    ];

//    public function users()
//    {
//        return $this->belongsTo(User::class);
//    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
