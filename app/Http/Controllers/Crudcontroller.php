<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class Crudcontroller extends Controller
{
    public function saveData(Request $request)
    {

        $firstNm = $request->input('firstNm');
        $lastNm = $request->input('lastNm');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $phno = $request->input('phno');
        $Address = $request->input('Address');
        // Save data in users table
        $storeQry = User::saverecord($firstNm,$lastNm,$email,$password,$phno,$Address);
        echo "Data saved successfully";

    }

    public function saveEditData(Request $request){
        $editId = $request->input('editId');
        $firstNm = $request->input('firstNm');
        $lastNm = $request->input('lastNm');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $phno = $request->input('phno');
        $Address = $request->input('Address');
        // data edited in users table
        $storeQry = User::saveeditrecord($editId,$firstNm,$lastNm,$email,$password,$phno,$Address);
        echo "Data edited successfully";
    }

    public function fetchRecord(){
        $fetchdata = User::fetchRecords();
        echo json_encode($fetchdata);
    }

    public function deleteRecord(Request $request){
        $id = $request->input('id');
        $deleteQry = User::deleteQry($id);
        echo json_encode($deleteQry);
    }

    public function fetchSingleRecord($id)
    {
        $fetchSngleQry = User::fetchsingleRecord($id);
        echo json_encode($fetchSngleQry);
    }
}
