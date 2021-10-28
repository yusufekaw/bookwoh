<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Tuanrumah;
use App\Models\Tamu;
use App\Models\Kado;

use DB;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class TuanrumahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        //jika tidak login -> kembali ke halaman login
        if (!Auth::user())
            return redirect('login');

        //data pengelompokan kado
        $data['kado'] = Kado::select('barang',DB::raw('sum(qty) as qty'),'satuan')->groupBy('barang')->get();
        //data tamu
        $data['tamu'] = Tamu::where('id_tuanrumah',Auth::user()->id_tuanrumah)->get();
        return view('tuanrumah.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //halaman registrasi tuan rumah baru
        return view('tuanrumah/register');
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
        //menyimpan data tuan rumah
        //field wajib diisi
        $rules = [
            'nama' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]; 
        //pesan field gagal input
        $messages = [
            'nama.required' => 'Nama tuan rumah wajib diisi',
            'gender' => 'Jenis kelamin wajib diisi',
            'email.required' => 'Alamat email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sesuai'
        ];
        //validator field form
        $validator = Validator::make($request->all(), $rules, $messages);
        //jika validator gagal
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        //id unique tuan rumah
        $id = uniqid();
        //simpan data tuan ruamh
        Tuanrumah::create([
            'id_tuanrumah' => $id,
            'nama' => $request['nama'],
            'gender' => $request['gender'],
        ]);
        //simpan data user login
        User::create([
            'id_user' => $id.'0',
            'nama' => $request['nama'],
            'email' => $request['email'],
            'role' => 'tuanrumah',
            'id_tuanrumah' => $id,
            'password' => Hash::make($request['password']),
        ]);
        //kembali ke halaman login, menampilkan notifikasi pendaftaran akun berhasil
        return redirect('login')->with('message','Berhasil mendaftarkan akun, Silahkan login!');
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
        //update data tuan rumah
        $tuanrumah = Tuanrumah::find($id);
        $tuanrumah->update([
            'nama' => $request->nama,
            'gender' => $request->gender,
        ]);
        //kembali ke halaman profil tuan rumah
        return redirect('user')->with('message', 'Berhasil update profil tuan rumah!');
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
    }
}
