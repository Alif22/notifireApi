<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $primaryKey = "ResponseID";
    protected $fillable = ['ActionTaken','Remark','UserID','ReportID'];
    
    public function report(){
        return $this->belongsTo(Report::class,'ReportID');
    }
    public function designation(){
        return $this->hasMany(Designation::class,'DesignationID');
    }
    public function user(){
        return $this->belongsTo(User_::class,'UserID');
    }
    public function officer(){
        return $this->belongsToMany(Officer::class,"designations","ResponseID","OfficerID");
    }
}
