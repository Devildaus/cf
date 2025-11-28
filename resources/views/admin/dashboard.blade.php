    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                @if(auth()->user()->role == 'admin')
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Pasien</span>
                            <span class="info-box-number">
                                {{ $total_pasien ?? '0' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-calendar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jenis Penyakit</span>
                            <span class="info-box-number">{{ $total_penyakit ?? '0' }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-list"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Gejala</span>
                            <span class="info-box-number">{{ $total_gejala ?? '0' }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pengguna</span>
                            <span class="info-box-number">{{ $total_user ?? '0' }}</span>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Diagnosa stats for all users -->
                @if(auth()->user()->role == 'admin')
            
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-spinner"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Diagnosa Hari Ini</span>
                            <span class="info-box-number">{{ $diagnosa_hari_ini ?? '0' }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div><!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col - DIPERLEBAR -->
                <div class="col-md-9">
                    <!-- Welcome Card -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Selamat Datang di Sistem Pakar Klinik</h3>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <i class="fas fa-stethoscope fa-3x text-primary mb-3"></i>
                                <h4 class="text-dark">Sistem Pakar Diagnosa Penyakit</h4>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="callout callout-info">
                                        <h5><i class="fas fa-info-circle mr-2"></i>Fitur Utama</h5>
                                        <p class="mb-1">• Diagnosa penyakit berdasarkan gejala</p>
                                        <p class="mb-1">• Manajemen data pasien</p>
                                        <p class="mb-1">• Basis pengetahuan penyakit</p>
                                        <p class="mb-0">• Laporan dan analisis</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="callout callout-success">
                                        <h5><i class="fas fa-bolt mr-2"></i>Quick Actions</h5>
                                        <div class="d-flex flex-column gap-2">
                                            <a href="/admin/diagnosa" class="btn btn-primary btn-block mb-2 py-2">
                                                <i class="fas fa-stethoscope mr-2"></i> Mulai Diagnosa
                                            </a>
                                            @if(auth()->user()->role == 'admin')
                                            <a href="/admin/pasien" class="btn btn-success btn-block mb-2 py-2">
                                                <i class="fas fa-user-injured mr-2"></i> Kelola Pasien
                                            </a>
                                            <a href="/admin/penyakit" class="btn btn-info btn-block py-2">
                                                <i class="fas fa-disease mr-2"></i> Data Penyakit
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    @if(auth()->user()->role == 'admin')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Aktivitas Terbaru</h3>
                        </div>
                        <div class="card-body">
                            <div class="activity-feed">
                                <div class="feed-item">
                                    <div class="feed-icon bg-primary">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <div class="feed-content">
                                        <span class="feed-text">Pasien baru terdaftar</span>
                                        <small class="text-muted">5 menit yang lalu</small>
                                    </div>
                                </div>
                                <div class="feed-item">
                                    <div class="feed-icon bg-success">
                                        <i class="fas fa-spinner"></i>
                                    </div>
                                    <div class="feed-content">
                                        <span class="feed-text">Diagnosa berhasil dilakukan</span>
                                        <small class="text-muted">1 jam yang lalu</small>
                                    </div>
                                </div>
                                <div class="feed-item">
                                    <div class="feed-icon bg-info">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div class="feed-content">
                                        <span class="feed-text">Data penyakit diperbarui</span>
                                        <small class="text-muted">2 jam yang lalu</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div><!-- /.Left col -->

                <!-- Right col - DIPERSEMPIT -->
                <div class="col-md-3">
                    <!-- System Info -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Sistem</h3>
                        </div>
                        <div class="card-body">
                            <div class="system-info">
                                <div class="info-item d-flex justify-content-between mb-2">
                                    <span><i class="fas fa-user mr-2"></i>Pengguna:</span>
                                    <strong>{{ auth()->user()->name }}</strong>
                                </div>
                                <div class="info-item d-flex justify-content-between mb-2">
                                    <span><i class="fas fa-shield-alt mr-2"></i>Role:</span>
                                    <strong class="text-capitalize">{{ auth()->user()->role }}</strong>
                                </div>
                                <div class="info-item d-flex justify-content-between mb-2">
                                    <span><i class="fas fa-clock mr-2"></i>Login:</span>
                                    <strong>{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</strong>
                                </div>
                                <div class="info-item d-flex justify-content-between">
                                    <span><i class="fas fa-database mr-2"></i>Status:</span>
                                    <strong class="text-success">Aktif</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    @if(auth()->user()->role == 'admin')
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Statistik Cepat</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="quickStatsChart" height="200"></canvas>
                        </div>
                    </div>
                    @endif


                </div><!-- /.Right col -->
            </div><!-- /.row -->
        </div><!--/. container-fluid -->


<style>
    .info-box {
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        border-radius: 0.5rem;
        background: #fff;
        display: flex;
        margin-bottom: 1rem;
        min-height: 80px;
        padding: .5rem;
        position: relative;
    }

    .info-box .info-box-icon {
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        font-size: 1.875rem;
    }

    .info-box .info-box-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        line-height: 1.8;
        flex: 1;
        padding: 0 10px;
    }

    .info-box .info-box-number {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .callout {
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        padding: 1rem;
    }

    .activity-feed {
        list-style: none;
        padding: 0;
    }

    .feed-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eaeaea;
    }

    .feed-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
    }

    .feed-content {
        flex: 1;
    }

    .feed-text {
        display: block;
        font-weight: 500;
    }

    .system-info .info-item {
        padding: 0.5rem 0;
        border-bottom: 1px solid #f8f9fa;
        font-size: 0.9rem;
    }

    .system-info .info-item:last-child {
        border-bottom: none;
    }

    .card {
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        margin-bottom: 1rem;
        border: none;
        border-radius: 0.5rem;
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #dee2e6;
        padding: 1rem 1.25rem;
    }

    .card-title {
        margin-bottom: 0;
        font-size: 1.1rem;
        font-weight: 600;
    }

    /* Tambahan untuk perataan lebih ke kiri */
    .content-wrapper {
        margin-left: 0;
    }

    .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simple chart for quick stats
        const ctx = document.getElementById('quickStatsChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Diagnosa', 'Pasien', 'Penyakit'],
                datasets: [{
                    data: [{{ $diagnosa_hari_ini ?? 5 }}, {{ $total_pasien ?? 3 }}, {{ $total_penyakit ?? 8 }}],
                    backgroundColor: [
                        '#007bff',
                        '#28a745',
                        '#ffc107'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom'
                },
                cutoutPercentage: 60
            }
        });
    });
</script>