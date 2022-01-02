<!DOCTYPE html>
<html lang="en">

@include("include.head")
<style>
	.modal-backdrop {display: none;}
	dl {
		width: 100%;
		overflow: hidden;
		padding: 0;
		margin: 0
	}
	dt {
		float: left;
		width: 50%;
		/* adjust the width; make sure the total of both is 100% */
		padding: 0;
		margin: 0
	}
	dd {
		float: left;
		width: 50%;
		/* adjust the width; make sure the total of both is 100% */
		padding: 0;
		margin: 0;
	}
</style>
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
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Order Number</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" value="{{ @$rs->order_number }}" class="form-control form-control-outline" placeholder="Placeholder" disabled>
											<label class="label-floating">Order Number</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Nama Customer</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" value="{{ @$rs->customers->nama }}" class="form-control form-control-outline" placeholder="Placeholder" disabled>
											<label class="label-floating">Nama Customer</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Nama Produk</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select data-placeholder="Ketik 'keyword'" name="product_id" class="form-control select-minimum" data-fouc disabled>
												<option value="">-- Pilih Produk --</option>
												@foreach(@$products as $prod)
												<option value="{{ @$prod->id }}" @if(@$rs->product_id == @$prod->id) selected @endif>{{ @$prod->nama_produk }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Nama Brand</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" id="nama_brand" value="{{ @$rs->brands->nama_brand }}" class="form-control form-control-outline" placeholder="Placeholder" disabled>
											<label class="label-floating">Nama Brand</label>
											<input type="hidden" name="brand_id" id="brand_id" />
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Size</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select name="size_id" class="custom-select form-control-outline" disabled>
												<option value="">-- Pilih Size --</option>
												@foreach(@$size as $sz)
												<option value="{{ @$sz->id }}" @if(@$rs->size_id == @$sz->id) selected @endif>{{ @$sz->size }}</option>
												@endforeach
											</select>
											<label class="label-floating">Size</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Expired Date</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" name="expired_date" value="{{ @$rs->expired_date }}" class="form-control form-control-outline pickadate-accessibility" placeholder="Placeholder" disabled>
											<label class="label-floating">Masukkan expired date</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Harga Per Produk</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="number" name="harga_per_produk" value="{{ number_format(@$rs->harga_produk,0,',','.') }}" class="form-control form-control-outline" placeholder="Placeholder" disabled>
											<label class="label-floating">Harga Per Produk</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Jumlah</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="number" name="total" value="{{ @$rs->total }}" class="form-control form-control-outline" placeholder="Placeholder" disabled>
											<label class="label-floating">Jumlah</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Total Harga</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="number" name="total_harga_produk" value="{{ number_format(@$rs->total_harga_produk,0,',','.') }}" class="form-control form-control-outline" placeholder="Placeholder" disabled>
											<label class="label-floating">Total Harga</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Delivery</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" value="{{ @$rs->delivery->delivery }}" class="form-control form-control-outline" placeholder="Placeholder" disabled>
											<label class="label-floating">Delivery</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Source</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" value="{{ @$rs->source->source }}" class="form-control form-control-outline" placeholder="Placeholder" disabled>
											<label class="label-floating">Source</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<a href="{{ route('stock-out') }}" class="btn btn-warning">Back</a>&nbsp;
									<a href="#" data-toggle="modal" data-target="#see_barcode" class="btn btn-success"><i class="icon-barcode2"></i> Barcode</a>&nbsp;
									<a href="#" data-toggle="modal" data-target="#see_label" class="btn btn-info"><i class="icon-price-tag2"></i> Label</a>


									<div id="see_barcode" class="modal fade" tabindex="10000" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-indigo text-white">
													<h6 class="modal-title"><i class="icon-eye"></i> Barcode {{ @$rs->products->nama_produk }} {{ @$rs->brands->nama_brand }} {{ @$rs->size->size }}</span></h6>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body" align="center">
													<div class="barcode" id="printbarcode">
														{{ @$rs->products->nama_produk }} <br><br>
														<span>{{ date("M Y", strtotime(@$rs->expired_date)) }}</span>
														{!! DNS1D::getBarcodeHTML(@$rs->barcode, "C128",1.3,100) !!}
														<span>{{ @$rs->barcode }}</span>
													</div>
												</div>

												<div class="modal-footer">
													<button type="button" class="btn btn-link" onclick="printDiv('printbarcode')">PRINT</button>
												</div>
											</div>
										</div>
									</div>

									<div id="see_label" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header bg-indigo text-white">
													<h6 class="modal-title"><i class="icon-eye"></i> Label {{ @$rs->products->nama_produk }} {{ @$rs->brands->nama_brand }} {{ @$rs->size->size }}</h6>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body" align="center">
													<div class="label" id="label">
														{!! DNS1D::getBarcodeHTML(@$rs->barcode, "C128",1.3,100) !!}
														<span>{{ @$rs->barcode }}</span>
														<br>
														<br>
														<dl>
															<dt><b>Brand</b></dt>
															<dd>{{ @$rs->brands->nama_brand }}</dd>
															<dt><b>Nama Produk</b></dt>
															<dd>{{ @$rs->products->nama_produk }}</dd>
															<dt><b>Nama Customer</b></dt>
															<dd>{{ @$rs->customers->nama }}</dd>
															<dt><b>Telepon</b></dt>
															<dd>{{ @$rs->customers->no_tlp }}</dd>
															<dt><b>Alamat</b></dt>
															<dd>{{ @$rs->customers->alamat }}</dd>

															<dt><b>Ukuran</b></dt>
															<dd>{{ @$rs->size->size }}</dd>
															<dt><b>Tanggal Kadaluarsa</b></dt>
															<dd>{{ @$rs->expired_date }}</dd>
															<dt><b>Source</b></dt>
															<dd>{{ @$rs->source->source }}</dd>
															<dt><b>Delivery</b></dt>
															<dd>{{ @$rs->delivery->delivery }}</dd>
														</dl>
													</div>
												</div>

												<div class="modal-footer">
													<button type="button" class="btn btn-link" onclick="printDiv('label')">PRINT</button>
												</div>
											</div>
										</div>
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

<script>
	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		window.location = '<?php echo url()->current(); ?>';
	}
</script>

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/# by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:46:42 GMT -->
</html>
