<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = "OfficerID";
    protected $fillable = [
        'OfficerName',
        'Email',
        'Password',
        'Department',
        'Availibility'
    ];
    public function designation(){
        return $this->hasMany(Designation::class,"DesignationID");
    }
   
    public function response(){
        return $this->belongsToMany(Response::class,"designations","OfficerID","ResponseID");
    }
}
