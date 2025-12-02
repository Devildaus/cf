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
                    <div class="form-group">
                        <label for="jumlah_pilihan">Jumlah Pilihan</label>
                        
                        {{-- Ganti input type="text" dengan elemen <select> --}}
                        <select class="form-control @error('jumlah_pilihan') is-invalid @enderror" name="jumlah_pilihan" id="jumlah_pilihan">
                            
                            {{-- Tentukan nilai default untuk ditampilkan, ambil dari $gejala atau old() --}}
                            @php
                                $selected_value = isset($gejala) ? $gejala->jumlah_pilihan : old('jumlah_pilihan');
                            @endphp

                            {{-- Opsi 2 (Ya / Tidak) --}}
                            <option value="2" {{ $selected_value == 2 ? 'selected' : '' }}>2 Pilihan (Ya / Tidak)</option>
                            
                            {{-- Opsi 3 (Ya / Sebagian / Tidak) --}}
                            <option value="3" {{ $selected_value == 3 ? 'selected' : '' }}>3 Pilihan (Ya / Sebagian / Tidak)</option>
                            
                            {{-- Opsi 6 (Lengkap: Normal s/d Yakin Sepenuhnya) --}}
                            <option value="6" {{ $selected_value == 6 || is_null($selected_value) ? 'selected' : '' }}>6 Pilihan (Opsi Lengkap)</option>

                        </select>
                    <div class="form-group">
                        <label for="penjelasan_pilihan">Penjelasan Nilai (Opsional)</label>
                        {{-- Menggunakan textarea untuk penjelasan yang lebih panjang --}}
                        <textarea class="form-control @error('penjelasan_pilihan') is-invalid @enderror" 
                                name="penjelasan_pilihan" 
                                id="penjelasan_pilihan" 
                                placeholder="Contoh: 'penjelasan nilai normal pada gejala pasien dan kepastiannya...'">{{ isset($gejala) ? $gejala->penjelasan_pilihan : old('penjelasan_pilihan') }}</textarea>
                        
                        @error('penjelasan_pilihan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                        
                        @error('jumlah_pilihan')
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