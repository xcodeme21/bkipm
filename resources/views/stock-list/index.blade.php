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
								<div class="table-responsive">
									<table class="table datatable-basic">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama</th>
												<th>Brand</th>
												<th>Ukuran</th>
												<th>Expired Date</th>
												<th>Jumlah</th>
												<th>Tanggal</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead>
										<tbody>
										<?php $no=0; ?>
											@foreach(@$stocklist as $rs)
											<?php $no++; ?>
											<tr>
												<td>{{ @$no }}</td>
												<td>{{ @$rs->products->nama_produk }}</td>
												<td>{{ @$rs->brands->nama_brand }}</td>
												<td>{{ @$rs->size->size }}</td>
												<td>{{ @$rs->expired_date }}</td>
												<td>{{ @$rs->total }}</td>
												<td>{{ substr(@$rs->created_at,0,10) }}</td>
												<td class="text-center">
													<a href="#" data-toggle="modal" data-target="#see_barcode{{ @$rs->id }}" class="btn btn-sm btn-block btn-success"><i class="icon-barcode2"></i> Barcode</a>
													<a href="#" data-toggle="modal" data-target="#see_label{{ @$rs->id }}" class="btn btn-sm btn-block btn-info"><i class="icon-price-tag2"></i> Label</a>
													<a href="{{ route('stock-list.edit',[$rs->id]) }}" class="btn btn-sm btn-block btn-warning"><i class="icon-pencil"></i> Update</a>
													<a href="{{ route('stock-list.delete',[$rs->id]) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-block btn-danger"><i class="icon-trash"></i> Delete</a>

													<div id="see_barcode{{ @$rs->id }}" class="modal fade" tabindex="10000" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header bg-indigo text-white">
																	<h6 class="modal-title"><i class="icon-eye"></i> Barcode {{ @$rs->products->nama_produk }} {{ @$rs->brands->nama_brand }} {{ @$rs->size->size }}</span></h6>
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																</div>
																<div class="modal-body" align="center">
																	<div class="barcode" id="barcode">
																		{{ @$rs->products->nama_produk }} <br><br>
																		<span>{{ date("M Y", strtotime(@$rs->expired_date)) }}</span>
																		{!! DNS1D::getBarcodeHTML(@$rs->barcode, "C128",1.3,100) !!}
																		<span>{{ @$rs->barcode }}</span>
																	</div>
																</div>

																<div class="modal-footer">
																	<button type="button" class="btn btn-link" onclick="printDiv('barcode')">PRINT</button>
																</div>
															</div>
														</div>
													</div>

													<div id="see_label{{ @$rs->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
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
																			<dt><b>Ukuran</b></dt>
																			<dd>{{ @$rs->size->size }}</dd>
																			<dt><b>Tanggal Kadaluarsa</b></dt>
																			<dd><?php echo date("d M Y", strtotime(@$rs->expired_date)); ?></dd>
																		</dl>
																	</div>
																</div>

																<div class="modal-footer">
																	<button type="button" class="btn btn-link" onclick="printDiv('label')">PRINT</button>
																</div>
															</div>
														</div>
													</div>


													
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
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
