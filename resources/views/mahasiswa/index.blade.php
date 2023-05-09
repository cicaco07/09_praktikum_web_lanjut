@extends('mahasiswa.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="pb-3">
                <form class="d-flex" action="{{ url('mahasiswa') }}" method="get">
                    <input class="form-control me-1" type="search" name="search" value="{{ Request::get('search') }}" placeholder="search" aria-label="Search">
                    <button class="btn btn-secondary" type="submit">Cari</button>
                </form>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
            </div>
        </div>
    </div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <table class="table table-bordered">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Foto</th>
            <th>Email</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>No_Handphone</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($mahasiswa as $Mahasiswa)
    <tr>
        <td>{{ $Mahasiswa->nim }}</td>
        <td>{{ $Mahasiswa->nama }}</td>
        <td>{{ $Mahasiswa->tanggal_lahir }}</td>
        <td><img src="{{asset('storage/'.$Mahasiswa->foto_mhs)}}" alt="foto_mhs" style="height: 100px; width: 100px; overflow: hidden; object-fit: cover;"></td>
        <td>{{ $Mahasiswa->email }}</td>
        <td>{{ $Mahasiswa->kelas->nama_kelas }}</td>
        <td>{{ $Mahasiswa->jurusan }}</td>
        <td>{{ $Mahasiswa->no_hp }}</td>
        <td><form action="{{ route('mahasiswa.destroy',$Mahasiswa->nim) }}" method="POST">
            <a class="btn btn-info" href="{{ route('mahasiswa.show',$Mahasiswa->nim) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$Mahasiswa->nim) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            <a class="btn btn-warning" href="/mahasiswa/nilai/{{ $Mahasiswa->nim }}">Nilai</a>
        </form>
        </td>
    </tr>
    @endforeach
    </table>
    {!! $mahasiswa->withQueryString()->links('pagination::bootstrap-5') !!}
</div>
@endsection