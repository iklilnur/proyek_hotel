<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use PDF;

class ReservasiController extends Controller
{
    public function read_reservasi(){
        //mengambil data
        $reservasi = DB::table('reservasi')
            ->join('pembayaran','reservasi.no_reservasi', '=', 'pembayaran.no_reservasi')
            ->select('reservasi.*','pembayaran.*')
            ->get();
        $detail = DB::table('detail_reservasi')->get();
        $pembayaran = DB::table('pembayaran')->get();
        $kamar = DB::table('kamar')->get();


        $data = [
            'reservasi' => $reservasi,
            'detail' => $detail,
            'kamar' => $kamar
        ];
       

        $session_nama = Session::get('session_no_peg');        
        $session_jabatan = Session::get('session_jabatan_peg');
        //mengembalikan view
        if($session_jabatan == null){
            return view('user_not_found');
        }
        else{
            return view('list_reservasi',['data' => $data],['session_jabatan' => $session_jabatan]);
        }
    }

    public function input_reservasi(){
        //mengambil data dari kamar
        $kamar = DB::table('kamar')->get();

        //menaruh session variable
        $session_nama = Session::get('session_no_peg');        
        $session_jabatan = Session::get('session_jabatan_peg');

        //data
        $date_now = date('Y-m-d');
        $data = [
            'date_now' => $date_now,
            'session_jabatan' => $session_jabatan
        ];

        //mengembalikan view
        if($session_jabatan == null){
            return view('user_not_found');
        }
        else{
            return view('tambah_reservasi',['kamar'=>$kamar], ['data' => $data]);
        }
    }

    public function konfirmasi_reservasi(Request $request){
        //menaruh session variable
        $session_nama = Session::get('session_no_peg');        
        $session_jabatan = Session::get('session_jabatan_peg');
        $carbon_checkin = Carbon::createFromDate($request->tgl_checkin);
        $carbon_checkout = Carbon::createFromDate($request->tgl_checkout);

        $day_diff = $carbon_checkout->diffInDays($carbon_checkin);
        $day_diff = (int) $day_diff;

        $request->validate([
            'lama_inap' => "gte:$day_diff",
            'tgl_checkin' => "before:$request->tgl_checkout",
            'tgl_checkout' => "after:$request->tgl_checkin",
            'no_ktp' => "numeric|digits_between:16,16",
            'nama_penanggungjawab' => "min:8|max:50"
        ]);

        $total_harga = 0;
        //menyimpan data dari halaman input_reservasi
        $kamarDB = DB::table('kamar')->get();
        foreach($kamarDB as $k){
            if($k->no_kamar == $request->kamar1){
                $harga1 = $k->harga_kamar;
                $total_harga = $total_harga + $harga1;
            }
            if($k->no_kamar == $request->kamar2){
                $harga2 = $k->harga_kamar;
                $total_harga = $total_harga + $harga2;
            }
            if($k->no_kamar == $request->kamar3){
                $harga3 = $k->harga_kamar;
                $total_harga = $total_harga + $harga3;
            }
        }
        $lama_inap = $request->lama_inap;
        $total_harga = $total_harga*$lama_inap;
        $uang_muka = $total_harga*(0.5);

        
        $data = [
            'kamar1' => $request->kamar1,
            'kamar2' => $request->kamar2,
            'kamar3' => $request->kamar3,
            'checkin' => $request->tgl_checkin,
            'checkout' => $request->tgl_checkout,
            'no_ktp' => $request->no_ktp,
            'session_jabatan' => $session_jabatan,
            'lama_inap' => $request->lama_inap,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'total_harga' => $total_harga,
            'uang_muka' => $uang_muka,
            'nama_penanggungjawab' => $request->nama_penanggungjawab,
        ];

        //mengembalikan view
        if($data['session_jabatan'] == null){
            return view('user_not_found');
        }
        else{
            return view('konfirmasi_reservasi',['kamarDB'=>$kamarDB],['data'=>$data]);
        }
    }

