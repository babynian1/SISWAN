<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Jabatan;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index(){
        if(Auth::check()){
            $units = Unit::all();
            $employe = Employee::with('unit')->get();
            return view('admin.employee.index', compact('units', 'employe'));
        }

        return redirect("login")->withSuccess('Opps! kamu tidak memiliki akses!');
    }

    public function get_position(Request $request){
        if(Auth::check()){
            $id = $request->uid;
            
            $datas = Jabatan::where('unit_id', $id)->get();

            return response()->json(['success' => true, 'data' => $datas]);
        }

        return response()->json(['success' => false, 'msg' => 'Opps!, kamu tidak memiliki akses!']);
    }

    public function store(Request $request){
        if(Auth::check()){
            $request->validate([
                'unit' => 'required',
                'pos' => 'required',
                'name' => 'required',
                'date_join' => 'required',
            ]);
            
            $store = Employee::create([
                'employee_name' => $request->name,
                'unit_id' => $request->unit,
                'position_id' => json_encode($request->pos),
                'date_join' => $request->date_join,
            ]);

            if($store){
                return redirect()->back()->with('success', 'Karyawan Berhasil di tambahkan ...');
            } 

            return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi');

    }


    public function edit(Request $request){
        if(Auth::check()){
            try {
                $id = $request->id;
        
                $employe = Employee::where('id', $id)->first();
                
                return response()->json(['success' => true, 'data' => $employe]);
            } catch (\Throwable $th) {
                return response()->json(['success' => false, 'msg' => 'Opps!, terjadi kesalahan, silahkan refresh halaman dan coba lagi!']);
            }
        }
        
        return response()->json(['success' => false, 'msg' => 'Opps!, kamu tidak memiliki akses!']);
    }

    public function update(Request $request){
        if(Auth::check()){
            try {
                $id = $request->uid;
        
                $positions = Employee::where('id', $id)->update([
                    'employee_name' => $request->name,
                    'unit_id' => $request->unit,
                    'position_id' => json_encode($request->pos),
                    'date_join' => $request->date_join,
                ]);
                
                if($positions){
                    return redirect()->back()->with('success', 'Karyawan Berhasil di update ...');
                } 

                return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Opps!, Terjadi kesalahan, silahkan refresh halaman dan coba lagi!');
            }
        } 
        return redirect()->back()->with('success', 'Opps!, kamu tidak memiliki akses!');
    }

    public function destroy(Request $request){
        if(Auth::check()){
            try {
                $id = $request->id;
        
                $positions = Employee::find($id)->delete();
                
                if($positions){
                    return redirect()->back()->with('success', 'Karyawan Berhasil di hapus ...');
                } 

                return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi');
            } catch (\Throwable $th) {
                return redirect()->back()->with('success', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi false');
            }
        } 

        return redirect()->back()->with('success', 'Opps!, kamu tidak memiliki akses!');
    
    }
}
