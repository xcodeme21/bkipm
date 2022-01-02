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
						
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					@include("include.session")

					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-xl-6">
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Order Number</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<input type="text" value="{{ @$ordernumber }}" class="form-control form-control-outline" placeholder="Placeholder" readonly>
												<label class="label-floating">Order Number</label>
											</div>
										</div>
									</div>
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Nama Customer</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<input type="text" value="{{ @$customers->nama }}" class="form-control form-control-outline" placeholder="Placeholder" readonly>
												<label class="label-floating">Nama Customer</label>
											</div>
										</div>
									</div>
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">No. Tlp</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<input type="text" value="{{ @$customers->no_tlp }}" class="form-control form-control-outline" placeholder="Placeholder" readonly>
												<label class="label-floating">No. Tlp</label>
											</div>
										</div>
									</div>
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Alamat</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<textarea class="form-control form-control-outline" placeholder="Placeholder" readonly>{{ @$customers->alamat }}</textarea>
												<label class="label-floating">Alamat</label>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-xl-6">
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Delivery</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<input type="text" value="{{ @$delivery->delivery }}" class="form-control form-control-outline" placeholder="Placeholder" readonly>
												<label class="label-floating">Delivery</label>
											</div>
										</div>
									</div>
									<div class="form-group form-group-floating row">
										<label class="col-form-label col-lg-2">Source</label>
										<div class="col-lg-10">
											<div class="position-relative">
												<input type="text" value="{{ @$source->source }}" class="form-control form-control-outline" placeholder="Placeholder" readonly>
												<label class="label-floating">Source</label>
											</div>
										</div>
									</div>
									<div class="row-fluid" align="right">
										<a href="{{ route('stock-out.tambah') }}" class="btn btn-warning">Batal</a>
										<a href="#" data-toggle="modal" data-target="#lihat_barcode" class="btn btn-success"><i class="icon-barcode2"></i> Barcode</a>&nbsp;
										<a href="#" data-toggle="modal" data-target="#lihat_label" class="btn btn-info"><i class="icon-price-tag2"></i> Label</a>


										<div id="lihat_barcode" class="modal fade" tabindex="10000" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-indigo text-white">
														<h6 class="modal-title"><i class="icon-eye"></i> Barcode <span class="text-success">{{ @$ordernumber }}</span> <span class="text-info">{{ @$rs->brands->nama_brand }}</span> <span class="text-danger">{{ @$rs->size->size }}</span></h6>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body" align="center">
														<div class="barcode" id="cetakbarcode">
															{!! DNS1D::getBarcodeHTML(@$ordernumber, "C128",1.3,100) !!}
															<span>{{ @$ordernumber }}</span>
														</div>
													</div>

													<div class="modal-footer">
														<button type="button" class="btn btn-link" onclick="printDiv('cetakbarcode')">PRINT</button>
													</div>
												</div>
											</div>
										</div>

										<div id="lihat_label" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-indigo text-white">
														<h6 class="modal-title"><i class="icon-eye"></i> Label <span class="text-warning">{{ @$ordernumber }}</span> <span class="text-info">{{ @$rs->brands->nama_brand }}</span> <span class="text-danger">{{ @$rs->size->size }}</span></h6>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body" align="center">
														<div class="label" id="cetaklabel">
															{!! DNS1D::getBarcodeHTML(@$ordernumber, "C128",1.3,100) !!}
															<span>{{ @$ordernumber }}</span>
															<br>
															<br>
															<dl>
																<dt><b>Nama Customer</b></dt>
																<dd>{{ @$customers->nama }}</dd>
																<dt><b>Telepon</b></dt>
																<dd>{{ @$customers->no_tlp }}</dd>
																<dt><b>Alamat</b></dt>
																<dd>{{ @$customers->alamat }}</dd>
																<dt><b>Email</b></dt>
																<dd>{{ @$customers->email }}</dd>
																<dt><b>Source</b></dt>
																<dd>{{ @$source->source }}</dd>
																<dt><b>Delivery</b></dt>
																<dd>{{ @$delivery->delivery }}</dd>
															</dl>
														</div>
													</div>

													<div class="modal-footer">
														<button type="button" class="btn btn-link" onclick="printDiv('cetaklabel')">PRINT</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							
						</div>
					</div>

					

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
								{{ Form::open(['route'=>'stock-out.add', 'id' => 'form1', 'method' => 'POST']) }} 
								{{ Form::token() }}
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Nama Produk</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select data-placeholder="Ketik 'keyword'" name="product_id" class="form-control select-minimum" required>
												<option value="">-- Pilih Produk --</option>
												@foreach(@$products as $prod)
												<option value="{{ @$prod->product_id }}">{{ @$prod->nama_produk }}</option>
												@endforeach
											</select>
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
											<input type="hidden" name="order_number" value="{{ @$ordernumber }}" />
											<input type="hidden" name="customer_id" value="{{ @$customers->id }}" />
											<input type="hidden" name="delivery_id" value="{{ @$delivery->id }}" />
											<input type="hidden" name="source_id" value="{{ @$source->id }}" />
											<input type="hidden" name="barcode" id="barcodeshow" />
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Harga</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" name="harga_produk" id="harga" class="form-control form-control-outline uang" placeholder="Placeholder" readonly>
											<label class="label-floating">Harga</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Size</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select name="size_id" id="size_id" class="custom-select form-control-outline" required>
												<option value="">-- Pilih Size --</option>
											</select>
											<label class="label-floating">Size</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Expired Date</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select name="expired_date" id="expired_date" class="custom-select form-control-outline" required>
												<option value="">-- Pilih Expired Date --</option>
											</select>
											<label class="label-floating">Size</label>
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
									<div class="col-6">
										<button type="button" class="btn btn-outline-danger btn-sm">TOTAL STOCK TERSEDIA : <strong><span id="totalstock">0</span></strong></button>
									</div>
									<div class="col-6" align="right">
									<button type="submit" class="btn btn-success">Simpan</button>
									</div>
								</div>
								{{ Form::close() }}



								{{ Form::open(['route'=>'stock-out.add', 'id' => 'form2', 'style' => 'display:none;' ,'method' => 'POST']) }} 
								{{ Form::token() }}
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Nama Produk</label>
									<div class="col-lg-10">
										<div class="position-relative">
											
										<input type="text" name="nama_produk" id="nama_produk" class="form-control form-control-outline uang" placeholder="Placeholder" readonly>
											<small><a href="#" data-toggle="modal" data-target="#modal_theme_custom" class="text-danger"> Add New Produk</a></small>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Nama Brand</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" id="nama_brand2" class="form-control form-control-outline" placeholder="Placeholder" readonly>
											<label class="label-floating">Nama Brand</label>
											<input type="hidden" name="brand_id" id="brand_id2" />
											<input type="hidden" name="product_id" id="product_id2" />
											<input type="hidden" name="order_number" value="{{ @$ordernumber }}" />
											<input type="hidden" name="customer_id" value="{{ @$customers->id }}" />
											<input type="hidden" name="delivery_id" value="{{ @$delivery->id }}" />
											<input type="hidden" name="source_id" value="{{ @$source->id }}" />
											<input type="hidden" name="barcode" id="barcodeshow2" />
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Harga</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<input type="text" name="harga_produk" id="harga2" class="form-control form-control-outline uang" placeholder="Placeholder" readonly>
											<label class="label-floating">Harga</label>
										</div>
									</div>
								</div>
								<div class="form-group form-group-floating row">
									<label class="col-form-label col-lg-2">Size</label>
									<div class="col-lg-10">
										<div class="position-relative">
											<select name="size_id" id="size_id2" class="custom-select form-control-outline" required>
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
											<input type="text" name="expired_date" id="expired_date2" class="form-control form-control-outline pickadate-accessibility" placeholder="Placeholder" required>
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
											@foreach(@$stockouttempo as $rs)
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
													<a href="{{ route('stock-out-tempo.delete',[$rs->id]) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="icon-trash"></i> Delete</a>
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
															<div class="barcode" id="printbarcode">
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
																{!! DNS1D::getBarcodeHTML(@$rs->barcode, "C128",1.3,100) !!}
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

								{{ Form::open(['route'=>'stock-out.move', 'method' => 'POST']) }} 
								{{ Form::token() }}
								<input type="hidden" name="order_number_move" value="{{ $ordernumber }}" />
								<input type="hidden" name="customer_id_move" value="{{ $customers->id }}" />
								<input type="hidden" name="delivery_id_move" value="{{ $delivery->id }}" />
								<input type="hidden" name="source_id_move" value="{{ $source->id }}" />
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
					url : 'getbrand/' +productID,
					type : "GET",
					dataType : "json",
					success:function(data)
					{
						$("#nama_brand").val(data.nama_brand);
						$("input[name=harga_produk]").val(data.harga);
						$("#brand_id").val(data.id);
						$("#product_id").val(data.product_id);

						$("#size_id").empty();
						$('<option>').val('').text("-- Pilih Size --").appendTo('#size_id');
						$.each(data.size, function(k, v) {
							$('<option>').val(v.size_id).text(v.size).appendTo('#size_id');
						});
					}
				});
			}
			else
			{
				$("#nama_brand").empty();
				$("input[name=harga_produk]").empty();
				$("#brand_id").empty();
				$("#product_id").empty();
				$("#size_id").empty();
			}
		});

		jQuery('select[name="product_id"]').on('change',function(a){
			var productID = $(a.target).val();
			jQuery('select[name="size_id"]').on('change',function(b){
				var sizeID = $(b.target).val();

				if(sizeID)
				{
					jQuery.ajax({
						url : 'getexpireddate/'+productID+'/'+sizeID ,
						type : "GET",
						dataType : "json",
						success:function(data)
						{
							$("#expired_date").empty();
							$('<option>').val('').text("-- Pilih Expired Date --").appendTo('#expired_date');
							$.each(data, function(k, v) {
								$('<option>').val(v.expired_date).text(v.expired_date).appendTo('#expired_date');
							});
						}
					});
				}
				else
				{
					$("#expired_date").empty();
				}
			});
		});

		

		jQuery('select[name="product_id"]').on('change',function(c){
			var productID = $(c.target).val();
			jQuery('select[name="size_id"]').on('change',function(d){
				var sizeID = $(d.target).val();
				jQuery('select[name="expired_date"]').on('change',function(e){
					var expiredDate = $(e.target).val();

					if(expiredDate)
					{
						jQuery.ajax({
							url : 'getbarcode/'+productID+'/'+sizeID+'/'+expiredDate ,
							type : "GET",
							dataType : "json",
							success:function(data)
							{
								$("#barcodeshow2").val(data.barcode);
								$("#barcodeshow").val(data.barcode);
								$("#totalstock").text(data.total);
							}
						});
					}
					else
					{
						$("#barcodeshow2").empty();
						$("#barcodeshow").empty();
						$("#totalstock").empty();
					}
				});
			});
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
					$("#form1").hide();
					$("#form2").show();
					$("#expired_date").val(data.expired_date);
					$("#brand_id").val(data.brand_id);
					$("#nama_brand").val(data.nama_brand);
					$("input[name=harga_produk]").val(data.harga);
					$('#size_id').find('option[value="'+data.size_id+'"]').prop('selected', true);
					$('#product_id').val(data.product_id).trigger('change');
					$("#barcodeshow").val(data.barcode);

					$("#nama_produk").val(data.nama_produk).show();
					$("#expired_date2").val(data.expired_date);
					$("#brand_id2").val(data.brand_id);
					$("#nama_brand2").val(data.nama_brand);
					$("input[name=harga_produk]").val(data.harga);
					$('#size_id2').find('option[value="'+data.size_id+'"]').prop('selected', true);
					$('#product_id2').val(data.product_id).trigger('change');
					$("#barcodeshow2").val(data.barcode);
					
				} else {
					$("#form1").show();
					$("#form2").hide();
					$("#expired_date").val('');
					$("#brand_id").val('');
					$("#nama_brand").val('');
					$("input[name=harga_produk]").val('');
					$('#size_id').find('option[value=""]').prop('selected', true);
					$('#product_id').val('').trigger('change');
					$("#barcodeshow").val('').focus();
					
					$("#nama_produk").val('').hide();
					$("#expired_date2").val('');
					$("#brand_id2").val('');
					$("#nama_brand2").val('');
					$("input[name=harga_produk]").val('');
					$('#size_id2').find('option[value=""]').prop('selected', true);
					$('#product_id2').val('').trigger('change');
					$("#barcodeshow2").val('').focus();
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
					$("#form1").hide();
					$("#form2").show();
					$("#expired_date").val(data.expired_date);
					$("#brand_id").val(data.brand_id);
					$("#nama_brand").val(data.nama_brand);
					$("input[name=harga_produk]").val(data.harga);
					$('#size_id').find('option[value="'+data.size_id+'"]').prop('selected', true);
					$('#product_id').val(data.product_id).trigger('change');
					$("#barcodeshow").val(data.barcode);

					$("#nama_produk").val(data.nama_produk).show();
					$("#expired_date2").val(data.expired_date);
					$("#brand_id2").val(data.brand_id);
					$("#nama_brand2").val(data.nama_brand);
					$("input[name=harga_produk]").val(data.harga);
					$('#size_id2').find('option[value="'+data.size_id+'"]').prop('selected', true);
					$('#product_id2').val(data.product_id).trigger('change');
					$("#barcodeshow2").val(data.barcode);
					
				} else {
					$("#form1").show();
					$("#form2").hide();
					$("#expired_date").val('');
					$("#brand_id").val('');
					$("#nama_brand").val('');
					$("input[name=harga_produk]").val('');
					$('#size_id').find('option[value=""]').prop('selected', true);
					$('#product_id').val('').trigger('change');
					$("#barcodeshow").val('').focus();
					
					$("#nama_produk").val('').hide();
					$("#expired_date2").val('');
					$("#brand_id2").val('');
					$("#nama_brand2").val('');
					$("input[name=harga_produk]").val('');
					$('#size_id2').find('option[value=""]').prop('selected', true);
					$('#product_id2').val('').trigger('change');
					$("#barcodeshow2").val('').focus();
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
