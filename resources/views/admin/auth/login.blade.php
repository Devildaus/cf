<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Klinik Nediva Husada — Login</title>
  <style>
    :root{
      --accent:#0061af;
      --bg:#f5f6f8;
      --card:#ffffff;
      --muted:#6b7280;
      --radius:12px;
      font-family:Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      background:linear-gradient(180deg,var(--bg),#e9f2fb 60%);
      color:#0f172a;
      padding:24px;
    }

    .wrap{
      width:100%;
      max-width:980px;
      display:grid;
      grid-template-columns:1fr 420px;
      gap:30px;
      align-items:center;
    }

    /* Left: branding / info (like index) */
    .panel{
      background:transparent;
      padding:20px 24px;
      border-radius:var(--radius);
    }
    .brand{
      display:flex;
      gap:14px;
      align-items:center;
      margin-bottom:18px;
    }
    .logo{
      width:72px; height:72px; border-radius:14px; overflow:hidden; flex:0 0 72px;
      background:linear-gradient(135deg,var(--accent),#0ea5a4);
      display:flex; align-items:center; justify-content:center; color:white;
    }
    .logo img{width:100%; height:100%; object-fit:cover; display:block}
    .brand h1{margin:0; font-size:20px}
    .brand p{margin:6px 0 0; color:var(--muted); font-size:14px}

    .info-card{
      background:var(--card);
      border-radius:12px;
      padding:18px;
      box-shadow:0 10px 30px rgba(6,20,50,0.06);
    }
    .info-card h3{margin:0 0 8px; color:var(--accent)}
    .list{display:grid; gap:8px; margin-top:10px}
    .list div{background:linear-gradient(180deg,#fbfdff,#ffffff); padding:10px; border-radius:8px; border:1px solid rgba(3,102,214,0.06); font-size:14px}

    /* Right: login box */
    .login-card{
      background:var(--card);
      border-radius:14px;
      padding:24px;
      box-shadow:0 18px 50px rgba(6,20,50,0.12);
    }
    .login-card h2{margin:0 0 6px; color:var(--accent)}
    .login-card p.lead{margin:0 0 14px; color:var(--muted)}
    .field{margin-top:12px}
    label{display:block; font-size:13px; margin-bottom:6px; color:#334155}
    .input-group{display:flex; gap:8px; align-items:center}
    .icon-box{background:#f1f5f9;padding:10px;border-radius:8px;border:1px solid #e6eef8; display:flex; align-items:center; justify-content:center; width:44px;}
    input[type="text"], input[type="password"], input[type="email"]{
      flex:1; padding:10px 12px; border-radius:10px; border:1px solid #e6eef8; font-size:15px;
    }
    .actions{display:flex; gap:10px; margin-top:16px; align-items:center}
    .btn{
      background:var(--accent); color:white; padding:10px 14px; border-radius:10px; text-decoration:none; border:none;
      font-weight:600; cursor:pointer;
    }
    .btn.secondary{
      background:white; color:var(--accent); border:1px solid rgba(3,102,214,0.12);
    }
    .note{margin-top:12px; color:var(--muted); font-size:13px}
    .invalid-feedback{color:#b91c1c; font-size:13px; margin-top:8px}
    .is-invalid{border-color:#f87171 !important; box-shadow:none}

    @media (max-width:920px){
      .wrap{grid-template-columns:1fr; padding:0 8px}
      .brand{justify-content:center}
    }
  </style>
</head>
<body>

  <div class="wrap" role="main">

    <!-- left: branding & services -->
    <div class="panel" aria-hidden="false">
      <div class="brand" role="banner">
        <div class="logo" aria-hidden="true">
          <img src="icon.jpg" alt="Logo Klinik Nediva Husada">
        </div>
        <div>
          <h1>Klinik Nediva Husada</h1>
          <p class="muted">Medical &amp; health — Layanan kesehatan lengkap untuk keluarga Anda</p>
        </div>
      </div>

      <div class="info-card" aria-labelledby="layanan">
        <h3 id="layanan">Melayani</h3>
        <div class="list" aria-hidden="false">
          <div>🏥 UGD 24 Jam</div>
          <div>🤱 Persalinan</div>
          <div>🩺 Rawat Inap</div>
          <div>💉 Rawat Jalan</div>
          <div>👨‍👩‍👧‍👦 KB &amp; KIA</div>
          <div>💊 Apotek</div>
          <div>🩸 Laboratorium</div>
          <div>🧏‍♂️ Khitan</div>
          <div>🏠 Home Care</div>
        </div>

        <div style="margin-top:14px; font-size:14px; color:var(--muted)">
          <strong>Alamat</strong><br>
          Dusun Krajan RT 30 RW 03, Desa Kanigoro, Kec. Pagelaran, Malang 65177
        </div>
      </div>
    </div>

    <!-- right: login -->
    <aside class="login-card" aria-label="Login">
      <h2>Masuk</h2>
      <p class="lead">Masuk sebagai staf atau pasien untuk mengakses informasi.</p>

      {{-- show general login error (session) --}}
      @if (session()->has('loginError'))
        <div style="background:#fee2e2;color:#7f1d1d;padding:10px;border-radius:8px;margin-bottom:12px;">{{ session('loginError') }}</div>
      @endif

      <form action="/login" method="post" novalidate>
        @csrf

        {{-- Email --}}
        <div class="field">
          <label for="email">Email / Username</label>
          <div class="input-group">
            <input id="email" name="email" type="email"
                   class="@error('email') is-invalid @enderror"
                   placeholder="you@example.com" value="{{ old('email') }}" autocomplete="username" required>
            <div class="icon-box" aria-hidden="true">
              <!-- simple envelope icon using SVG -->
              <svg width="18" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M3 6.5L12 13L21 6.5" stroke="#64748b" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="3" y="5" width="18" height="14" rx="2" stroke="#cbd5e1" stroke-width="1.2"/>
              </svg>
            </div>

            @error('email')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
        </div>

        {{-- Password --}}
        <div class="field">
          <label for="password">Kata Sandi</label>
          <div class="input-group">
            <input id="password" name="password" type="password"
                   class="@error('password') is-invalid @enderror"
                   placeholder="••••••••" autocomplete="current-password" required>
            <div class="icon-box" aria-hidden="true">
              <svg width="14" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <rect x="3" y="11" width="18" height="10" rx="2" stroke="#cbd5e1" stroke-width="1.2"/>
                <path d="M7 11V8a5 5 0 0110 0v3" stroke="#64748b" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>

            @error('password')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="actions">
          <button class="btn" type="submit">Login</button>
          <a href="{{ url('/') }}" class="btn secondary" role="button">Batal</a>
        </div>

        <p class="note">Demo: tampilan diubah agar konsisten dengan halaman indeks.</p>
      </form>

    </aside>

  </div>

</body>
</html>
