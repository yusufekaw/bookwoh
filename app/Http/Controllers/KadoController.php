<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;
use App\Models\Kado;

class KadoController extends Controller
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
        $id_tamu = $request['id_tamu'];
        $id_kado_baru = 0; //inisialisasi id tamu baru
        //id kado terakhir dari tamu ybs
        $id_kado_terakhir = Kado::select('id_kado')->where('id_tamu',$id_tamu)->max('id_kado');
        //jika belum ada tamu
        if ($id_kado_terakhir==null) { 
            $id_kado_baru = $id_tamu.'k0'; // maka id tamu baru = id tuan rumah t0 
        }
        //jika sudah ada tamu
        else {
            //id  tamu terakhir + 1
            $id_kado_baru = ltrim($id_kado_terakhir,$id_tamu);
            $id_kado_baru = ltrim($id_kado_baru,'k');
            $id_kado_baru+=1;
            $id_kado_baru = $id_tamu.'k'.$id_kado_baru;
        }
        Kado::create([
            'id_kado' => $id_kado_baru,
            'barang' => $request['barang'], 
            'qty' => $request['qty'], 
            'satuan' => $request['satuan'], 
            'id_tamu' => $id_tamu, 
        ]);
        
        return redirect('tamu/'.$id_tamu)->with('message', 'Berhasil menambah kado baru!');
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
        $kado = Kado::where('id_kado',$id)->delete();
        return back()->with('message', 'Berhasil menghapus data kado!');
    }
}
