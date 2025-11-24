<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Klinik Nediva Husada - Layanan Kesehatan Terpercaya</title>
  <style>
    :root {
      --primary: #0061af;
      --primary-dark: #004a87;
      --primary-light: #e8f2ff;
      --secondary: #0ea5a4;
      --white: #ffffff;
      --gray-light: #f8fafc;
      --gray: #64748b;
      --gray-dark: #334155;
      --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.12);
      --radius: 16px;
      --radius-sm: 12px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
      background: var(--gray-light);
      color: var(--gray-dark);
      line-height: 1.6;
      overflow-x: hidden;
    }

    /* Header */
    header {
      background: var(--white);
      box-shadow: var(--shadow);
      padding: 16px 5%;
      position: sticky;
      top: 0;
      z-index: 100;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: all 0.3s ease;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 22px;
      font-weight: 700;
      color: var(--primary);
    }

    .logo-img {
      height: 48px;
      width: 48px;
      border-radius: 12px;
      object-fit: cover;
      box-shadow: 0 4px 12px rgba(0, 97, 175, 0.2);
    }

    .btn-login {
      padding: 12px 24px;
      border-radius: var(--radius-sm);
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: var(--white);
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(0, 97, 175, 0.3);
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 97, 175, 0.4);
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(rgba(0, 74, 135, 0.85), rgba(14, 165, 164, 0.8)), 
                  url('https://images.unsplash.com/photo-1580281657521-3aa1f5b6f58a?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
      height: 80vh;
      min-height: 500px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      text-align: center;
      padding: 0 5%;
      position: relative;
    }

    .hero-content {
      max-width: 800px;
      animation: fadeInUp 1s ease;
    }

    .hero h1 {
      font-size: 3.5rem;
      margin-bottom: 20px;
      font-weight: 700;
      line-height: 1.2;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .hero p {
      font-size: 1.25rem;
      margin-bottom: 30px;
      opacity: 0.9;
    }

    .hero-buttons {
      display: flex;
      gap: 16px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .btn-primary {
      padding: 14px 32px;
      border-radius: var(--radius-sm);
      background: var(--white);
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: var(--shadow);
    }

    .btn-secondary {
      padding: 14px 32px;
      border-radius: var(--radius-sm);
      background: transparent;
      color: var(--white);
      text-decoration: none;
      font-weight: 600;
      border: 2px solid var(--white);
      transition: all 0.3s ease;
    }

    .btn-primary:hover, .btn-secondary:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* Sections */
    .section {
      max-width: 1200px;
      margin: 80px auto;
      padding: 0 5%;
    }

    .section-header {
      text-align: center;
      margin-bottom: 50px;
    }

    .section-header h2 {
      color: var(--primary);
      font-size: 2.5rem;
      margin-bottom: 16px;
      font-weight: 700;
    }

    .section-header p {
      color: var(--gray);
      font-size: 1.125rem;
      max-width: 700px;
      margin: 0 auto;
    }

    /* About Section */
    .about-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px;
      align-items: center;
    }

    .about-text h3 {
      color: var(--primary);
      font-size: 1.75rem;
      margin-bottom: 20px;
    }

    .about-text p {
      margin-bottom: 20px;
      font-size: 1.1rem;
    }

    .about-image {
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow-lg);
      height: 400px;
    }

    .about-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .about-image:hover img {
      transform: scale(1.05);
    }

    /* Services Section */
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
    }

    .card {
      background: var(--white);
      border-radius: var(--radius);
      padding: 30px;
      box-shadow: var(--shadow);
      transition: all 0.3s ease;
      border-top: 4px solid var(--primary);
      text-align: center;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: var(--shadow-lg);
    }

    .card-icon {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }

    .card h3 {
      color: var(--primary);
      margin-bottom: 15px;
      font-size: 1.5rem;
    }

    .card p {
      color: var(--gray);
    }

    /* Contact Section */
    .contact-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px;
      background: var(--white);
      border-radius: var(--radius);
      padding: 40px;
      box-shadow: var(--shadow);
    }

    .contact-info h3 {
      color: var(--primary);
      margin-bottom: 20px;
      font-size: 1.75rem;
    }

    .contact-details {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .contact-item {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .contact-icon {
      background: var(--primary-light);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
    }

    .map-placeholder {
      background: var(--gray-light);
      border-radius: var(--radius);
      height: 300px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--gray);
      font-weight: 600;
    }

    /* Footer */
    footer {
      background: linear-gradient(135deg, var(--primary-dark), #003350);
      color: var(--white);
      padding: 50px 5% 30px;
      margin-top: 80px;
    }

    .footer-content {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 40px;
      margin-bottom: 40px;
    }

    .footer-column h3 {
      font-size: 1.25rem;
      margin-bottom: 20px;
      position: relative;
      padding-bottom: 10px;
    }

    .footer-column h3::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 40px;
      height: 2px;
      background: var(--secondary);
    }

    .footer-links {
      list-style: none;
    }

    .footer-links li {
      margin-bottom: 10px;
    }

    .footer-links a {
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .footer-links a:hover {
      color: var(--white);
      padding-left: 5px;
    }

    .footer-bottom {
      text-align: center;
      padding-top: 30px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: rgba(255, 255, 255, 0.7);
    }

    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.5rem;
      }
      
      .about-content,
      .contact-content {
        grid-template-columns: 1fr;
      }
      
      .hero-buttons {
        flex-direction: column;
        align-items: center;
      }
      
      .btn-primary,
      .btn-secondary {
        width: 100%;
        max-width: 250px;
        text-align: center;
      }
    }

    @media (max-width: 480px) {
      .hero h1 {
        font-size: 2rem;
      }
      
      .section-header h2 {
        font-size: 2rem;
      }
      
      .cards {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

<header>
  <div class="logo">
    <img src="/icon.jpg" alt="Klinik Nediva Husada" class="logo-img">
    <span>Klinik Nediva Husada</span>
  </div>
  <a href="/login" class="btn-login">Login</a>
</header>

<section class="hero">
  <div class="hero-content">
    <h1>Layanan Kesehatan Lengkap & Terjangkau</h1>
    <p>Memberikan pelayanan medis terbaik dengan tim profesional dan fasilitas modern untuk kesehatan keluarga Anda</p>
    <div class="hero-buttons">
      <a href="#layanan" class="btn-primary">Lihat Layanan</a>
      <a href="#kontak" class="btn-secondary">Hubungi Kami</a>
    </div>
  </div>
</section>

<section class="section" id="tentang">
  <div class="section-header">
    <h2>Tentang Kami</h2>
    <p>Klinik Nediva Husada berkomitmen memberikan pelayanan kesehatan terbaik dengan standar profesional</p>
  </div>
  <div class="about-content">
    <div class="about-text">
      <h3>Pelayanan Kesehatan Terpercaya Sejak 2010</h3>
      <p>Klinik Nediva Husada adalah fasilitas pelayanan kesehatan yang menyediakan berbagai layanan seperti UGD 24 jam, persalinan, rawat inap, rawat jalan, KB & KIA, apotek, laboratorium, khitan, hingga layanan home care.</p>
      <p>Berlokasi di Dusun Krajan RT 30 RW 03, Desa Kanigoro, Kecamatan Pagelaran, Malang, klinik ini berkomitmen memberikan pelayanan medis yang ramah, cepat, dan profesional dengan tim dokter dan perawat yang berpengalaman.</p>
    </div>
    <div class="about-image">
      <img src="https://images.unsplash.com/photo-1551076805-e1869033e561?q=80&w=1000&auto=format&fit=crop" alt="Interior Klinik Nediva Husada">
    </div>
  </div>
</section>

<section class="section" id="layanan">
  <div class="section-header">
    <h2>Layanan Kami</h2>
    <p>Berbagai layanan kesehatan lengkap untuk memenuhi kebutuhan medis Anda dan keluarga</p>
  </div>
  <div class="cards">
    <div class="card">
      <div class="card-icon">🏥</div>
      <h3>UGD 24 Jam</h3>
      <p>Penanganan darurat medis kapan saja dengan tim dokter yang siap siaga</p>
    </div>
    <div class="card">
      <div class="card-icon">🤱</div>
      <h3>Persalinan</h3>
      <p>Layanan persalinan yang aman dan nyaman dengan fasilitas lengkap</p>
    </div>
    <div class="card">
      <div class="card-icon">🩺</div>
      <h3>Rawat Inap</h3>
      <p>Fasilitas rawat inap yang bersih, nyaman, dan didukung perawat profesional</p>
    </div>
    <div class="card">
      <div class="card-icon">💉</div>
      <h3>Rawat Jalan</h3>
      <p>Pemeriksaan dan konsultasi kesehatan setiap hari oleh dokter spesialis</p>
    </div>
    <div class="card">
      <div class="card-icon">👨‍👩‍👧‍👦</div>
      <h3>KB & KIA</h3>
      <p>Layanan kesehatan ibu, anak, dan keluarga berencana yang komprehensif</p>
    </div>
    <div class="card">
      <div class="card-icon">💊</div>
      <h3>Apotek</h3>
      <p>Penyediaan obat lengkap sesuai resep dokter dengan harga terjangkau</p>
    </div>
    <div class="card">
      <div class="card-icon">🩸</div>
      <h3>Laboratorium</h3>
      <p>Pemeriksaan laboratorium cepat, akurat, dan dengan hasil yang terpercaya</p>
    </div>
    <div class="card">
      <div class="card-icon">🧏‍♂️</div>
      <h3>Khitan</h3>
      <p>Layanan khitan anak dan dewasa dengan metode modern dan steril</p>
    </div>
    <div class="card">
      <div class="card-icon">🏠</div>
      <h3>Home Care</h3>
      <p>Perawatan medis langsung ke rumah pasien oleh tenaga kesehatan profesional</p>
    </div>
  </div>
</section>

<section class="section" id="kontak">
  <div class="section-header">
    <h2>Kontak Kami</h2>
    <p>Hubungi kami untuk informasi lebih lanjut atau janji temu dengan dokter</p>
  </div>
  <div class="contact-content">
    <div class="contact-info">
      <h3>Informasi Kontak</h3>
      <div class="contact-details">
        <div class="contact-item">
          <div class="contact-icon">📍</div>
          <div>
            <strong>Alamat</strong><br>
            Dusun Krajan RT 30 RW 03, Desa Kanigoro, Kec. Pagelaran, Malang 65177
          </div>
        </div>
        <div class="contact-item">
          <div class="contact-icon">📞</div>
          <div>
            <strong>Telepon</strong><br>
            (0341) 123456
          </div>
        </div>
        <div class="contact-item">
          <div class="contact-icon">📱</div>
          <div>
            <strong>WhatsApp</strong><br>
            +62 812-3456-7890
          </div>
        </div>
        <div class="contact-item">
          <div class="contact-icon">✉️</div>
          <div>
            <strong>Email</strong><br>
            info@nedivahusada.com
          </div>
        </div>
        <div class="contact-item">
          <div class="contact-icon">🕒</div>
          <div>
            <strong>Jam Operasional</strong><br>
            Senin - Minggu: 24 Jam
          </div>
        </div>
      </div>
    </div>
    <div class="map">
      <div class="map-placeholder">
        [Peta Lokasi Klinik Nediva Husada]
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="footer-content">
    <div class="footer-column">
      <h3>Klinik Nediva Husada</h3>
      <p>Layanan kesehatan lengkap dan terjangkau untuk keluarga Anda dengan tim medis profesional dan fasilitas modern.</p>
    </div>
    <div class="footer-column">
      <h3>Layanan Cepat</h3>
      <ul class="footer-links">
        <li><a href="#tentang">Tentang Kami</a></li>
        <li><a href="#layanan">Layanan</a></li>
        <li><a href="#kontak">Kontak</a></li>
        <li><a href="/login">Login Staff</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h3>Layanan Medis</h3>
      <ul class="footer-links">
        <li><a href="#layanan">UGD 24 Jam</a></li>
        <li><a href="#layanan">Rawat Inap</a></li>
        <li><a href="#layanan">Persalinan</a></li>
        <li><a href="#layanan">Home Care</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    © 2025 Klinik Nediva Husada — Semua hak dilindungi.
  </div>
</footer>

</body>
</html>