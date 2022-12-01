<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">



<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
    <meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content=" " />
	<meta property="og:title" content=" " />
	<meta property="og:description" content="" />
	<meta property="og:image" content="../social-image.png" />
	<meta name="format-detection" content="telephone=no">
    <title>Naxum - Technical Assessment</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	
</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-8">
                    <div class="form-input-content text-center error-page">
                        {{-- <h1 class="error-text font-weight-bold">404</h1> --}}
                        <h1 class="font-weight-bold">Naxum Laravel Assessment</h6>
                            <p class="text-center">By</p>
                        <h3 class="text-lead mb-3"><i class="fa fa-laptop text-primary"></i> Oyekola Toheeb</h3>
                        <p>Assessment result are below.</p>
						<div class="mb-4">
                            <a class="btn btn-primary" href="{{ route('task_one')}}">Task one</a>
                        </div>
                        <div>
                            <a class="btn btn-primary" href="{{ route('task_two')}}">Task two</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{ asset('assets/vendor/global/global.min.js')}}"></script>
<script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js' )}}"></script>
<script src="{{ asset('assets/js/deznav-init.js')}}"></script>
<script src="{{ asset('assets/js/custom.js')}}"></script> 
{{-- <script src="{{ asset('assets/js/demo.js')}}"></script>
<script src="{{ asset('assets/js/styleSwitcher.js')}}"></script> --}}
</body>

</html>