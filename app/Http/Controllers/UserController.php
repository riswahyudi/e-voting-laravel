<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }
    
    public function votinglogin(){
        return view('user.votinglogin');
    }

    public function cektoken(Request $data){
        $token  = $data->input('usertoken');

        $cek    = DB::table('pemilih')->where(['username' => $token])->first();
        $status = DB::table('pemilih')->where(['username' => $token,
                                                'status' => 1])->first();

        if(!$cek){
            Session::flash('Gagal', 'Token Tidak Ditemukan');
            return redirect('/voting-login');
        }else{
            if($status){
                Session::flash('Gagal', 'Token Yang Anda Input Telah Digunakan');
                return redirect('/voting-login');
            }else{
                $data->session()->put('token', $token);
                return redirect('/voting');
            }
        }
    }
        public function ApiCekToken(Requst $data){
            $token  = $data->usertoken;

            $cek    = DB::table('pemilih')->where(['username' => $token])->first();
            $status = DB::table('pemilih')->where(['username' => $token, 
                                                    'status' => 2])->first();

            if(!$cek){
                return response()->json([
                    'success' => '0',
                    'message' => 'Token Telah Digunakan'
                ]);
            }else{
                if(!$status){
                return response()->json([
                    'success' => '1',
                    'message' => 'Berhasil Masuk',
                    'token'   => $token                
                    ]);
            }
        }
    }
}
