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
							{{ Form::open(['route'=>'stock-out.tambahtemporary', 'method' => 'GET']) }} 
							<div class="row">
								<div class="col-xl-6">
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Order Number</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<input type="text" name="order_number" value="{{ @$ordernumber }}" class="form-control form-control-outline" placeholder="Placeholder" required>
												<label class="label-floating">Order Number</label>
											</div>
										</div>
									</div>
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Nama Customer</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<select data-placeholder="Ketik 'keyword'" name="customer_id" class="form-control select-minimum" data-fouc required>
													<option value="">-- Pilih Customer --</option>
													@foreach(@$customers as $cust)
														@if(!empty(@$detailcustomer))
														<option value="{{ @$cust->id }}" @if(@$cust->id == @$detailcustomer->id) selected @endif>{{ @$cust->nama }}</option>
														@else
														<option value="{{ @$cust->id }}">{{ @$cust->nama }}</option>
														@endif
													@endforeach
												</select>
												<small><a href="#" data-toggle="modal" data-target="#modal_theme_custom" class="text-danger"> Add New Customer</a></small>

												
											</div>
										</div>
									</div>
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">No. Tlp</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<input type="text" id="no_tlp" class="form-control form-control-outline" value="{{ @$detailcustomer->no_tlp }}" placeholder="Placeholder" readonly>
												<label class="label-floating">No. Tlp</label>
											</div>
										</div>
									</div>
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Alamat</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<textarea id="alamat" class="form-control form-control-outline" placeholder="Placeholder" readonly>{{ @$detailcustomer->alamat }}</textarea>
												<label class="label-floating">Alamat</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-6">
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Delivery</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<select name="delivery_id" class="form-control form-control-outline" required>
													<option value="">-- Pilih Delivery --</option>
													@foreach(@$delivery as $deliv)
													<option value="{{ @$deliv->id }}">{{ @$deliv->delivery }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Source</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<select name="source_id" class="form-control form-control-outline" required>
													<option value="">-- Pilih Source --</option>
													@foreach(@$source as $src)
													<option value="{{ @$src->id }}">{{ @$src->source }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="row-fluid" align="right">
										<button type="submit" class="btn btn-success">Teruskan</button>&nbsp;
										<a href="{{ route('stock-out') }}" class="btn btn-warning">Batal</a>
									</div>
								</div>
							</div>
							{{ Form::close() }}

							<div id="modal_theme_custom" class="modal fade" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header bg-indigo text-white">
											<h6 class="modal-title"><i class="icon-add"></i> Add New Product</h6>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										{{ Form::open(['route'=>'stock-out.addcustomer', 'method' => 'POST']) }} 
										{{ Form::token() }}
										<div class="modal-body">
											<div class="form-group form-group-floating row">
												<label class="col-form-label col-lg-2">Nama</label>
												<div class="col-lg-10">
													<div class="position-relative">
														<input type="text" name="nama" class="form-control form-control-outline" placeholder="Placeholder" required>
														<label class="label-floating">Masukkan nama customer</label>
													</div>
												</div>
											</div>
											<div class="form-group form-group-floating row">
												<label class="col-form-label col-lg-2">Username</label>
												<div class="col-lg-10">
													<div class="position-relative">
														<input type="text" name="username" class="form-control form-control-outline" placeholder="Placeholder" required>
														<label class="label-floating">Masukkan username customer</label>
														<input type="hidden" value="{{ @$ordernumber }}" name="ordernumber" />
													</div>
												</div>
											</div>
											<div class="form-group form-group-floating row">
												<label class="col-form-label col-lg-2">Alamat</label>
												<div class="col-lg-10">
													<div class="position-relative">
														<textarea name="alamat" class="form-control form-control-outline" placeholder="Placeholder" required></textarea>
														<label class="label-floating">Masukkan alamat customer</label>
													</div>
												</div>
											</div>
											<div class="form-group form-group-floating row">
												<label class="col-form-label col-lg-2">No. Tlp</label>
												<div class="col-lg-10">
													<div class="position-relative">
														<input type="text" name="no_tlp" class="form-control form-control-outline" placeholder="Placeholder" required>
														<label class="label-floating">Masukkan nomor telepon customer</label>
													</div>
												</div>
											</div>
											<div class="form-group form-group-floating row">
												<label class="col-form-label col-lg-2">Email</label>
												<div class="col-lg-10">
													<div class="position-relative">
														<input type="email" name="email" class="form-control form-control-outline" placeholder="Placeholder" required>
														<label class="label-floating">Masukkan email customer</label>
													</div>
												</div>
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-link" data-dismiss="modal">BATAL</button>
											<button type="submit" class="btn btn-indigo">SIMPAN</button>
										</div>
										{{ Form::close() }}
									</div>
								</div>
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

<script type="text/javascript">
	jQuery(document).ready(function ()
	{
		jQuery('select[name="customer_id"]').on('change',function(){
			var customerID = jQuery(this).val();
			if(customerID)
			{
				jQuery.ajax({
					url : 'getdetailcustomer/' +customerID,
					type : "GET",
					dataType : "json",
					success:function(data)
					{
					console.log(data);
					$("#no_tlp").val(data.no_tlp);
					$("#alamat").val(data.alamat);
					}
				});
			}
			else
			{
				$("#no_tlp").empty();
				$("#alamat").empty();
			}
		});
	});

</script>

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/# by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:46:42 GMT -->
</html>
