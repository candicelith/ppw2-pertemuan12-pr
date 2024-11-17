@extends('auth.layouts')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="card" style="padding: 20px; width: 18rem;">
            <img src="{{ asset('storage/cover_book_images/' . $data_buku->photo) }}" alt="">
            <div class="card-body">
                <p class="card-text" style="font-size: 28px;">{{ $data_buku->judul }}</p>
                <p class="card-text" style="font-size: 20px;">{{ $data_buku->penulis }}</p>
            </div>
            <a href="{{ '/buku' }}" class="btn btn-secondary"
                style="margin-top: 30px; margin-bottom:30px;">Kembali</a>
        </div>
    </div>
@endsection
