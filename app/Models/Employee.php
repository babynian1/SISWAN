<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';

    protected $fillable = [
        'employee_name',
        'unit_id',
        'position_id',
        'date_join',
        'user_id',
        'foto'
    ];


    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id');
    }

}
