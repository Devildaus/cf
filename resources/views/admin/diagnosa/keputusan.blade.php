<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <a href="/admin/diagnosa" class="btn btn-primary mb-2"><i class="fas fa-file"></i> Diagnosa Baru</a>
                <a href="" class="btn btn-warning mb-2"><i class="fas fa-print"></i> Cetak</a>

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
                                <td>Deskripsi</td>
                                <td>: {{ isset($pasien->penyakit) ? $pasien->penyakit->desc : 'Gejala Tidak Akurat. Silahkan Diagnosa Ulang' }}</td>
                            </tr>
                            <tr>
                                <td>Penanganan</td>
                                <td>:  {{ isset($pasien->penyakit) ? $pasien->penyakit->penanganan : 'Gejala Tidak Akurat. Silahkan Diagnosa Ulang' }}</td>
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