<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    public function index(){
        if(Auth::check()){
            $units = Unit::all();

            return view('admin.unit.index', compact('units'));
        }
  
        return redirect("login")->withSuccess('Opps! kamu tidak memiliki akses!');
    }

    public function store(Request $request){
        if(Auth::check()){
            try {
                $request->validate([
                    'name_unit' => 'required'
                ]);

                $store = Unit::create([
                    'unit_name' => $request->name_unit,
                    'description' => $request->desc_unit,
                ]);

                if($store){
                    return redirect()->back()->with('success', 'Unit Berhasil di tambahkan ...');
                } 

                return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi');
            }
        }

        return redirect("login")->withSuccess('Opps! kamu tidak memiliki akses!');
    }


    public function getUnit(Request $request){
        if(Auth::check()){
            try {
                $id = $request->id;
        
                $unit = Unit::where('id', $id)->first();
                
                return response()->json(['success' => true, 'data' => $unit]);
            } catch (\Throwable $th) {
                return response()->json(['success' => false, 'msg' => 'Opps!, terjadi kesalahan, silahkan refresh halaman dan coba lagi!']);
            }
        } 

        return response()->json(['success' => false, 'msg' => 'Opps!, kamu tidak memiliki akses!']);
    }


    public function update(Request $request){
        if(Auth::check()){
            try {
                $id = $request->id;
        
                $unit = Unit::where('id', $id)->update([
                    'unit_name' => $request->name_unit,
                    'description' => $request->desc_unit,
                ]);
                
                if($unit){
                    return redirect()->back()->with('success', 'Unit Berhasil di update ...');
                } 

                return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi');
            } catch (\Throwable $th) {
                return redirect()->back()->with('success', 'Opps!, kamu tidak memiliki akses!');
            }
        } 
        return redirect()->back()->with('success', 'Opps!, kamu tidak memiliki akses!');
    }

    public function destroy(Request $request){

        if(Auth::check()){
            try {
                $id = $request->id;
        
                $unit = Unit::find($id)->delete();
                
                if($unit){
                    return redirect()->back()->with('success', 'Unit Berhasil di hapus ...');
                } 

                return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi');
            } catch (\Throwable $th) {
                return redirect()->back()->with('success', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi false');
            }
        } 

        return redirect()->back()->with('success', 'Opps!, kamu tidak memiliki akses!');
    }
    
}
