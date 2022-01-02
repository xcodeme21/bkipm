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
							<div class="row-fluid" align="right">
								<a href="{{ route('stock-opname.tambah') }}" class="btn btn-primary">
									<i class="icon-add"></i> 
									Add New {{ @$indexPage }}
								</a>
							</div>
							<div class="col-xl-12">
								<div class="table-responsive">
									<table class="table datatable-basic">
										<thead>
											<tr>
												<th>No.</th>
												<th>Tgl. Opname</th>
												<th>Jam</th>
												<th>User</th>
												<th>Status</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=0; ?>
											@foreach(@$stockopname as $rs)
											<?php $no++; ?>
											<tr>
												<td>{{ @$no }}</td>
												<td>{{ @$rs->submit_date }}</td>
												<td>{{ @$rs->submit_time }}</td>
												<td>{{ @$rs->submit->name }}</td>
												<td class="text-center">
													@if(@$rs->status == 0)
													<button class="btn btn-warning btn-sm btn-block"><i class="icon-spinner2 spinner"></i> CHECKING</button>
													@else
													<button class="btn btn-success btn-sm btn-block"><i class="icon-checkmark"></i> APPROVED</button>
													<span class="small">
														Approved by : {{ @$rs->approve->name }}<br>
														{{ @$rs->approved_date }} / {{ @$rs->approved_time }}
													</span>
													@endif
												</td>
												<td class="text-center">
													<a href="{{ route('stock-opname.detail',[$rs->id]) }}" class="btn btn-info btn-sm btn-block"><i class="icon-list"></i> Detail</a>
													<?php $role = "" ?>
													@if(!empty(auth()->user()->getRoleNames()))
														@foreach(auth()->user()->getRoleNames() as $v)
														<?php $role = $v ?>
														@endforeach
													@endif
													
													@if(@$rs->status == 0 && $role == "Admin")
													<a href="#" data-toggle="modal" data-target="#finish{{ @$rs->id }}" class="btn btn-primary btn-sm btn-block"><i class="icon-pencil"></i> Finish</a>

													<div id="finish{{ @$rs->id }}" class="modal fade" tabindex="-1">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header bg-indigo text-white">
																	<h6 class="modal-title"><i class="icon-add"></i> Approval</h6>
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																</div>
																{{ Form::open(['route'=>'stock-opname.approve', 'method' => 'POST']) }} 
																{{ Form::token() }}
																<div class="modal-body">
																	<h3>Are you sure to approve?</h3>
																	<input type="hidden" value="{{ @$rs->id }}" name="id" />
																</div>

																<div class="modal-footer">
																	<button type="submit" class="btn btn-indigo">OK</button>
																	<button type="button" class="btn btn-link" data-dismiss="modal">CANCEL</button>
																</div>
																{{ Form::close() }}
															</div>
														</div>
													</div>
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

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/# by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:46:42 GMT -->
</html>
