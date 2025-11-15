<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">


                @isset($gejala)
                <form action="/admin/gejala/{{ $gejala->id }}" method="POST">
                    @method('PUT')
                @else    
                <form action="/admin/gejala" method="POST">
                @endisset
                    @csrf

                    <div class="form-group">
                        <label for="">Kode Gejala</label>
                        <input type="text" class="form-control @error('kode_gejala') is-invalid @enderror" name="kode_gejala" placeholder="Kode Gejala" value="{{ isset($gejala) ? $gejala->kode_gejala : old('kode_gejala') }}">
                        @error('kode_gejala')
                            <div class="invalid-feedback">{{ $message }}</div>                            
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Nama Gejala</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"  name="name" placeholder="Nama Gejala" value="{{ isset($gejala) ? $gejala->name : old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>                            
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Nilai CF</label>
                        <input type="text" class="form-control @error('nilai_cf') is-invalid @enderror" name="nilai_cf" placeholder="Nilai CF" value="{{ isset($gejala) ? $gejala->nilai_cf : old('nilai_cf') }}">
                        @error('nilai_cf')
                            <div class="invalid-feedback">{{ $message }}</div>                            
                        @enderror
                    </div>


                    <a href="/admin/gejala" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>

                </form>

            </div>
        </div>
    </div>
</div>