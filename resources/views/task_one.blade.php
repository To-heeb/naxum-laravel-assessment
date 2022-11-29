
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
									<tr>
										<td>Tiger Nixon</td>
										<td>System Architect</td>
										<td>Edinburgh</td>
										<td>61</td>
										<td>2011/04/25</td>
										<td>$320,800</td>
                                        <td>$320,800</td>
                                        <td>$320,800</td>
                                        <td>View</td>
									</tr>
									<tr>
										<td>Garrett Winters</td>
										<td>Accountant</td>
										<td>Tokyo</td>
										<td>63</td>
										<td>2011/07/25</td>
										<td>$170,750</td>
                                        <td>$320,800</td>
                                        <td>$320,800</td>
                                        <td>View</td>
									</tr>
									<tr>
										<td>Ashton Cox</td>
										<td>Junior Technical Author</td>
										<td>San Francisco</td>
										<td>66</td>
										<td>2009/01/12</td>
										<td>$86,000</td>
                                        <td>$320,800</td>
                                        <td>$320,800</td>
                                        <td>View</td>
									</tr>
									<tr>
										<td>Cedric Kelly</td>
										<td>Senior Javascript Developer</td>
										<td>Edinburgh</td>
										<td>22</td>
										<td>2012/03/29</td>
										<td>$433,060</td>
                                        <td>$320,800</td>
                                        <td>$320,800</td>
                                        <td>View</td>
									</tr>
									<tr>
										<td>Airi Satou</td>
										<td>Accountant</td>
										<td>Tokyo</td>
										<td>33</td>
										<td>2008/11/28</td>
										<td>$162,700</td>
                                        <td>$320,800</td>
                                        <td>$320,800</td>
                                        <td>View</td>
									</tr>
									<tr>
										<td>Brielle Williamson</td>
										<td>Integration Specialist</td>
										<td>New York</td>
										<td>61</td>
										<td>2012/12/02</td>
										<td>$372,000</td>
                                        <td>$320,800</td>
                                        <td>$320,800</td>
                                        <td>View</td>
									</tr>
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