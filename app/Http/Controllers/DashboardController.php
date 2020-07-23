<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jumlahsuara    = DB::select('SELECT * FROM kandidat');
        $belumvoting    = DB::select('SELECT COUNT(status) as jumlahbelumvoting FROM pemilih WHERE status = 2 GROUP BY status');
        $kandidat       = DB::select('SELECT COUNT(nama) as jumlah FROM kandidat');
        $jumlahhaksuara = DB::select('SELECT COUNT(username) as jumlah FROM pemilih');
        $suaramasuk     = DB::select('SELECT COUNT(username) as suaramasuk FROM pemilih WHERE status = 1');

        return view('dashboard/index',[
    		'jumlahhaksuara' => $jumlahhaksuara,
            'jumlahkandidat' => $kandidat,
            'jumlahsuara'    => $jumlahsuara,
            'belumvoting'    => $belumvoting,
            'suaramasuk'     => $suaramasuk
    	]);
    }
}
