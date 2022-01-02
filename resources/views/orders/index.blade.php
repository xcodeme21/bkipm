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
								<a href="#" class="breadcrumb-item"><i class="icon-cart mr-2"></i> {{ @$indexPage }}</a>
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
							{{ Form::open(['route'=>'orders', 'method' => 'GET']) }} 
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">From</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<input type="text" name="from" value="{{ @$from }}" class="form-control form-control-outline pickadate-accessibility" placeholder="Placeholder" required>
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
												<input type="text" name="to" value="{{ @$to }}" class="form-control form-control-outline pickadate-accessibility" placeholder="Placeholder" required>
												<label class="label-floating">To</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row-fluid" align="right">
								<button type="submit" class="btn btn-xs btn-success"><i class="icon-search4"></i> Cari</button>
								<a href="{{ route('orders') }}" class="btn btn-xs btn-danger"><i class="icon-spinner2 spinner"></i> Reset</a>
							</div>
							{{ Form::close() }}

							<hr>
							<!-- <div class="row-fluid" align="right">
								@if(@$from == null && @$to == null)
								<a href="{{ route('orders.export') }}" class="btn btn-xs btn-success"><i class="icon-file-excel"></i> Export</a>
								@else
								<a href="{{ route('orders.exportbydates',[@$from, @$to]) }}" class="btn btn-xs btn-success"><i class="icon-file-excel"></i> Export</a>
								@endif
							</div> -->

							<div class="col-xl-12">
								<div class="table-responsive">
									<table class="table datatable-export">
										<thead>
											<tr>
												<th>No. Order</th>
												<th>Customer</th>
												<th>Tgl. Pesan</th>
												<th>Delivery</th>
												<th>Source</th>
												<th>Status</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead>
										<tbody>
											@foreach(@$orders as $rs)
											<tr>
												<td>{{ @$rs->order_number }}</td>
												<td>{{ @$rs->customers->nama }}</td>
												<td>{{ substr(@$rs->created_at,0,10) }}</td>
												<td>{{ @$rs->delivery->delivery }}</td>
												<td>{{ @$rs->source->source }}</td>
												<td>
													@if(@$rs->status == 0)
													<button class="btn btn-info"><i class="icon-spinner2 spinner"></i> DELIVERING</button>
													@else
													<button class="btn btn-success"><i class="icon-checkmark"></i> FINISH</button>
													@endif
												</td>
												<td class="text-center">
													<a href="{{ route('orders.view',[$rs->id]) }}" class="btn btn-warning btn-block"><i class="icon-eye"></i> View Detail</a>
													
													@if(@$rs->status == 0)
													<a href="#" data-toggle="modal" data-target="#finish{{ @$rs->id }}" class="btn btn-primary btn-block"><i class="icon-pencil"></i> Finish</a>

													<div id="finish{{ @$rs->id }}" class="modal fade" tabindex="-1">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header bg-indigo text-white">
																	<h6 class="modal-title"><i class="icon-add"></i> Finishing</h6>
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																</div>
																{{ Form::open(['route'=>'orders.finish', 'method' => 'POST']) }} 
																{{ Form::token() }}
																<div class="modal-body">
																	<div class="form-group form-group-floating row">
																		<label class="col-form-label col-lg-2">Biaya Admin</label>
																		<div class="col-lg-10">
																			<div class="position-relative">
																				<input type="text" name="biaya_admin" value="{{ @$rs->biaya_admin }}" class="form-control form-control-outline uang" placeholder="Placeholder" required>
																				<label class="label-floating">Biaya Admin</label>
																			</div>
																			<input type="hidden" name="id" value="{{ @$rs->id }}" />
																		</div>
																	</div>
																	<div class="form-group form-group-floating row">
																		<label class="col-form-label col-lg-2">Diskon Voucher</label>
																		<div class="col-lg-10">
																			<div class="position-relative">
																				<input type="text" name="diskon_voucher" value="{{ @$rs->diskon_voucher }}" class="form-control form-control-outline uang" placeholder="Placeholder" required>
																				<label class="label-floating">Diskon Voucher</label>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="modal-footer">
																	<button type="submit" class="btn btn-indigo">SIMPAN</button>
																	<button type="button" class="btn btn-link" data-dismiss="modal">BATAL</button>
																</div>
																{{ Form::close() }}
															</div>
														</div>
													</div>
													@endif
													<a href="{{ route('orders.delete',[$rs->order_number]) }}" style="margin-top:8px;" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-block"><i class="icon-trash"></i> Delete</a>

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

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/# by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:46:42 GMT -->
</html>
