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
    <!-- form edit user admin -->
    <div class="col-xl-12 col-md-12 mb-4">
        <form method="POST" action="{{ url('user/update/'.$user['id_user']) }}"> @csrf
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit User Admin</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4">Nama *</label>
                        <input id="nama" type="text" class="col-sm-8 form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $user['nama'] }}" required autocomplete="nama" autofocus placeholder="Nama User">
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4">Email *</label>
                        <input id="email" type="email" class="col-sm-8 form-control @error('email') is-invalid @enderror" name="email" value="{{ $user['email'] }}" required autocomplete="email" placeholder="Alamat Email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4">Password *</label>
                        <input id="password" type="password" class="col-sm-8 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" minlength="8">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4">Konfirmasi Password *</label>
                        <input id="password" type="password" class="col-sm-8 form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password" minlength="8">
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
