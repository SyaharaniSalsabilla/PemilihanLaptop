@extends('layouts.index')

@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h5>View Rangking</h5>
            </div>
        </div>



        <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Product</th>
                        <th scope="col">Hasil</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['nama_alt']}}</td>
                            <td>{{ $item['hasil'] }}</td>
                            {{-- <td>{{ $item->rangking }}</td> --}}


                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
