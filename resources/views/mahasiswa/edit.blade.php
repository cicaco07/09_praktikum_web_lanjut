@extends('mahasiswa.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem">
            <div class="card-header">
            Edit Mahasiswa
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger"><strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" action="{{ route('mahasiswa.update', $Mahasiswa->nim) }}" id="myForm"> 
                    @csrf 
                    @method('PUT')
                    <div class="form-group">
                        <label for="nim">Nim</label>
                        <input type="text" name="nim" class="form-control" id="nim" aria-describedby="nim" value="{{ $Mahasiswa->nim }}">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="nama" name="nama" class="form-control" id="nama" aria-describedby="nama" value="{{ $Mahasiswa->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="tanggal_lahir" name="tanggal_lahir" class="form-control" id="tanggal_lahir" aria-describedby="tanggal_lahir" value="{{ $Mahasiswa->tanggal_lahir }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="email" value="{{ $Mahasiswa->email }}">
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" class="form-control">
                        @foreach ($kelas as $Kelas)
                            <option value="{{$Kelas->id}}">{{$Kelas->nama_kelas}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input type="jurusan" name="jurusan" class="form-control" id="jurusan" aria-describedby="jurusan" value="{{ $Mahasiswa->jurusan }}">
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No_Handphone</label>
                        <input type="no_hp" name="no_hp" class="form-control" id="no_hp" aria-describedby="no_hp" value="{{ $Mahasiswa->no_hp }}">
                    </div>
                <button type="submit" class="btn btn-primary my-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 