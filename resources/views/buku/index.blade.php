@extends('auth.layouts')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />

    @if (Session::has('pesan'))
        <div class="alert alert-success">{{ Session::get('pesan') }}</div>
    @endif

    <h1 class="text-center">Daftar Buku</h1>
    <div>

        @if (Auth::user()->level == 'admin')
            {{-- <form action="{{ route('buku.search') }}" method="GET">
                @csrf
                <input type="text" name="kata" class="form-control w-25 d-inline float-right mb-3 mt-3"
                    placeholder="Cari...">
            </form> --}}

            <a href="{{ route('buku.create') }}" class="btn btn-primary float-end my-3">Tambah Buku</a>
        @endif

        <table class="table-light table-hover table" id="datatable">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    @if (Auth::user()->level == 'admin')
                        <th>Hapus</th>
                        <th>Edit</th>
                        <th>Detail</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($data_buku as $index => $buku)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><img src="{{ asset('storage/cover_book_images_resized/' . $buku->photo) }}" alt=""></td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ 'Rp. ' . number_format($buku->harga, 2, '.', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                        @if (Auth::user()->level == 'admin')
                            <td class="text-center">
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin mau dihapus?')" type="submit"
                                        class="btn btn-danger">
                                        Hapus
                                    </button>

                                </form>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary float-end">Edit
                                    Buku</a>
                            </td>
                            <td>
                                <a href="{{ route('buku.detail', $buku->id) }}" class="btn btn-primary float-end">Lihat
                                    Detail</a>
                            </td>
                        @endif
                    </tr>
                @endforeach

                {{-- <tr>
                    <th scope="row" colspan="3" class="table-active table-primary border-black">Jumlah Harga</th>
                    <td colspan="3">{{'Rp. '.number_format($totalPrice,  2, '.', '.')}}</td>
                </tr>
                <tr>
                    <th scope="row" colspan="3" class="table-active table-primary border-black">Banyak Data</th>
                    <td colspan="3">{{$countbuku}}</td>
                </tr> --}}

            </tbody>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endsection