    public function konfirmasi_edit_reservasi(Request $request){
        //menaruh session variable
        $session_nama = Session::get('session_no_peg');        
        $session_jabatan = Session::get('session_jabatan_peg');

        $carbon_checkin = Carbon::createFromDate($request->tgl_checkin);
        $carbon_checkout = Carbon::createFromDate($request->tgl_checkout);

        $day_diff = $carbon_checkout->diffInDays($carbon_checkin);
        $day_diff = (int) $day_diff;

        $request->validate([
            'lama_inap' => "gte:$day_diff",
            'tgl_checkin' => "before:$request->tgl_checkout",
            'tgl_checkout' => "after:$request->tgl_checkin",
            'no_ktp' => "numeric|digits_between:16,16",
            'nama_penanggungjawab' => "min:8|max:50"
        ]);


        $total_harga = 0;
        //menyimpan data dari halaman input_reservasi
        $kamarDB = DB::table('kamar')->get();
        foreach($kamarDB as $k){
            if($k->no_kamar == $request->kamar1){
                $harga1 = $k->harga_kamar;
                $total_harga = $total_harga + $harga1;
            }
            if($k->no_kamar == $request->kamar2){
                $harga2 = $k->harga_kamar;
                $total_harga = $total_harga + $harga2;
            }
            if($k->no_kamar == $request->kamar3){
                $harga3 = $k->harga_kamar;
                $total_harga = $total_harga + $harga3;
            }
        }
        $lama_inap = $request->lama_inap;
        $total_harga = $total_harga*$lama_inap;
        $uang_muka = $total_harga*(0.5);

        
        $data = [
            'kamar1' => $request->kamar1,
            'kamar2' => $request->kamar2,
            'kamar3' => $request->kamar3,
            'checkin' => $request->tgl_checkin,
            'checkout' => $request->tgl_checkout,
            'no_ktp' => $request->no_ktp,
            'session_jabatan' => $session_jabatan,
            'lama_inap' => $request->lama_inap,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'total_harga' => $total_harga,
            'uang_muka' => $uang_muka,
            'nama_penanggungjawab' => $request->nama_penanggungjawab,
            'no_reservasi' => $request->no_reservasi
        ];

        //mengembalikan view
        if($data['session_jabatan'] == null){
            return view('user_not_found');
        }
        else{
            return view('konfirmasi_edit_reservasi',['kamarDB'=>$kamarDB],['data'=>$data]);
        }

    }

    public function reservation_confirmation(Request $request){
        Session::put('pesan_reservasi',"");
        $carbon_checkin = Carbon::createFromDate($request->tgl_checkin);
        $carbon_checkout = Carbon::createFromDate($request->tgl_checkout);

        $day_diff = $carbon_checkout->diffInDays($carbon_checkin);
        $day_diff = (int) $day_diff;

        $request->validate([
            'lama_inap' => "gte:$day_diff",
            'tgl_checkin' => "before:$request->tgl_checkout",
            'tgl_checkout' => "after:$request->tgl_checkin",
            'no_ktp' => "numeric|digits_between:16,16",
            'nama_penanggungjawab' => "min:8|max:50"
        ]);

        $total_harga = 0;
        //menyimpan data dari halaman input_reservasi
        $kamarDB = DB::table('kamar')->get();
        foreach($kamarDB as $k){
            if($k->no_kamar == $request->kamar1){
                $harga1 = $k->harga_kamar;
                $total_harga = $total_harga + $harga1;
            }
            if($k->no_kamar == $request->kamar2){
                $harga2 = $k->harga_kamar;
                $total_harga = $total_harga + $harga2;
            }
            if($k->no_kamar == $request->kamar3){
                $harga3 = $k->harga_kamar;
                $total_harga = $total_harga + $harga3;
            }
        }
        $lama_inap = $request->lama_inap;
        $total_harga = $total_harga*$lama_inap;
        $uang_muka = $total_harga*(0.5);

        
        $data = [
            'kamar1' => $request->kamar1,
            'kamar2' => $request->kamar2,
            'kamar3' => $request->kamar3,
            'checkin' => $request->tgl_checkin,
            'checkout' => $request->tgl_checkout,
            'no_ktp' => $request->no_ktp,
            'session_no_customer' => Session::get('session_no_customer'),
            'lama_inap' => $request->lama_inap,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'total_harga' => $total_harga,
            'uang_muka' => $uang_muka,
            'nama_penanggungjawab' => $request->nama_penanggungjawab,
        ];

        //mengembalikan view
        if($data['session_no_customer'] == null){
            Session::put('pesan_reservasi',"Silahkan login terlebih dahulu");
            return redirect('reservation');
        }
        else{
            Session::put('pesan_reservasi',"");
            return view('reservation_confirmation',['kamarDB'=>$kamarDB],['data'=>$data]);
        }
    }

