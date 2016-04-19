<?php

namespace App\Http\Controllers;

use App\UserRest;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserRestController extends Controller
{
//    public function index()
//    {
//        if (!Session::has('users')) {
//            $user_1 = new UserRest();
//            $user_1->name = 'gamba';
//            $user_1->surename = 'frita';
//
//            $user_2 = new UserRest();
//            $user_2->name = 'calamar';
//            $user_2->surename = 'torrat';
//
//            $users = array($user_1,$user_2);
//
//            Session::put('users',$users);
//        }
//        return view('UserManagement',compact(Session::get('users')));
//    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            return Employee::orderBy('id', 'asc')->get();
        } else {
            return $this->show($id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $employee = new Employee;

        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->contact_number = $request->input('contact_number');
        $employee->position = $request->input('position');
        $employee->save();

        return 'Employee record successfully created with id ' . $employee->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return Employee::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $employee = Employee::find($id);

        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->contact_number = $request->input('contact_number');
        $employee->position = $request->input('position');
        $employee->save();

        return "Sucess updating user #" . $employee->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
        $employee = Employee::find($request->input('id'));

        $employee->delete();

        return "Employee record successfully deleted #" . $request->input('id');
    }
}
