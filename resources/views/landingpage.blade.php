<!DOCTYPE html>
<html>
   <head>
        <meta charset="utf-8" />
		<title>{!! config('global.Title') !!}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		{{-- <meta content="{!! config('global.sekolah') !!}" name="description" />
        <meta content="{!! config('global.kota') !!}" name="author" /> --}}
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">
        @include('adminlte3.css')
    </head>

    <style>
        .cards-list {
        z-index: 0;
        width: 100%;
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        }

        .card {
        margin: 30px auto;
        width: 300px;
        height: 300px;
        border-radius: 20px;
        box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22);
        cursor: pointer;
        transition: 0.4s;
        background-color: #3498db;
        }

        .card .card_image {
        width: inherit;
        height: inherit;
        border-radius: 20px;
        }

        .card .card_image img {
        margin-top: 10px;
        margin-left: 30px;
        width: 240px;
        height: 240px;
        border-radius: 20px;
        object-fit: cover;
        }

        .card .card_title {
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

        .card:hover {
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

        @media all and (max-width: 500px) {
        .card-list {
            /* On small screens, we are no longer using row direction but column */
            flex-direction: column;
        }
        }


        /*
        .card {
        margin: 30px auto;
        width: 300px;
        height: 300px;
        border-radius: 40px;
        background-image: url('https://i.redd.it/b3esnz5ra34y.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-repeat: no-repeat;
        box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22);
        transition: 0.4s;
        }
        */
    </style>

	<body class="hold-transition skin-purple layout-top-nav">
        <div class="wrapper" >      
            <div class="content-wrapper">
                <section class="content" >
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-widget widget-user-2">
                                <div class="widget-user-header bg-primary">
                                    <img src="{!! config('global.logosimaster') !!}" >
                                    <br>
                                    <hr>
                                    <b>{!! config('global.Title2') !!}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cards-list">

                                <?php foreach($data as $item) { ?>
                                    
                                    <div class="card 1" onclick="window.location.href = '{{ $item['domain'].'/frontpage?id='.$item['id'] }}';">
                                        <div class="card_image"> 
                                        <img src="{{ url('').'/'.$item['logo'] }}" /> 
                                        </div>
                                        <div class="card_title title-white">
                                            <p>{{ $item['nama_sekolah'] }}</p>
                                        </div>
                                    </div>

                                <?php }  ?>
                                
                            </div>
                        </div>
                    </div>
                    
                </section>
            </div>
        </div>
    
    </body>
</html>
