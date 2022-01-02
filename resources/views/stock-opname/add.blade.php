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
							<div class="col-xl-12">
								<div class="table-responsive">
								{{ Form::open(['route'=>'stock-opname.add', 'method' => 'POST']) }} 
								{{ Form::token() }}
									<table class="table">
										<thead>
											<tr>
												<th>No.</th>
												<th>Brand</th>
												<th>Nama</th>
												<th>Ukuran</th>
												<th>Expired Date</th>
												<th class="text-center">Jumlah Sekarang</th>
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
												<td>{{ @$rs->expired_date }}</td>
												<td class="text-center">
													<input type="number" class="form-control" name="jumlah_sekarang[]" required />
													<input type="hidden" name="stock_list_id[]" value="{{ @$rs->id }}" />
												</td>
											</tr>
											
											@endforeach
										</tbody>
									</table>
									<br>
									<button type="submit" class="btn btn-success">Simpan</button>
									<a href="{{ route('stock-opname') }}" class="btn btn-warning">Batal</a>
								{{ Form::close() }}
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

<script type="text/javascript">
	jQuery(document).ready(function ()
	{
		jQuery('select[name="product_id"]').on('change',function(){
			var productID = jQuery(this).val();
			if(productID)
			{
				jQuery.ajax({
					url : '../getbrand/' +productID,
					type : "GET",
					dataType : "json",
					success:function(data)
					{
					console.log(data);
					$("#nama_brand").val(data.nama_brand);
					$("#brand_id").val(data.id);
					}
				});
			}
			else
			{
				$("#nama_brand").empty();
				$("#brand_id").empty();
			}
		});
	});

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
