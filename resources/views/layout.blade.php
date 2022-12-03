<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
    <meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:image" content="../social-image.png" />
	<meta name="format-detection" content="telephone=no">
    <title>NaXum - Assessment </title>
    <!-- Favicon icon -->
	
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
	<link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>	
	<link href="{{ asset('assets/css/style.css') }} " rel="stylesheet" type="text/css"/>	
	@yield('link')	
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
	
	<!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
		<!--**********************************
	Nav header start
***********************************-->
<div class="nav-header">
    <a href="/"><h1 class="text-light text-center" style="color: white">NaXuM</h1></a>
	<div class="nav-control">
		<div class="hamburger">
			<span class="line"></span><span class="line"></span><span class="line"></span>
		</div>
	</div>
</div>
<!--**********************************
	Nav header end
***********************************-->		<!--**********************************
	Chat box start
***********************************-->
<div class="chatbox">
	<div class="chatbox-close"></div>
	<div class="custom-tab-1">
		
		
	</div>
</div>
<!--**********************************
	Chat box End
***********************************-->        <!--**********************************
	Header start
***********************************-->
<div class="header">
	<div class="header-content">
		<nav class="navbar navbar-expand">
			<div class="collapse navbar-collapse justify-content-between">
				<div class="header-left">
					<div class="dashboard_bar">
						@yield('title')					</div>
				</div>

				
			</div>
		</nav>
	</div>
</div>
<!--**********************************
	Header end ti-comment-alt
***********************************-->        <!--**********************************
	Sidebar start
***********************************-->
<div class="deznav">
	<div class="deznav-scroll">
		<ul class="metismenu" id="menu">
			<li><a href="{{ route('dashboard')}}" ><i class="flaticon-381-networking"></i> <span class="nav-text">Dashboard</span></a></li>
            <li class="has-menu"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-layer"></i>
                    <span class="nav-text">Tasks</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('task_one')}}">Task One</a></li>
                    <li><a href="{{ route('task_two')}}">Task Two</a></li>
                  
                </ul>
            </li>
		</ul>
	</div>
</div>
<!--**********************************
	Sidebar end
***********************************-->        <!--**********************************
	Content body start
***********************************-->
<div class="content-body">
	<!-- row -->
	@yield('content')
</div>
<!--**********************************
	Content body end
***********************************-->
        <!--**********************************
	Footer start
***********************************-->
<div class="footer">
	<div class="copyright">
		<p>Copyright © Developed by <a href="https://github.com/To-heeb/naxum-laravel-assessment.git" target="_blank">Oyekola Toheeb </a> {{ date('Y')}}</p>
	</div>
</div>
<!--**********************************
	Footer end
***********************************-->	</div>
			
			
			<script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
			
			<script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
		
			<script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script>
			<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
			<script src="{{ asset('assets/js/autocomplete.js') }}"></script>
			<script src="{{ asset('assets/js/custom.js') }}"></script>
			<script src="{{ asset('assets/js/deznav-init.js') }}"></script>
			

			<script>	
		function carouselReview(){
			/*  testimonial one function by = owl.carousel.js */
			function checkDirection() {
				var htmlClassName = document.getElementsByTagName('html')[0].getAttribute('class');
				if(htmlClassName == 'rtl') {
					return true;
				} else {
					return false;
				
				}
			}
			jQuery('.testimonial-one').owlCarousel({
				loop:true,
				autoplay:true,
				margin:15,
				nav:false,
				dots: false,
				left:true,
				rtl: checkDirection(),
				navText: ['', ''],
				responsive:{
					0:{
						items:1
					},
					800:{
						items:2
					},	
					991:{
						items:2
					},			
					
					1200:{
						items:2
					},
					1600:{
						items:2
					}
				}
			})		
			jQuery('.testimonial-two').owlCarousel({
				loop:true,
				autoplay:true,
				margin:15,
				nav:false,
				dots: true,
				left:true,
				rtl: checkDirection(),
				navText: ['', ''],
				responsive:{
					0:{
						items:1
					},
					600:{
						items:2
					},	
					991:{
						items:3
					},			
					
					1200:{
						items:3
					},
					1600:{
						items:4
					}
				}
			})					
		}
		jQuery(window).on('load',function(){
			setTimeout(function(){
				carouselReview();
			}, 1000); 
		});
	</script>
	{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
	
		@yield('script')
    <!--**********************************
        Main wrapper end
    ***********************************-->
</body>

</html>