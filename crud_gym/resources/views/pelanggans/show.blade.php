@extends('main')
@section('section')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h4>Detail Pelanggan</h4>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Nama Lengkap</th>
                                    <td>{{ $pelanggan->nama }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tempat</th>
                                    <td>{!! $pelanggan->tempat !!}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Lahir</th>
                                    <td>{{ $pelanggan->tanggal_lahir }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jenis Kelamin</th>
                                    <td>{{ $pelanggan->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor</th>
                                    <td>{{ $pelanggan->nomor }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Paket</th>
                                    <td>{{ \App\Models\Pelanggan::paket[$pelanggan->paket] ?? $pelanggan->paket }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('pelanggans.index') }}" class="btn btn-md btn-custom btn-secondary">Kembali</a>
                        <a href="{{ route('pelanggans.edit', $pelanggan->id) }}" class="btn btn-md btn-custom btn-primary">EDIT</a>
                        <form action="{{ route('pelanggans.destroy', $pelanggan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda Yakin ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-md btn-custom btn-danger">HAPUS</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection