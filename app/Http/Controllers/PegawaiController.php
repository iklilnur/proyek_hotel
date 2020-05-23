<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use PDF;

class PegawaiController extends Controller
{
    public function login_pegawai(){
        return view('login_pegawai');
    }

    public function logout_pegawai(){
        Session::flush();

        return redirect('/pegawai/login_pegawai');
    }

    public function cek_pegawai(Request $request){
        if((DB::table('pegawai')->where('password_pegawai',$request->password)->where('no_pegawai',$request->username)->get())->first()){
            $session_pegawai = DB::table('pegawai')->where('no_pegawai',$request->username)->get();
            foreach($session_pegawai as $sp){
                Session::put('session_no_peg',$sp->nama_pegawai);
                Session::put('session_jabatan_peg',$sp->jabatan_pegawai);
                Session::put('session_nomor_pegawai',$sp->no_pegawai);
            }
            $session_nama = Session::get('session_no_peg');
            $session_jabatan = Session::get('session_jabatan_peg');
            return view('home_pegawai',['session_nama'=>$session_nama],['session_jabatan' => $session_jabatan]);
        }
        else{
            Session::put('pesan_login',"Username atau password salah");
            $request->validate([
                'username'=>'min:999999'
            ]);
        }
    }

    public function read_pegawai(){
        //mengambil data dari table pegawai
        $pegawai = DB::table('pegawai')->get();

        //mengambil session variable jabatan
        $session_jabatan = Session::get('session_jabatan_peg');

        //mengirim data pegawai ke view
        if($session_jabatan == null or $session_jabatan == "admin"){
            return view('user_not_found');
        }
        else{
            return view('list_pegawai',['pegawai' => $pegawai],['session_jabatan' => $session_jabatan]);
        }
    }

    public function input_pegawai(){
        $session_nama = Session::get('session_no_peg');        
        $session_jabatan = Session::get('session_jabatan_peg');
        //memanggil view

        if($session_jabatan == null or $session_jabatan =="admin"){
            return view('user_not_found');
        }
        else{
            return view('tambah_pegawai',['session_nama' => $session_nama],['session_jabatan'=>$session_jabatan]);
        }
        
    }

    public function store_pegawai(Request $request){
        //insert data
        Session::put('pesan_nohp_pegawai',"");
        Session::put('pesan_nama_pegawai',"");
        $validated_data = $request->validate([
            'nama_pegawai' => 'min:8|max:50',
            'alamat_pegawai' => 'min:20|max:200',
            'nohp_pegawai' => "digits_between:12,13|numeric",
            'password_pegawai' => "min:8|max:30"
        ]);
       
        if(DB::table('pegawai')->where('nama_pegawai',$request->nama_pegawai)->get()->first()){
            Session::put('pesan_nohp_pegawai',"");
            Session::put('pesan_nama_pegawai',"Nama tersebut sudah ada");
            return back()->withInput();
        }
        elseif(DB::table('pegawai')->where('nohp_pegawai',$request->nohp_pegawai)->get()->first()){
            Session::put('pesan_nohp_pegawai',"Nomor tersebut sudah digunakan");
            Session::put('pesan_nama_pegawai',"");
            return back()->withInput();
        }
        else{
            DB::table('pegawai')->insert([
                'nama_pegawai' => $request-> nama_pegawai,
                'jabatan_pegawai' => $request-> jabatan_pegawai,
                'tgl_lahir_pegawai' => $request-> tgl_lahir_pegawai,
                'alamat_pegawai' => $request-> alamat_pegawai,
                'nohp_pegawai' => $request-> nohp_pegawai,
                'jk_pegawai' => $request-> jk_pegawai,
                'tgl_diterima' => $request-> tgl_diterima,
                'password_pegawai' => $request -> password_pegawai
            ]);
    
            //alihkan
            return redirect('/pegawai/list_pegawai');
        }
    }

    public function edit_pegawai($no_pegawai){
        //mengambil data berdasarkan no_pegawai
        $pegawai = DB::table('pegawai')->where('no_pegawai',$no_pegawai)->get();
        
        $session_nama = Session::get('session_no_peg');        
        $session_jabatan = Session::get('session_jabatan_peg');
        //return view
        if($session_jabatan == null or $session_jabatan == "admin"){
            return view('user_not_found');
        }
        else{
            return view('edit_pegawai',['pegawai'=>$pegawai],['session_jabatan'=>$session_jabatan]);
        }
    }

