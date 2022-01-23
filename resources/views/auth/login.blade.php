<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/login_background.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:50:52 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{ config('app.name') }} - Login</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('public/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ asset('public/global_assets/js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('public/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('public/assets/js/app.js') }}"></script>
	<!-- /theme JS files -->

</head>

<body class="bg-secondary">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

					<!-- Login card -->
					
                                
					

					{{ Form::open(['url'=>'/login-aplikasi', 'id'=>'form', 'class' =>'login-form', 'method' => 'POST']) }} 
					{{ Form::token() }}
						<div class="card mb-0">
							<div class="card-body">
								<div class="text-center mb-3">
									<img src="{{ asset('public/uploads/logo/'.@$logo->logo) }}" width="150" />
									<h5 class="mb-0">Login to your account</h5>
									<span class="d-block text-muted">Your credentials</span>
								</div>

								@include("include.session")

								<div class="form-group form-group-feedback form-group-feedback-left">                          
                                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
									<div class="form-control-feedback">
										<i class="icon-user text-muted"></i>
									</div>
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="number" class="form-control" id="captcha" placeholder="Enter captcha" name="captcha">
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
								</div>
        
								<div class="form-group" align="center">
									<div id="recaptcha">
										{!! captcha_img() !!}
									</div>            
                                    <a href="#" id="refreshcaptcha" class="text-muted"><span class="fa fa-refresh fa-spin"></span> Refresh</a>                  
								</div><!--end form-group--> 

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Sign in</button>
								</div>

							</div>
						</div>
					{{ Form::close() }}
					<!-- /login card -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>

<script>
	$('#refreshcaptcha').click(function() { 
		var token = '{!! csrf_token() !!}';
		var request = 1;
		$.post('{{ url("/reloadcaptcha") }}', {_token:token, request:request}, function(e) {
				$('#recaptcha').fadeIn('slow').html(e);
		});
	});
</script>

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/login_background.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:50:52 GMT -->
</html>
