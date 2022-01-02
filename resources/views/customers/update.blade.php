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
								<a href="#" class="breadcrumb-item"><i class="icon-people mr-2"></i> {{ @$indexPage }}</a>
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
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
								{{ Form::open(['route'=>'customers.update', 'method' => 'POST']) }} 
								{{ Form::token() }}
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Nama</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" name="nama" value="{{ @$rs->nama }}" class="form-control form-control-outline" placeholder="Placeholder" required>
											<label class="label-floating">Masukkan nama customer</label>
											<input type="hidden" name="id" value="{{ @$rs->id }}" />
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Username</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" name="username" value="{{ @$rs->username }}" class="form-control form-control-outline" placeholder="Placeholder" required>
											<label class="label-floating">Masukkan username customer</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Alamat</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<textarea name="alamat" class="form-control form-control-outline" placeholder="Placeholder" required>{{ @$rs->alamat }}</textarea>
											<label class="label-floating">Masukkan alamat customer</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">No. Tlp</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" name="no_tlp" value="{{ @$rs->no_tlp }}" class="form-control form-control-outline" placeholder="Placeholder" required>
											<label class="label-floating">Masukkan nomor telepon customer</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Email</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="email" name="email" value="{{ @$rs->email }}" class="form-control form-control-outline" placeholder="Placeholder" required>
											<label class="label-floating">Masukkan email customer</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<button type="submit" class="btn btn-success">Simpan</button>&nbsp;
									<a href="{{ route('customers') }}" class="btn btn-warning">Batal</a>
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
