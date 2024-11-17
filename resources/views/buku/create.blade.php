@extends('auth.layouts')

@section('content')

    <h4>Tambah Buku</h4>

    @if (count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">

        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <!-- atribut judul adalah key dan inputan value -->
            <input type="text" class="form-control" name="judul">
        </div>
        <div class="form-group">
            <label for="penulis">Penulis</label>
            <input type="text" class="form-control" name="penulis">
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" class="form-control" name="harga">
        </div>
        <div class="form-group">
            <label for="tgl_terbit">Tanggal Terbit</label>
            <input type="date" id="tgl_terbit" class="date form-control" name="tgl_terbit" placeholder="yyyy/mm/dd">
        </div>
        <div class="form-group">
            <label for="cover">Photo</label>
            <input type="file" id="cover" class="form-control" name="cover">
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ '/buku' }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>

@endsection
