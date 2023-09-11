<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_ extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = "UserID";
    protected $fillable = ['UserName',
    'UserPhoneNumber',
    'UserIDNumber'
    ,'UserType','Email',
    'Password','AddressID'];

    public function address(){
        return $this->belongsTo(Address::class,'AddressID');
    }
    public function reports(){
        return $this->hasMany(Report::class,'ReportID');
    }
    public function responses(){
        return $this->hasMany(Response::class,'ResponseID');
    }
}
