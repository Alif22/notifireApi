<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Officer;
use App\Models\ReportCategory;
use App\Models\Address;
use App\Models\User_;
use App\Models\Report;
use App\Models\Response;
use App\Models\Designation;
use App\Exports\ExportReport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ApiController extends Controller
{
    //States
    public function getAllStates(){
        $state = State::get()->toJson(JSON_PRETTY_PRINT);
        return response($state,200);
    }
    //change id with name if want to get using name
    public function getState($id){
        if(State::where('StateId',$id)->exists()){
            $state = State::where('StateId',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($state,200);
        }else{
            return response()->json([
                "message" => "State not found"
            ],404);
        }
    }
    public function createState(Request $request){
        $state = new State;
        $state->StateName = $request->StateName;
        $state->save();
        return response()->json([
            "message" => "State record created"
        ],201);
    }
    
    public function updateState(Request $request, $id){
        if(State::where('StateId',$id)->exists()){
            $state = State::find($id);
            //if null replace the request with the existing one, if not passed a new value using a  ternary operator (? true : false)
            $state->StateName = is_null($request->StateName) ? $state->StateName : $request->StateName;  
            $state->save();
            
            return response()->json(["message" => "records updated successfully"],200);
        }else{
            return response()->json(["message" =>"State not found"],400);
        }
    }
    public function deleteState($id){
        if(State::where('StateId',$id)->exists()){
            $state = State::find($id);
            $state->delete();
            return response()->json(["message"=>"records deleted"],202);
        }else{
            return response()->json(["message"=>"State not found"],404);
        }
    }
    //officers
    public function getAllOfficers(){
        if(request('Email')!= null){
            $email = request('Email');
            if(Officer::where('Email',$email)->exists()){
                $Officer = Officer::where('Email',$email)->get()->toJson(JSON_PRETTY_PRINT);
                return response($Officer,200);
            }else{
                return response()->json([
                    "message" => "Officer not found"
                ],404);
            }
        }else{
            $officer = Officer::get()->toJson(JSON_PRETTY_PRINT);
            return response($officer,200);
        }
    }
    public function getOfficer($id){
        if(Officer::where('OfficerId',$id)->exists()){
            $officer = Officer::where('OfficerId',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($officer,200);
        }else{
            return response()->json([
                "message" => "Officer not found"
            ],404);
        }
    }
    public function createOfficer(Request $request){
        $officer = new Officer;
        $officer->OfficerName = $request->OfficerName;
        $officer->Email = $request->Email;
        $officer->Password = $request->Password;
        $officer->Department = $request->Department;
        $officer->Availability = $request->Availability;
        $officer->save();
        return response()->json([
            "message" => "Officer $officer->OfficerName record created"
        ],201);
    }
   
    public function updateOfficer(Request $request, $id){
        if(Officer::where('OfficerId',$id)->exists()){
            $officer = Officer::find($id);
            $officer->OfficerName = is_null($request->OfficerName) ? $officer->OfficerName : $request->OfficerName;  
            $officer->Email = is_null($request->Email) ? $officer->Email : $request->Email;
            $officer->Password = is_null($request->Password) ? $officer->Password: $request->Password;
            $officer->Department = is_null($request->Department) ? $officer->Department: $request->Department;
            $officer->Availability = is_null($request->Availability) ? $officer->Availability: $request->Availability;
            $officer->save();
            
            return response()->json(["message" => "Records updated successfully"],200);
        }else{
            return response()->json(["message" =>"Officer not found"],400);
        }
    }
    public function deleteOfficer($id){
        if(Officer::where('OfficerId',$id)->exists()){
            $officer = Officer::find($id);
            $officer->delete();
            return response()->json(["message"=>"records deleted"],202);
        }else{
            return response()->json(["message"=>"Officer not found"],404);
        }
    }
    //report category
    public function getAllCategory(){
        $category = ReportCategory::get()->toJson(JSON_PRETTY_PRINT);
        return response($category,200);
    }
    
    public function getCategory($id){
        if(ReportCategory::where('CategoryId',$id)->exists()){
            $category = ReportCategory::where('CategoryId',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($category,200);
        }else{
            return response()->json([
                "message" => "Category not found"
            ],404);
        }
    }
    public function createCategory(Request $request){
        $category = new ReportCategory;
        $category->CategoryName = $request->CategoryName;
        $category->save();
        return response()->json([
            "message" => "Category record created"
        ],201);
    }
    
    public function updateCategory(Request $request, $id){
        if(ReportCategory::where('CategoryId',$id)->exists()){
            $category = ReportCategory::find($id);
            //if null replace the request with the existing one, if not passed a new value using a ternary operator (? true : false)
            $category->CategoryName = is_null($request->CategoryName) ? $category->CategoryName : $request->CategoryName;  
            $category->save();
            
            return response()->json(["message" =>"Records updated successfully"],200);
        }else{
            return response()->json(["message" =>"Category not found"],400);
        }
    }
    public function deleteCategory($id){
        if(ReportCategory::where('CategoryId',$id)->exists()){
            $category = ReportCategory::find($id);
            $category->delete();
            return response()->json(["message"=>"records deleted"],202);
        }else{
            return response()->json(["message"=>"Category not found"],404);
        }
    }
    //address
    public function getAllAddress(){
        if(request('UserID') != null){
            $userID = request('UserID');
            if(User_::where('UserID',$userID)->exists()){
                $user = User_::where('UserID',$userID)->first();
                $addressID = $user->AddressID;
                $address = Address::where('AddressID',$addressID)->get()->toJson(JSON_PRETTY_PRINT);
                
                return response($address,200);
            }else{
                return response()->json([
                    "address" => "user's address not found"
                ],404);
            }
        }else{
            $address = Address::get()->toJson(JSON_PRETTY_PRINT);
            return response($address,200);
        }
    }
   
    public function getAddress($id){
        if(Address::where('AddressId',$id)->exists()){
            $address = Address::where('AddressId',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($address,200);
        }else{
            return response()->json([
                "message" => "Address not found"
            ],404);
        }
    }
    public function createAddress(Request $request){
        $AddressID = Address::max("AddressID")+1;
        //make address for user with null addressID
        if(request('UserID') != null){
            $userID = request('UserID');
            if(User_::where('UserID',$userID)->exists()){
                $addressArr = [
                    "AddressLine"=>$request->AddressLine,
                    "City" => $request->City,
                    "Latitude" => $request->Latitude,
                    "Longitude" => $request->Longitude,
                    "PostalCode" => $request->PostalCode,
                    "StateID" => $request->StateID,
                ];
                $address = Address::create($addressArr);
                $user = User_::where('UserID',$userID)->first();
                $user->address()->associate($address);
                $user->save();                  
            }else{
                return response()->json([
                    "userID" => "user id does not exist"
                ],404);
            }
        }else{
            $address = new Address;
            $address->AddressLine = $request->AddressLine;
            $address->City = $request->City;
            $address->Latitude = $request->Latitude;
            $address->Longitude = $request->Longitude;
            $address->PostalCode = $request->PostalCode;
            $address->StateID = $request->StateID;
            $address->save();
        }
        return response()->json([
            "AddressID" => $AddressID,
            "message" => "Address created succesfully"
        ], 201);
    }
    public function createAddressWithUser(Request $request){
        $address = new Address;
        $user = new User_;
        $addressArr = [
            "AddressLine"=>$request->AddressLine,
            "City" => $request->City,
            "Latitude" => $request->Latitude,
            "Longitude" => $request->Longitude,
            "PostalCode" => $request->PostalCode,
            "StateID" => $request->StateID,
        ];
        $address = Address::create($addressArr);
        $user->UserName = $request->UserName;
        $user->UserPhoneNumber = $request->UserPhoneNumber;
        $user->UserIDNumber = $request->UserIDNumber;
        $user->UserType = $request->UserType;
        $user->Email = $request->Email;
        $user->Password = $request->Password;
        $user->address()->associate($address);
        $user->save();
        return response()->json([
            "UserID" =>  $user->UserID,
            "AddressID" => $address->AddressID,
            "message" => "Address with user created succesfully"
        ], 201);
    }
    
    public function postReportasGuest(Request $request){
        $report = new Report;
        $addressArr = [
            "AddressLine"=>$request->AddressLine,
            "City" => $request->City,
            "Latitude" => $request->Latitude,
            "Longitude" => $request->Longitude,
            "PostalCode" => $request->PostalCode,
            "StateID" => $request->StateID,
        ];
        $address = Address::create($addressArr);
 
        $userArr = [
            "UserName" => $request->UserName,
            "UserPhoneNumber" => $request->UserPhoneNumber,
            "UserIDNumber" => $request->UserIDNumber,
            "UserType" => $request->UserType,
            "Email" => $request->Email,
            "Password" => $request->Password,
            "AddressID" => $address->AddressID,
        ];
        $user = User_::create($userArr);
        $address->user()->associate($user);
        $address->save();
        return response()->json([
            "UserID" =>  $user->UserID,
            "AddressID" => $address->AddressID,
            "message" => "report,report address, user and user address with user created succesfully"
        ], 201);
    }

    public function register(Request $request){
        $addressArr = [
            "AddressLine"=>$request->AddressLine,
            "City" => $request->City,
            "PostalCode" => $request->PostalCode,
            "StateID" => $request->StateID,
        ];
        $Address = Address::create($addressArr);
        $user = new User_;
        $user->UserName = $request->UserName;
        $user->UserPhoneNumber = $request->UserPhoneNumber;
        $user->UserIDNumber = $request->UserIDNumber;
        $user->UserType = $request->UserType;
        $user->Email = $request->Email;
        $user->Password = $request->Password;
        $user->address()->associate($Address);
        $user->save();
        return response()->json([
            "UserID" => $user->UserID,
            "message" => "User record created succesfully"
        ],201);
    }
    
    public function updateAddress(Request $request, $id){
        if(Address::where('AddressID',$id)->exists()){
            $address = Address::find($id);
            //if null replace the request with the existing one, if not passed a new value using a ternary operator (? true : false)  
            $address->AddressLine = is_null($request->AddressLine) ? $address->AddressLine : $request->AddressLine;
            $address->City = is_null($request->City) ? $address->City : $request->City;
            $address->Latitude = is_null($request->Latitude) ? $address->Latitude : $request->Latitude;
            $address->Longitude = is_null($request->Longitude) ? $address->Longitude : $request->Longitude;
            $address->PostalCode = is_null($request->PostalCOde) ? $address->PostalCode : $request->PostalCode;
            $address->save();
            
            return response()->json(["message" =>"Records updated successfully"],200);
        }else{
            return response()->json(["message" =>"Address not found"],400);
        }
    }
    public function deleteAddress($id){
        if(Address::where('AddressID',$id)->exists()){
            $address = Address::find($id);
            $address->delete();
            return response()->json(["message"=>"records deleted"],202);
        }else{
            return response()->json(["message"=>"Address not found"],404);
        }
    }

    public function updateAddressforUser(Request $request,$userID){
        if(User_::where('UserID',$userID)->exists()){
            $user = User_::find($userID);
            $address = Address::find($user->AddressID);
            $address->AddressLine = is_null($request->AddressLine) ? $address->AddressLine : $request->AddressLine;
            $address->City = is_null($request->City) ? $address->City : $request->City;
            $address->Latitude = is_null($request->Latitude) ? $address->Latitude : $request->Latitude;
            $address->Longitude = is_null($request->Longitude) ? $address->Longitude : $request->Longitude;
            $address->PostalCode = is_null($request->PostalCode) ? $address->PostalCode : $request->PostalCode;
            $address->StateID = is_null($request->StateID) ? $address->StateID : $request->StateID;
            $address->save();
            return response()->json(["message" =>"Records updated successfully"],200);
        }else{
            return response()->json(["message"=>"Address not found"],404);
        }
    }

    public function getAddressbyUserID(Request $request,$userID){
        if(User_::where('UserID',$userID)->exists()){
            $user = User_::find($userID);
            if(Address::where('AddressID',$user->AddressID)->exists()){
                $address = Address::find($user->AddressID);
                return response($address,200);
            }else{
                return response()->json(["AddressID"=>"0"],200);
            }
        }else{
            return response()->json(["message"=>"User not found"],404);
        }
      
    }
    //user_
    public function getAllUser(){
        //get user by email
        if(request('Email')!= null){
            $email = request('Email');
            if(User_::where('Email',$email)->exists()){
                $user = User_::where('Email',$email)->get()->toJson(JSON_PRETTY_PRINT);
                return response($user,200);
            }else{
                return response()->json([
                    "message" => "User not found"
                ],404);
            }
        }else{
            //return all user
            $user = User_::get()->toJson(JSON_PRETTY_PRINT);
            return response($user,200);
        }
    }
    public function getUser($id){
        if(User_::where('UserId',$id)->exists()){
            $user = User_::where('UserId',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($user,200);
        }else{
            return response()->json([
                "message" => "User not found"
            ],404);
        }
    }
    public function createUser(Request $request){
        $user = new User_;
        $user->UserName = $request->UserName;
        $user->UserPhoneNumber = $request->UserPhoneNumber;
        $user->UserIDNumber = $request->UserIDNumber;
        $user->UserType = $request->UserType;
        $user->Email = $request->Email;
        $user->Password = $request->Password;
        $user->AddressID = $request->AddressID;
        $user->save();
        return response()->json([
            "UserID" => $user->UserID,
            "message" => "User record created succesfully"
        ],201);
    }

    
    public function updateUser(Request $request, $id){
        if(User_::where('UserId',$id)->exists()){
            $user = User_::find($id);
            //if null replace the request with the existing one, if not passed a new value using a ternary operator (? true : false)  
            $user->UserName = is_null($request->UserName) ? $user->UserName : $request->UserName;
            $user->UserPhoneNumber = is_null($request->UserPhoneNumber) ? $user->UserPhoneNumber : $request->UserPhoneNumber;
            $user->UserIDNumber = is_null($request->UserIDNumber) ? $user->UserIDNumber : $request->UserIDNumber;
            $user->UserType = is_null($request->UserType) ? $user->UserType : $request->UserType;
            $user->Email = is_null($request->Email) ? $user->Email : $request->Email;
            $user->Password = is_null($request->Password) ? $user->Password : $request->Password;
            $user->AddressID = is_null($request->AddressID) ? $user->AddressID : $request->AddressID;
            $user->save();
            
            return response()->json(["message" =>"Records updated successfully"],200);
        }else{
            return response()->json(["message" =>"User not found"],400);
        }
    }
    public function deleteUser($id){
        if(User_::where('UserId',$id)->exists()){
            $user = User_::find($id);
            $user->delete();
            return response()->json(["message"=>"records deleted"],202);
        }else{
            return response()->json(["message"=>"User not found"],404);
        }
    }
 
    //report
    public function getAllReport(){
        if(request('Status')!= null){
            $reportStatus = request('Status');
            if(Report::where('ReportStatus',$reportStatus)->exists()){
                $report = Report::where('ReportStatus',$reportStatus)->get()->toJson(JSON_PRETTY_PRINT);
                return response($report,200);
            }else{
                return response()->json([
                    "message" => "Report not found"
                ],404);
            }
        }else{
            $report = Report::latest()->get()->toJson(JSON_PRETTY_PRINT);
            return response($report,200);
        }
    }
    public function getReportCount(){
        if(request('Status')!= null){
            $reportStatus = request('Status');
            if(Report::where('ReportStatus',$reportStatus)->exists()){
                $report = Report::where('ReportStatus',$reportStatus)->get();
                $reportCount = $report->count();
                return response()->json([
                    "reportCount" => $reportCount
                ],200);

            }else{
                return response()->json([
                    "message" => "Report not found"
                ],404);
            }
        }else{
            $newReportCount = Report::where('ReportStatus','new')->get()->count();
            $OIReportCount = Report::where('ReportStatus','on investigation')->get()->count();
            return response()->json([
                "newReportCount" => $newReportCount,
                "OIReportCount" => $OIReportCount
            ],200);
        }
    }
    
    public function getReport($id){
        if(Report::where('ReportId',$id)->exists()){
            $report = Report::where('ReportId',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($report,200);
        }else{
            return response()->json([
                "message" => "Report not found"
            ],404);
        }
    }
    
    public function getReportForUser($userId){
        if(Report::where('UserID',$userId)->exists()){
            $report = Report::where('UserID',$userId)->latest()->get()->toJson(JSON_PRETTY_PRINT);
            return response($report,200);
        }else{
            return response()->json([
                
            ],200);
    
        }
    }
    public function getReportAssigned($officerId){
        if(Officer::where('OfficerID',$officerId)->exists()){
            $officer = Officer::find($officerId);
            $responseArray = [];
            foreach ($officer->response as $response) {
               
                if($response->report->ReportStatus == 'on investigation'){
                    array_push($responseArray,$response->report);
                }
            }
            
            return response($responseArray,200);
        }else{
            return response()->json([
                "message" => "Report not found"
            ],404);
        }
    }
    public function getOfficerAssigned($reportId){
        if(Report::where('ReportID',$reportId)->exists()){
            $report = Report::find($reportId);
            if(Response::whereBelongsTo($report)->exists()){
                $response = Response::whereBelongsTo($report)->first();
                $output = "";
                foreach($response->officer as $officer){
                    $output = $output.$officer->OfficerName.", ";
                }
                return response()->json([
                    "OfficerName" => $output
                ],200);
            }else{
                return response()->json([
                    "OfficerName" => ""
                ],200);
            }
        }else{
            return response()->json([
                "message" => "Report not found"
            ],404);
        }
    }

    public function createReport(Request $request){
        $burnAddressArr = [
            "AddressLine"=>$request->AddressLineB,
            "City" => $request->CityB,
            "Latitude" => $request->LatitudeB,
            "Longitude" => $request->LongitudeB,
            "PostalCode" => $request->PostalCodeB,
            "StateID" => $request->StateIDB,
        ];
        $burnAddress = Address::create($burnAddressArr);
        $user = User_::find($request->UserID);
        $report = new Report;
        $report->Comment = $request->Comment;
        if($request->hasfile('MediaAttachment')){
            $file=$request->file('MediaAttachment');
            $name = time().'.'.$file->getClientOriginalName();
            $file->move(public_path().'\\files\\',time().'.'.$file->getClientOriginalName());
            $report->MediaAttachment = $name;
        }else{
            $report->MediaAttachment = "";
        }
        $report->ReportStatus = $request->ReportStatus;
        $report->CategoryID = $request->CategoryID;
        $report->address()->associate($burnAddress);
        $report->user()->associate($user);
        $report->save();
        return response()->json([
            "message" => "Report record created"
        ],201);
    }
    
    public function updateReport(Request $request, $id){
        if(Report::where('ReportId',$id)->exists()){
            $report = Report::find($id);
            //if null replace the request with the existing one, if not passed a new value using a ternary operator (? true : false)  
            $report->Comment = is_null($request->Comment) ? $report->Comment : $request->Comment;
            $report->MediaAttachment = is_null($request->MediaAttachment) ? $report->MediaAttachment : $request->MediaAttachment;
            $report->ReportStatus = is_null($request->ReportStatus) ? $report->ReportStatus : $request->ReportStatus;
            $report->UserID = is_null($request->UserID) ? $report->UserID : $request->UserID;
            $report->CategoryID = is_null($request->CategoryID) ? $report->CategoryID : $request->CategoryID;
            $report->AddressID = is_null($request->AddressID) ? $report->AddressID : $request->AddressID;
            $report->save();
            
            return response()->json(["message" =>"Records updated successfully"],200);
        }else{
            return response()->json(["message" =>"Report not found"],400);
        }
    }
    public function deleteReport($id){
        if(Report::where('ReportId',$id)->exists()){
            $report = Report::find($id);
            $report->delete();
            return response()->json(["message"=>"records deleted"],202);
        }else{
            return response()->json(["message"=>"Report not found"],404);
        }
    }

    //response
    public function getAllResponse(){
        $response = Response::get()->toJson(JSON_PRETTY_PRINT);
        return response($response,200);
    }
    //change id with name if want to get using name
    public function getResponse($id){
        if(Response::where('ResponseId',$id)->exists()){
            $response = Response::where('ResponseId',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($response,200);
        }else{
            return response()->json([
                "message" => "Response not found"
            ],404);
        }
    }

    public function createResponse(Request $request){
        if(request("ReportID")!= null && request("AdminID")!= null){
            $response = new Response;
            $reportID = request("ReportID");
            $adminID = request("AdminID");
            $admin = User_::find($adminID);
            $report = Report::find($reportID);
            $response->user()->associate($admin);
            $response->report()->associate($report);
            $response->save();
            return response()->json([
                "message" => "Base response record created"
            ],201);
        }else{
            $response = new Response;
            $response->ActionTaken = $request->ActionTaken;
            $response->Remark = $request->Remark;
            $response->UserID = $request->UserID;
            $response->ReportID = $request->ReportID;
            $response->save();
        return response()->json([
            "message" => "Response record created"
        ],201);
        }
        
    }
    
    public function updateResponse(Request $request){
        if(request("ReportID")!= null){
            $reportID = request("ReportID");
            $report = Report::find($reportID);
            $response = Response::whereBelongsTo($report)->first();
            $response->ActionTaken = is_null($request->ActionTaken) ? $response->ActionTaken : $request->ActionTaken;
            $response->Remark = is_null($request->Remark) ? $response->Remark : $request->Remark;
            $response->save();
            return response()->json(["message" =>"Records updated successfully"],200);
        }
        if(Response::where('ResponseId',request("ResponseID"))->exists()){
            $response = Response::find($id);
            //if null replace the request with the existing one, if not passed a new value using a ternary operator (? true : false)  
            $response->ActionTaken = is_null($request->ActionTaken) ? $response->ActionTaken : $request->ActionTaken;
            $response->Remark = is_null($request->Remark) ? $response->Remark : $request->Remark;
            $response->UserID = is_null($request->UserID) ? $response->UserID : $request->UserID;
            $response->ReportID = is_null($request->ReportID) ? $response->ReportID : $request->ReportID;
            $response->OfficerID = is_null($request->OfficerID) ? $response->OfficerID : $request->OfficerID;
            $response->save();
            
            return response()->json(["message" =>"Records updated successfully"],200);
        }else{
            return response()->json(["message" =>"Response not found"],400);
        }
    }
    public function deleteResponse($id){
        if(Response::where('ResponseId',$id)->exists()){
            $response = Response::find($id);
            $response->delete();
            return response()->json(["message"=>"records deleted"],202);
        }else{
            return response()->json(["message"=>"Response not found"],404);
        }
    }
   
 
    //Designation
    public function getAllDesignation(){
        $designation = Designation::get()->toJson(JSON_PRETTY_PRINT);
        return response($designation,200);
    }

    public function getDesignation($id){
        if(Designation::where('DesignationId',$id)->exists()){
            $designation = Designation::where('DesignationId',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($designation,200);
        }else{
            return response()->json([
                "message" => "Designation not found"
            ],404);
        }
    }
    public function getResponseForReport(Request $request){
        $reportID = request("ReportID");
        $report = Report::find($reportID);
        if(Response::whereBelongsTo($report)->exists()){
            $response = Response::whereBelongsTo($report)->first();
            if($response->ActionTaken == null && $response->Remark == null){
                return response()->json([
                    "ActionTaken" => "",
                    "Remark" => ""
                ],201);
            }else{
                return response($response,200);
            }
        }else{
            return response()->json([
                "ActionTaken" => "",
                "Remark" => ""
            ],201);   
        }
    }

    public function createDesignation(Request $request){
        if(request("ReportID")!= null && request("OfficerID")!= null){
            $reportID = request("ReportID");
            $officerID = request("OfficerID");
            $officer = Officer::find($officerID);
            $report = Report::find($reportID);
            $response = Response::whereBelongsTo($report)->first();
            $designation = new Designation;
            $designation->officer()->associate($officer);
            $designation->response()->associate($response);
            $designation->save();
            return response()->json([
                "message" => "Designation record created"
            ],201);
        }
        else{
            $designation = new Designation;
            $designation->OfficerID = $request->OfficerID;
            $designation->ResponseID = $request->ResponseID;
            $designation->save();
            return response()->json([
                "message" => "Designation record created"
            ],201);
        }
    }
    
    public function updateDesignation(Request $request, $id){
        if(Designation::where('DesignationId',$id)->exists()){
            $designation = Designation::find($id);
            //if null replace the request with the existing one, if not passed a new value using a ternary operator (? true : false)  
            $designation->OfficerID = is_null($request->OfficerID) ? $designation->OfficerID : $request->OfficerID;
            $designation->ResponseID = is_null($request->ResponseID) ? $designation->ResponseID : $request->ResponseID;
            $designation->save();
            
            return response()->json(["message" =>"Records updated successfully"],200);
        }else{
            return response()->json(["message" =>"Designation not found"],400);
        }
    }
    public function deleteDesignation($id){
        if(Designation::where('DesignationId',$id)->exists()){
            $designation = Designation::find($id);
            $designation->delete();
            return response()->json(["message"=>"records deleted"],202);
        }else{
            return response()->json(["message"=>"Designation not found"],404);
        }
    }
    public function uploadFile(Request $request){
        if($request->hasfile('filename')){
            $file=$request->file('filename');
            $file->move(public_path().'\\files\\',time().'.'.$file->getClientOriginalName());
            return response()->json(["message"=>"has file, uploaded and the name is something i didnt do yet",
                "status" => "true",
                "param" => $request->testParam,
                "url" => asset('files/1648489915.sampleBurningImage.jpg')
            ]);
        }else{
            return response()->json(["message"=>"has file, uploaded and the name is something i didnt do yet",
            "status" => "true",
            "url" => asset('files/1648489915.sampleBurningImage.jpg')
        ]);
        }
    }
    public function countState(){
        $reports = DB::table('reports')
                ->join('addresses','reports.AddressID','=','addresses.AddressID')
                ->get();
        $reportCount = [];
        for ($x = 1; $x <= 13; $x++) {
            array_push($reportCount, $reports->where('StateID',$x)->count());
        }
        return response($reportCount);        
    }
    public function countCategory(){
        $reports = DB::table('reports')
                ->join('report_categories','reports.CategoryID','=','report_categories.CategoryID')
                ->get();
        $reportCount = [];
        for ($x = 1; $x <= 8; $x++) {
            array_push($reportCount, $reports->where('CategoryID',$x)->count());
        }
        return response($reportCount);        
    }
    public function exportReport(){
        return Excel::download( new ExportReport, time().'.reports.xlsx');
    }
}
