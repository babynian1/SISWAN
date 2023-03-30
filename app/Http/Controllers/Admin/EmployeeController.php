<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index(){
        if(Auth::check()){
            return view('admin.employee.index');
        }

        return redirect("login")->withSuccess('Opps! kamu tidak memiliki akses!');
    }
}
