<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JabatanController extends Controller
{
    public function index(){
        if(Auth::check()){
            $positions = Jabatan::all();
            $units = Unit::all();

            return view('admin.position.index', compact('positions','units'));
        }
  
        return redirect("login")->withSuccess('Opps! kamu tidak memiliki akses!');
    }

     public function store(Request $request){
        if(Auth::check()){
            try {
                $request->validate([
                    'name_pos' => 'required',
                    'unit' => 'required'
                ]);

                $store = Jabatan::create([
                    'position_name' => $request->name_pos,
                    'description' => $request->desc_pos,
                    'unit_id' => $request->unit
                ]);

                if($store){
                    return redirect()->back()->with('success', 'Position Berhasil di tambahkan ...');
                } 

                return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi');
            }
        }

        return redirect("login")->withSuccess('Opps! kamu tidak memiliki akses!');
    }


    public function getJabatan(Request $request){
        if(Auth::check()){
            try {
                $id = $request->id;
        
                $positions = Jabatan::where('id', $id)->first();
                
                return response()->json(['success' => true, 'data' => $positions]);
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
        
                $positions = Jabatan::where('id', $id)->update([
                    'position_name' => $request->name_Jabatan,
                    'description' => $request->desc_Jabatan,
                ]);
                
                if($positions){
                    return redirect()->back()->with('success', 'Jabatan Berhasil di update ...');
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
        
                $positions = Jabatan::find($id)->delete();
                
                if($positions){
                    return redirect()->back()->with('success', 'Jabatan Berhasil di hapus ...');
                } 

                return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi');
            } catch (\Throwable $th) {
                return redirect()->back()->with('success', 'Terjadi kesalahan, silahkan refresh halaman dan coba lagi false');
            }
        } 

        return redirect()->back()->with('success', 'Opps!, kamu tidak memiliki akses!');
    }
}
