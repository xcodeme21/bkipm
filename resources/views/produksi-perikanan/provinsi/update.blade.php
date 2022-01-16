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
								{{ Form::open(['route'=>'pp.provinsi.update', 'method' => 'POST']) }} 
								{{ Form::token() }}
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Jenis Usaha</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select name="jenis_usaha_id" class="form-control form-control-outline" required>
												<option value="">-- Pilih Jenis Usaha --</option>
												@foreach(@$jenisusaha as $ju)
												<option value="{{ @$ju->id }}" @if(@$ju->id == @$rs->jenis_usaha_id) selected @endif>{{ @$ju->jenis_usaha }}</option>
												@endforeach
												<input type="hidden" name="id" value="{{ @$rs->id }}" />
											</select>
											<label class="label-floating">Masukkan jenis usaha</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Provinsi</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select name="provinsi_id" class="form-control form-control-outline" required>
												<option value="">-- Pilih Provinsi --</option>
												@foreach(@$provinsi as $pr)
												<option value="{{ @$pr->id }}" @if(@$ji->pr == @$rs->provinsi_id) selected @endif>{{ @$pr->provinsi }}</option>
												@endforeach
											</select>
											<label class="label-floating">Masukkan provinsi</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Jenis Tahun</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" class="form-control form-control-outline tahun" name="tahun" value="{{ @$rs->tahun }}" required>
											<label class="label-floating">Masukkan tahun</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Jenis Ikan</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select name="jenis_ikan_id" class="form-control form-control-outline" required>
												<option value="">-- Pilih Jenis Ikan --</option>
												@foreach(@$jenisikan as $ji)
												<option value="{{ @$ji->id }}" @if(@$ji->id == @$rs->jenis_ikan_id) selected @endif>{{ @$ji->jenis_ikan }}</option>
												@endforeach
											</select>
											<label class="label-floating">Masukkan jenis ikan</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Volume Produksi</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="number" class="form-control form-control-outline" name="volume_produksi" value="{{ @$rs->volume_produksi }}" required>
											<label class="label-floating">Masukkan volume produksi</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<button type="submit" class="btn btn-success">Simpan</button>&nbsp;
									<a href="{{ route('pp.provinsi') }}" class="btn btn-warning">Batal</a>
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
