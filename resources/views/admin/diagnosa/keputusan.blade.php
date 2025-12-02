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

                            <tr>
                                <td style="vertical-align: top;">Deskripsi</td>
                                <td>
                                    @if(isset($pasien->penyakit))
                                        @if(!empty($pasien->deskripsi_ai))
                                            {{-- Tampilkan Hasil AI --}}
                                            <div style="background: #f4f6f9; padding: 10px; border-radius: 5px; border-left: 4px solid #17a2b8;">
                                                {!! nl2br(e($pasien->deskripsi_ai)) !!}
                                                <div class="mt-2">
                                                    <small class="text-muted"><i class="fas fa-robot"></i> <em>Penjelasan diperjelas oleh AI Assistant</em></small>
                                                </div>
                                            </div>
                                        @else
                                            {{-- Fallback Data Asli Database --}}
                                            : {{ $pasien->penyakit->desc }}
                                        @endif
                                    @else
                                        : Gejala Tidak Akurat. Silahkan Diagnosa Ulang
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top;">Penanganan</td>
                                <td>
                                    @if(isset($pasien->penyakit))
                                        @if(!empty($pasien->penanganan_ai))
                                            {{-- Tampilkan Saran AI --}}
                                            <div style="background: #e8f5e9; padding: 10px; border-radius: 5px; border-left: 4px solid #28a745;">
                                                {!! nl2br(e($pasien->penanganan_ai)) !!}
                                                <div class="mt-2">
                                                    <small class="text-muted"><i class="fas fa-user-md"></i> <em>Saran penanganan personal (AI)</em></small>
                                                </div>
                                            </div>
                                        @else
                                            {{-- Fallback Data Asli Database --}}
                                            : {{ $pasien->penyakit->penanganan }}
                                        @endif
                                    @else
                                        : Gejala Tidak Akurat. Silahkan Diagnosa Ulang
                                    @endif
                                </td>
                            </tr>

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