    public function update_pegawai(Request $request){
        //insert data
        Session::put('pesan_nohp_pegawai',"");
        Session::put('pesan_nama_pegawai',"");
        $validated_data = $request->validate([
            'nama_pegawai' => 'min:8|max:50',
            'alamat_pegawai' => 'min:20|max:200',
            'nohp_pegawai' => "digits_between:12,13|numeric",
            'password_pegawai' => "min:8|max:30"
        ]);
       
        $sedang_edit = DB::table('pegawai')->where('no_pegawai',$request->no_pegawai)->get();

        foreach($sedang_edit as $e){
            if($e->nama_pegawai != $request->nama_pegawai){
                if(DB::table('pegawai')->where('nama_pegawai',$request->nama_pegawai)->get()->first()){
                    Session::put('pesan_nohp_pegawai',"");
                    Session::put('pesan_nama_pegawai',"Nama tersebut sudah ada");
                    return back()->withInput();
                }
               elseif($e->nohp_pegawai != $request->nohp_pegawai){
                   if(DB::table('pegawai')->where('nohp_pegawai',$request->nohp_pegawai)->get()->first()){
                        Session::put('pesan_nohp_pegawai',"Nomor tersebut sudah digunakan");
                        Session::put('pesan_nama_pegawai',"");
                        return back()->withInput();
                    }
                    else{
                        DB::table('pegawai')->where('no_pegawai', $request->no_pegawai)->update([
                            'nama_pegawai' => $request-> nama_pegawai,
                            'jabatan_pegawai' => $request-> jabatan_pegawai,
                            'tgl_lahir_pegawai' => $request-> tgl_lahir_pegawai,
                            'alamat_pegawai' => $request-> alamat_pegawai,
                            'nohp_pegawai' => $request-> nohp_pegawai,
                            'jk_pegawai' => $request-> jk_pegawai,
                            'tgl_diterima' => $request-> tgl_diterima,
                            'password_pegawai' => $request -> password_pegawai
                        ]);
                
                        //alihkan
                        return redirect('/pegawai/list_pegawai');
                    }
               }
            }
            elseif($e->nohp_pegawai != $request->nohp_pegawai){
                if(DB::table('pegawai')->where('nohp_pegawai',$request->nohp_pegawai)->get()->first()){
                    Session::put('pesan_nohp_pegawai',"Nomor tersebut sudah digunakan");
                    Session::put('pesan_nama_pegawai',"");
                    return back()->withInput();
                }
                else{
                    DB::table('pegawai')->where('no_pegawai', $request->no_pegawai)->update([
                        'nama_pegawai' => $request-> nama_pegawai,
                        'jabatan_pegawai' => $request-> jabatan_pegawai,
                        'tgl_lahir_pegawai' => $request-> tgl_lahir_pegawai,
                        'alamat_pegawai' => $request-> alamat_pegawai,
                        'nohp_pegawai' => $request-> nohp_pegawai,
                        'jk_pegawai' => $request-> jk_pegawai,
                        'tgl_diterima' => $request-> tgl_diterima,
                        'password_pegawai' => $request -> password_pegawai
                    ]);
            
                    //alihkan
                    return redirect('/pegawai/list_pegawai');
                }
            }
            else{
                DB::table('pegawai')->where('no_pegawai', $request->no_pegawai)->update([
                    'nama_pegawai' => $request-> nama_pegawai,
                    'jabatan_pegawai' => $request-> jabatan_pegawai,
                    'tgl_lahir_pegawai' => $request-> tgl_lahir_pegawai,
                    'alamat_pegawai' => $request-> alamat_pegawai,
                    'nohp_pegawai' => $request-> nohp_pegawai,
                    'jk_pegawai' => $request-> jk_pegawai,
                    'tgl_diterima' => $request-> tgl_diterima,
                    'password_pegawai' => $request -> password_pegawai
                ]);
        
                //alihkan
                return redirect('/pegawai/list_pegawai');
                
            }
        }
    }

    public function delete_pegawai($no_pegawai){
        //menghapus data sesuai no_pegawai
        DB::table('pegawai')->where('no_pegawai',$no_pegawai)->delete();

        //mengembalikan view
        return redirect('/pegawai/list_pegawai');
    }

    public function home_pegawai(){
        $session_nama = Session::get('session_no_peg');
        $session_jabatan = Session::get('session_jabatan_peg');

        //return view home
        if($session_jabatan == null){
            return view('user_not_found');
        }
        else{
            return view('home_pegawai',['session_nama'=>$session_nama],['session_jabatan'=>$session_jabatan]);
        }
        
    }

    public function search_pegawai(Request $request){
        $pegawai = DB::table('pegawai')
        ->where('jabatan_pegawai','like','%'.$request->search_pegawai.'%')
        ->orWhere('nama_pegawai','like','%'.$request->search_pegawai.'%')
        ->orWHere('alamat_pegawai','like','%'.$request->search_pegawai.'%')
        ->orWHere('tgl_lahir_pegawai','like','%'.$request->search_pegawai.'%')
        ->orWHere('nohp_pegawai','like','%'.$request->search_pegawai.'%')
        ->get();

        $session_nama = Session::get('session_no_peg');
        $session_jabatan = Session::get('session_jabatan_peg');

        if($session_jabatan == null or $session_jabatan == "admin"){
            return view('user_not_found');
        }
        else{
            return view('/list_pegawai',['pegawai' => $pegawai],['session_jabatan'=>$session_jabatan]);
        }
    }

    public function cetak_pdf(){
        $pegawai = DB::table('pegawai')->get();

        $pdf = PDF::loadview('pegawai_pdf',['pegawai' => $pegawai]);
        return $pdf->download('laporan-pegawai-pdf');
    }
}
