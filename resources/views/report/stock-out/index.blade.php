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
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">From</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<input type="text" id="from" class="form-control form-control-outline" placeholder="Placeholder" required>
												<label class="label-floating">From</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">To</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<input type="text" id="to" class="form-control form-control-outline" placeholder="Placeholder" required>
												<label class="label-floating">To</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr>
							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Brands</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<select class="form-control form-control-outline" id="brands">
													<option value="">-- Pilih Brand --</option>
													@foreach(@$brands as $br)
													<option value="{{ @$br->nama_brand }}">{{ @$br->nama_brand }}</option>
													@endforeach
												</select>
												<label class="label-floating">Brands</label>
											</div>
										</div>
									</div>
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Ukuran</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<select class="form-control form-control-outline" id="ukuran">
													<option value="">-- Pilih Ukuran --</option>
													@foreach(@$size as $sz)
													<option value="{{ @$sz->size }}">{{ @$sz->size }}</option>
													@endforeach
												</select>
												<label class="label-floating">Ukuran</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Name</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<select class="form-control form-control-outline" id="products">
													<option value="">-- Pilih Name --</option>
													@foreach(@$products as $prod)
													<option value="{{ @$prod->nama_produk }}">{{ @$prod->nama_produk }}</option>
													@endforeach
												</select>
												<label class="label-floating">Name</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<hr>

							<div class="col-xl-12">
								<div class="table-responsive">
									<table class="table" id="example">
										<thead>
											<tr>
												<th>No.</th>
												<th>Brand</th>
												<th>Nama</th>
												<th>Ukuran</th>
												<th>Expired Date</th>
												<th>Jumlah</th>
												<th>Nama Customer</th>
												<th>Tanggal</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=0; ?>
											@foreach(@$stockout as $rs)
											<?php $no++; ?>
											<tr>
												<td>{{ @$no }}</td>
												<td>{{ @$rs->brands->nama_brand }}</td>
												<td>{{ @$rs->products->nama_produk }}</td>
												<td>{{ @$rs->size->size }}</td>
												<td>{{ @$rs->expired_date }}</td>
												<td>{{ @$rs->total }}</td>
												<td>{{ @$rs->customers->nama }}</td>
												<td>{{ substr(@$rs->created_at,0,10) }}</td>
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
	var minDate, maxDate;
 
	// Custom filtering function which will search data in column four between two values
	$.fn.dataTable.ext.search.push(
		function( settings, data, dataIndex ) {
			var min = minDate.val();
			var max = maxDate.val();
			var date = new Date( data[7] );
	
			if (
				( min === null && max === null ) ||
				( min === null && date <= max ) ||
				( min <= date   && max === null ) ||
				( min <= date   && date <= max )
			) {
				return true;
			}
			return false;
		}
	);
	
	$(document).ready(function() {
		// Create date inputs
		minDate = new DateTime($('#from'), {
			format: 'YYYY-MM-DD'
		});
		maxDate = new DateTime($('#to'), {
			format: 'YYYY-MM-DD'
		});
	
		// DataTables initialisation
		var table = $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [ 
            'excel',
            'print'
            ]
        } );
	
		// Refilter the table
		$('#from, #to').on('change', function () {
			table.draw();
		});

        $('#brands').on( 'change', function () {
			table.column(1)
				.search( $(this).val() )
				.draw();
		} );

		$('#products').on( 'change', function () {
			table.column(2)
				.search( $(this).val() )
				.draw();
		} );

		$('#ukuran').on( 'change', function () {
			table.column(3)
				.search( $(this).val() )
				.draw();
		} );
		


	});
</script>

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/# by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:46:42 GMT -->
</html>
