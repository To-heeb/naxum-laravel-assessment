@extends('layout')
   
@section('title', 'Task Two')
@section('content')
    <div class="container-fluid">
		<div class="page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Distributors</a></li>
			</ol>
		</div>
		<!-- row -->

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Top 100 Distributors</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-responsive-md table-striped">
								<thead>
									<tr>
										<th>Top</th>
                                        <th>Distributor Name</th>
										<th>Total Sales</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($distributors as $distributor)
									<tr>
										<td>{{ $distributor->num_row}}</td>
										<td>{{ $distributor->last_name .' '.$distributor->first_name}}</td>
										<td>${{ $distributor->total_sales}}</td>
									</tr>
                                    @endforeach
								</tbody>
							</table>
                            {{ $distributors->links() }}
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