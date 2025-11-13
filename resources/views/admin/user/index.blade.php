<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <a href="/admin/user/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah</a>


                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($user as $item)
                        
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $item->name }} </td>
                        <td> {{ $item->email }} </td>
                        <td> {{ $item->role }} </td>
                        <td>
                            <div class="d-flex">
                                <a href="/admin/user/{{ $item->id }}/edit" class="btn btn-info mr-2"><i class="fas fa-edit"></i> Edit</a>
                                <form action="/admin/user/{{ $item->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </form>                                
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>