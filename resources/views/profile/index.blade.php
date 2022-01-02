<!DOCTYPE html>
<html lang="en">

@include("include.head")

<body>

	@include("include.navbar")


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-light sidebar-main sidebar-expand-lg">

			@include("include.sidebar")
			
		</div>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Page header -->
				<div class="page-header page-header-light">

					<div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
						<div class="d-flex">
							<div class="breadcrumb">
								<a href="#" class="breadcrumb-item"><i class="icon-profile mr-2"></i> {{ @$indexPage }}</a>
							</div>
						</div>

					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					@include("include.session")

					<div class="card">
						<div class="card-body">
							<div class="col-xl-12">
								{{ Form::open(['route'=>'profile.update', 'method' => 'POST']) }} 
								{{ Form::token() }}
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Name</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control form-control-outline" placeholder="Placeholder" required>
											<label class="label-floating">Name</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Email</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control form-control-outline" placeholder="Placeholder" required>
											<label class="label-floating">Email</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Password</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="password" name="password" class="form-control form-control-outline" placeholder="Placeholder">
											<label class="label-floating">Password</label>
											<span class="text-samll text-danger">Kosongkan jika tidak ingin mengganti password.</span>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Confirm Password</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="password" name="confirm_password" class="form-control form-control-outline" placeholder="Placeholder">
											<label class="label-floating">Confirm Password</label>
											<span class="text-samll text-danger">Kosongkan jika tidak ingin mengganti password.</span>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<button type="submit" class="btn btn-success">Simpan</button>
								</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>


				</div>
				<!-- /content area -->


				@include("include.footer")

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>


@include("include.script")

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/# by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:46:42 GMT -->
</html>
