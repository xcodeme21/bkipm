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
								<a href="#" class="breadcrumb-item"><i class="icon-key mr-2"></i> {{ @$indexPage }}</a>
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
								<a href="{{ route('roles.tambah') }}" class="btn btn-primary">
									<i class="icon-add"></i> 
									Add New Roles
								</a>
							</div>
							<div class="col-xl-12">
								<div class="table-responsive">
									<table class="table datatable-basic">
										<thead>
											<tr>
												<th>No.</th>
												<th>Name</th>
												<th>Guard Name</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=0; ?>
											@foreach(@$roles as $rs)
											<?php $no++; ?>
											<tr>
												<td>{{ @$no }}</td>
												<td>{{ @$rs->name }}</td>
												<td>{{ @$rs->guard_name }}</td>
												<td class="text-center">
													<a href="{{ route('roles.edit',[$rs->id]) }}" class="btn btn-info"><i class="icon-pencil"></i> Update</a>
													<a href="{{ route('roles.delete',[$rs->id]) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="icon-trash"></i> Delete</a>
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
