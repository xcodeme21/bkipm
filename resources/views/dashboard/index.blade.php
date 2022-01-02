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
								<a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
								<span class="breadcrumb-item active">Dashboard</span>
							</div>

							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">


					<!-- Dashboard content -->
					<div class="row">
						<div class="col-xl-12">

							@include("include.session")
						

							<!-- Quick stats boxes -->
							<div class="row">
								<div class="col-lg-6">

									<!-- Members online -->
									<div class="card">
										<div class="card-body">
											<div class="d-flex">
												<h4 class="font-weight-semibold mb-0">TOTAL REVENUE</h4>
												<span class="badge badge-dark badge-pill align-self-center ml-auto">{{ date('M') }} {{ date('Y') }}</span>
						                	</div>
						                	
						                	<div>
											<h2><?php echo "Rp " . number_format(@$revenue,0,',','.'); ?></h2>
											
												<div class="row">
													<div class="col-lg-6">
														<div class="font-size-sm">
														@if(@$revenue > @$revenuebefore)
														<span class="text-success"><h5><i class="icon-arrow-up52"></i> {{ $averagerevenue }} %</h5></span>
														@else
														<span class="text-danger"><h5><i class="icon-arrow-down52"></i> {{ $averagerevenue }} %</h5></span>
														@endif
														</div>
													</div>
													<div class="col-lg-6" align="right">
														<div class="font-size-sm">FROM LAST MONTH</div>
													</div>
												</div>
												
											</div>
										</div>

										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
									<!-- /members online -->

								</div>

								<div class="col-lg-6">

									<!-- Current server load -->
									<div class="card">
										<div class="card-body">
											<div class="d-flex">
												<h4 class="font-weight-semibold mb-0">TOTAL ITEM SOLD</h4>
												<span class="badge badge-dark badge-pill align-self-center ml-auto">{{ date('M') }} {{ date('Y') }}</span>
						                	</div>
						                	
						                	<div>
											<h2>{{ @$sold }} PCS</h2>
												<div class="row">
													<div class="col-lg-6">
														<div class="font-size-sm">
														@if(@$sold > @$soldbefore)
														<span class="text-success"><h5><i class="icon-arrow-up52"></i> {{ $averagesold }} %</h5></span>
														@else
														<span class="text-danger"><h5><i class="icon-arrow-down52"></i> {{ $averagesold }} %</h5></span>
														@endif
														</div>
													</div>
													<div class="col-lg-6" align="right">
														<div class="font-size-sm">FROM LAST MONTH</div>
													</div>
												</div>
											</div>
										</div>

										<div id="server-load"></div>
									</div>
									<!-- /current server load -->

								</div>

							</div>
							<!-- /quick stats boxes -->

							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
											<h6 class="card-title">Report Statistic <b><u>({{ date('M') }} {{ date('Y') }})</u></b></h6>
										</div>

										<div class="card-body">
											<ul class="nav nav-tabs nav-tabs-highlight justify-content-end">
												<li class="nav-item"><a href="#right-tab1" class="nav-link active" data-toggle="tab">Revenue</a></li>
												<li class="nav-item"><a href="#right-tab2" class="nav-link" data-toggle="tab">Item Sold</a></li>
											</ul>

											<div class="tab-content">
												<div class="tab-pane fade active show" id="right-tab1">
													<canvas id="revenuechart"></canvas>
												</div>

												<div class="tab-pane fade" id="right-tab2">
													<canvas id="soldchart"></canvas>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>
					<!-- /dashboard content -->

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

<script src="{{ asset('public/global_assets/js/Chart.min.js') }}"></script>

<script>
	var ctx = document.getElementById('revenuechart').getContext('2d');
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'bar',
			// The data for our dataset
			data: {
				labels: [<?php echo json_decode($bulan, true); ?>],
				datasets: [{
					label: 'Total Revenue',
					backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
					data: [<?php echo json_decode($revenueValue, true); ?>]
				}]
			},
			// Configuration options go here
			options: {
				tooltips: {
					callbacks: {
						label: function(t, d) {
						var xLabel = d.datasets[t.datasetIndex].label;
						var yLabel = t.yLabel >= 1000 ? 'Rp.' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : 'Rp.' + t.yLabel;
						return xLabel + ': ' + yLabel;
						}
					}
				},
				scales: {
					yAxes: [{
						ticks: {
						callback: function(value, index, values) {
							if (parseInt(value) >= 1000) {
								return 'Rp.' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
							} else {
								return 'Rp.' + value;
							}
						}
						}
					}]
				}
			}
		});

		
	var ctx = document.getElementById('soldchart').getContext('2d');
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'bar',
			// The data for our dataset
			data: {
				labels: [<?php echo json_decode($bulan, true); ?>],
				datasets: [{
					label: 'Total Item Sold',
					backgroundColor: '#56abee',
					borderColor: '#7548ff',
					data: [<?php echo json_decode($soldValue, true); ?>]
				}]
			},
			// Configuration options go here
			options: {}
		});
</script>

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/# by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:46:42 GMT -->
</html>
