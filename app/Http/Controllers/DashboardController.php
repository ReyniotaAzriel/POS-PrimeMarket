<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.dashboard-admin');
    }

    public function kasir()
    {
        $data['kategoris'] = Kategori::all();
        return view('dashboard.dashboard-kasir')->with($data);
    }

    public function pemilik()
    {
        $data['kategoris'] = Kategori::all();
        return view('dashboard.dashboard-pemilik')->with($data);
    }
}
