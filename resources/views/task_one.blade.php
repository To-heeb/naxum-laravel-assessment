
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
						<h4 class="card-title"></h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="display" style="min-width: 845px">
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
										<td>{{$order->invoice_number}}</td>
										<td>{{$order->last_name .' '.$order->first_name}}</td>
										<td>{{$order->referred_by}}</td>
										<td>{{$order->last_name .' '.$order->first_name}}</td>
										<td>{{ $order->order_date }}</td>
										<td>{{ $order->order_id }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td><a href="#">View</a></td>
									</tr>
                                    @endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Office</th>
										<th>Age</th>
										<th>Start date</th>
										<th>Salary</th>
                                        <th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			
			
		</div>
	</div>
@endsection

@section('script')
		<script src="{{ asset('assets/vendor/toastr/js/toastr.min.js') }}"></script>	
		<script src="{{ asset('assets/js/plugins-init/toastr-init.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>
@endsection