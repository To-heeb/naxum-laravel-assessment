
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
							<div class="row">
								<form action="{{route('search')}}" method="GET">
									<div class="row">
										<div class="mb-3 col-md-6">
											<label class="form-label">Distributor</label>
											<input type="text" name="" id="search_term" class="form-control search_term typeahead" placeholder="Search by ID, Username, Firstname, Lastname">
											<input type="hidden" name="user_id" id="user_id">
											<div id="search_result"></div>
										</div>
									</div>
									<div class="row">
										<div class="mb-3 col-md-3">
											<label class="form-label">Date From</label>
											<input type="date" name="date_from" class="form-control" required>
										</div>
										<div class="mb-3 col-md-3">
											<label class="form-label">Date To</label>
											<input type="date" name="date_to" class="form-control" required>
										</div>
										<div class="mb-3 col-md-3">
											<input type="submit" name="new_search" class="btn btn-primary btn-sm mt-md-4" value="Filter">
										</div>
									</div>
								</form>
								<div>
									<p style="float: right;" class=""><b>Total Commission:</b> ${{$total_commission}}</p>
									<p style="clear: both"></p>
								</div>
								
							</div>
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
                                        <td><a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" data-id="{{$order->real_order_id}}" data-invoice="{{$order->invoice_number}}">View</a></td>
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
							<h5 class="modal-title">Invoice: <b id="invoice-tag"></b></h5>
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

	$(document).on('click', function(event){
			
			$("#search_result").html("")
	})
	//Ajax for Order's  details
	$('#orderDetailsModal').on('show.bs.modal', function(e) {

		
		var order_id = $(e.relatedTarget).data('id');
		var invoice_number = $(e.relatedTarget).data('invoice');
		$("#invoice-tag").html(invoice_number)
		$('#table-body').html()
		//alert(order_id);
		
		
		var url = '{{  url("/order_items/:id") }}',
		
		url = url.replace(':id', order_id);

		$.ajax({
			url: url,
			type: "GET",
			data: {
				'order_id' : order_id, 
			},
			success: function(result){

				console.log(result);
				var output = '';
				result.forEach((order_item) => {
                output += `
						<tr>
							<td>${order_item.sku}</td>
							<td>${order_item.name}</td>
							<td>${order_item.price}</td>
							<td>${order_item.quantity}</td>
							<td>$${order_item.total}</td>
						<tr>
                    `;
            })
				
				
				//$('.modal-body').html(output);
				$('#table-body').html(output);
			},
			error: function(error){
				console.log(error);
			}
		})

    })

	var path = "{{ route('autocomplete') }}";
	
    $('input.typeahead').typeahead({
        source:  function (terms, process) 
        {
          return $.get(path, { terms: terms }, function (data) {
				console.log(data);
				$("#search_result").html("")
				// data = JSON.parse(data);
				var output = '';
				if(data.length > 0) {
					
					output += `<ul class="list-group" style="display:block;position:relative;z-index:1;">`;
					data.forEach((data_details) => {
						output += `<li class="list-group-item search-list" onMouseOver="this.style.backgroundColor='#40189D'; this.style.color='#fff';" onMouseOut="this.style.backgroundColor='#fff'; this.style.color='#000';" data-id="${data_details.id}">${data_details.first_name} ${data_details.last_name}</li>`;
					})
					output += `</ul>`
				}else{
					output += "<li class='list-group-item'>No Data Found</li>";
				}
				$("#search_result").html(output)
                return process(data);

            });
        }
    });


	$(document).on('click', '.search-list', function(event){
		var value = $(this).text();
		var user_id = $(this).data('id');
		$("#search_term").val(value);
		$("#user_id").val(user_id);
		$("#search_result").html("")
	})
</script>
@endsection