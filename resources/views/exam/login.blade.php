<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Ujian CBT</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background: #e9ecef;">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>CBT</b> UJIAN</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Masukkan No Induk & Token Ujian</p>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('exam.login.post') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="noinduk" class="form-control" placeholder="Nomor Induk Siswa" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="exam_password" class="form-control" placeholder="Password / Token Ujian" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-key"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">MASUK UJIAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="text-center mt-2 text-muted">
        <small>Pastikan jam perangkat Anda sesuai dengan waktu saat ini.</small>
    </div>
</div>
</body>
</html>