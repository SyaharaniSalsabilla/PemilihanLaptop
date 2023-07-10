@extends('layouts.index')

@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h5>View Normalisasi</h5>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jenis Prosesor</th>
                        <th scope="col">Kapasitas Memori</th>
                        <th scope="col">Tipe Memori</th>
                        <th scope="col">Kapasitas Harddisk</th>
                        <th scope="col">Ukuran Layar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['nama_alt']}}</td>
                            <td>{{ $item['harga'] }}</td>
                            <td>{{ $item['jenis_prosesor'] }}</td>
                            <td>{{ $item['kapasitas_memori'] }}</td>
                            <td>{{ $item['tipe_memori'] }}</td>
                            <td>{{ $item['kapasitas_harddisk'] }}</td>
                            <td>{{ $item['ukuran_layar'] }}</td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
