<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Session;


class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Jadwal::all();
        return view('jadwal.index')->with('data_jadwal', $jadwal)
        ->with('active', 'active')
        ->with('title', 'Jadwal');
    }

    public function create()
    {
        return view('jadwal.create',[
            'title' => 'Jadwal',
            'active' => 'active'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_sprint' => 'required',
            'tgl_sprint' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        Jadwal::create([
            'no_sprint' => $validatedData['no_sprint'],
            'tgl_sprint' => $validatedData['tgl_sprint'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
        ]);
        // Set flash message
        Session::flash('success', 'Jadwal berhasil ditambahkan.');

        return redirect('/jadwal');
    }

    public function show($id)
    {
        $jadwal = Jadwal::find($id)->first();
        return view('jadwal.show')
            ->with('jadwal', $jadwal)
            ->with('active', 'active')
            ->with('title', 'Jadwal');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::find($id)->first();
        return view('jadwal.edit')
            ->with('jadwal', $jadwal)
            ->with('active', 'active')
            ->with('title', 'Jadwal');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_sprint' => 'required',
            'tgl_sprint' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $jadwal = Jadwal::find($id);
        $jadwal->no_sprint = $validatedData['no_sprint'];
        $jadwal->tgl_sprint = $validatedData['tgl_sprint'];
        $jadwal->start_date = $validatedData['start_date'];
        $jadwal->end_date = $validatedData['end_date'];
        $jadwal->save();
        // Set flash message
        Session::flash('updated', 'Berhasil update jadwal.');

        return redirect('/jadwal');

    }

    public function destroy($id)
    {
        Jadwal::find($id)->delete();
        // Set flash message
        Session::flash('success', 'Jadwal berhasil dihapus.');

        return redirect('/jadwal');
    }
}
