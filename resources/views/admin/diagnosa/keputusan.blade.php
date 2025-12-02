<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <a href="/admin/diagnosa" class="btn btn-primary mb-2"><i class="fas fa-file"></i> Diagnosa Baru</a>
                <a href="/admin/pasien/cetak/{{ $pasien->id }}" target="blank" class="btn btn-warning mb-2"><i class="fas fa-print"></i> Cetak</a>
                <a href="/admin/pasien/kirim-wa/{{ $pasien->id }}" class="btn btn-success mb-2">
                    <i class="fab fa-whatsapp"></i> Kirim WhatsApp
                </a>

                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td width="200px">Nama Pasien</td>
                                <td>: {{ $pasien->name }} </td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td>: {{ $pasien->umur }} Tahun</td>
                            </tr>

                            <tr>
                                <td>Nama Penyakit</td>
                                <td>: {{ isset($pasien->penyakit) ? $pasien->penyakit->name : 'Gejala Tidak Akurat. Silahkan Diagnosa Ulang' }}</td>
                            </tr>

                            <tr>
                                <td>Keakuratan</td>
                                <td>: {{ $pasien->akumulasi_cf }}</td>
                            </tr>
                            <tr>
                                <td>Presentase</td>
                                <td>: {{ $pasien->persentase }}%</td>
                            </tr>

                            <div class="card">
                                <div class="card-header">Hasil Analisa</div>
                                <div class="card-body">
                                    <h5>Deskripsi Penyakit</h5>
                                    <p>
                                        {{-- Prioritaskan hasil AI, jika kosong pakai deskripsi database --}}
                                        {!! nl2br($pasien->deskripsi_ai ?? $pasien->penyakit->desc) !!}
                                    </p>
                                    @if($pasien->deskripsi_ai)
                                        <small class="text-success"><i class="fas fa-robot"></i> Dianalisa oleh AI</small>
                                    @else
                                        <small class="text-muted"><i class="fas fa-database"></i> Data Standar Medis</small>
                                    @endif

                                    <hr>

                                    <h5>Saran Penanganan</h5>
                                    <p>
                                        {!! nl2br($pasien->penanganan_ai ?? $pasien->penyakit->penanganan) !!}
                                    </p>
                                    
                                    @if($pasien->penanganan_ai)
                                        <small class="text-success"><i class="fas fa-robot"></i> Saran oleh AI</small>
                                    @else
                                        <small class="text-muted"><i class="fas fa-database"></i> Data Standar Medis</small>
                                    @endif
                                </div>
                            </div>

                        </table>
                    </div>

                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>Gejala</th>
                                <th>Nilai</th>
                            </tr>

                            @foreach ($gejala as $item)
                            @if ($item->cf_hasil != 0)
                                
                            
                            
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->gejala->name }}</td>
                                <td>{{ $item->cf_hasil }}</td>
                            </tr>
                            
                            @endif
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>