<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">

                <form action="/admin/user" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email">
                    </div>

                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" class="form-control" id="">
                            <option value="">-- Role --</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="re_pass" placeholder="Konfirmasi Password">
                    </div>

                    <a href="/admin/user" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>

                </form>

            </div>
        </div>
    </div>
</div>