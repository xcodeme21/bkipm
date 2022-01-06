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
								<div class="col-lg-12">

									<!-- Members online -->
									<div class="card">
										<div class="card-body">
											<div class="d-flex">
												<h4 class="font-weight-semibold mb-0">WELCOME TO CMS</h4>
												<span class="badge badge-dark badge-pill align-self-center ml-auto">{{ date('d') }} {{ date('M') }} {{ date('Y') }}</span>
						                	</div>
										</div>

										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
									<!-- /members online -->

								</div>
							</div>
							<!-- /quick stats boxes -->

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
