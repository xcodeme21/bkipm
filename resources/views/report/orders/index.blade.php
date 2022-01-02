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
										<label class="col-form-label col-lg-2">Delivery</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<select class="form-control form-control-outline" id="delivery">
													<option value="">-- Pilih Delivery --</option>
													@foreach(@$delivery as $deliv)
													<option value="{{ @$deliv->delivery }}">{{ @$deliv->delivery }}</option>
													@endforeach
												</select>
												<label class="label-floating">Delivery</label>
											</div>
										</div>
									</div>
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Customers</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<select class="form-control form-control-outline" id="customer">
													<option value="">-- Pilih Customer --</option>
													@foreach(@$customers as $cus)
													<option value="{{ @$cus->nama }}">{{ @$cus->nama }}</option>
													@endforeach
												</select>
												<label class="label-floating">Customer</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Source</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<select class="form-control form-control-outline" id="source">
													<option value="">-- Pilih Source --</option>
													@foreach(@$source as $sour)
													<option value="{{ @$sour->source }}">{{ @$sour->source }}</option>
													@endforeach
												</select>
												<label class="label-floating">Source</label>
											</div>
										</div>
									</div>
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Status</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<select class="form-control form-control-outline" id="status">
													<option value="">-- Pilih Status --</option>
													<option value="DELIVERING">DELIVERING</option>
													<option value="FINISH">FINISH</option>
												</select>
												<label class="label-floating">Status</label>
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
												<th>No. Order</th>
												<th>Customer</th>
												<th>Tgl. Pesan</th>
												<th>Delivery</th>
												<th>Source</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=0; ?>
											@foreach(@$orders as $rs)
											<?php $no++; ?>
											<tr>
												<td>{{ @$no }}</td>
												<td>{{ @$rs->order_number }}</td>
												<td>{{ @$rs->customers->nama }}</td>
												<td>{{ substr(@$rs->created_at,0,10) }}</td>
												<td>{{ @$rs->delivery->delivery }}</td>
												<td>{{ @$rs->source->source }}</td>
												<td>
													@if(@$rs->status == 0)
													DELIVERING
													@else
													FINISH
													@endif
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
	var minDate, maxDate;
 
	// Custom filtering function which will search data in column four between two values
	$.fn.dataTable.ext.search.push(
		function( settings, data, dataIndex ) {
			var min = minDate.val();
			var max = maxDate.val();
			var date = new Date( data[3] );
	
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

        $('#delivery').on( 'change', function () {
			table.column(4)
				.search( $(this).val() )
				.draw();
		} );

		$('#source').on( 'change', function () {
			table.column(5)
				.search( $(this).val() )
				.draw();
		} );

		$('#customer').on( 'change', function () {
			table.column(3)
				.search( $(this).val() )
				.draw();
		} );

		$('#status').on( 'change', function () {
			table.column(6)
				.search( $(this).val() )
				.draw();
		} );
		


	});
</script>
<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/# by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:46:42 GMT -->
</html>
