<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>Welcome To Duidev Production</title>
		<meta content="Sofware House" name="description" />
        <meta content="Web Application Developer" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
		<meta name="csrf-token" content="xAbdOw0tTzEp0haET5PfDE90TgEZi0WHCGkWzYSW">
        <!-- App favicon -->
        <link rel="icon" href="https://duidev.com/public/duidev-softwarehouse.png">
        <link rel="apple-touch-icon" href="https://duidev.com/public/duidev-softwarehouse.png">
        <!-- App css -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <link rel="stylesheet" href="https://duidev.com/public/adminlte3/fonts/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link href="https://simbian.duidev.com/adminlte3/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="https://simbian.duidev.com/adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
        <link href="https://simbian.duidev.com/adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
        <link href="https://simbian.duidev.com/adminlte3/plugins/select2/css/select2.min.css" rel="stylesheet">
        <link href="https://simbian.duidev.com/adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet">
        <link href="https://simbian.duidev.com/adminlte3/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css" rel="stylesheet">
        <link href="https://simbian.duidev.com/adminlte3/plugins/bs-stepper/css/bs-stepper.min.css" rel="stylesheet">
        <link href="https://simbian.duidev.com/adminlte3/dist/css/adminlte.min.css" rel="stylesheet">
        <style>
            #map {
                height:400px;
                min-height: 100%;
                min-width: 100%;
                display: block;
            }
        </style>
        <style>
            .duidevproduct-list {
                z-index: 0;
                width: 100%;
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
            }

            .duidevproduct {
                margin: 30px auto;
                width: 300px;
                height: 300px;
                border-radius: 20px;
                box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22);
                cursor: pointer;
                transition: 0.4s;
                background-color: #3498db;
            }
           
            .duidevproduct .duidevproduct_image {
            width: inherit;
            height: inherit;
            border-radius: 20px;
            }

            .duidevproduct .duidevproduct_image img {
            margin-top: 10px;
            margin-left: 30px;
            width: 240px;
            height: 240px;
            border-radius: 20px;
            object-fit: cover;
            }

            .duidevproduct .duidevproduct_title {
                text-align: center;
                border-radius: 0px 0px 20px 20px;
                font-family: sans-serif;
                font-weight: bold;
                font-size: 16px;
                margin-top: -40px;
                padding: 10px;
                height: 60px;
                background-color: #2980b9;
            }

            .duidevproduct:hover {
            transform: scale(0.9, 0.9);
            box-shadow: 5px 5px 30px 15px rgba(0,0,0,0.25), 
                -5px -5px 30px 15px rgba(0,0,0,0.22);
            }

            .title-white {
            color: white;
            }

            .title-yellow {
            color: yellow;
            }

            .title-black {
            color: black;
            }

            @media  all and (max-width: 500px) {
            .duidevproduct-list {
                /* On small screens, we are no longer using row direction but column */
                flex-direction: column;
            }
            }
        </style>
    </head>
    <body class="hold-transition sidebar-collapse layout-top-nav">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-blue">
                <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="https://duidev.com/public/logo-ub.png" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">
                        Selamat Datang di Website Kami
                    </span>
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="suratmenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Our Product</a>
                            <ul aria-labelledby="suratmenu" class="dropdown-menu border-0 shadow">
                                <li><a class="dropdown-item" href="https://radiology.duidev.com">Radiology Information System (RIS)</a></li>
                                <li><a class="dropdown-item" href="https://simbian.kejati-jatim.go.id">SIMBIAN - KEJATI SBY</a></li>
                                <li><a class="dropdown-item" href="http://ajpi.fp.ub.ac.id">Asosiasi Jurnal Pertanian Indonesia</a></li>
                                <li><a class="dropdown-item" href="https://sigap.ub.ac.id">Sistem Informasi Gaji Pegawai (SIGAP)</a></li>
                                <li><a class="dropdown-item" href="https://sco.ub.ac.id">Smart and Collaborative Office UB (SCO UB)</a></li>
                                <li><a class="dropdown-item" href="https://sco.ub.ac.id/safehouse">SafeHouse UB</a></li>
                                <li><a class="dropdown-item" href="https://sco.ub.ac.id/bazis">Badan Amil Zakat UB (BAZIS)</a></li>
                                <li><a class="dropdown-item" href="https://insitu.fk.ub.ac.id">Fakultas Kedokteran UB (INSITU)</a></li>
                                <li><a class="dropdown-item" href="https://siatfp.ub.ac.id">Fakultas Pertanian UB (SIAT FP)</a></li>
                                <li><a class="dropdown-item" href="https://fia.ub.ac.id/sifia/">Fakultas Ilmu Administrasi UB (SIFIA)</a></li>
                                <li><a class="dropdown-item" href="https://sco.ub.ac.id/sivoka">Fakultas Vokasi UB (SIVOKA)</a></li>
                                <li><a class="dropdown-item" href="https://sco.ub.ac.id/mipa">Fakultas MIPA UB</a></li>
                                <li><a class="dropdown-item" href="https://fikes.ub.ac.id">Fakultas Ilmu Kesehatan UB</a></li>
                                <li><a class="dropdown-item" href="https://sco.ub.ac.id/pps">Sekolah Pascasarjana UB (SIPASCA)</a></li>
                                <li><a class="dropdown-item" href="https://wakepen.duidev.com">Aplikasi Kependudukan RT/RW (WAKEPEN)</a></li>
                                <li><a class="dropdown-item" href="https://simbian.duidev.com/webinar">Webinar System</a></li>
                                <li><a class="dropdown-item" href="https://fikes.ub.ac.id/loginsikomet">Sistem Informasi Etik Penelitian</a></li>
                                <li><a class="dropdown-item" href="https://pasangkayu.duidev.com">Sistem Informasi IPM dan IPG</a></li>
                                <li><a class="dropdown-item" href="https://sco.ub.ac.id/simpen">Sistem Peminjaman Ruang</a></li>
                                <li><a class="dropdown-item" href="https://ar-rahman.duidev.com">Masjid Ar Rohman</a></li>
                                <li><a class="dropdown-item" href="https://amil.sdimohammadhatta.sch.id">SD Islam Mohammad Hatta (MH SIMUTU)</a></li>
                                <li><a class="dropdown-item" href="https://gmm.duidev.com">Yayasan Gema Mitra Muslim</a></li>
                                <li><a class="dropdown-item" href="https://alqalam.duidev.com">Kuttab Al Qalam Malang</a></li>
                                <li><a class="dropdown-item" href="https://banksoal.duidev.com">Bank Soal dan Ujian Online</a></li>
                                <li><a class="dropdown-item" href="https://aipki.duidev.com">Surat Elektronik dengan Tandatangan Elektronik</a></li>
                                <li><a class="dropdown-item" href="https://pj.duidev.com">Pesantren Jumat</a></li>
                                <li><a class="dropdown-item" href="https://fikes.ub.ac.id/siquas">Quality Assurance Information System (SIQUA)</a></li>
                                <li><a class="dropdown-item" href="">Etc</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fa fa-arrows-alt"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown user-menu">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <img src="https://duidev.com/public/mascot.png" class="user-image img-circle elevation-2" alt="User Image">
                                    <span class="d-none d-md-inline">Welcome</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <li class="user-header bg-primary">
                                    <img src="https://duidev.com/public/mascot.png" class="img-circle elevation-2" alt="User Image">
                                    <p>
                                    Visitor 
                                    <small>on Duidev Software House</small>
                                    </p>
                                </li>
                                </ul>
                            </li>
                    </ul>
                </div>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="/" class="brand-link">
                    <img src="https://duidev.com/public/logo-ub.png" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">
                        Main Menu
                    </span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="https://duidev.com/public/mascot.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"> Visitor</a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li><a class="nav-link" href="http://duidev.com"><i class="nav-icon fa fa-power-on text-primary"></i> <p>Home</p></a></li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper" >
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                        </div>
                    </div>
                </div>
                <div class="content" >
                    <div class="container-fluid">
                        <div class="row" >
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#depan" data-toggle="tab">Over View</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#formonline" data-toggle="tab">Product List</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#telemedicine" data-toggle="tab">Route To Us</a></li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="divawal">
                                            <div class="active tab-pane" id="depan">
                                                <div class="card card-widget widget-user-2">
                                                    <div class="widget-user-header bg-success">
                                                        <div class="widget-user-image">
                                                            <img class="img-circle elevation-2" src="https://duidev.com/public/DP.jpg" alt="User Avatar">
                                                        </div>
                                                        <h3 class="widget-user-username">Profil Perusahaan</h3>
                                                        <h5 class="widget-user-desc">CV. Swandhana</h5>
                                                    </div>
                                                </div>
                                                <div class="card card-primary shadow">
                                                    <div class="card-header">
                                                        <h3 class="card-title">About Me</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <strong><i class="fa fa-book mr-1"></i> Bidang Jasa</strong>
                                                        <p class="text-muted">Pengadaan Aplikasi Berbasis Website, Company Profile, Blog, etc</p>
                                                        <hr>
                                                        <strong><i class="fa fa-map-marker mr-1"></i> Alamat</strong>
                                                        <p class="text-muted">Jl. Sebuku X/18 Bunulrejo Blimbing Malang</p>
                                                        <hr>
                                                        <strong><i class="fa fa-pencil mr-1"></i> Skills</strong>
                                                        <p class="text-muted">
                                                            <span class="badge badge-danger">UI Design</span>
                                                            <span class="badge badge-success">Coding</span>
                                                            <span class="badge badge-info">Javascript</span>
                                                            <span class="badge badge-warning">PHP</span>
                                                            <span class="badge badge-primary">Laravel</span>
                                                        </p>
                                                        <hr>
                                                        <strong><i class="fa fa-file mr-1"></i> Notes</strong>
                                                        <p class="text-muted"><a href="http://wa.me/6281359108565" target="_blank">WA ME : 081359108565</a>; Email : swandhana17@gmail.com</p>
                                                    </div>
                                                    <div class="card-footer">
                                                        <a href="https://duidev.com/public/format/duidev_profile.gif" target="_blank"><img src="https://duidev.com/public/format/swandhana.gif" alt="Company Profile" width="100%"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="formonline">
                                                <div class="duidevproduct-list">
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://radiology.duidev.com/';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://radiology.duidev.com/assets/images/avatars/logomini.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Radiology Information System</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://simbian.kejati-jatim.go.id/';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://simbian.kejati-jatim.go.id/images/img-01.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>SIMBIAN - KEJATI SBY</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'http://ajpi.fp.ub.ac.id/';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Asosiasi Jurnal Pertanian Indonesia</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://sigap.ub.ac.id/login.php';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://sigap.ub.ac.id/images/mascot.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Sistem Informasi Gaji Pegawai (SIGAP)</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://sco.ub.ac.id';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://sco.ub.ac.id/logo-ub.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Smart and Collaborative Office UB</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://sco.ub.ac.id/safehouse';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://sco.ub.ac.id/logo-safehouse.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>SafeHouse UB</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://sco.ub.ac.id/bazis';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://banksoal.duidev.com/duidev-softwarehouse.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Badan Amil Zakat UB</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://insitu.fk.ub.ac.id';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Fakultas Kedokteran UB</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://siatfp.ub.ac.id';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Fakultas Pertanian UB</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://fia.ub.ac.id/sifia/';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://sco.ub.ac.id/logo-ub.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Fakultas Ilmu Administrasi UB</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://sco.ub.ac.id/sivoka';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://sco.ub.ac.id/logo-ub.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Fakultas Vokasi UB</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://sco.ub.ac.id/mipa';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://sco.ub.ac.id/logo-ub.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Fakultas MIPA UB</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://fikes.ub.ac.id';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://sco.ub.ac.id/logo-ub.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Fakultas Ilmu Kesehatan UB</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://wakepen.duidev.com/';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Aplikasi Kependudukan RT/RW </p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://simbian.duidev.com/webinar';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://firrec.org/wp-content/uploads/2020/07/logo.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Webinar System</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://fikes.ub.ac.id/loginsikomet';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Sistem Informasi Etik Penelitian</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://pasangkayu.duidev.com';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Sistem Informasi IPM dan IPG</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://sco.ub.ac.id/simpen';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://sco.ub.ac.id/logo-ub.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Sistem Peminjaman Ruang</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://ar-rahman.duidev.com';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Masjid Ar Rohman </p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://amil.sdimohammadhatta.sch.id/frontpage';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://simbian.duidev.com/logo/1602884372logo.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>SD Islam Mohammad Hatta</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://gmm.duidev.com/';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://simbian.duidev.com/logo/1603375609logo.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Yayasan Gema Mitra Muslim</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://gmm.duidev.com/';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://simbian.duidev.com/logo/1609804637logo.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>SMK Wachid Hasyim Surabaya</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://simbian.duidev.com/frontpage?id=1';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://simbian.duidev.com/logo/1653361770logo.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>SDIT SALSABILA KEPANJEN</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://alqalam.duidev.com';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://simbian.duidev.com/logo/1643895019logo.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Kuttab Al Qalam Malang</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://banksoal.duidev.com';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://banksoal.duidev.com/duidev-softwarehouse.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Bank Soal</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://aipki.duidev.com';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://aipki.duidev.com/duidev-softwarehouse.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Surat Elektronik</p>
                                                        </div>
                                                    </div>
                                                    <div class="duidevproduct 1" onclick="window.location.href = 'https://pj.duidev.com/';">
                                                        <div class="duidevproduct_image"> 
                                                        <img src="https://pj.duidev.com/logo/1662246561logo.png" /> 
                                                        </div>
                                                        <div class="duidevproduct_title title-white">
                                                            <p>Pesantren Jumat</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="telemedicine">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15805.12514208683!2d112.6533271!3d-7.9698547!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc86b43c32c52667b!2sDuidev%20Software%20Hose!5e0!3m2!1sid!2sid!4v1662254555631!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-primary card-outline" >
                                    <div class="card-body box-profile bg-primary">
                                        <div class="text-center">
                                            <img src="https://simbian.duidev.com/frontduidev.png" alt="User profile picture" width="100%">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <strong><i class="fa fa-book mr-1"></i> President</strong>
                                        <p class="text-muted"><a href="http://wa.me/6281359108565" target="_blank">Dwi Swandhana</a></p>
                                        <hr>
                                        <strong><i class="fa fa-phone mr-1"></i> Office</strong>
                                        <p class="text-muted">Jalan Lamandau 18 A</p>
                                        <hr>
                                        <strong><i class="fa fa-envelope mr-1"></i> Email</strong>
                                        <p class="text-muted">swandhana17@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tempatctk" style="overflow: hidden; display: none;">
                <div id="tabel_cetak"></div>
            </div>
            <input type="hidden" name="_token" id="token" value="xAbdOw0tTzEp0haET5PfDE90TgEZi0WHCGkWzYSW">
            <footer class="main-footer">
                <div class="float-right d-none d-sm-inline">
                    <b>Duidev Sofware House</b>
                </div>
                <strong>Copyright &copy; 2022 <a href="#"></a>.</strong> All rights reserved.
            </footer>
        </div>
        <script src="https://simbian.duidev.com/adminlte3/plugins/jquery/jquery.min.js"></script>
        <script src="https://simbian.duidev.com/adminlte3/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="https://simbian.duidev.com/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://simbian.duidev.com/adminlte3/plugins/select2/js/select2.full.min.js"></script>
        <script src="https://simbian.duidev.com/adminlte3/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
        <script src="https://simbian.duidev.com/adminlte3/plugins/inputmask/jquery.inputmask.min.js"></script>
        <script src="https://simbian.duidev.com/adminlte3/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="https://simbian.duidev.com/adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="https://simbian.duidev.com/adminlte3/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script src="https://simbian.duidev.com/adminlte3/plugins/bs-stepper/js/bs-stepper.min.js"></script>
        <script src="https://simbian.duidev.com/adminlte3/dist/js/adminlte.min.js"></script>

        <!-- Slimscroll -->
        <script src="https://simbian.duidev.com/adminlte3/plugins/jquery-knob/jquery.knob.min.js"></script>

        <script type="text/javascript">
            $(function () {
                $('.select2').select2({width: '100%'});
            });
            
            $(document).ready(function() {
                $('#loading').hide();
                $('#divlupapassword').hide();
                $('#divterimakasih').hide();
                $('.rujukan').hide();
            });
        </script>
    </body>
</html>