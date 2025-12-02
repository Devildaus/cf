<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <a href="/admin/gejala/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah</a>


                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Kode Gejala</th>
                        <th>Nama</th>
                        <th>Penjelasan Nilai Normal dan Tidak Normalnya</th>
                        <th>Nilai CF</th>
                        <th>Jumlah Pilihan</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($gejala as $item)
                        
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $item->kode_gejala }} </td>
                        <td> {{ $item->name }} </td>
                        <td> {{ $item->penjelasan_pilihan }} </td>
                        <td> {{ $item->nilai_cf }} </td>
                        <td> {{ $item->jumlah_pilihan }} </td>
                        <td>
                            <div class="d-flex">
                                <a href="/admin/gejala/{{ $item->id }}/edit" class="btn btn-info mr-2"><i class="fas fa-edit"></i> Edit</a>
                                <form action="/admin/gejala/{{ $item->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </form>                                
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </table>
                {{ $gejala->links() }}
            </div>
        </div>
    </div>
</div>