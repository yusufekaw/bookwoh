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
    <!-- Menampilkan detail data tamu -->
    <div class="col-xl-4 col-md-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kado</h6>
            </div>
            <div class="card-body">
                <Table class="table table-striped">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $tamu->nama }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>
                            @if($tamu->keterangan==null)
                                {{ $tamu->alamat }}
                            @else
                            {{ $tamu->alamat.' ('.$tamu->keterangan.')' }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>
                            @if($tamu->gender=='l')
                                Laki-laki
                            @else
                                Perempuan
                            @endif
                        </td>
                    </tr>
                </Table>
            </div>
        </div>
    </div>

    <!-- Menampilkan kado yang dibawa tamu -->

    <div class="col-xl-5 col-md-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tamu</h6>
            </div>
            <div class="card-body">
                <Table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Kuantitas</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kado as $kado)
                        <tr>
                            <td>{{ $kado['barang'] }}</td>
                            <td>{{ $kado['qty'].' '.$kado['satuan'] }}</td>
                            <td>
                                <a href="{{ url('kado/hapus/'.$kado['id_kado']) }}" class="btn btn-danger btn-sm btn-circle" onclick="return confirm('Apakah anda yakin untuk menghapus data yang anda pilih!');">
                                    <i class="fas fa-trash"></i>  
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </Table>
            </div>
        </div>
    </div>

    <!-- form tambah kado baru -->
    
    <div class="col-xl-3 col-md-12 mb-4">
        <form method="POST" action="{{ route('kado/simpan') }}"> @csrf
        <input type="hidden" name="id_tamu" value="{{ $tamu->id_tamu }}">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Kado</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="barang">Barang *</label>
                        <input type="text" class="form-control" id="barang" name="barang" placeholder="Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="qty">Kuantitas / Jumlah *</label>
                        <input type="number" class="form-control" id="qty" name="qty" placeholder="Kuantitas / Jumlah" required step="any">
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan *</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan (kg,rupiah,liter,dll)" required>
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
