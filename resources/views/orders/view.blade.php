<!DOCTYPE html>
<html lang="en">

@include("include.head")
<style>
	.modal-backdrop {display: none;}
	dl {
	width: 100%;
	overflow: hidden;
	background: #ff0;
	padding: 0;
	margin: 0
	}
	dt {
	float: left;
	width: 50%;
	/* adjust the width; make sure the total of both is 100% */
	background: black;
	color:white;
	padding: 0;
	margin: 0
	}
	dd {
	float: left;
	width: 50%;
	/* adjust the width; make sure the total of both is 100% */
	background: black;
	color:white;
	padding: 0;
	margin: 0
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
							<div class="row">
								<div class="col-xl-4" align="center">
									<h4><b>ORDER NUMBER</b></h4>
									{!! DNS1D::getBarcodeHTML(@$detailorder->order_number, "C128",1.5,100) !!}
									<h6>{{ @$detailorder->order_number }}</h6>
								</div>
								<div class="col-xl-8">
									<div class="row-fluid" align="right">
										@if(@$detailorder->status == 0)
										<button class="btn btn-info"><i class="icon-spinner2 spinner"></i> DELIVERING</button>
										@else
										<button class="btn btn-success"><i class="icon-checkmark"></i> FINISH</button>
										@endif
										<a href="#" data-toggle="modal" data-target="#lihat_barcode" class="btn btn-success"><i class="icon-barcode2"></i> Barcode</a>&nbsp;
										<a href="{{ route('orders.label',[@$detailorder->id]) }}" target="_blank" class="btn btn-info"><i class="icon-price-tag2"></i> Label</a>


										<div id="lihat_barcode" class="modal fade" tabindex="10000" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-indigo text-white">
														<h6 class="modal-title"><i class="icon-eye"></i> Barcode {{ @$detailorder->order_number }}</h6>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body" align="center">
														<div class="barcode" id="cetakbarcode">
															{!! DNS1D::getBarcodeHTML(@$detailorder->order_number, "C128",1.3,100) !!}
															<span>{{ @$detailorder->order_number }}</span>
														</div>
													</div>

													<div class="modal-footer">
														<button type="button" class="btn btn-link" onclick="printDiv('cetakbarcode')">PRINT</button>
													</div>
												</div>
											</div>
										</div>

										<!-- <div id="lihat_label" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-indigo text-white">
														<h6 class="modal-title"><i class="icon-eye"></i> Label <span class="text-warning">{{ @$detailorder->order_number }}</span> <span class="text-info">{{ @$rs->brands->nama_brand }}</span> <span class="text-danger">{{ @$rs->size->size }}</span></h6>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body" align="center">
														<div class="label" id="cetaklabel">
															{!! DNS1D::getBarcodeHTML(@$detailorder->order_number, "C128",1.3,100) !!}
															<span>{{ @$detailorder->order_number }}</span>
															<br>
															<br>
															<ul>
																<li><b>Nama Customer</b></li>
																<li>{{ @$detailorder->customers->nama }}</li>
																<li><b>Telepon</b></li>
																<li>{{ @$detailorder->customers->no_tlp }}</li>
																<li><b>Alamat</b></li>
																<li>{{ @$detailorder->customers->alamat }}</li>
																<li><b>Email</b></li>
																<li>{{ @$detailorder->customers->email }}</li>
																<li><b>Source</b></li>
																<li>{{ @$detailorder->source->source }}</li>
																<li><b>Delivery</b></li>
																<li>{{ @$detailorder->delivery->delivery }}</li>
															</ul>
														</div>
													</div>

													<div class="modal-footer">
														<button type="button" class="btn btn-link" onclick="printDiv('cetaklabel')">PRINT</button>
													</div>
												</div>
											</div>
										</div> -->
										
										<a href="{{ route('orders') }}" class="btn btn-warning">
											<i class="icon-arrow-left52"></i> 
											Back
										</a>
									</div>

									<h5>{{ @$detailorder->customers->nama }}</h5>
									<h5>{{ @$detailorder->customers->no_tlp }}</h5>
									<h5>{{ @$detailorder->customers->alamat }}</h5>
									<h5>{{ @$detailorder->delivery->delivery }}</h5>
									<h5>{{ @$detailorder->source->source }}</h5>

									<div class="row-fluid" align="right">
										@if(@$detailorder->status ==  0)
										<a href="#" data-toggle="modal" data-target="#update_orders" class="btn btn-warning"><i class="icon-pencil"></i> EDIT ORDER</a>

										<div id="update_orders" class="modal fade" tabindex="-1">
											<div class="modal-dialog modal-xl">
												<div class="modal-content">
													<div class="modal-header bg-indigo text-white">
														<h6 class="modal-title"><i class="icon-pencil"></i> Edit Orders</h6>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													{{ Form::open(['route'=>'orders.update', 'method' => 'POST']) }} 
													{{ Form::token() }}
													<div class="modal-body">
														<div class="form-group form-group-floating row">
															<label class="col-form-label col-lg-2">No. Telepon</label>
															<div class="col-lg-10">
																<div class="position-relative">
																	<input type="text" name="no_tlp" value="{{ @$detailorder->no_tlp }}" class="form-control form-control-outline" placeholder="Placeholder" required>
																	<label class="label-floating">No. Telepon</label>
																	<input type="hidden" name="id_edit" value="{{ @$detailorder->id }}" />
																</div>
															</div>
														</div>
														<div class="form-group form-group-floating row">
															<label class="col-form-label col-lg-2">Alamat</label>
															<div class="col-lg-10">
																<div class="position-relative">
																	<textarea name="alamat" class="form-control form-control-outline" cols="30" rows="5" required>{{ @$detailorder->alamat }}</textarea>
																	<label class="label-floating">No. Telepon</label>
																</div>
															</div>
														</div>
														<div class="form-group form-group-floating row">
															<label class="col-form-label col-lg-2">Delivery</label>
															<div class="col-lg-10">
																<div class="position-relative">
																	<select name="delivery_id" class="form-control form-control-outline" required>
																		<option value="">-- Pilih Delivery --</option>
																		@foreach(@$delivery as $deliv)
																		<option value="{{ @$deliv->id }}" @if(@$detailorder->delivery_id == @$deliv->id) selected @endif>{{ @$deliv->delivery }}</option>
																		@endforeach
																	</select>
																</div>
															</div>
														</div>
														<div class="form-group form-group-floating row">
															<label class="col-form-label col-lg-2">Source</label>
															<div class="col-lg-10">
																<div class="position-relative">
																	<select name="source_id" class="form-control form-control-outline" required>
																		<option value="">-- Pilih Source --</option>
																		@foreach(@$source as $src)
																		<option value="{{ @$src->id }}" @if(@$detailorder->source_id == @$src->id) selected @endif>{{ @$src->source }}</option>
																		@endforeach
																	</select>
																</div>
															</div>
														</div>
														<div class="form-group form-group-floating row">
															<label class="col-form-label col-lg-2">Harga</label>
															<div class="col-lg-10">
																<div class="position-relative">
																	<input type="text" name="harga_semua_produk" id="harga_semua_produk" onkeyup="hitung();" value="{{ @$detailorder->harga_semua_produk }}" class="form-control form-control-outline uang" placeholder="Placeholder" required>
																	<label class="label-floating">Harga</label>
																</div>
															</div>
														</div>
														<div class="form-group form-group-floating row">
															<label class="col-form-label col-lg-2">Biaya Admin</label>
															<div class="col-lg-10">
																<div class="position-relative">
																	<input type="text" name="biaya_admin" id="biaya_admin" onkeyup="hitung();" value="{{ @$detailorder->biaya_admin }}" class="form-control form-control-outline uang" placeholder="Placeholder" required>
																	<label class="label-floating">Biaya Admin</label>
																</div>
															</div>
														</div>
														<div class="form-group form-group-floating row">
															<label class="col-form-label col-lg-2">Diskon Voucher</label>
															<div class="col-lg-10">
																<div class="position-relative">
																	<input type="text" name="diskon_voucher" id="diskon_voucher" onkeyup="hitung();" value="{{ @$detailorder->diskon_voucher }}" class="form-control form-control-outline uang" placeholder="Placeholder" required>
																	<label class="label-floating">Diskon Voucher</label>
																</div>
															</div>
														</div>
														<div class="form-group form-group-floating row">
															<label class="col-form-label col-lg-2">Total</label>
															<div class="col-lg-10">
																<div class="position-relative">
																	<input type="text" name="total_harga" id="total_harga" value="{{ @$detailorder->total_harga }}" class="form-control form-control-outline uang" placeholder="Placeholder" required>
																	<label class="label-floating">Total</label>
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

										<a href="#" data-toggle="modal" data-target="#finish" class="btn btn-success"><i class="icon-checkmark"></i> FINISH</a>

										<div id="finish" class="modal fade" tabindex="-1">
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
																	<input type="text" name="biaya_admin" value="{{ @$detailorder->biaya_admin }}" class="form-control form-control-outline uang" placeholder="Placeholder" required>
																	<label class="label-floating">Biaya Admin</label>
																</div>
																<input type="hidden" name="id" value="{{ @$detailorder->id }}" />
															</div>
														</div>
														<div class="form-group form-group-floating row">
															<label class="col-form-label col-lg-2">Diskon Voucher</label>
															<div class="col-lg-10">
																<div class="position-relative">
																	<input type="text" name="diskon_voucher" value="{{ @$detailorder->diskon_voucher }}" class="form-control form-control-outline uang" placeholder="Placeholder" required>
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
										@else
										<button href="#"  class="btn btn-warning" disabled><i class="icon-pencil"></i> EDIT ORDER</button>
										<button class="btn btn-success" disabled><i class="icon-checkmark"></i> FINISH</button>
										@endif
									</div>
									
									<br>

									<dl>
										<dt>Harga</dt>
										<dd><?php echo "Rp " . number_format(@$detailorder->harga_semua_produk,0,',','.'); ?></dd>
										<dt>Biaya Admin</dt>
										<dd>( - <?php echo "Rp " . number_format(@$detailorder->biaya_admin,0,',','.'); ?>)</dd>
										<dt>Diskon Voucher</dt>
										<dd>( - <?php echo "Rp " . number_format(@$detailorder->diskon_voucher,0,',','.'); ?> )</dd>
										<dt>Total</dt>
										<dd><?php echo "Rp " . number_format(@$detailorder->total_harga,0,',','.'); ?></dd>
									</dl>
								</div>
							</div>
						</div>
					</div>


					<div class="card">
						<div class="card-body">
							<div class="row-fluid">
								@if(@$detailorder->status == 0)
								<a href="#" data-toggle="modal" data-target="#add_orders" class="btn btn-warning"><i class="icon-add"></i> Add Item</a>

								<div id="add_orders" class="modal fade" tabindex="-1">
									<div class="modal-dialog modal-xl">
										<div class="modal-content">
											<div class="modal-header bg-indigo text-white">
												<h6 class="modal-title"><i class="icon-add"></i> Add Item</h6>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											{{ Form::open(['route'=>'orders.add', 'method' => 'POST']) }} 
											{{ Form::token() }}
											<div class="modal-body">
												<div class="form-group form-group-floating row">
													<label class="col-form-label col-lg-2">Nama Produk</label>
													<div class="col-lg-10">
														<div class="position-relative">
															<select data-placeholder="Ketik 'keyword'" name="product_id" class="form-control select2-order" data-fouc required>
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
															<input type="hidden" name="product_id" id="product_id" />
															<input type="hidden" name="order_number" value="{{ @$ordernumber }}" />
															<input type="hidden" name="customer_id" value="{{ @$ordercustomers->id }}" />
															<input type="hidden" name="delivery_id" value="{{ @$orderdelivery->id }}" />
															<input type="hidden" name="source_id" value="{{ @$ordersource->id }}" />
															<input type="hidden" name="barcode" id="barcode" />
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
														<span><h6 class="text-danger">TOTAL STOCK TERSEDIA : <strong><span id="totalstock">0</span></strong></h6></span>
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
								@endif
								
							</div>
							<div class="col-xl-12">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Nama</th>
												<th>Brand</th>
												<th>Ukuran</th>
												<th>Expired Date</th>
												<th>Jumlah</th>
												<th>Harga Total</th>
												@if(@$detailorder->status == 0)
												<th class="text-center">Actions</th>
												@endif
											</tr>
										</thead>
										<tbody>
											@foreach(@$stockout as $rs)
											<tr>
												<td>{{ @$rs->products->nama_produk }}</td>
												<td>{{ @$rs->brands->nama_brand }}</td>
												<td>{{ @$rs->size->size }}</td>
												<td>{{ @$rs->expired_date }}</td>
												<td>{{ @$rs->total }}</td>
												<td><?php echo "Rp " . number_format(@$rs->total_harga_produk,0,',','.'); ?></td>
												@if(@$detailorder->status == 0)
												<td class="text-center">
													<!-- <a href="#" data-toggle="modal" data-target="#editptoduct{{ @$rs->id }}" class="btn btn-info btn-sm btn-block"><i class="icon-pencil"></i> Edit</a>

													<div id="editptoduct{{ @$rs->id }}" class="modal fade" tabindex="-1">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header bg-indigo text-white">
																	<h6 class="modal-title"><i class="icon-add"></i> Edit</h6>
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																</div>
																{{ Form::open(['route'=>'orders.updateproduct', 'method' => 'POST']) }} 
																{{ Form::token() }}
																<div class="modal-body">
																	<div class="form-group form-group-floating row">
																		<label class="col-form-label col-lg-2">Nama Produk</label>
																		<div class="col-lg-10">
																			<div class="position-relative">
																				<select data-placeholder="Ketik 'keyword'" class="form-control select-minimum" data-fouc disabled>
																					<option value="">-- Pilih Produk --</option>
																					@foreach(@$products as $prod)
																					<option value="{{ @$prod->product_id }}" @if(@$rs->product_id == @$prod->product_id) selected @endif>{{ @$prod->nama_produk }}</option>
																					@endforeach
																				</select>
																			</div>
																		</div>
																	</div>
																	<div class="form-group form-group-floating row">
																		<label class="col-form-label col-lg-2">Nama Brand</label>
																		<div class="col-lg-10">
																			<div class="position-relative">
																				<input type="text" id="nama_brand" value="{{ @$rs->brands->nama_brand }}" class="form-control form-control-outline" placeholder="Placeholder" disabled>
																				<label class="label-floating">Nama Brand</label>
																				<input type="hidden" name="order_number" value="{{ @$rs->order_number }}" />
																				<input type="hidden" name="product_id" value="{{ @$rs->product_id }}" />
																				<input type="hidden" name="size_id" value="{{ @$rs->size_id }}" />
																			</div>
																		</div>
																	</div>
																	<div class="form-group form-group-floating row">
																		<label class="col-form-label col-lg-2">Harga</label>
																		<div class="col-lg-10">
																			<div class="position-relative">
																				<input type="text" name="harga_produk" value="{{ @$rs->harga_produk }}" id="harga" class="form-control form-control-outline uang" placeholder="Placeholder" disabled>
																				<label class="label-floating">Harga</label>
																			</div>
																		</div>
																	</div>
																	<div class="form-group form-group-floating row">
																		<label class="col-form-label col-lg-2">Size</label>
																		<div class="col-lg-10">
																			<div class="position-relative">
																				<select  class="custom-select form-control-outline" disabled>
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
																		<h6 class="text-danger">Mohon update harga di order setelah melakukan update sesuai dengan total di tabel ini !</h6>
																	</div>
																</div>

																<div class="modal-footer">
																	<button type="button" class="btn btn-link" data-dismiss="modal">BATAL</button>
																	<button type="submit" class="btn btn-indigo">SIMPAN</button>
																</div>
																{{ Form::close() }}
															</div>
														</div>
													</div> -->

													
													<a href="{{ route('orders.deleteproduct',[@$rs->id]) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm btn-block"><i class="icon-trash"></i> Delete</a>
												</td>
												@endif
											</tr>
											@endforeach
											<tr>
											<td colspan="5"><h4>TOTAL</h4></td>
											<td><h4><?php echo "Rp " . number_format(@$totalsum,0,',','.'); ?></h4></td>
											</tr>
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
						$("#harga").val(data.harga);
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
				$("#harga").empty();
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
								$("#barcode").val(data.barcode);
								$("#totalstock").text(data.total);
							}
						});
					}
					else
					{
						$("#barcode").empty();
						$("#totalstock").empty();
					}
				});
			});
		});



	});

</script>

<script type="text/javascript">
	function hitung() {
		var harga_semua_produk = document.getElementById('harga_semua_produk').value.replace(/[^0-9]+/g, "");
		var biaya_admin = document.getElementById('biaya_admin').value.replace(/[^0-9]+/g, "");
		var diskon_voucher = document.getElementById('diskon_voucher').value.replace(/[^0-9]+/g, "");
		var total_harga = parseInt(harga_semua_produk) + parseInt(biaya_admin) - parseInt(diskon_voucher);
		if (!isNaN(total_harga)) {
			document.getElementById('total_harga').value = formatRupiah(total_harga, 'Rp. ');
		}
	}

	function formatRupiah(angka, prefix){
		var number_string = angka.toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
	
		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
	
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
	}

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
