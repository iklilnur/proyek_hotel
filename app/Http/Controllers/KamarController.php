<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Session;

class KamarController extends Controller
{
    public function read_kamar(){
        //mengambil data
        $kamar = DB::table('kamar')->get();

        $session_nama = Session::get('session_no_peg');        
        $session_jabatan = Session::get('session_jabatan_peg');
        //mengembalikan view
        if($session_jabatan == null){
            return view('user_not_found');
        }
        else{
            return view('list_kamar',['kamar' => $kamar],['session_jabatan' => $session_jabatan]);
        }
    }

    public function input_kamar(){
        $session_nama = Session::get('session_no_peg');        
        $session_jabatan = Session::get('session_jabatan_peg');

        //mengembalikan view
        if($session_jabatan == null){
            return view('user_not_found');
        }
        else{
            return view('tambah_kamar',['session_jabatan'=>$session_jabatan]);
        }

    }

    public function store_kamar(Request $request){
        Session::put('pesan_nama_kamar',"");
        $request->validate([
            'nama_kamar' => "digits_between:3,3|numeric"
        ]);

        if(DB::table('kamar')->where('nama_kamar',$request->nama_kamar)->get()->first()){
            Session::put('pesan_nama_kamar',"Nama kamar tersebut sudah ada");
            return back()->withInput();
        }
        else{
            if($request->tipe_kamar == "Single Bed"){
                $harga_kamar = 500000;
            }
            else{
                $harga_kamar = 750000;
            }
            DB::table('kamar')->insert([
                'nama_kamar' => $request-> nama_kamar,
                'tipe_kamar' => $request-> tipe_kamar,
                'status_kamar' => $request-> status_kamar,
                'harga_kamar' => $harga_kamar
            ]);
    
            //mengembalikan view
            return redirect('pegawai/list_kamar');
        }
    }

    public function edit_kamar($no_kamar){
        //mengambil data kamar berdasarkan no_kamar nya
        $kamar = DB::table('kamar')->where('no_kamar', $no_kamar)->get();

        $session_nama = Session::get('session_no_peg');        
        $session_jabatan = Session::get('session_jabatan_peg');

        //return view
        if($session_jabatan == null){
            return view('user_not_found');
        }
        else{
            return view('edit_kamar',['kamar' => $kamar],['session_jabatan'=>$session_jabatan]);
        }
        
    }
    
    public function update_kamar(Request $request){
        Session::put('pesan_nama_kamar',"");
        $request->validate([
            'nama_kamar' => "digits_between:3,3|numeric"
        ]);

        $sedang_edit = DB::table('kamar')->where('no_kamar',$request->no_kamar)->get();

        foreach($sedang_edit as $e){
            if($e->nama_kamar != $request->nama_kamar){
                if(DB::table('kamar')->where('nama_kamar',$request->nama_kamar)->get()->first()){
                    Session::put('pesan_nama_kamar',"Nama kamar tersebut sudah ada");
                    return back()->withInput();
                }
                else{
                    if($request->tipe_kamar == "Single Bed"){
                        $harga_kamar = 500000;
                    }
                    else{
                        $harga_kamar = 750000;
                    }
                    DB::table('kamar')->where('no_kamar',$request->no_kamar)->update([
                        'nama_kamar' => $request-> nama_kamar,
                        'tipe_kamar' => $request-> tipe_kamar,
                        'status_kamar' => $request-> status_kamar,
                        'harga_kamar' => $harga_kamar
                    ]);
            
                    //mengembalikan view
                    return redirect('pegawai/list_kamar');
                }
            }
            else{
                if($request->tipe_kamar == "Single Bed"){
                    $harga_kamar = 500000;
                }
                else{
                    $harga_kamar = 750000;
                }
                DB::table('kamar')->where('no_kamar',$request->no_kamar)->update([
                    'nama_kamar' => $request-> nama_kamar,
                    'tipe_kamar' => $request-> tipe_kamar,
                    'status_kamar' => $request-> status_kamar,
                    'harga_kamar' => $harga_kamar
                ]);
        
                //mengembalikan view
                return redirect('pegawai/list_kamar');  
            }
        }

      
    }

    public function delete_kamar($no_kamar){
        //menghapus data sesuai no_kamar nya
        DB::table('kamar')->where('no_kamar', $no_kamar)->delete();

        //return view
        return redirect('/pegawai/list_kamar');
    }

    public function search_kamar(Request $request){
        $kamar = DB::table('kamar')
        ->where('tipe_kamar','like','%'.$request->search_kamar.'%')
        ->orWhere('status_kamar','like','%'.$request->search_kamar.'%')
        ->orWHere('nama_kamar','like','%'.$request->search_kamar.'%')
        ->orWhere('harga_kamar','like','%'.$request->search_kamar.'%')
        ->get();

        $session_nama = Session::get('session_no_peg');
        $session_jabatan = Session::get('session_jabatan_peg');

        if($session_jabatan == null){
            return view('user_not_found');
        }
        else{
            return view('/list_kamar',['kamar' => $kamar],['session_jabatan'=>$session_jabatan]);
        }
        
    }
}
