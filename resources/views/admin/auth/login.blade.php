<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Klinik Nediva Husada — Login</title>
  <style>
    :root{
      --accent:#0061af;
      --accent-light:#e8f2ff;
      --accent-dark:#004a87;
      --bg:#f8fafc;
      --card:#ffffff;
      --muted:#64748b;
      --muted-light:#94a3b8;
      --radius:16px;
      --radius-sm:12px;
      --shadow:0 10px 40px rgba(6,20,50,0.08);
      --shadow-lg:0 20px 60px rgba(6,20,50,0.12);
      font-family:Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      background:linear-gradient(135deg, #f0f7ff 0%, #e6f0ff 50%, #ffffff 100%);
      color:#0f172a;
      padding:24px;
      position: relative;
      line-height:1.6;
    }

    /* Background decorative elements */
    .bg-decoration {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: -1;
    }
    
    .bg-circle {
      position: absolute;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent-light), transparent);
      opacity: 0.6;
    }
    
    .circle-1 {
      width: 300px;
      height: 300px;
      top: -150px;
      right: -100px;
    }
    
    .circle-2 {
      width: 200px;
      height: 200px;
      bottom: -80px;
      left: -80px;
    }

    /* Tombol Home yang Lebih Aestetik */
    .home-btn {
      position: absolute;
      top: 24px;
      left: 24px;
      background: linear-gradient(135deg, var(--accent), var(--accent-dark));
      color: white;
      padding: 12px 20px;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 10px;
      box-shadow: var(--shadow);
      border: none;
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      z-index: 100;
      overflow: hidden;
    }
    
    .home-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }
    
    .home-btn:hover::before {
      left: 100%;
    }
    
    .home-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(0, 97, 175, 0.4);
    }
    
    .home-btn:active {
      transform: translateY(-1px);
    }
    
    .home-icon {
      width: 18px;
      height: 18px;
      transition: transform 0.3s ease;
    }
    
    .home-btn:hover .home-icon {
      transform: scale(1.1);
    }

    .wrap{
      width:100%;
      max-width:980px;
      display:grid;
      grid-template-columns:1fr 420px;
      gap:40px;
      align-items:center;
    }

    /* Left: branding / info (like index) */
    .panel{
      background:transparent;
      padding:20px 0;
      border-radius:var(--radius);
    }
    .brand{
      display:flex;
      gap:16px;
      align-items:center;
      margin-bottom:24px;
    }
    .logo{
      width:80px; 
      height:80px; 
      border-radius:18px; 
      overflow:hidden; 
      flex:0 0 80px;
      background:linear-gradient(135deg,var(--accent),#0ea5a4);
      display:flex; 
      align-items:center; 
      justify-content:center; 
      color:white;
      box-shadow: var(--shadow);
    }
    .logo img{width:100%; height:100%; object-fit:cover; display:block}
    .brand-text h1{margin:0; font-size:24px; font-weight:700; color:#1e293b}
    .brand-text p{margin:8px 0 0; color:var(--muted); font-size:15px; line-height:1.5}

    .info-card{
      background:var(--card);
      border-radius:var(--radius);
      padding:28px;
      box-shadow:var(--shadow);
      border: 1px solid rgba(255,255,255,0.8);
      backdrop-filter: blur(10px);
    }
    .info-card h3{margin:0 0 16px; color:var(--accent); font-size:20px; font-weight:600}
    .list{display:grid; gap:10px; margin-top:16px}
    .list div{
      background:linear-gradient(180deg,#fbfdff,#ffffff); 
      padding:12px 16px; 
      border-radius:var(--radius-sm); 
      border:1px solid rgba(3,102,214,0.08); 
      font-size:14px;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.2s ease;
    }
    
    .list div:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 97, 175, 0.1);
      border-color: rgba(3,102,214,0.15);
    }

    .address {
      margin-top:20px; 
      padding-top:20px;
      border-top: 1px solid #f1f5f9;
      font-size:14px; 
      color:var(--muted);
      line-height: 1.6;
    }

    /* Right: login box */
    .login-card{
      background:var(--card);
      border-radius:var(--radius);
      padding:32px;
      box-shadow:var(--shadow-lg);
      border: 1px solid rgba(255,255,255,0.9);
      backdrop-filter: blur(10px);
    }
    .login-card h2{
      margin:0 0 8px; 
      color:var(--accent); 
      font-size:24px;
      font-weight:700;
    }
    .login-card p.lead{
      margin:0 0 24px; 
      color:var(--muted);
      font-size:15px;
    }
    .field{margin-top:20px}
    label{
      display:block; 
      font-size:14px; 
      margin-bottom:8px; 
      color:#334155;
      font-weight:500;
    }
    .input-group{
      display:flex; 
      gap:12px; 
      align-items:center;
    }
    .icon-box{
      background:var(--accent-light);
      padding:12px;
      border-radius:var(--radius-sm);
      border:1px solid rgba(3,102,214,0.1); 
      display:flex; 
      align-items:center; 
      justify-content:center; 
      width:48px;
      height:48px;
      flex-shrink: 0;
    }
    input[type="text"], input[type="password"], input[type="email"]{
      flex:1; 
      padding:14px 16px; 
      border-radius:var(--radius-sm); 
      border:1.5px solid #e2e8f0; 
      font-size:15px;
      transition: all 0.2s ease;
      background: #ffffff;
    }
    
    input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(0, 97, 175, 0.1);
    }
    
    .actions{
      display:flex; 
      gap:12px; 
      margin-top:28px; 
      align-items:center;
    }
    .btn{
      background:var(--accent); 
      color:white; 
      padding:14px 24px; 
      border-radius:var(--radius-sm); 
      text-decoration:none; 
      border:none;
      font-weight:600; 
      cursor:pointer;
      font-size:15px;
      transition: all 0.2s ease;
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .btn:hover {
      background: var(--accent-dark);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 97, 175, 0.3);
    }
    
    .btn.secondary{
      background:white; 
      color:var(--accent); 
      border:1.5px solid #e2e8f0;
    }
    
    .btn.secondary:hover {
      background: #f8fafc;
      border-color: var(--accent);
      transform: translateY(-2px);
    }
    
    .note{
      margin-top:20px; 
      color:var(--muted-light); 
      font-size:13px;
      text-align: center;
      padding: 12px;
      background: #f8fafc;
      border-radius: var(--radius-sm);
    }
    .invalid-feedback{
      color:#dc2626; 
      font-size:13px; 
      margin-top:8px;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .is-invalid{
      border-color:#f87171 !important; 
      box-shadow:0 0 0 3px rgba(220, 38, 38, 0.1) !important;
    }

    /* Error message styling */
    .error-message {
      background:#fef2f2;
      color:#991b1b;
      padding:14px 16px;
      border-radius:var(--radius-sm);
      margin-bottom:20px;
      border-left:4px solid #dc2626;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size:14px;
    }

    @media (max-width:920px){
      .wrap{
        grid-template-columns:1fr; 
        padding:0 8px;
        gap: 30px;
      }
      .brand{
        justify-content:center;
        text-align: center;
        flex-direction: column;
      }
      .home-btn {
        top: 16px;
        left: 16px;
        padding: 10px 16px;
        font-size: 13px;
      }
      .login-card {
        padding: 24px;
      }
    }
  </style>
</head>
<body>

  <!-- Background decorations -->
  <div class="bg-decoration">
    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>
  </div>

  <!-- Tombol Home yang Lebih Aestetik -->
  <a href="{{ url('/') }}" class="home-btn" role="button" aria-label="Kembali ke halaman utama">
    <svg class="home-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <span>Kembali ke Beranda</span>
  </a>

  <div class="wrap" role="main">

    <!-- left: branding & services -->
    <div class="panel" aria-hidden="false">
      <div class="brand" role="banner">
        <div class="logo" aria-hidden="true">
          <img src="icon.jpg" alt="Logo Klinik Nediva Husada">
        </div>
        <div class="brand-text">
          <h1>Klinik Nediva Husada</h1>
          <p>Medical & health — Layanan kesehatan lengkap untuk keluarga Anda</p>
        </div>
      </div>

      <div class="info-card" aria-labelledby="layanan">
        <h3 id="layanan">Layanan Kami</h3>
        <div class="list" aria-hidden="false">
          <div>🏥 UGD 24 Jam</div>
          <div>🤱 Persalinan</div>
          <div>🩺 Rawat Inap</div>
          <div>💉 Rawat Jalan</div>
          <div>👨‍👩‍👧‍👦 KB & KIA</div>
          <div>💊 Apotek</div>
          <div>🩸 Laboratorium</div>
          <div>🧏‍♂️ Khitan</div>
          <div>🏠 Home Care</div>
        </div>

        <div class="address">
          <strong>Alamat</strong><br>
          Dusun Krajan RT 30 RW 03, Desa Kanigoro, Kec. Pagelaran, Malang 65177
        </div>
      </div>
    </div>

    <!-- right: login -->
    <aside class="login-card" aria-label="Login">
      <h2>Masuk ke Akun</h2>
      <p class="lead">Masuk sebagai staf atau pasien untuk mengakses informasi.</p>

      {{-- show general login error (session) --}}
      @if (session()->has('loginError'))
        <div class="error-message">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 8V12M12 16H12.01M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          {{ session('loginError') }}
        </div>
      @endif

      <form action="/login" method="post" novalidate>
        @csrf

        {{-- Email --}}
        <div class="field">
          <label for="email">Email / Username</label>
          <div class="input-group">
            <input id="email" name="email" type="email"
                   class="@error('email') is-invalid @enderror"
                   placeholder="anda@contoh.com" value="{{ old('email') }}" autocomplete="username" required>
            <div class="icon-box" aria-hidden="true">
              <svg width="20" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M3 6.5L12 13L21 6.5" stroke="#0061af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="3" y="5" width="18" height="14" rx="2" stroke="#0061af" stroke-width="1.5"/>
              </svg>
            </div>
          </div>
          @error('email')
            <div class="invalid-feedback">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 8V12M12 16H12.01M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              {{ $message }}
            </div>
          @enderror
        </div>

        {{-- Password --}}
        <div class="field">
          <label for="password">Kata Sandi</label>
          <div class="input-group">
            <input id="password" name="password" type="password"
                   class="@error('password') is-invalid @enderror"
                   placeholder="••••••••" autocomplete="current-password" required>
            <div class="icon-box" aria-hidden="true">
              <svg width="16" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <rect x="3" y="11" width="18" height="10" rx="2" stroke="#0061af" stroke-width="1.5"/>
                <path d="M7 11V8a5 5 0 0110 0v3" stroke="#0061af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </div>
          @error('password')
            <div class="invalid-feedback">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 8V12M12 16H12.01M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="actions">
          <button class="btn" type="submit">
            <span>Masuk</span>
          </button>
          <a href="{{ url('/') }}" class="btn secondary" role="button">Batal</a>
        </div>

        <div class="note">
          Pastikan informasi yang Anda masukkan benar sebelum menekan tombol "Masuk".
      </form>

    </aside>

  </div>

</body>
</html>