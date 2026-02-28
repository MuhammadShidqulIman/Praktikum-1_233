<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pertemuan 1 Laravel</title>
</head>
<body style="background:#0f172a; color:white; font-family:Arial; margin:0;">

    <!-- NAVIGATION LOGIN REGISTER -->
    <div style="position:absolute; top:20px; right:30px;">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" style="color:white; margin-right:15px; text-decoration:none;">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" style="color:white; margin-right:15px; text-decoration:none;">
                    Login
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" style="color:white; text-decoration:none;">
                        Register
                    </a>
                @endif
            @endauth
        @endif
    </div>

    <!-- CARD UTAMA -->
    <div style="display:flex; justify-content:center; align-items:center; height:100vh;">
        <div style="background:#111827; padding:40px; border-radius:12px; text-align:center; box-shadow:0 0 20px #2563eb;">
            <h1 style="color:#38bdf8;">Tugas Laravel Pertemuan 1</h1>
            <h2>Nama: <b>Muhammad Shidqul Iman</b></h2>
            <p>NIM: <b>20230140233</b></p>

            <button style="margin-top:15px; padding:10px 20px; background:#2563eb; color:white; border:none; border-radius:6px;">
                Laravel Berhasil Diinstall 🚀
            </button>
        </div>
    </div>

</body>
</html>