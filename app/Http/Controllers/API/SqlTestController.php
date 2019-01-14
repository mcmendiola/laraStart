<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Salary;

class SqlTestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users1 = DB::select('select * from users where name = ?', array('435345'));
        $salary = new Salary();
        //$salary1 = new Salary();
        //return $salary->getUserInfo('admin'); 
        //return $salary->insertUserInfo('mervin','mevin@me.com','password');
        //return $salary->updateUserInfo('mervin mendiola','mervin@me.com','password','28');
        return $salary->DeleteUserInfo('28');
        
        
        //return 'Connected to ' .$name;
    } 

    public function getDBInfo(){
        return ['message' => 'Updated the user infofff']; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
