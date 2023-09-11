<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportReport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Report::all();
       return       $reports = DB::table('reports')
       ->join('user_','reports.UserID','=','user_.UserID')
       ->join('report_categories','reports.CategoryID','=','report_categories.CategoryID')
       ->join('addresses','reports.AddressID','=','addresses.AddressID')
       ->join('states','addresses.StateID', '=', 'states.StateID')
       ->get()
       ->map(function ($output) {
           unset($output->Password);
           unset($output->CategoryID);
           unset($output->AddressID);
           unset($output->StateID);
           unset($output->updated_at);
           return $output;}
       );
    }
    public function headings():array{
        return [ "ReportID","created_at","Comment","Attachment","ReportStatus","UserID",
          "UserName",
          "UserPhoneNumber",
          "UserIDNumber",
          "UserType",
          "Email",
          "CategoryName",
          "AddressLine",
          "City",
          "Latitude",
          "Longitude",
          "PostalCode",
          "StateName"];
    }
}
