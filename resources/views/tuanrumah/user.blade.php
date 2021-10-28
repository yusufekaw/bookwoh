@extends('tuanrumah.app')

@section('content')

<!-- Pesan alert -->
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{Session::get('message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>    
</div>
@endif

<!-- Content Row -->
<div class="row">
    <!-- Menampilkan detail data tuan rumah -->
    <div class="col-xl-4 col-md-12 mb-4">
        <form method="POST" action="{{ url('tuanrumah/update/'.Auth::user()->id_tuanrumah) }}"> @csrf
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profil Tuan Rumah</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama *</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $tuanrumah['nama'] }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-4">Jenis Kelamin *</label><br>
                        <div class="form-check form-check-inline col-sm-3">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="l" required>
                            <label class="form-check-label" for="gender">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline col-sm-3">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="p" required>
                            <label class="form-check-label" for="gender">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer py-3">
                    <button type="submit" class="btn btn-sm btn-info"><i class="fas fa-check"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Menampilkan detail data tuan user -->
    <div class="col-xl-5 col-md-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User Admin</h6>
            </div>
            <div class="card-body">
                <Table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $user)
                        <tr>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ url('user/edit/'.$user->id_user) }}" class="btn btn-info btn-sm btn-circle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- user dengan role tuan rumah tidak boleh dihapus -->
                                @if($user->role!='tuanrumah')
                                <a href="{{ url('user/hapus/'.$user->id_user) }}" class="btn btn-danger btn-sm btn-circle" onclick="return confirm('Apakah anda yakin untuk menghapus data yang anda pilih!');">
                                    <i class="fas fa-trash"></i>  
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </Table>
            </div>
        </div>
    </div>
    
    <!-- form tambah user baru -->
    
    <div class="col-xl-3 col-md-12 mb-4">
        <form method="POST" action="{{ route('user/simpan') }}"> @csrf
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah User Admin</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="barang">Nama *</label>
                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus placeholder="Nama User">
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Alamat Email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" minlength="8">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Konfirmasi Password *</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password" minlength="8">
                    </div>
                </div>
                <div class="card-footer py-3">
                    <button type="submit" class="btn btn-sm btn-info"><i class="fas fa-check"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Content Row -->

@endsection
