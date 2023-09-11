<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = "DesignationID";
    protected $fillable = ['OfficerID,ResponseID'];
    public function officer(){
        return $this->belongsTo(Officer::class,'OfficerID');
    }
    public function response(){
        return $this->belongsTo(Response::class,'ResponseID');
    }
}