    public function store_reservasi(Request $request){
        $session_jabatan_peg = Session::get('session_jabatan_peg');
        $session_no_customer = Session::get('session_no_customer');
        $session_no_pegawai = Session::get('session_nomor_pegawai');

        $minimum = $request->total_harga*0.5;

        $request->validate([
            'uang_muka' => "gte:$minimum|lt:$request->total_harga"
        ]);


        if($session_jabatan_peg == null){
            DB::table('reservasi')->insert([
                'tgl_reservasi' => date('Y-m-d'),
                'tgl_checkin' => $request->tgl_checkin,
                'tgl_checkout' => $request->tgl_checkout,
                'no_customer' => $session_no_customer,
                'nomor_ktp' => $request->no_ktp,
                'nama_penanggungjawab' => $request->nama_penanggungjawab
            ]);
        }
        else{
            DB::table('reservasi')->insert([
                'tgl_reservasi' => date('Y-m-d'),
                'tgl_checkin' => $request->tgl_checkin,
                'tgl_checkout' => $request->tgl_checkout,
                'no_pegawai' => $session_no_pegawai,
                'nomor_ktp' => $request->no_ktp,
                'nama_penanggungjawab' => $request->nama_penanggungjawab
            ]);
        }


        //pengisian detail_reservasi
        $reservasi_baru = DB::table('reservasi')->where('no_pembayaran',null)->get();
        foreach($reservasi_baru as $r){
            $no_reservasi = $r->no_reservasi;
        }

        $kamarDB = DB::table('kamar')->get();
        foreach($kamarDB as $k){
            if($k->no_kamar == $request->kamar1){
                foreach($reservasi_baru as $r){
                    DB::table('detail_reservasi')->insert([
                        'nomor_ktp'=>$request->no_ktp,
                        'no_reservasi'=>$r->no_reservasi,
                        'no_kamar'=>$request->kamar1
                    ]);
                    DB::table('kamar')->where('no_kamar', $request->kamar1)->update([
                        'status_kamar' => "Dipesan"
                    ]);
                }
            }
            if($k->no_kamar == $request->kamar2){
                foreach($reservasi_baru as $r){
                    DB::table('detail_reservasi')->insert([
                        'nomor_ktp'=>$request->no_ktp,
                        'no_reservasi'=>$r->no_reservasi,
                        'no_kamar'=>$request->kamar2
                    ]);
                    DB::table('kamar')->where('no_kamar', $request->kamar2)->update([
                        'status_kamar' => "Dipesan"
                    ]);
                }
            }
            if($k->no_kamar == $request->kamar3){
                foreach($reservasi_baru as $r){
                    DB::table('detail_reservasi')->insert([
                        'nomor_ktp'=>$request->no_ktp,
                        'no_reservasi'=>$r->no_reservasi,
                        'no_kamar'=>$request->kamar3
                    ]);
                    DB::table('kamar')->where('no_kamar', $request->kamar3)->update([
                        'status_kamar' => "Dipesan"
                    ]);
                }
            }
        }

        //pengisian ke tabel pembayaran
        $sisa_pembayaran = ($request->total_harga) - ($request->uang_muka);
        foreach($reservasi_baru as $r){
            if($request->jenis_pembayaran == "Bayar diawal"){
                DB::table('pembayaran')->insert([
                    'status_pembayaran'=>1,
                    'total_pembayaran'=>$request->total_harga,
                    'sisa_pembayaran'=>0,
                    'no_reservasi'=> $r->no_reservasi
                ]);
            }
            else{
                DB::table('pembayaran')->insert([
                    'status_pembayaran'=>0,
                    'total_pembayaran'=>$request->total_harga,
                    'sisa_pembayaran'=>$sisa_pembayaran,
                    'no_reservasi'=> $r->no_reservasi
                ]);
            }
        }

        //pengisian no_pembayaran ke tabel reservasi
        $pembayaran = DB::table('pembayaran')->where('no_reservasi',$no_reservasi)->get();
        foreach($pembayaran as $p){
            $no_pembayaran = $p->no_pembayaran;
        }
        DB::table('reservasi')->where('no_reservasi',$no_reservasi)->update([
            'no_pembayaran' => $no_pembayaran
        ]);

        return redirect('/pegawai/list_reservasi');
        
    }

