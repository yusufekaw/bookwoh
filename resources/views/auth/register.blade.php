@extends('layouts.app')
@section('content')
    

    <div id="app">
      <main class="py-4">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card">
                      <div class="card-header bg-primary text-white text-center">Bookwoh | Register Tuan Rumah</div>

                      <div class="card-body">
                          <form method="POST" action="{{ route('tuanrumah/simpan') }}">
                              @csrf

                              <div class="form-group row">
                                  <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>

                                  <div class="col-md-6">
                                      <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus placeholder="Nama Tuan Rumah">

                                      @error('nama')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="nama" class="col-md-4 col-form-label text-md-right">Jenis Kelamin</label>

                                  <div class="col-md-6">
                                      <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="l"> Laki-laki
                                      <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="p"> Perempuan

                                      @error('gender')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="email" class="col-md-4 col-form-label text-md-right">Alamat Email</label>

                                  <div class="col-md-6">
                                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Alamat Email">

                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                  <div class="col-md-6">
                                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" minlength="8">

                                      @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Konfirmasi Password</label>

                                  <div class="col-md-6">
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
                                  </div>
                              </div>

                              <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                      <button type="submit" class="btn btn-primary">
                                          Register
                                      </button>
                                  </div>
                              </div>
                          </form>
                          
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </main>
    </div>
    @endsection