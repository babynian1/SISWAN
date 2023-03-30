<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(){
        if(Auth::check()){
            $users = User::all();
            return view('admin.user.index', compact('users'));
        }
        
        return redirect("login")->withSuccess('Opps! kamu tidak memiliki akses!');
    }
}