    public function store_reservation(Request $request){
        $session_jabatan_peg = Session::get('session_jabatan_peg');
        $session_no_customer = Session::get('session_no_customer');
        $session_no_pegawai = Session::get('session_nomor_pegawai');

        $minimum = $request->total_harga*0.5;

        $request->validate([
            'uang_muka' => "gte:$minimum|lt:$request->total_harga"
        ]);


        if($session_jabatan_peg == null){
            DB::table('reservasi')->insert([
                'tgl_reservasi' => date('Y-m-d'),
                'tgl_checkin' => $request->tgl_checkin,
                'tgl_checkout' => $request->tgl_checkout,
                'no_customer' => $session_no_customer,
                'nomor_ktp' => $request->no_ktp,
                'nama_penanggungjawab' => $request->nama_penanggungjawab
            ]);
        }
        else{
            DB::table('reservasi')->insert([
                'tgl_reservasi' => date('Y-m-d'),
                'tgl_checkin' => $request->tgl_checkin,
                'tgl_checkout' => $request->tgl_checkout,
                'no_pegawai' => $session_no_pegawai,
                'nomor_ktp' => $request->no_ktp,
                'nama_penanggungjawab' => $request->nama_penanggungjawab
            ]);
        }


        //pengisian detail_reservasi
        $reservasi_baru = DB::table('reservasi')->where('no_pembayaran',null)->get();
        foreach($reservasi_baru as $r){
            $no_reservasi = $r->no_reservasi;
        }

        $kamarDB = DB::table('kamar')->get();
        foreach($kamarDB as $k){
            if($k->no_kamar == $request->kamar1){
                foreach($reservasi_baru as $r){
                    DB::table('detail_reservasi')->insert([
                        'nomor_ktp'=>$request->no_ktp,
                        'no_reservasi'=>$r->no_reservasi,
                        'no_kamar'=>$request->kamar1
                    ]);
                    DB::table('kamar')->where('no_kamar', $request->kamar1)->update([
                        'status_kamar' => "Dipesan"
                    ]);
                }
            }
            if($k->no_kamar == $request->kamar2){
                foreach($reservasi_baru as $r){
                    DB::table('detail_reservasi')->insert([
                        'nomor_ktp'=>$request->no_ktp,
                        'no_reservasi'=>$r->no_reservasi,
                        'no_kamar'=>$request->kamar2
                    ]);
                    DB::table('kamar')->where('no_kamar', $request->kamar2)->update([
                        'status_kamar' => "Dipesan"
                    ]);
                }
            }
            if($k->no_kamar == $request->kamar3){
                foreach($reservasi_baru as $r){
                    DB::table('detail_reservasi')->insert([
                        'nomor_ktp'=>$request->no_ktp,
                        'no_reservasi'=>$r->no_reservasi,
                        'no_kamar'=>$request->kamar3
                    ]);
                    DB::table('kamar')->where('no_kamar', $request->kamar3)->update([
                        'status_kamar' => "Dipesan"
                    ]);
                }
            }
        }

        //pengisian ke tabel pembayaran
        $sisa_pembayaran = ($request->total_harga) - ($request->uang_muka);
        foreach($reservasi_baru as $r){
            if($request->jenis_pembayaran == "Bayar diawal"){
                DB::table('pembayaran')->insert([
                    'status_pembayaran'=>1,
                    'total_pembayaran'=>$request->total_harga,
                    'sisa_pembayaran'=>0,
                    'no_reservasi'=> $r->no_reservasi
                ]);
            }
            else{
                DB::table('pembayaran')->insert([
                    'status_pembayaran'=>0,
                    'total_pembayaran'=>$request->total_harga,
                    'sisa_pembayaran'=>$sisa_pembayaran,
                    'no_reservasi'=> $r->no_reservasi
                ]);
            }
        }

        //pengisian no_pembayaran ke tabel reservasi
        $pembayaran = DB::table('pembayaran')->where('no_reservasi',$no_reservasi)->get();
        foreach($pembayaran as $p){
            $no_pembayaran = $p->no_pembayaran;
        }
        DB::table('reservasi')->where('no_reservasi',$no_reservasi)->update([
            'no_pembayaran' => $no_pembayaran
        ]);

        return redirect('/reservation');
        
    }


