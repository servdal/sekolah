<link rel="stylesheet" href="{{ asset('adminlte3/fonts/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
<link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('adminlte3/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<link href="{{ asset('adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
<link href="{{ asset('adminlte3/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('adminlte3/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('adminlte3/plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('adminlte3/plugins/jquery-toastr/jquery.toast.min.css') }}" rel="stylesheet" />
<link href="{{ asset('adminlte3/dist/css/adminlte.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
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
            flex-direction: column;
        }
    }
</style>