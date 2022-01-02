<!DOCTYPE html>
<html lang="en">

@include("include.head")
<style>
	.modal-backdrop {display: none;}
	dl {
		width: 100%;
		overflow: hidden;
		padding: 0;
		margin: 0
	}
	dt {
		float: left;
		width: 50%;
		/* adjust the width; make sure the total of both is 100% */
		padding: 0;
		margin: 0
	}
	dd {
		float: left;
		width: 50%;
		/* adjust the width; make sure the total of both is 100% */
		padding: 0;
		margin: 0;
	}
</style>
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
						<div class="header-elements d-none">
							<div class="breadcrumb justify-content-center">

								<div id="modal_theme_custom" class="modal fade" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header bg-indigo text-white">
												<h6 class="modal-title"><i class="icon-add"></i> Add New Product</h6>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											{{ Form::open(['route'=>'brands.addproducts', 'method' => 'POST']) }} 
											{{ Form::token() }}
											<div class="modal-body">
												<div class="form-group form-group-floating row">
													<label class="col-form-label col-lg-2">Nama Brand</label>
													<div class="col-lg-10">
														<div class="position-relative">
															<select name="brand_id" class="form-control form-control-outline" required>
																<option value="">-- Pilih Brand --</option>
																@foreach(@$brands as $br)
																<option value="{{ @$br->id }}">{{ @$br->nama_brand }}</option>
																@endforeach
															</select>
														</div>
													</div>
												</div>
												<div class="form-group form-group-floating row">
													<label class="col-form-label col-lg-2">Nama Produk</label>
													<div class="col-lg-10">
														<div class="position-relative">
															<input type="text" name="nama_produk" class="form-control form-control-outline" placeholder="Placeholder" required>
															<label class="label-floating">Masukkan nama produk</label>
														</div>
													</div>
												</div>
												<div class="form-group form-group-floating row">
													<label class="col-form-label col-lg-2">Harga</label>
													<div class="col-lg-10">
														<div class="position-relative">
															<input type="text" name="harga" class="form-control form-control-outline uang" placeholder="Placeholder" required>
															<label class="label-floating">Masukkan harga produk</label>
														</div>
													</div>
												</div>
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-link" data-dismiss="modal">BATAL</button>
												<button type="submit" class="btn btn-indigo">SIMPAN</button>
											</div>
											{{ Form::close() }}
										</div>
									</div>
								</div>
							</div>
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
								<form id="scan">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="" name="barcode" id="barcode" autofocus="autofocus" onfocus="this.select()" required>
										<span class="input-group-append">
											<button class="btn btn-success btn-scan" type="button">SCAN</button>
										</span>
									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<div class="col-xl-12">
								{{ Form::open(['route'=>'stock-in.add', 'method' => 'POST']) }} 
								{{ Form::token() }}
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Nama Produk</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select data-placeholder="Ketik 'keyword'" name="product_id" id="product_id" class="form-control select-minimum" required>
												<option value="">-- Pilih Produk --</option>
												@foreach(@$products as $prod)
												<option value="{{ @$prod->id }}">{{ @$prod->nama_produk }}</option>
												@endforeach
											</select>
											<small><a href="#" data-toggle="modal" data-target="#modal_theme_custom" class="text-danger"> Add New Produk</a></small>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Nama Brand</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" id="nama_brand" class="form-control form-control-outline" placeholder="Placeholder" readonly>
											<label class="label-floating">Nama Brand</label>
											<input type="hidden" name="brand_id" id="brand_id" />
											<input type="hidden" name="unique_code" value="{{ $unique_code }}" />
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Size</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select name="size_id" id="size_id" class="custom-select form-control-outline" required>
												<option value="">-- Pilih Size --</option>
												@foreach(@$size as $sz)
												<option value="{{ @$sz->id }}">{{ @$sz->size }}</option>
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
											<input type="text" name="expired_date" id="expired_date" class="form-control form-control-outline pickadate-accessibility" placeholder="Placeholder" required>
											<label class="label-floating">Masukkan expired date</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Jumlah</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="number" name="total" class="form-control form-control-outline" placeholder="Placeholder" required>
											<label class="label-floating">Jumlah</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<button type="submit" class="btn btn-success">Simpan</button>&nbsp;
									<a href="{{ route('stock-in') }}" class="btn btn-warning">Batal</a>
								</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<div class="col-xl-12">
								<div class="table-responsive">
									<table class="table datatable-basic">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama</th>
												<th>Brand</th>
												<th>Ukuran</th>
												<th>Expired Date</th>
												<th>Jumlah</th>
												<th class="text-center">Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=0; ?>
											@foreach(@$stockintempo as $rs)
											<?php $no++; ?>
											<tr>
												<td>{{ @$no }}</td>
												<td>{{ @$rs->products->nama_produk }}</td>
												<td>{{ @$rs->brands->nama_brand }}</td>
												<td>{{ @$rs->size->size }}</td>
												<td>{{ @$rs->expired_date }}</td>
												<td>{{ @$rs->total }}</td>
												<td class="text-center">
													<a href="#" data-toggle="modal" data-target="#see_barcode{{ @$rs->id }}" class="btn btn-success"><i class="icon-barcode2"></i> Barcode</a>
													<a href="#" data-toggle="modal" data-target="#see_label{{ @$rs->id }}" class="btn btn-info"><i class="icon-price-tag2"></i> Label</a>
													<a href="{{ route('stock-in-tempo.delete',[$rs->id]) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="icon-trash"></i> Delete</a>
												</td>
											</tr>

											<div id="see_barcode{{ @$rs->id }}" class="modal fade" tabindex="10000" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header bg-indigo text-white">
															<h6 class="modal-title"><i class="icon-eye"></i> Barcode {{ @$rs->products->nama_produk }} {{ @$rs->brands->nama_brand }} {{ @$rs->size->size }}</span></h6>
															<button type="button" class="close" data-dismiss="modal">&times;</button>
														</div>
														<div class="modal-body" align="center">
															<div class="barcode"  id="printbarcode">
																{{ @$rs->products->nama_produk }} <br><br>
																<span>{{ date("M Y", strtotime(@$rs->expired_date)) }}</span>
																{!! DNS1D::getBarcodeHTML(@$rs->barcode, "C128",1.3,100) !!}
																<span>{{ @$rs->barcode }}</span>
															</div>
														</div>

														<div class="modal-footer">
															<button type="button" class="btn btn-link" onclick="printDiv('printbarcode')">PRINT</button>
														</div>
													</div>
												</div>
											</div>

											<div id="see_label{{ @$rs->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header bg-indigo text-white">
															<h6 class="modal-title"><i class="icon-eye"></i> Label {{ @$rs->products->nama_produk }} {{ @$rs->brands->nama_brand }} {{ @$rs->size->size }}</h6>
															<button type="button" class="close" data-dismiss="modal">&times;</button>
														</div>
														<div class="modal-body" align="center">
															<div class="label" id="label">
																{!! DNS1D::getBarcodeHTML(@$rs->barcode, "C128",2,100) !!}
																<span>{{ @$rs->barcode }}</span>
																<br>
																<br>
																<dl>
																	<dt><b>Brand</b></dt>
																	<dd>{{ @$rs->brands->nama_brand }}</dd>
																	<dt><b>Nama Produk</b></dt>
																	<dd>{{ @$rs->products->nama_produk }}</dd>
																	<dt><b>Ukuran</b></dt>
																	<dd>{{ @$rs->size->size }}</dd>
																	<dt><b>Tanggal Kadaluarsa</b></dt>
																	<dd><?php echo date("d M Y", strtotime(@$rs->expired_date)); ?></dd>
																</dl>
															</div>
														</div>

														<div class="modal-footer">
															<button type="button" class="btn btn-link" onclick="printDiv('label')">PRINT</button>
														</div>
													</div>
												</div>
											</div>


											@endforeach
										</tbody>
									</table>
								</div>

								{{ Form::open(['route'=>'stock-in.move', 'method' => 'POST']) }} 
								{{ Form::token() }}
								<input type="hidden" name="unique_code_move" value="{{ $unique_code }}" />
								<button type="submit" class="btn btn-success">Submit</button>
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

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $(".btn-scan").click(function(e){
  
        e.preventDefault();
   
        var barcode = $("input[name=barcode]").val();
   
        $.ajax({
           type:'POST',
           url:"{{ route('stock-in.scan') }}",
           data:{barcode:barcode},
           success:function(response){
				if (response.status == 200) {
					let data = response.data;
					$("#expired_date").val(data.expired_date);
					$("#brand_id").val(data.brand_id);
					$("#nama_brand").val(data.nama_brand);
					$('#size_id').find('option[value="'+data.size_id+'"]').prop('selected', true);
					$('#product_id').val(data.product_id).trigger('change');
					
				} else {
					$("#expired_date").val('');
					$("#brand_id").val('');
					$("#nama_brand").val('');
					$('#size_id').find('option[value=""]').prop('selected', true);
					$('#product_id').val('').trigger('change');
					$("#barcode").val('').focus();
					alert("Data tidak ditemukan!");
				}
           }
        });
  
    });

	$('#scan').keypress(function (e) {

		if (e.which == 13) {
			
		var barcode = $("input[name=barcode]").val();
		
		$.ajax({
			type:'POST',
			url:"{{ route('stock-in.scan') }}",
			data:{barcode:barcode},
			success:function(response){
				if (response.status == 200) {
					let data = response.data;
					$("#expired_date").val(data.expired_date);
					$("#brand_id").val(data.brand_id);
					$("#nama_brand").val(data.nama_brand);
					$('#size_id').find('option[value="'+data.size_id+'"]').prop('selected', true);
					$('#product_id').val(data.product_id).trigger('change');
					
				} else {
					$("#expired_date").val('');
					$("#brand_id").val('');
					$("#nama_brand").val('');
					$('#size_id').find('option[value=""]').prop('selected', true);
					$('#product_id').val('').trigger('change');
					$("#barcode").val('').focus();
					alert("Data tidak ditemukan!");
				}
			}
		});
			return false;    //<---- Add this line
		}
		
	});
</script>

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/material/full/# by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Jun 2021 13:46:42 GMT -->
</html>
