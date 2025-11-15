<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {{-- <a href="/admin/pasien/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah</a> --}}


                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Diagnosa Penyakit</th>
                        <th>Keakuratan</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($pasien as $item)
                        
                    {{-- <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $item->name }} </td>
                        <td> {{ $item->nilai_cf }} </td>
                        <td>
                            <div class="d-flex">
                                <a href="/admin/pasien/{{ $item->id }}/edit" class="btn btn-info mr-2"><i class="fas fa-edit"></i> Edit</a>
                                <form action="/admin/pasien/{{ $item->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </form>                                
                            </div>
                        </td>
                    </tr> --}}

                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>