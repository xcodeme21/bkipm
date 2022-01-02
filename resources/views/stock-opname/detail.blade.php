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
							<div class=row-fluid align="right">
								@if(@$stockopname->status == 0)
									<button class="btn btn-warning"><i class="icon-spinner2 spinner"></i> CHECKING</button>
								@else
									<button class="btn btn-success"><i class="icon-checkmark"></i> APPROVED</button>
								@endif

								
								<a href="{{ route('stock-opname') }}" class="btn btn-info">
									<i class="icon-arrow-left52"></i> 
									&nbsp; Kembali
								</a>
							</div>
							<hr>
							<div class="col-xl-12">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>No.</th>
												<th>Brand</th>
												<th>Nama</th>
												<th>Ukuran</th>
												<th>Expired Date</th>
												<th>Jumlah Sekarang</th>
												<th>Hasil Stock Opname</th>
												<th>Selisih</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=0; ?>
											@foreach(@$stocklist as $rs)
											<?php $no++; ?>
											<tr>
												<td>{{ @$no }}</td>
												<td>{{ @$rs->brands->nama_brand }}</td>
												<td>{{ @$rs->products->nama_produk }}</td>
												<td>{{ @$rs->size->size }}</td>
												<td>{{ @$rs->stocklist->expired_date }}</td>
												<td>{{ @$rs->jumlah_list }}</td>
												<td>{{ @$rs->jumlah_sekarang }}</td>
												<td>{{ @$rs->selisih }}</td>
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
<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/# by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:46:42 GMT -->
</html>
