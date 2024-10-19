@extends('templates.app', ['title' => 'Edit Akun'])

@section('content-dinamis')
{{-- action route mengirim $item['id'] untuk spesifikasi data di route path {id} --}}
@if (Session::get('failed'))
    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
@endif
    <form action="{{ route('laptops.edit.update', $laptop['id']) }}" method="POST">
        @csrf
        {{-- patch : http method route untuk ubah data --}}
        @method('PATCH')
        <div class="form-group mb-3">
            <label for="name" class="form-label">Nama Laptop</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $laptop['name'] }}">
        </div>
        {{-- jika ada error validasi berhubungan dengan name, tampilkan dibawah input name text merah --}}
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group mb-3">
            <label for="type" class="form-label">Tipe Laptop</label>
            <select name="type" id="type" class="form-select">
                <option value="Gaming" {{ $laptop['type'] == 'Gaming' ? 'selected' : '' }}>Gaming</option>
                <option value="Non Gaming" {{ $laptop['type'] == 'Non Gaming' ? 'selected' : '' }}>Non Gaming</option>
            </select>
        </div>
        @error('type')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group mb-3">
            <label for="price" class="form-label">Harga laptop</label>
            {{-- $laptop dari compact, yg mengambil first() data yg mau diedit --}}
            <input type="number" class="form-control" id="price" name="price" value="{{ $laptop['price'] }}">
        </div>
        @error('price')
        {{-- $message : memunculkan error terkait dengan price --}}
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group mb-3">
            <label for="stock" class="form-label">stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $laptop['stock'] }}">
        </div>
        @error('stock')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <button type="submit" class="btn btn-primary">Ubah Data</button>
    </form>
@endsection
