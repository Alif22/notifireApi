<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = "AddressID";
    protected $fillable = ['AddressLine','City','Latitude','Longitude','PostalCode','StateID'];
    public function user(){
        return $this->hasOne(User_::class,'AddressID');
    }
    public function report(){
        return $this->hasOne(Report::class,'AddressID');
    }
}