    public function delete_reservasi(Request $request){
        //menghapus data sesuai no_reservasi

        $detail = DB::table('detail_reservasi')->where('no_reservasi',$request->no_reservasi)->get();
        $kamar = DB::table('kamar')->get();
        foreach($kamar as $k){
            foreach($detail as $d){
                if($k->no_kamar == $d->no_kamar){
                    DB::table('kamar')->where('no_kamar',$k->no_kamar)->update([
                        'status_kamar' => "Tersedia"
                    ]);
                }
            }
        }
        DB::table('reservasi')->where('no_reservasi', $request->no_reservasi)->delete();

        

        //mengembalikan view
        return redirect('/pegawai/list_reservasi');
    }

    public function edit_reservasi(Request $request){
        $session_nama = Session::get('session_no_peg');
        $session_jabatan = Session::get('session_jabatan_peg');

        //mengambil data
        $reservasi = DB::table('reservasi')->where('reservasi.no_reservasi',$request->no_reservasi)
            ->join('pembayaran','reservasi.no_reservasi','=','pembayaran.no_reservasi')
            ->select('reservasi.*','pembayaran.*')
            ->get();

        $detail = DB::table('detail_reservasi')->where('no_reservasi',$request->no_reservasi)->get();
        $kamar = DB::table('kamar')->get();
        $kamar1 = "Tidak Dipesan";
        $kamar2 = "Tidak Dipesan";
        $kamar3 = "Tidak Dipesan";
        
        foreach($reservasi as $r){
            $tgl_checkin = Carbon::createFromDate($r->tgl_checkin);
            $tgl_checkout = Carbon::createFromDate($r->tgl_checkout);
            $lama_inap = $tgl_checkout->diffInDays($tgl_checkin);
        }

        foreach($detail as $d){
            foreach($kamar as $k){
                if($k->no_kamar == $d->no_kamar && $kamar1 == "Tidak Dipesan"){
                    $kamar1 = DB::table('kamar')->where('no_kamar',$k->no_kamar)->get();
                    foreach($kamar1 as $k1){
                        $no_kamar1 = $k1->no_kamar;
                    }
                }
                elseif($k->no_kamar == $d->no_kamar && $kamar2 == "Tidak Dipesan" && $d->no_kamar != $no_kamar1){
                    $kamar2 = DB::table('kamar')->where('no_kamar',$k->no_kamar)->get();
                    foreach($kamar2 as $k2){
                        $no_kamar2 = $k2->no_kamar;
                    }
                }
                elseif($k->no_kamar == $d->no_kamar && $kamar3 == "Tidak Dipesan" && $d->no_kamar != $no_kamar1){
                    $kamar3 = DB::table('kamar')->where('no_kamar',$k->no_kamar)->get();
                }
            }
        }
        $date_now = date('Y-m-d');

        $data=[
            'reservasi'=>$reservasi,
            'detail'=>$detail,
            'kamar'=>$kamar,
            'kamar1'=>$kamar1,
            'kamar2'=>$kamar2,
            'kamar3'=>$kamar3,
            'lama_inap'=>$lama_inap,
            'date_now'=>$date_now
        ];

        //return view
        return view('edit_reservasi',['data'=>$data],['session_jabatan'=>$session_jabatan]);
    }

