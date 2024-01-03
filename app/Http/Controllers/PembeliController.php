<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PembeliController extends Controller
{
   
    public function index()
    {
        $pembeli = Pembeli::orderBy('id', 'desc')->get();

        // Kembalikan data ke tampilan
        return view('pembeli.index', [
            'title' => 'Pembeli',
            'active' => 'active',
            'daftarPembeli' => $pembeli,
        ]);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        $pembeli = Pembeli::find($id);

        $pembeli->verifikasi()->delete();

        User::find($pembeli->user_id)->delete();
        
        $pembeli->delete();
        // Set flash message
        Session::flash('success', 'pembeli berhasil dihapus.');

        return redirect('/pembeli');
    }
}
