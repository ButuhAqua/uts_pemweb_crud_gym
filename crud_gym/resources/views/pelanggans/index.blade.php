@extends('main')
@section('section')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">{{ trans('panel.site_title') }}</h3>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('pelanggans.create') }}" class="btn btn-md btn-custom btn-success mb-3">Add Pelanggan</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Tempat</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Nomor</th>
                                <th scope="col">Paket</th>
                                <th scope="col" style="width: 20%">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelanggans as $p)
                                <tr>
                                    <td>{{ $p->nama }}</td>
                                    <td>{!! $p->tempat !!}</td>
                                    <td>{{ $p->tanggal_lahir }}</td>
                                    <td>{{ $p->jenis_kelamin }}</td>
                                    <td>{{ $p->nomor }}</td>
                                    <td>{{ App\Models\Pelanggan::paket[$p->paket] ?? $p->paket }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pelanggans.destroy', $p->id) }}" method="POST">
                                            <a href="{{ route('pelanggans.show', $p->id) }}" class="btn btn-sm btn-custom btn-dark">SHOW</a>
                                            <a href="{{ route('pelanggans.edit', $p->id) }}" class="btn btn-sm btn-custom btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-custom btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="alert alert-danger">
                                            Data pelanggans belum Tersedia.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $pelanggans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    //message with sweetalert
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endsection