    public function update_reservasi(Request $request){
        $request->validate([
            'uang_muka' => "gte:$minimum|lt:$request->total_harga"
        ]);

        //update tabel reservasi
        DB::table('reservasi')->where('no_reservasi',$request->no_reservasi)->update([
            'tgl_checkin' => $request->tgl_checkin,
            'tgl_checkout' => $request->tgl_checkout,
            'nomor_ktp' => $request->no_ktp,
            'nama_penanggungjawab' => $request->nama_penanggungjawab
        ]);

        //update tabel detail reservasi
        $kamarDB = DB::table('kamar')->get();
        $detail_reservasi = DB::table('detail_reservasi')->where('no_reservasi',$request->no_reservasi)->get();
        //delete detail_reservasi yang lama
        DB::table('detail_reservasi')->where('no_reservasi',$request->no_reservasi)->delete();
        //insert data setelah diedit
        DB::table('detail_reservasi')->insert([
            'nomor_ktp' => $request->no_ktp,
            'no_reservasi' => $request->no_reservasi,
            'no_kamar'=> $request->kamar1
        ]);
        if($request->kamar2 != "Tidak Dipesan"){
            DB::table('detail_reservasi')->insert([
                'nomor_ktp' => $request->no_ktp,
                'no_reservasi' => $request->no_reservasi,
                'no_kamar'=> $request->kamar2
            ]);
        }
        if($request->kamar3 != "Tidak Dipesan"){
            DB::table('detail_reservasi')->insert([
                'nomor_ktp' => $request->no_ktp,
                'no_reservasi' => $request->no_reservasi,
                'no_kamar'=> $request->kamar3
            ]);
        }


        //update ke tabel pembayaran
        $sisa_pembayaran = ($request->total_harga) - ($request->uang_muka);
        if($request->jenis_pembayaran == "Bayar diawal"){
            DB::table('pembayaran')->where('no_reservasi',$request->no_reservasi)->update([
                'status_pembayaran'=>1,
                'total_pembayaran'=>$request->total_harga,
                'sisa_pembayaran'=>0,
            ]);
        }
        else{
            DB::table('pembayaran')->where('no_reservasi',$request->no_reservasi)->update([
                'status_pembayaran'=>0,
                'total_pembayaran'=>$request->total_harga,
                'sisa_pembayaran'=>$sisa_pembayaran,
            ]);
        }

        return redirect('/pegawai/list_reservasi');
    }

    public function cetak_nota($no_reservasi){
        $kamar = DB::table('kamar')->get();
        $date_now = date('Y-m-d');
        $reservasi = DB::table('reservasi')->where('no_reservasi', $no_reservasi )->get();
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

        $pdf = PDF::loadview('cetak_nota',['data'=>$data],['kamar'=>$kamar]);
        return $pdf->download('bukti-reservasi-pdf');
    }
}
