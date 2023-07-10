@extends('layouts.index')
@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <a href="/alternatif/create">
                    <button type="button" class="btn btn-primary mt-3 mb-3">Tambah Data</button>
                </a>
            </div>
        </div>

        @if ($message = Session::get('inserted'))
            <div class="alert alert-success alert-dismissible fade show mb-3 mt-3" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif ($message = Session::get('updated'))
            <div class="alert alert-primary alert-dismissible fade show mb-3 mt-3" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif ($message = Session::get('deleted'))
            <div class="alert alert-danger alert-dismissible fade show mb-3 mt-3" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Alternatif</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jenis Prosesor</th>
                        <th scope="col">Kapasitas Memori</th>
                        <th scope="col">Tipe Memori</th>
                        <th scope="col">Kapasitas Harddisk</th>
                        <th scope="col">Ukuran layar</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatif as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nmalternatif }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>{{ $item->jenis_prosesor }}</td>
                            <td>{{ $item->kapasitas_memori }}</td>
                            <td>{{ $item->tipe_memori }}</td>
                            <td>{{ $item->kapasitas_harddisk }}</td>
                            <td>{{ $item->ukuran_layar }}</td>

                            <td>

                                <a href="{{ url('alternatif/' . $item->id . '/edit') }}">
                                    <button type="button" class="btn btn-success">
                                        <i class="">Edit</i>
                                    </button>
                                </a>

                                <a href="{{ url('alternatif/' . $item->id . '/delete') }}">
                                    <button type="button" class="btn btn-danger">
                                        <i class="">Hapus</i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
