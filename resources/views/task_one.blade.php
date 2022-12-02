
@extends('layout')
@section('title', 'Task One')
@section('content')
    <div class="container-fluid">
		<div class="page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Transaction Report</a></li>
			</ol>
		</div>
		<!-- row -->


		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Transaction Report</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-responsive-md table-striped">
								<thead>
									<tr>
										<th>Invoice</th>
										<th>Purchaser</th>
										<th>Distributor</th>
										<th>Referred Distributors</th>
										<th>Order Date</th>
                                        <th>Order Total</th>
										<th>Percentage</th>
                                        <th>Commission</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($orders as $order)
									<tr>
										<td>{{ $order->invoice_number}}</td>
										<td>{{ $order->purchaser_last_name .' '.$order->purchaser_first_name}}</td>
										<td>@if($order->distributor_category_id == 1) {{$order->distributor_last_name .' '.$order->distributor_first_name}} @endif</td>
										<td>{{ $order->referred_distributor_count }}</td>
										<td>{{ $order->order_date }}</td>
										<td>${{ $order->order_total }}</td>
                                        <td>{{ $order->percentage }}%</td>
                                        <td>${{ $order->commission }}</td>
                                        <td><a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" data-id="{{$order->real_order_id}}">View</a></td>
									</tr>
                                    @endforeach
								</tbody>
							</table>
                            {{ $orders->links() }}
						</div>
					</div>
				</div>
			</div>
			
			<!-- Large modal -->
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="orderDetailsModal">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Invoice: <b></b></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal">
							</button>
						</div>
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-responsive-md table-striped">
									<thead>
										<tr>
											<th>SKU</th>
											<th>Product Name</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody id="table-body">
										
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
@endsection

@section('script')
<script>


	//Ajax for Order's  details
	$('#orderDetailsModal').on('show.bs.modal', function(e) {

		
		var order_id = $(e.relatedTarget).data('id');
		alert(order_id);
		
		var url = '{{  url("/order_items") }}',
		//var url = '{{ route("/order_items") }}';
		url = url.replace(':id', order_id);

		$.ajax({
			url: url,
			type: "POST",
			data: {
				'order_id' : order_id, 
				'_token' : "<?= @csrf ?>"
			},
			success: function(result){

				console.log(result);
				var output =    ''
				
				$('.modal-body').html(output);
				$('.modal-title').html();
			},
			error: function(error){
				console.log(error);
			}
		})

    })
</script>
@endsection