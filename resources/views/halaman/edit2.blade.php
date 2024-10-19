@extends('templates.app', ['title' => 'Edit Obat || APOTEK'])

@section('content-dinamis')
{{-- action route mengirim $item['id'] untuk spesifikasi data di route path {id} --}}
@if (Session::get('failed'))
    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
@endif
    <form action="{{ route('akun.edit.update', $user['id']) }}" method="POST">
        @csrf
        {{-- patch : http method route untuk ubah data --}}
        @method('PATCH')
        <div class="form-group mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] }}">
        </div>
        {{-- jika ada error validasi berhubungan dengan name, tampilkan dibawah input name text merah --}}
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group mb-3">
            <label for="role" class="form-label">Pilih Role</label>
            <select name="role" id="role" class="form-select">
                <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kasir" {{ $user['role'] == 'kasir' ? 'selected' : '' }}>kasir</option>
            </select>
        </div>
        @error('role')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user['email'] }}">
        </div>
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group mb-3">
            <label for="passowrd" class="form-label">Password</label>
            {{-- $user dari compact, yg mengambil first() data yg mau diedit --}}
            <input type="password" class="form-control" id="password" name="password">
        </div>
        @error('passowrd')
        {{-- $message : memunculkan error terkait dengan passowrd --}}
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <button type="submit" class="btn btn-primary">Ubah Data</button>
    </form>
@endsection
