@extends('templates.app', ['title' => 'Tambah Akun || APOTEK'])

@section('content-dinamis')
    <div class="m-auto" style="width: 65%">
        <form class="p-4 mt-2" style="border: 1px solid black" action="{{ route('akun.add.store') }}" method="POST">
        {{-- memunculkan teks dari with('failed') --}}
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{Session::get('failed')}}</div>
        @endif
        {{-- memunculkan error dari $request->validate --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ol>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
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
                <label for="name" class="form-label">Nama</label>
                {{-- old : mengambil isi input sblm submit : old('name_input') --}}
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                {{-- old : mengambil isi input sblm submit : old('name_input') --}}
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                {{-- old : mengambil isi input sblm submit : old('name_input') --}}
                <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
            </div>
            <div class="form-group">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select">
                    <option hidden selected disabled>Pilih</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-3">Kirim Data</button>
        </form>
    </div>
@endsection
