<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Salary extends DB
{
    //
    protected $fillable = [
        'name',
    ];

    public function tempSalary(){
        return '4500';
    }

    public function setSalary($salary){
        return $salary + 4500;
    }

    //public function getUserInfo($name){
    //    $users1 = DB::selectOne('select id,name,email from users where name = ?', array($name));
        //$users1 = DB::select('select * from users');
    //    return $users1->id.  ' is a ' .$users1->name;
   // }


    // public function insertUserInfo($name,$emailadd,$password){
    //     DB::insert('insert into users(name,email,password)values(?,?,?)', array($name,$emailadd,$password));
    //     //$users1 = DB::select('select * from users');
    //     return 'Insert Successful!';
    // }

    // public function updateUserInfo($name,$emailadd,$password,$id){
    //     DB::update('Update users set name=?,email=?,password=?  where id=?', array($name,$emailadd,$password,$id));
    //     //$users1 = DB::select('select * from users');
    //     return 'Insert Successful!';
    // }

    public function DeleteUserInfo($id){
        DB::delete('delete from  users where id=?', array($id));
        //$users1 = DB::select('select * from users');
        return 'Insert Successful!';
    }



}
