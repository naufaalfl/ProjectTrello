@extends('templates.app', ['title' => 'LaPtOpKUY'])

@section('content-dinamis')

<a href="{{ route('laptops.add') }}" class="btn btn-success mt-2 mb-2">+ Tambah Menu</a>

@if(Session::get('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif


<div class="table-responsive">
    <table class="table table-bordered table-striped text-center">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Tipe</th>
                <th>Harga</th>
                <th>Jumlah stock</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($laptops) > 0)
            @foreach ($laptops as $index => $item)
            <tr>
                <td>{{ ($laptops->currentPage() - 1) * $laptops->perPage() + ($index + 1) }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['type'] }}</td>
                <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                <td class="{{ $item['stock'] <= 3 ? 'bg-danger text-white' : 'bg-white text-dark' }}"
                onclick="editStock({{ $item['id'] }}, {{ $item['stock']}})">
                <span style="cursor: pointer; text decoration: underline ! importand"> {{ $item['stock'] }}</span>
            </td>
            <td class="d-flex justify-content-center py-1">
                {{--Karna edit ada path dinamis {id} --}}
                <a href="{{route('laptops.edit', $item['id'])}}" class="btn btn-primary btn-sm me-2">Edit</a>
                <button class="btn btn-danger btn-sm" onclick="showModal('{{ $item->id}}', '{{ $item->name}}')">Hapus</button>
            </td>

        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6" class="text-center">Tidak ada data</td>
        </tr>
        @endif
    </tbody>
</table>

</div>

<div class="d-flex justify-content-end mt-3">
    {{ $laptops->links() }}
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-delete-laptop" method="POST">
            @csrf
            {{-- menimpa method="POST" diganti menjadi delete, sesuai dengan http
            method untul menghapus data---}}
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Laptop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus tipe <span id="nama-laptop"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-danger" id="confirm-delete">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editStockkModal" tabindex="-1" aria-labelledby="editStockLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-edit-stock" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editstockLabel">Edit stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="laptop-id">
                    <div class="form-group">
                        <label for="stock" class="form-label">stock</label>
                        <input type="number" name="stock" id="stock" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
    <script>
        //fungsi untuk menampilkan modal
        function showModal(id, name) {
            //isi untuk action form
            let action='{{ route("laptops.delete", ":id") }}';
            action = action.replace(':id', id);
            //buat attribute action pada form
            $('#form-delete-laptop').attr('action', action);
            //munculkan modal yang id nya exampleModal
            $('#exampleModal').modal('show');
            //innerText pada element html id nama-obat
            console.log(name);
            $('#nama-laptop').text(name);
        }

        //fungsi untuk menampilkan modal edit stock sama masukin nilai stock yang mau di edit
        function editstock(id, stock) {
            $('#laptop-id').val(id);
            $('#stock').val(stock);
            $('#editStockModal').modal('show');
        }

        //event listener buat handle submit form secara AJAX
        $('#form-edit-stock').on('submit', function(e) {
            //biar form gak ke-submit dengan cara biasa (refresh halaman)
            e.preventDefault();
            //Ambil id obat dari input hidden
            let id = $('#laptop-id').val();
            //Ambil stock baru yang di input user
            let stock = $('#stock').val();
            //Bikin URL buat update stock dengan metode PUT
            let actionUrl = "{{ url('/laptops/update-stock') }}/" + id;
            //Kirim request AJAX buat update stock
            $.ajax({
                url:actionUrl,//URL tujuan buat update stock
                type:'PUT', // Gunakan metode PUT buat update data
                data: {
                    _token: "{{ csrf_token() }}", //Token CSRF biar aman
                    stock: stock // Data stock baru yang mau di kirim ke Server(Database)
                },
                success: function(response) {
                    //Tutup modal kalau update berhasil
                    $('#editstockkModal').modal('hide');
                    //Refresh halaman biar perubahan stock keliatan
                    alert('berhasil update stock')
                    location.reload();
                },
                error: function(err) {
                    //Tutup modal kalau update gagal
                    // alert('Ada masalah waktu update stock');
                    // console.log(xhr.responseText);
                    alert(err.responseJSON.failed);
                }
            });
        });
    </script>
@endpush
