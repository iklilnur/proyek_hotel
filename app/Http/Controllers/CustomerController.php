<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class CustomerController extends Controller
{
    public function home_customer(){
        $status = Session::get('status');
        if($status == ""){
            $status = "customer";
        }
        else{
            $status= "loggedin";
        }
        $data_session = [
            'status'=>$status
        ];
        return view('home_customer',['data_session'=>$data_session]);
    }

    public function reservation(){
        $kamar = DB::table('kamar')->get();
        $date_now = date('Y-m-d');
        $reservasi = DB::table('reservasi')->where('no_customer',Session::get('session_no_customer'))->get();
        $detail_reservasi = DB::table('detail_reservasi')->get();

        $status = Session::get('status');
        if($status == ""){
            $status = "customer";
        }
        $data = [
            'status'=>$status,
            'date_now'=>$date_now,
            'reservasi'=>$reservasi,
            'detail_reservasi'=>$detail_reservasi
        ];
        return view('reservation',['data'=>$data],['kamar'=>$kamar]);
    }

    public function rooms(){
        $status = Session::get('status');
        if($status == ""){
            $status = "customer";
        }
        $data_session = [
            'status'=>$status
        ];
        return view('rooms',['data_session'=>$data_session]);
    }

    public function login_customer(){
        $pesan_login = Session::get('pesan_login');
        return view('login');
    }

    public function logout_customer(){
        Session::flush();

        return redirect('/');
    }
    
    public function signup_customer(){
        $pesan_nohp = Session::get('pesan_nohp');
        $pesan_username = Session::get('pesan_username');
        $condition = [
            'pesan_username' => $pesan_username,
            'pesan_nohp' => $pesan_nohp
        ];
        return view('sign_up_customer',['condition'=>$condition]);
    }

    public function cek_customer(Request $request){
        if((DB::table('customer')->where('password',$request->password)->where('username',$request->username)->get())->first()){
            Session::flush();
            $session_customer = DB::table('customer')->where('username',$request->username)->where('password',$request->password)->get();
            foreach($session_customer as $sc){
                Session::put('session_no_customer',$sc->no_customer);
                Session::put('session_username',$sc->username);
                Session::put('session_nama_customer',$sc->nama_customer);
                
            }
            Session::put('status',"loggedin");
            $session_nama_customer = Session::get('session_nama_customer');
            $session_no_customer = Session::get('session_no_customer');
            $session_username_customer = Session::get('session_username');
            $status = "loggedin";
            $data_session = [
                'session_nama_customer' => $session_nama_customer,
                'session_no_customer' => $session_no_customer,
                'session_username_customer' => $session_username_customer,
                'status' => $status
            ];

            return view('home_customer',['data_session'=>$data_session]);
        }
        else{
            $validate = $request->validate([
                'username'=>"min:9999999"
            ]);
        }
    }

    public function read_customer(){
        //mengambil data dari table pegawai
        $customer = DB::table('customer')->get();

        //mengambil session variable jabatan
        $session_jabatan = Session::get('session_jabatan_peg');

        //mengirim data pegawai ke view
        if($session_jabatan == null){
            return view('user_not_found');
        }
        else{
            return view('list_customer',['customer' => $customer],['session_jabatan' => $session_jabatan]);
        }
    }

    public function search_customer(Request $request){
        $customer = DB::table('customer')
        ->where('no_customer','like','%'.$request->search_customer.'%')
        ->orWhere('nama_customer','like','%'.$request->search_customer.'%')
        ->orWhere('tgl_lahir_customer','like','%'.$request->search_customer.'%')
        ->orWhere('alamat_customer','like','%'.$request->search_customer.'%')
        ->orWhere('nohp_customer','like','%'.$request->search_customer.'%')
        ->orWhere('username','like','%'.$request->search_customer.'%')
        ->orWhere('password','like','%'.$request->search_customer.'%')
        ->get();

        $session_nama = Session::get('session_no_peg');
        $session_jabatan = Session::get('session_jabatan_peg');

        if($session_jabatan == null){
            return view('user_not_found');
        }
        else{
            return view('/list_customer',['customer' => $customer],['session_jabatan'=>$session_jabatan]);
        }
    }

    public function input_customer(){
        $session_nama = Session::get('session_no_peg');        
        $session_jabatan = Session::get('session_jabatan_peg');
        //memanggil view

        if($session_jabatan == null){
            return view('user_not_found');
        }
        else{
            return view('tambah_customer',['session_nama' => $session_nama],['session_jabatan'=>$session_jabatan]);
        }
    }

    public function store_customer(Request $request){
        //insert data
        Session::put('pesan_username_customer',"");
        Session::put('pesan_nohp_customer',"");
        $validated_data = $request->validate([
            'nama_customer' => 'min:8|max:50',
            'alamat_customer' => 'min:20|max:200',
            'nohp_customer' => "digits_between:12,13|numeric",
            'username' => "min:8|max:30",
            'password' => "min:8|max:30"
        ]);
        
        
        
        if(DB::table('customer')->where('nohp_customer',$request->nohp_customer)->get()->first()){
            Session::put('pesan_username_customer',"");
            Session::put('pesan_nohp_customer',"Nomor tersebut sudah digunakan");
            return back()->withInput();
        }
        elseif(DB::table('customer')->where('username',$request->username)->get()->first()){
            Session::put('pesan_nohp_customer',"");
            Session::put('pesan_username_customer',"Username tersebut sudah digunakan");
            return back()->withInput();
        }
        else{
            Session::put('pesan_nohp_customer',"");
            Session::put('pesan_username_customer',"");
                //insert data
            DB::table('customer')->insert([
                'nama_customer' => $request-> nama_customer,
                'tgl_lahir_customer' => $request-> tgl_lahir_customer,
                'alamat_customer' => $request-> alamat_customer,
                'nohp_customer' => $request-> nohp_customer,
                'jk_customer' => $request-> jk_customer,
                'password' => $request -> password,
                'username' => $request-> username
            ]);

             //alihkan
            return redirect('/pegawai/list_customer');
        }
    }

    public function store_signup_customer(Request $request){
        //validate data
        Session::put('pesan_username',"");
        Session::put('pesan_nohp',"");
        $validated_data = $request->validate([
            'nama_customer' => 'min:8|max:50',
            'alamat_customer' => 'min:20|max:200',
            'nohp_customer' => "digits_between:12,13|numeric",
            'username' => "min:8|max:30",
            'password' => "min:8|max:30"
        ]);
        
        
        
        if(DB::table('customer')->where('nohp_customer',$request->nohp_customer)->get()->first()){
            Session::put('pesan_username',"");
            Session::put('pesan_nohp',"Nomor tersebut sudah digunakan");
            return back()->withInput();
        }
        elseif(DB::table('customer')->where('username',$request->username)->get()->first()){
            Session::put('pesan_nohp',"");
            Session::put('pesan_username',"Username tersebut sudah digunakan");
            return back()->withInput();
        }
        else{
            Session::put('pesan_nohp',"");
            Session::put('pesan_username',"");
                //insert data
            DB::table('customer')->insert([
                'nama_customer' => $request-> nama_customer,
                'tgl_lahir_customer' => $request-> tgl_lahir_customer,
                'alamat_customer' => $request-> alamat_customer,
                'nohp_customer' => $request-> nohp_customer,
                'jk_customer' => $request-> jk_customer,
                'password' => $request -> password,
                'username' => $request-> username
            ]);

            $session_customer = DB::table('customer')->where('username',$request->username)->where('password',$request->password)->get();
            foreach($session_customer as $sc){
                Session::put('session_no_customer',$sc->no_customer);
                Session::put('session_username',$sc->username);
                Session::put('session_nama_customer',$sc->nama_customer);
            }
            Session::put('status',"loggedin");
            $session_nama_customer = Session::get('session_nama_customer');
            $session_no_customer = Session::get('session_no_customer');
            $session_username_customer = Session::get('session_username');
            $status = "loggedin";
            $data_session = [
                'session_nama_customer' => $session_nama_customer,
                'session_no_customer' => $session_no_customer,
                'session_username_customer' => $session_username_customer,
                'status' => $status
            ];

            //alihkan
            return redirect('/');
        }
        
    }

    public function delete_customer($no_customer){
        //menghapus data sesuai no_customer
        DB::table('customer')->where('no_customer',$no_customer)->delete();

        //mengembalikan view
        return redirect('/pegawai/list_customer');
    }

    public function edit_customer($no_customer){
        //mengambil data berdasarkan no_pegawai
        $customer = DB::table('customer')->where('no_customer',$no_customer)->get();
        
        $session_nama = Session::get('session_no_peg');        
        $session_jabatan = Session::get('session_jabatan_peg');
        //return view
        if($session_nama == null){
            return view('user_not_found');
        }
        else{
            return view('edit_customer',['customer'=>$customer],['session_jabatan'=>$session_jabatan]);
        }
    }

    public function update_customer(Request $request){
        //insert data
        Session::put('pesan_username_customer',"");
        Session::put('pesan_nohp_customer',"");
        $validated_data = $request->validate([
            'nama_customer' => 'min:8|max:50',
            'alamat_customer' => 'min:20|max:200',
            'nohp_customer' => "digits_between:12,13|numeric",
            'username' => "min:8|max:30",
            'password' => "min:8|max:30"
        ]);

        $sedang_edit = DB::table('customer')->where('no_customer',$request->no_customer)->get();
        
        foreach($sedang_edit as $e){
            if($e->username != $request->username){
                if(DB::table('customer')->where('username',$request->username)->get()->first()){
                    Session::put('pesan_nohp_customer',"");
                    Session::put('pesan_username_customer',"Username tersebut sudah digunakan");
                    return back()->withInput();
                }
                elseif($e->nohp_customer != $request->nohp_customer){
                    if(DB::table('customer')->where('nohp_customer',$request->nohp_customer)->get()->first()){
                        Session::put('pesan_username_customer',"");
                        Session::put('pesan_nohp_customer',"Nomor tersebut sudah digunakan");
                        return back()->withInput();
                    }
                    else{
                        Session::put('pesan_nohp_customer',"");
                        Session::put('pesan_username_customer',"");
                        //insert data
                        DB::table('customer')->where('no_customer',$request->no_customer)->update([
                            'nama_customer' => $request-> nama_customer,
                            'tgl_lahir_customer' => $request-> tgl_lahir_customer,
                            'alamat_customer' => $request-> alamat_customer,
                            'nohp_customer' => $request-> nohp_customer,
                            'jk_customer' => $request-> jk_customer,
                            'password' => $request -> password,
                            'username' => $request-> username
                        ]);
                        
                         //alihkan
                        return redirect('/pegawai/list_customer');
                    }
                }
            }
            elseif($e->nohp_customer != $request->nohp_customer){
                if(DB::table('customer')->where('nohp_customer',$request->nohp_customer)->get()->first()){
                    Session::put('pesan_username_customer',"");
                    Session::put('pesan_nohp_customer',"Nomor tersebut sudah digunakan");
                    return back()->withInput();
                }
                else{
                    Session::put('pesan_nohp_customer',"");
                    Session::put('pesan_username_customer',"");
                    //insert data
                    DB::table('customer')->where('no_customer',$request->no_customer)->update([
                        'nama_customer' => $request-> nama_customer,
                        'tgl_lahir_customer' => $request-> tgl_lahir_customer,
                        'alamat_customer' => $request-> alamat_customer,
                        'nohp_customer' => $request-> nohp_customer,
                        'jk_customer' => $request-> jk_customer,
                        'password' => $request -> password,
                        'username' => $request-> username
                    ]);
                    
                     //alihkan
                    return redirect('/pegawai/list_customer');
                }
            }
            else{
                Session::put('pesan_nohp_customer',"");
                Session::put('pesan_username_customer',"");
                //insert data
                DB::table('customer')->where('no_customer',$request->no_customer)->update([
                    'nama_customer' => $request-> nama_customer,
                    'tgl_lahir_customer' => $request-> tgl_lahir_customer,
                    'alamat_customer' => $request-> alamat_customer,
                    'nohp_customer' => $request-> nohp_customer,
                    'jk_customer' => $request-> jk_customer,
                    'password' => $request -> password,
                    'username' => $request-> username
                ]);
                
                    //alihkan
                return redirect('/pegawai/list_customer');
                
            }
        }
    }
}
