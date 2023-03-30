<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Jabatan;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function do_login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Kamu berhasil login ....');
        }

        return redirect("login")->withSuccess('Oppes! username atau password tidak sesuai!');
    }

    public function dashboard()
    {
        if(Auth::check()){
            $count_unit = Unit::count();
            $count_pos = Jabatan::count();
            $count_user = User::count();
            $count_emp = Employee::count();

            return view('admin.dashboard.index', compact('count_unit','count_pos','count_user', 'count_emp'));
        }
  
        return redirect("login")->withSuccess('Opps! kamu tidak memiliki akses!');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
