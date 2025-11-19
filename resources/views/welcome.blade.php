<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Klinik Nediva</title>
  <style>
    body{
      margin:0; font-family:Arial, sans-serif; background:#f5f6f8;
    }
    header{
      background:white; box-shadow:0 2px 8px rgba(0,0,0,0.08); padding:14px 26px; display:flex; justify-content:space-between; align-items:center;
      position:sticky; top:0; z-index:10;
    }
    .logo{font-size:22px; font-weight:700; color:#0061af;}
    .btn-login{
      padding:10px 18px; border-radius:6px; background:#0061af; color:white; text-decoration:none; font-weight:600;
    }

    .hero{
      background:url('https://images.unsplash.com/photo-1580281657521-3aa1f5b6f58a?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
      height:360px; display:flex; align-items:center; justify-content:center; color:white; text-shadow:0 2px 6px rgba(0,0,0,0.4);
      text-align:center;
    }
    .hero h1{font-size:40px; margin:0;}

    .section{
      max-width:1100px; margin:40px auto; padding:0 20px;
    }
    h2{color:#0061af; margin-bottom:10px;}
    p{color:#555; line-height:1.6}

    .cards{
      display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:20px; margin-top:20px;
    }
    .card{
      background:white; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.06);
    }
    .card h3{margin-top:0; color:#0061af}

    footer{
      margin-top:60px; background:#003b64; color:white; padding:30px; text-align:center;
    }
  </style>
</head>
<body>

<header>
  <div class="logo"><img src="/icon.jpg" style="height:40px;width:40px;border-radius:50%;vertical-align:middle;margin-right:8px;">Klinik Nediva Husada</div>
  <a href="/login" class="btn-login">Login</a>
</header>

<section class="hero">
  <h1>Layanan Kesehatan Lengkap & Terjangkau</h1>
</section>

<section class="section">
  <h2>Tentang Kami</h2>
  <p>Klinik Nediva Husada adalah fasilitas pelayanan kesehatan yang menyediakan berbagai layanan seperti UGD 24 jam, persalinan, rawat inap, rawat jalan, KB & KIA, apotek, laboratorium, khitan, hingga layanan home care. Berlokasi di Dusun Krajan RT 30 RW 03, Desa Kanigoro, Kecamatan Pagelaran, Malang, klinik ini berkomitmen memberikan pelayanan medis yang ramah, cepat, dan profesional.</p>
</section>

<section class="section">
  <h2>Layanan Kami</h2>
  <div class="cards">
    <div class="card"><h3>UGD 24 Jam</h3><p>Penanganan darurat medis kapan saja.</p></div>
    <div class="card"><h3>Persalinan</h3><p>Layanan persalinan yang aman dan nyaman.</p></div>
    <div class="card"><h3>Rawat Inap</h3><p>Fasilitas rawat inap yang bersih dan nyaman.</p></div>
    <div class="card"><h3>Rawat Jalan</h3><p>Pemeriksaan dan konsultasi kesehatan setiap hari.</p></div>
    <div class="card"><h3>KB & KIA</h3><p>Layanan kesehatan ibu, anak, dan keluarga berencana.</p></div>
    <div class="card"><h3>Apotek</h3><p>Penyediaan obat lengkap sesuai kebutuhan.</p></div>
    <div class="card"><h3>Laboratorium</h3><p>Pemeriksaan laboratorium cepat dan akurat.</p></div>
    <div class="card"><h3>Khitan</h3><p>Layanan khitan anak dan dewasa.</p></div>
    <div class="card"><h3>Home Care</h3><p>Perawatan medis langsung ke rumah pasien.</p></div>
  </div>
</section>

<section class="section">
  <h2>Kontak</h2>
  <p>Alamat: Dusun Krajan RT 30 RW 03, Desa Kanigoro, Kec. Pagelaran, Malang 65177<br>Telp: -<br>Email: -</p>
</section>

<footer>
  © 2025 Klinik Nediva Husada — Semua hak dilindungi.
</footer>

</body>
</html>
