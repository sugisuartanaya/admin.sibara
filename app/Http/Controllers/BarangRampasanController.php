<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kategori;
use App\Models\Harga_wajar;
use Illuminate\Http\Request;
use App\Models\Barang_rampasan;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BarangRampasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang_rampasan::with('kategori')
                    // ->where('status', 0)
                    ->orderByDesc('id')
                    ->orderBy('status')
                    ->get();
        
        $id_barang = $barang->pluck('id')->toArray();
        $harga_terakhir = Harga_wajar::whereIn('id_barang', $id_barang)
                            ->orderBy('tgl_laporan_penilaian', 'desc')  
                            ->get()
                            ->groupBy('id_barang')
                            ->map(function ($group) {
                                $latest = $group->first(); // per group
                                $selisih_bulan = Carbon::now()->diffInMonths(Carbon::parse($latest->tgl_laporan_penilaian));
                                $expired = $selisih_bulan >= 6 ? true : false;
                                $latest->expired = $expired;
                                return $latest;
                            });

        return view('barangRampasan.index')
        ->with('data_barang', $barang)
        ->with('active', 'active')
        ->with('harga', $harga_terakhir)
        ->with('title', 'Barang Rampasan');
    }

    
    public function create()
    {
        $kategori = Kategori::all();
        return view('barangRampasan.create')->with('data_kategori', $kategori)
        ->with('active', 'active')
        ->with('title', 'Barang Rampasan');
    }
  
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'nama_terdakwa' => 'required',
            'no_putusan' => 'required',
            'tgl_putusan' => 'required',
            'kategori_id' => ['required',
                            function ($attribute, $value, $fail) {
                                if ($value === '0') {
                                    $fail('Please select a valid category.');
                                }
                            },],
            'deskripsi' => 'required',
            'foto_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_barang.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Simpan foto
        if ($request->hasFile('foto_thumbnail')) {
            $image = $request->file('foto_thumbnail');
            $fileName = time() . '.' . $image->getClientOriginalExtension();

            // Path untuk menyimpan gambar di dalam folder storage
            $storagePath = $image->storeAs('public/photos/products/thumbnail/', $fileName);

            // Path untuk menyimpan gambar di dalam folder public
            $publicPath = public_path('photos/products/thumbnail/' . $fileName);

            // Resize gambar sebelum disimpan
            $resizedImage = Image::make($image)->fit(800, 600);
            $resizedImage->save($publicPath); // Simpan gambar di folder public

            // URL gambar yang akan disimpan di database
            $url_foto_thumbnail = asset('photos/products/thumbnail/' . $fileName);
        }

        if ($request->hasFile('foto_barang')) {
            if (count($request->file('foto_barang')) <= 5) {
                $foto_paths = [];
                foreach ($request->file('foto_barang') as $image) {
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

                    // Path untuk menyimpan gambar di dalam folder storage
                    $storagePath = $image->storeAs('public/photos/products/', $fileName);
        
                    // Path untuk menyimpan gambar di dalam folder public
                    $publicPath = public_path('photos/products/' . $fileName);
        
                    // Resize gambar sebelum disimpan
                    $resizedImage = Image::make($image)->fit(800, 600);
                    $resizedImage->save($publicPath); // Simpan gambar di folder public
                    $url_foto_barang = asset('photos/products/' . $fileName);

                    $foto_paths[] = $url_foto_barang;
                }
                $url_foto_barang = json_encode($foto_paths);
                $url_foto_barang = stripslashes($url_foto_barang);
            } else{
                Session::flash('error', 'Foto tidak boleh lebih dari 5 file');

                return redirect('/barang-rampasan/create');
            }
            
        } else {
            Session::flash('errorKosong', 'Anda belum upload foto barang');

            return redirect('/barang-rampasan/create');
        }
        
        barang_rampasan::create([
            'nama_barang' => $validatedData['nama_barang'],
            'nama_terdakwa' => $validatedData['nama_terdakwa'],
            'no_putusan' => $validatedData['no_putusan'],
            'tgl_putusan' => $validatedData['tgl_putusan'],
            'kategori_id' => $validatedData['kategori_id'],
            'deskripsi' => $validatedData['deskripsi'],
            'foto_thumbnail' => $url_foto_thumbnail,
            'foto_barang' => $url_foto_barang,
            'status' => $request->status,
        ]);
        // Set flash message
        Session::flash('success', 'Barang rampasan berhasil ditambahkan.');

        return redirect('/barang-rampasan');
    }

   
    public function show($id)
    {
        $barang = Barang_rampasan::find($id);
        $fotoBarangArray = json_decode($barang->foto_barang, true);
        $harga = Harga_wajar::where('id_barang', $id)
            ->orderBy('tgl_laporan_penilaian', 'desc')    
            ->first();
        //cek apakah harga ada
        if ($harga){
            $tglHarga = $harga->tgl_laporan_penilaian;
            $selisih = Carbon::now()->diffInMonths($tglHarga);
            $expired = $selisih >= 6;
        } else {
            $tglHarga = null;
            $selisih = null;
            $expired = false;
        }

        return view('barangRampasan.show')
            ->with('data_barang', $barang)
            ->with('foto_barang', $fotoBarangArray)
            ->with('expired', $expired)
            ->with('active', 'active')
            ->with('title', 'Barang Rampasan'); 
    }

    
    public function edit($id)
    {
        $kategori = Kategori::all();
        $barang = Barang_rampasan::where('nama_barang', $id)->first();
        return view('barangRampasan.edit')
            ->with('data_barang', $barang)
            ->with('data_kategori', $kategori)
            ->with('active', 'active')
            ->with('title', 'Barang Rampasan'); 
    }

    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'nama_terdakwa' => 'required',
            'no_putusan' => 'required',
            'tgl_putusan' => 'required',
            'kategori_id' => ['required',
                            function ($attribute, $value, $fail) {
                                if ($value === '0') {
                                    $fail('Please select a valid category.');
                                }
                            },],
            'deskripsi' => 'required',
            'foto_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_barang.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $barang = Barang_rampasan::find($id);

        if ($request->hasFile('foto_thumbnail')) {
            $image = $request->file('foto_thumbnail');
            $fileName = time() . '.' . $image->getClientOriginalExtension();

            // Path untuk menyimpan gambar di dalam folder storage
            $storagePath = $image->storeAs('public/photos/products/thumbnail/', $fileName);

            // Path untuk menyimpan gambar di dalam folder public
            $publicPath = public_path('photos/products/thumbnail/' . $fileName);

            // Resize gambar sebelum disimpan
            $resizedImage = Image::make($image)->fit(800, 600);
            $resizedImage->save($publicPath); // Simpan gambar di folder public

            // URL gambar yang akan disimpan di database
            $url = asset('photos/products/thumbnail/' . $fileName);
            $barang->foto_thumbnail = $url;
        }

        if ($request->hasfile('foto_barang')){
            if (count($request->file('foto_barang')) <= 5){
                $foto_paths = [];
                foreach ($request->file('foto_barang') as $image) {
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

                    // Path untuk menyimpan gambar di dalam folder storage
                    $storagePath = $image->storeAs('public/photos/products/', $fileName);
        
                    // Path untuk menyimpan gambar di dalam folder public
                    $publicPath = public_path('photos/products/' . $fileName);
        
                    // Resize gambar sebelum disimpan
                    $resizedImage = Image::make($image)->fit(800, 600);
                    $resizedImage->save($publicPath); // Simpan gambar di folder public
                    $url_foto_barang = asset('photos/products/' . $fileName);

                    $foto_paths[] = $url_foto_barang;
                }
                $url_foto_barang = json_encode($foto_paths);
                $url_foto_barang = stripslashes($url_foto_barang);
                $barang->foto_barang = $url_foto_barang;
            } else {
                Session::flash('Error', 'Foto tidak boleh lebih dari 5 file');
                return redirect('/barang-rampasan/'.$barang->nama_barang.'/edit');
            }
        } 
            
        $barang->nama_barang = $validatedData['nama_barang'];
        $barang->nama_terdakwa = $validatedData['nama_terdakwa'];
        $barang->no_putusan = $validatedData['no_putusan'];
        $barang->tgl_putusan = $validatedData['tgl_putusan'];
        $barang->kategori_id = $validatedData['kategori_id'];
        $barang->deskripsi = $validatedData['deskripsi'];
        $barang->save();
        // Set flash message
        Session::flash('updated', 'Berhasil update data barang rampasan.');

        return redirect('/barang-rampasan');

    }

    public function destroy($id)
    {
        Barang_rampasan::find($id)->delete();
        // Set flash message
        Session::flash('success', 'Barang rampasan berhasil dihapus.');

        return redirect('/barang-rampasan');
    }

    public function generateQR($id)
    {
        $barang = Barang_rampasan::find($id);
        return view('qr.show',[
            'barang' => $barang
        ]);
    }

    public function printPdf($id)
    {
        $routeName = 'qr';
        $routeUrl = route($routeName, ['id' => $id]);
        $qrCode = QrCode::size(200)->generate($routeUrl);
        // dd($viewData);
        $pdf = Pdf::loadView('pdf.show', ['qrCode' => $qrCode] );
        return $pdf->download('Informasi Barang Rampasan.pdf');
    }

}
