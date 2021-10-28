<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;
use App\Models\Tuanrumah;
use App\Models\Kado;
use Illuminate\Support\Facades\Auth;


class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        return view('dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id_tamu_baru = 0; //inisialisasi id tamu baru
        $id_tuanrumah = Auth::user()->id_tuanrumah; //mencari id tuan rumah
        $id_user = Auth::user()->id_user; //mencari id user
        //id tamu terakhir dari tuan rumah ybs
        $id_tamu_terakhir = Tamu::select('id_tamu')->where('id_tuanrumah',$id_tuanrumah)->max('id_tamu');
        //jika belum ada tamu
        if ($id_tamu_terakhir==null) { 
            $id_tamu_baru = $id_tuanrumah.'t0'; // maka id tamu baru = id tuan rumah t0 
        }
        //jika sudah ada tamu
        else {
            //id  tamu terakhir + 1
            $id_tamu_baru = ltrim($id_tamu_terakhir,$id_tuanrumah);
            $id_tamu_baru = ltrim($id_tamu_baru,'t');
            $id_tamu_baru+=1;
            $id_tamu_baru = $id_tuanrumah.'t'.$id_tamu_baru;
        }
        //simpan data tamu
        Tamu::create([
            'id_tamu' => $id_tamu_baru,
            'nama' => $request['nama'], 
            'alamat' => $request['alamat'], 
            'keterangan' => $request['keterangan'], 
            'gender' => $request['gender'], 
            'id_tuanrumah' => $id_tuanrumah, 
        ]);
        
        return redirect('tamu/'.$id_tamu_baru)->with('message', 'Berhasil menambah tamu baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //menampilkan data tamu berdasarkan id
        $data['tamu'] = Tamu::find($id);
        $data['kado'] = Kado::select('*')->where('id_tamu',$id)->get();
        return view('tamu.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['tamu'] = Tamu::find($id);
        return view('tamu.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //memperbarui data tamu
        $tamu = Tamu::find($id);
        $tamu->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'keterangab' => $request->keterangan,
            'gender' => $request->gender,
        ]);
        //kembali ke halaman detail tamu
        return redirect('tamu/'.$id)->with('message', 'Berhasil update data tamu!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //menghapus data kado
        $kado = Kado::where('id_tamu',$id)->delete();
        //menghapus data tamu
        $tamu = Tamu::find($id)->delete();
        //kembali ke beranda -> menampilkan pesan berhasil menghapus data tamu
        return redirect('tuanrumah')->with('message', 'Berhasil menghapus data tamu');
    }
}
