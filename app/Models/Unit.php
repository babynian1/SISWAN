<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';
    protected $fillable = [
        'unit_name',
        'description'
    ];

    public function position(){
        return $this->hasMany(Jabatan::class, 'id');
    }

    public function employee(){
        return $this->hasMany(Employee::class, 'id');
    }
}
