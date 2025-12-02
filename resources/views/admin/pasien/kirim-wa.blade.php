<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kirim Hasil Diagnosa ke WhatsApp</h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Nama Pasien</th>
                                <td>{{ $pasien->name }}</td>
                            </tr>
                            <tr>
                                <th>Umur</th>
                                <td>{{ $pasien->umur }} Tahun</td>
                            </tr>
                            <tr>
                                <th>Hasil Diagnosa</th>
                                <td>
                                    {{ isset($pasien->penyakit) ? $pasien->penyakit->name : 'Gejala Tidak Akurat' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Tingkat Kepercayaan</th>
                                <td>{{ $pasien->persentase }}%</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <form action="/admin/pasien/kirim-wa/{{ $pasien->id }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nomor_wa">Nomor WhatsApp Pasien</label>
                        <input type="text" 
                               class="form-control @error('nomor_wa') is-invalid @enderror" 
                               id="nomor_wa" 
                               name="nomor_wa" 
                               placeholder="Contoh: 081234567890"
                               value="{{ old('nomor_wa') }}"
                               required>
                        @error('nomor_wa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Masukkan nomor WhatsApp (Contoh: 0812xxx atau 62812xxx)
                        </small>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="fab fa-whatsapp"></i> Kirim Otomatis
                        </button>
                        <a href="/admin/diagnosa/keputusan/{{ $pasien->id }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>

                <div class="mt-4">
                    <h5>Preview Pesan yang Akan Dikirim:</h5>
                    <div class="border p-3 bg-light rounded">
                        <small>
                            {!! nl2br(e($preview_pesan)) !!}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>