@extends('templates.app', ['title' => 'Login || NASPAD'])

@section('content-dinamis')
    <a href="{{ route('akun.add') }}" class="btn btn-success mb-2 mt-2">+ Tambah Akun</a>

    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no=1 @endphp
                @if (count($user) > 0)
                    @foreach ($user as $index => $item)
                        <tr>
                            {{-- <td>{{ ($medicines->currentPage() - 1) * $medicines->perPage() + ($index + 1) }}</td> --}}
                            <td>{{ $no++ }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['role'] }}</td>
                            <td class="d-flex justify-content-center py-1">
                                {{-- Karna edit ada path dinamis {id} --}}
                                <a href="{{ route('akun.edit', $item['id']) }}"
                                    class="btn btn-primary btn-sm me-2">Edit</a>
                                <button class="btn btn-danger btn-sm"
                                    onclick="showModal('{{ $item->id }}', '{{ $item->name }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center fw-bold">Data masih kosong</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        {{ $user->links() }}
    </div>

    <!-- Modal -->
    <div class="modal fade" id="showAkunModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-delete-akun" method="POST">
                @csrf
                {{-- menimpa method="POST" diganti menjadi delete, sesuai dengan http
            method untul menghapus data- --}}
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showAkunLabel">Hapus data akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus akun ini ? <span id="nama-akun"></span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-danger" id="confirm-delete">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        //fungsi untuk menampilkan modal
        function showModal(id, name) {
            //isi untuk action form
            let action = '{{ route('akun.delete', ':id') }}';
            action = action.replace(':id', id);
            //buat attribute action pada form
            $('#form-delete-akun').attr('action', action);
            //munculkan modal yang id nya exampleModal
            $('#showAkunModal').modal('show');
            //innerText pada element html id nama-obat
            console.log(name);
            $('#nama-akun').text(name);
        }
    </script>
@endpush
