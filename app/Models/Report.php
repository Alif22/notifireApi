<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Report extends Model
{
    use HasFactory;
    protected $primaryKey = "ReportID";
    protected $fillable = ['Comment','MediaAttachment','ReportStatus','UserID','CategoryID','AddressID'];

    public function address(){
        return $this->belongsTo(Address::class,'AddressID');
    }
    public function user(){
        return $this->belongsTo(User_::class,'UserID');
    }
    public function response(){
        return $this->hasOne(Response::class,'ResponseID');
    }
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('d-m-Y H:i A');
    }
}
