@extends('templates.app', ['title' => 'Tambah LaPtOp'])

@section('content-dinamis')
    <div class="m-auto" style="width: 65%">
        <form class="p-4 mt-2" style="border: 1px solid black" action="{{ route('laptops.add.store') }}" method="POST">
        {{-- memunculkan teks dari with('failed') --}}
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{Session::get('failed')}}</div>
        @endif
        {{-- memunculkan error dari $request->validate --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ol>
                    @foreach ($errors->all() as $error)
                        <li>{{ $errors }}</li>
                    @endforeach
                </ol>
            </div>
        @endif
            {{-- aturan form menambah/mengubah/menghapus :
                1. method POST
                2. name nya diambil dari nama field di migration
                3. harus ada @csrf dibawah <form> : headers token mengirim data POST
                4. form search -> action ke halaman return view, form selain search isi action harus berbeda dengan return view (bukan ke route yg return view halaman create)
            --}}
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Nama Laptop</label>
                {{-- old : mengambil isi input sblm submit : old('name_input') --}}
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="type" class="form-label">Tipe Laptop</label>
                <select name="type" id="type" class="form-select">
                    <option hidden selected disabled>Pilih</option>
                    <option value="Gaming" {{ old('type') == 'Gaming' ? 'selected' : '' }}>Gaming</option>
                    <option value="Non Gaming" {{ old('type') == 'Non Gaming' ? 'selected' : '' }}>Non Gaming</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Harga menu</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
            </div>
            <div class="form-group">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}">
            </div>
            <button type="submit" class="btn btn-success mt-3">Kirim Data</button>
        </form>
    </div>
@endsection
