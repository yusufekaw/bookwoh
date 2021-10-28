@extends('tuanrumah.app')

@section('content')

<!-- Form ubah data tamu -->

<div class="row">
    <div class="col-xl-12 col-md-12 mb-4">
        <form method="post" action="{{ url('tamu/update/'.$tamu->id_tamu) }}">@csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ubah Tamu</h6>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="nama" name="nama" value="{{ $tamu->nama }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $tamu->alamat }}" required>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $tamu->keterangan }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-7">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="l" required>
                            <label class="form-check-label" for="gender">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="p" required>
                            <label class="form-check-label" for="gender">Perempuan</label>
                        </div>
                    </div>
                </div>         
            </div>
            <div class="card-footer py-3">
                <button type="submit" class="btn btn-sm btn-info"><i class="fas fa-check"></i> Simpan</button>
            </div>
        </div>
        </form>
    </div>

</div>

@endsection