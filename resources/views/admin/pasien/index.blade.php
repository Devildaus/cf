<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {{-- <a href="/admin/pasien/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah</a> --}}


                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Umur</th>
                        <th>Diagnosa Penyakit</th>
                        <th>Keakuratan</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($pasien as $item)
                        
                    <tr>
                        <td> {{ $pasien->firstItem() + $loop->index }} </td>
                        <td><a href="/admin/diagnosa/keputusan/{{ $item->id }}"><b> {{ $item->name }} </b></a></td>
                        <td> {{ $item->umur }} </td>
                        <td> {{ isset($item->penyakit) ? $item->penyakit->name : 'Data Kosong' }} </td>
                        <td> {{ $item->persentase }}% </td>
                        <td>
                            <div class="d-flex">
                                {{-- <a href="/admin/pasien/{{ $item->id }}/edit" class="btn btn-info mr-2"><i class="fas fa-edit"></i> Edit</a> --}}
                                <form action="/admin/pasien/{{ $item->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </form>                                
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </table>
                {{ $pasien->links() }}
            </div>
        </div>
    </div>
</div>