<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tuanrumah;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        //hanya user dengan role tuanrumah yang punya hak akses pada halaman
        if(Auth::user()->role!='tuanrumah')
            return abort(404);
        //menampilkan user yang telah didaftarkan oleh tuan rumah
        $id_tuanrumah = Auth::user()->id_tuanrumah;
        $data['tuanrumah'] = Tuanrumah::find($id_tuanrumah);
        $data['user'] = User::select('*')->where('id_tuanrumah',$id_tuanrumah)->get();
        return view('tuanrumah.user', $data);
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
        //menyimpan data user baru
        //field wajib diisi
        $rules = [
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]; 
        //pesan field gagal input
        $messages = [
            'nama.required' => 'Nama tuan rumah wajib diisi',
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
            return redirect('user')->withErrors($validator)->withInput($request->all());
        }
        /*
            id user baru
            id tuan rumah + u + no urut
        */
        $id_tuanrumah=Auth::user()->id_tuanrumah;
        $id_user = Auth::user()->id_user;
        $id_user_terakhir = User::select('id_user')->where('id_tuanrumah',$id_tuanrumah)->max('id_user');
        $id_user_baru = ltrim($id_user_terakhir,$id_tuanrumah);
        $id_user_baru = ltrim($id_user_baru,'u');
        $id_user_baru+=1;
        $id_user_baru = $id_tuanrumah.'u'.$id_user_baru;
        //simpan user
        User::create([
            'id_user' => $id_user_baru,
            'nama' => $request['nama'],
            'email' => $request['email'],
            'role' => 'user',
            'id_tuanrumah' => $id_tuanrumah,
            'password' => Hash::make($request['password']),
        ]);
        //kembali ke halaman user -> menampilkan pesan sukses menambahkan user baru
        return redirect('user')->with('message','Berhasil menambahkan user baru!');
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
        //data user yg akan diubah
        $data['user'] = User::find($id);
        return view('user.edit', $data);
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
        //update data user
        //field wajib diisi
        $rules = [
            'nama' => 'required',
            'password' => 'required|min:8|confirmed'
        ]; 
        //pesan field gagal input
        $messages = [
            'nama.required' => 'Nama tuan rumah wajib diisi',
            'email.required' => 'Alamat email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sesuai'
        ];
        //validator field form
        $validator = Validator::make($request->all(), $rules, $messages);
        //jika validator gagal

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        //update data user
        $user = User::find($id);
        $user->update([
            'nama' => $request['nama'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        //kembali ke halaman user -> menampilkan pesan berhasil memperbarui data user
        return redirect('user')->with('message','Berhasil memperbarui data user!');
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
        //menghapus data user
        User::find($id)->delete();
        //kembali ke halaman user -> menampilkan pesan berhasil menghapus data user
        return redirect('user')->with('message','Berhasil menghapus data user!');

    }
}
