<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    
    protected $primaryKey = "id";
    protected $table = "users";

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'mobileno',
        'address',
        'created_at',
        'updated_at'
    ];

    public static function saverecord($firstNm,$lastNm,$email,$password,$phno,$Address){
        $user = new User();
        $user->firstname = $firstNm;
        $user->lastname = $lastNm;
        $user->email = $email;
        $user->password = $password;
        $user->mobileno = $phno;
        $user->address = $Address;
        $user->save();
    }

    public static function saveeditrecord($editId,$firstNm,$lastNm,$email,$password,$phno,$Address){

        $record = self::find($editId);
        if ($record) {
            $record->firstname = $firstNm;
            $record->lastname = $lastNm;
            $record->email = $email;
            $record->password = $password;
            $record->mobileno = $phno;
            $record->address = $Address;
            $record->save();
            return ['success' => true , 'message' => 'Record edited'];
        } else {
            return ['success' => false, 'message' => 'Record not edited'];
        }

    }

    public static function fetchRecords(){
        $fetchQry = self::orderBy('id','desc')->get();
        return $fetchQry;
    }

    public static function deleteQry($id) {
        $record = self::find($id);
        if ($record) {
            $record->delete();
            return ['success' => true];
        } else {
            return ['success' => false, 'message' => 'Record not found'];
        }
    }

    public static function fetchsingleRecord($id)
    {
        $fetchSnglRcd = self::where('id',$id)->first();
        return $fetchSnglRcd;
    }
    

}
