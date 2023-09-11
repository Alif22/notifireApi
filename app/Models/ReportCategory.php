<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = "CategoryID";
    protected $fillable = ['CategoryName'];
}
