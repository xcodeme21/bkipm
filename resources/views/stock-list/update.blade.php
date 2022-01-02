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
								{{ Form::open(['route'=>'stock-list.update', 'method' => 'POST']) }} 
								{{ Form::token() }}
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Nama Produk</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select data-placeholder="Ketik 'keyword'" name="product_id" class="form-control select-minimum" data-fouc required>
												<option value="">-- Pilih Produk --</option>
												@foreach(@$products as $prod)
												<option value="{{ @$prod->id }}" @if(@$prod->id == @$rs->product_id) selected @endif>{{ @$prod->nama_produk }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Nama Brand</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" id="nama_brand" value="{{ @$rs->brands->nama_brand }}" class="form-control form-control-outline" placeholder="Placeholder" readonly>
											<label class="label-floating">Nama Brand</label>
											<input type="hidden" name="brand_id" value="{{ @$rs->brand_id }}" id="brand_id" />
											<input type="hidden" name="id" value="{{ @$rs->id }}" />
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Size</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select name="size_id" class="custom-select form-control-outline" required>
												<option value="">-- Pilih Size --</option>
												@foreach(@$size as $sz)
												<option value="{{ @$sz->id }}" @if(@$sz->id == @$rs->size_id) selected @endif>{{ @$sz->size }}</option>
												@endforeach
											</select>
											<label class="label-floating">Size</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Expired Date</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" name="expired_date" value="{{ @$rs->expired_date }}" class="form-control form-control-outline pickadate-accessibility" placeholder="Placeholder" required>
											<label class="label-floating">Masukkan expired date</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Jumlah</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="number" name="total" value="{{ @$rs->total }}" class="form-control form-control-outline" placeholder="Placeholder" required>
											<label class="label-floating">Jumlah</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<button type="submit" class="btn btn-success">Simpan</button>&nbsp;
									<a href="{{ route('stock-list') }}" class="btn btn-warning">Batal</a>
								</div>
								{{ Form::close() }}
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

</script>

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/# by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:46:42 GMT -->
</html>
