@extends('layouts.index')
@section('content')
    <div class="wrapper">
        <h5>Tambah Data Alternatif</h5>
        <div class="line-custom"></div>
        <form action="{{ url('alternatif/store') }}" method="POST">
            @csrf
            {{-- <div class="mb-3">
                <label for="id" class="form-label">ID </label>
                <input type="text" name="id" class="form-control " placeholder="Disabled input" readonly>
                <div id="emailHelp" class="form-text">ID will automated increment</div>
            </div> --}}
            <div class="mb-3">
                <label for="nmalternatif" class="form-label">Nama Alternatif </label>
                <input type="text" name="nmalternatif" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" name="harga" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="jenis_prosesor" class="form-label">Jenis Prosesor</label>
                <input type="text" name="jenis_prosesor" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="kapasitas_memori" class="form-label">Kapasitas Memori</label>
                <input type="text" name="kapasitas_memori" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="tipe_memori" class="form-label">Tipe Memori</label>
                <input type="text" name="tipe_memori" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="kapasitas_harddisk" class="form-label">Kapasitas Harddisk</label>
                <input type="text" name="kapasitas_harddisk" class="form-control" />
            </div>
             <div class="mb-3">
                <label for="ukuran_layar" class="form-label">Ukuran Layar</label>
                <input type="text" name="ukuran_layar" class="form-control" />
            </div>

            <div class="mb-3 form-check"></div>
            <button type="submit" name="kirim" class="btn btn-primary">
                Submit
            </button>
        </form>
    </div>
@endsection
