<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::where([
            ['nama', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('nama', 'LIKE', '%' . $search . '%')
                    ->get();
                }
            }]
        ])->paginate(5);
        $posts = Mahasiswa::orderBy('nim', 'desc');
        return view('mahasiswa.index', compact('mahasiswa'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'foto_mhs' => 'required',
            'email' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_hp' => 'required',
        ]);

        $image_name = '';

        if ($request->file('foto_mhs')) {
            $image_name = $request->file('foto_mhs')->store('images', 'public');
        }

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim=$request->get('nim');
        $mahasiswa->nama=$request->get('nama');
        $mahasiswa->tanggal_lahir=$request->get('tanggal_lahir');
        $mahasiswa->foto_mhs = $image_name;
        $mahasiswa->email=$request->get('email');
        $mahasiswa->jurusan=$request->get('jurusan');
        $mahasiswa->no_hp=$request->get('no_hp');
        

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswa.detail', compact('Mahasiswa'));
    }

    public function khs($nim)
    {
        $Mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswa.khs', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::find($nim);
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('Mahasiswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nim)
    {
        $image_name = '';
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'foto_mhs' => 'required',
            'email' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_hp' => 'required',
        ]);

        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $mahasiswa->nim = $request->get('nim');
        $mahasiswa->nama = $request->get('nama');
        $mahasiswa->tanggal_lahir = $request->get('tanggal_lahir');

        if ($mahasiswa->foto_mhs && file_exists(storage_path('app/public/' . $mahasiswa->foto_mhs))) {
            Storage::delete('public/' . $mahasiswa->foto_mhs);
        }
        $image_name = $request->file('foto_mhs')->store('images', 'public');

        $mahasiswa->foto_mhs = $image_name;
        $mahasiswa->email = $request->get('email');
        $mahasiswa->jurusan = $request->get('jurusan');
        $mahasiswa->no_hp = $request->get('no_hp');

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //fungsi eloquent untuk mengupdate data inputan kita
        // Mahasiswa::find($nim)->update($request->all());
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($nim)->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Dihapus');
    }
    
    public function cetak($nim)
    {
        $Mahasiswa = Mahasiswa::find($nim);
        $pdf = PDF::loadView('mahasiswa.cetak',['Mahasiswa'=> $Mahasiswa]);
        return $pdf->stream();
    }
}
