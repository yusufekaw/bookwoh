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

<!-- Menampilkan data kado yang sudah dikelompokkan berdasarkan nama barang -->
<div class="row">
    @foreach ($kado as $kado)
        <div class="col-xl-2 col-md-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{ $kado->barang }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kado->qty.' '.$kado->satuan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="row">
    
    <!-- Grid tabel data tamu -->
    <div class="col-xl-8 col-md-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Semua Tamu</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Gender</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Gender</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($tamu as $tamu)
                            <tr>
                                <td>{{ $tamu['nama'] }}</td>
                                <td>
                                    @if($tamu->keterangan==null)
                                        {{ $tamu->alamat }}
                                    @else
                                        {{ $tamu->alamat.' ('.$tamu->keterangan.')' }}
                                    @endif
                                </td>
                                <td>
                                    @if($tamu->gender=='l')
                                        Laki-laki
                                    @else
                                        Perempuan
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('tamu/'.$tamu->id_tamu) }}"class="btn btn-success btn-sm btn-circle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ url('tamu/edit/'.$tamu->id_tamu) }}" class="btn btn-info btn-sm btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ url('tamu/hapus/'.$tamu->id_tamu) }}" class="btn btn-danger btn-sm btn-circle" onclick="return confirm('Apakah anda yakin untuk menghapus data yang anda pilih!');">
                                        <i class="fas fa-trash"></i>  
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- form tambah tamu -->
    
    <div class="col-xl-4 col-md-12 mb-4">
        <form method="POST" action="{{ route('tamu/simpan') }}"> @csrf
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Tamu</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama *</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat *</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangab" name="keterangan" placeholder="Keterangan">
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin *</label><br>
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
                <div class="card-footer py-3">
                    <button type="submit" class="btn btn-sm btn-info"><i class="fas fa-check"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
    
</div>
<!-- End Content Row -->

@endsection
