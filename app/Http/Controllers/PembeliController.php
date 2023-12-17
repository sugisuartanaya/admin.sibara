<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembeli;

class PembeliController extends Controller
{
   
    public function index()
    {
        $pembeli = Pembeli::get();

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
        //
    }
}
