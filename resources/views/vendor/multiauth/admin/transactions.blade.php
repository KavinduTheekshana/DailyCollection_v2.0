@extends('multiauth::layouts.header')
@section('content')


<div class="page-wrapper">
	<div class="container">
		<!-- Title -->
		<div class="row heading-bg">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h5 class="txt-dark">Add Transactions</h5>
			</div>
			<!-- Breadcrumb -->
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="index.html">Dashboard</a></li>
					<li><a href="#"><span>Customers</span></a></li>
					<li class="active"><span>Add Transactions</span></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->


		@if (count($errors) > 0)
		<div style="padding:.75rem 1.25rem;margin-bottom:1rem;border:1px solid transparent;border-radius:.25rem;
								  color:#721c24;background-color:#f8d7da;border-color:#f5c6cb;">
			<strong>Whoops!</strong> There were some problems with your input.<br>
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif

		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif

		@if (session('statusdanger'))
		<div class="alert alert-danger">
			{{ session('statusdanger') }}
		</div>
		@endif

		<!-- Row -->
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Add Transactions Details</h6>
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">

								<form role="form" method="POST"
									action="{{action('TransactionsController@submitcustomers')}}"
									enctype="multipart/form-data">

									{{-- <form role="form" method="POST"
									action="{{action('CustomerController@valid_nic')}}"
									enctype="multipart/form-data"> --}}

									@csrf

									<div class="form-group">
										<div class="row">
											<div class="col-sm-5">
												<label class="control-label mb-10 text-left">NIC</label>
												<div class="input-group"> <span class="input-group-addon"><i
															class="icon-layers"></i></span>

													<select name="cnic" id="cnic" class="form-control select2"
														onchange="myFunctioncustomer()">
														<option value="none">Select NIC</option>
														@foreach ($customer as $item)
														<option value="{{$item->nic}}">{{$item->nic}}</option>
														@endforeach
													</select>
													<span class="input-group-addon">V</span>

												</div>
											</div>
										</div>
										<span id="customermessage" class="help-block"></span>
										<br>
										<div class="row">
											<div class="col-sm-3">
												<label class="control-label mb-10 text-left">ID</label>
												<div class="input-group"> <span class="input-group-addon"><i
															class="icon-pin"></i></span>
													<input id="customer_id" type="number"
														class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}"
														name="customer_id" value="{{ old('nic') }}" readonly required>
												</div>
											</div>
											<div class="col-sm-9">
												<label class="control-label mb-10 text-left">Name</label>
												<div class="input-group">
													<div class="input-group-addon"><i class="icon-user"></i></div>
													<input id="cname" type="text"
														class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
														name="cname" value="{{ old('name') }}" readonly autofocus>
												</div>
											</div>
										</div>
										<br>
										<div class="form-group">
											<label class="control-label mb-10 text-left"
												for="example-email">Address</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="icon-location-pin"></i></div>
												<input id="caddress" type="text"
													class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
													name="caddress" value="{{ old('name') }}" autofocus readonly>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6">
													<label class="control-label mb-10 text-left">Mobile</label>
													<div class="input-group">
														<div class="input-group-addon"><i
																class="icon-screen-smartphone"></i></div>
														<input id="cmobile" type="text"
															class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
															name="cmobile" value="{{ old('name') }}" autofocus readonly>
													</div>
												</div>

												<div class="col-sm-6">
													<label class="control-label mb-10 text-left">Vehicle Number</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="icon-speedometer"></i></div>
														<input id="vehiclenumber" type="text"
															class="form-control {{ $errors->has('vehiclenumber') ? ' is-invalid' : '' }}"
															name="vehiclenumber" value="{{ old('vehiclenumber') }}" autofocus
															readonly>
													</div>
												</div>
											</div>
										</div>
<br>
										<hr>
										<div class="form-group">
											<label class="control-label mb-10 text-left"
												for="example-email">Route</label>

											<select class="form-control select2" name="route">

												@foreach ($route as $item)
												<option>{{$item->route}}</option>

												@endforeach

											</select>
										</div>

									</div>
							</div>
						</div>
					</div>



					{{-- First Guarantor --}}

					<!-- <div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Add First Guarantor Details</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<br>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-5">
								<label class="control-label mb-10 text-left">NIC</label>
								<div class="input-group"> <span class="input-group-addon"><i
											class="icon-layers"></i></span>

									<select name="g1nic" id="g1nic" class="form-control select2"
										onchange="myFunctionfirstguarantor()">
										<option value="none">Select NIC</option>
										@foreach ($customer as $item)
										<option value="{{$item->nic}}">{{$item->nic}}</option>
										@endforeach
									</select>
									<span class="input-group-addon">V</span>

								</div>
							</div>
						</div>
						<span id="g1message" class="help-block"></span>
						<br>
						<div class="row">

							<div class="col-sm-3">
								<label class="control-label mb-10 text-left">ID</label>
								<div class="input-group"> <span class="input-group-addon"><i
											class="icon-pin"></i></span>
									<input id="first_guaranter_id" type="number"
										class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}"
										name="first_guaranter_id" value="{{ old('nic') }}" readonly required>
								</div>
							</div>
							<div class="col-sm-9">
								<label class="control-label mb-10 text-left">Name</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="icon-user"></i></div>
									<input id="g1name" type="text"
										class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
										name="g1name" value="{{ old('name') }}" readonly autofocus>
								</div>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="control-label mb-10 text-left" for="example-email">Address</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-location-pin"></i></div>
								<input id="g1address" type="text"
									class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
									name="g1address" value="{{ old('name') }}" autofocus readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label class="control-label mb-10 text-left">Mobile</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-screen-smartphone"></i></div>
										<input id="g1mobile" type="text"
											class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
											name="g1mobile" value="{{ old('name') }}" autofocus readonly>
									</div>
								</div>

								<div class="col-sm-6">
									<label class="control-label mb-10 text-left">Lan Line</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-phone"></i></div>
										<input id="g1lanline" type="text"
											class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
											name="g1lanline" value="{{ old('name') }}" autofocus readonly>
									</div>
								</div>
							</div>
						</div>
					</div>



					{{-- second guarantor --}}

					<br>
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Add Second Guarantor Details</h6>
						</div>
						<div class="clearfix"></div>
					</div>

					<br>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-5">
								<label class="control-label mb-10 text-left">NIC</label>
								<div class="input-group"> <span class="input-group-addon"><i
											class="icon-layers"></i></span>

									<select name="g2nic" id="g2nic" class="form-control select2"
										onchange="myFunctionsecondguarantor()">
										<option value="none">Select NIC</option>
										@foreach ($customer as $item)
										<option value="{{$item->nic}}">{{$item->nic}}</option>
										@endforeach
									</select>
									<span class="input-group-addon">V</span>

								</div>
							</div>
						</div>
						<span id="g2message" class="help-block"></span>
						<br>
						<div class="row">

							<div class="col-sm-3">
								<label class="control-label mb-10 text-left">ID</label>
								<div class="input-group"> <span class="input-group-addon"><i
											class="icon-pin"></i></span>
									<input id="second_guaranter_id" type="number"
										class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}"
										name="second_guaranter_id" value="{{ old('nic') }}" readonly required>
								</div>
							</div>
							<div class="col-sm-9">
								<label class="control-label mb-10 text-left">Name</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="icon-user"></i></div>
									<input id="g2name" type="text"
										class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
										name="g2name" value="{{ old('name') }}" readonly autofocus>
								</div>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="control-label mb-10 text-left" for="example-email">Address</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="icon-location-pin"></i></div>
								<input id="g2address" type="text"
									class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
									name="g2address" value="{{ old('name') }}" autofocus readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label class="control-label mb-10 text-left">Mobile</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-screen-smartphone"></i></div>
										<input id="g2mobile" type="text"
											class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
											name="g2mobile" value="{{ old('name') }}" autofocus readonly>
									</div>
								</div>

								<div class="col-sm-6">
									<label class="control-label mb-10 text-left">Lan Line</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="icon-phone"></i></div>
										<input id="g2lanline" type="text"
											class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
											name="g2lanline" value="{{ old('name') }}" autofocus readonly>
									</div>
								</div>
							</div>
						</div>
					</div> -->



					<br>

					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Add Payment Details</h6>
						</div>
						<div class="clearfix"></div>
					</div>

					<br>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label mb-10 text-left">Select</label>

									<select id="select" onchange="cleardata()" class="form-control" name="payment_type">
										<option value="daily">Daily</option>
										<option value="weekly">Weekly</option>
									</select>

								</div>
							</div>


						</div>
					</div>


					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label class="control-label mb-10 text-left">Amount</label>
								<div class="input-group">
									<div class="input-group-addon"><i class=" icon-credit-card"></i></div>
									<input id="amount" placeholder="10,000 LKR" type="number"
										class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
										name="amount" value="{{ old('name') }}" autofocus required>
								</div>
							</div>

							<div class="col-sm-4">
								<label class="control-label mb-10 text-left">Installment</label>
								<div class="input-group">
									<div class="input-group-addon"><i class=" icon-credit-card"></i></div>

									<input id="installment" placeholder="10,000 LKR" type="text"
										class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
										name="installment" value="{{ old('name') }}" readonly autofocus>
								</div>
							</div>

							<div class="col-sm-4">
								<label class="control-label mb-10 text-left">Total Income</label>
								<div class="input-group">
									<div class="input-group-addon"><i class=" icon-credit-card"></i></div>

									<input id="totalincome" placeholder="10,000 LKR" type="text"
										class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
										name="totalincome" value="{{ old('name') }}" readonly autofocus>
								</div>
							</div>
						</div>
					</div>




					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label class="control-label mb-10 text-left">Date Purchased</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="icon-calender"></i></div>
									<input id="datepurchased" type="date"
										class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
										name="datepurchased" id="datepurchased" value="{{ old('name') }}" autofocus>
								</div>
							</div>

							<div class="col-sm-6">
								<label class="control-label mb-10 text-left">Due Date</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="icon-calender"></i></div>
									<input id="duedate" type="date" readonly
										class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
										name="duedate" value="{{ old('name') }}" autofocus>
								</div>
							</div>
						</div>
					</div>
					<br>


					<button type="submit" class="btn btn-success mr-10">Submit</button>
					<button type="reset" class="btn btn-default">Reset</button>
					</form>
					<br>
					<br><br>

				</div>

				<br>

			</div>
			<!-- /Row -->
		</div>
	</div>



	<script>
		$("#datepurchased").change(function() {
  $.ajax({
      type: "GET",
      url: '../duedate',
      data: {date:$('#datepurchased').val()},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
      success:function(data){
        //  alert(data);
        // document.getElementById('duedate').type = 'date';
        document.getElementById('duedate').value=data;
      },
      error:function(data){
        alert('Error');
      }
  });
});




		function cleardata(){

			document.getElementById("amount").value = null;
				document.getElementById("installment").value = null;
		}
			
	</script>

	<script>
		$('input[type="number"]').on('keydown, keyup', function () {
  var select=$( "#select" ).val();
  var texInputValue = $('#amount').val();
  var amount = parseInt(texInputValue) + parseInt((texInputValue*20)/100);
  $('#totalincome').val(amount.toFixed(2));
  if (select=='daily') {
	
	var dailyamount = amount/60;
  $('#installment').val(dailyamount.toFixed(2));
  }else if(select=='weekly'){
	var Weeklyamount = amount/10;
  $('#installment').val(Weeklyamount.toFixed(2));
  }
  
});

	
	</script>




	<script>
		$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		 }
		});
		const xCsrfToken = "{{ csrf_token() }}";
		function myFunctioncustomer() {
			$.ajax({
	type: "GET",
	url: '{{url(route('valid_nic'))}}',
	data: {nic:$('#cnic').val()},
	headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
	success:function(data){
		 


	if(data.status=="1"){
	document.getElementById("customermessage").style.color="#28A745";
	document.getElementById('customermessage').innerHTML="Valied Customer";
	document.getElementById('customer_id').value=data.id;
	document.getElementById('cname').value=data.name;
	document.getElementById('caddress').value=data.address;
	document.getElementById('cmobile').value=data.mobile;
	document.getElementById('vehiclenumber').value=data.vehiclenumber;
	}
	else if(data=="0"){
	document.getElementById("customermessage").style.color = "#DC3545";
	document.getElementById('customermessage').innerHTML="Blocked Customer";
	cleardatacustomer();
	}
	else{
	document.getElementById('customermessage').innerHTML="This Customer Is Not In Your Database";
	document.getElementById('customermessage').style.color="#FFC107";
	cleardatacustomer();
	}
	},
	error:function(data){
	alert('Error Loading');
	}
	});
	}


	function cleardatacustomer(){
		document.getElementById('customer_id').value=null;
	document.getElementById('cname').value=null;
	document.getElementById('caddress').value=null;
	document.getElementById('cmobile').value=null;
	document.getElementById('clanline').value=null;
	}
	

	
// First Guarator


	// 	function myFunctionfirstguarantor() {
	// 		var c = document.getElementById("cnic").value;
	// 		var g1 = document.getElementById("g1nic").value;
	// 		if(c==g1){
	// 			alert("You can't Use Customer and First Guarantor");
	// 		}else{

	// 			$.ajax({
	// type: "GET",
	// url: '{{url(route('valid_nic'))}}',
	// data: {nic:$('#g1nic').val()},
	// headers: {
	// 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// },
	// success:function(data){
		 


	// if(data.status=="1"){
	// document.getElementById("g1message").style.color="#28A745";
	// document.getElementById('g1message').innerHTML="Valied Guarantor";
	// document.getElementById('first_guaranter_id').value=data.id;
	// document.getElementById('g1name').value=data.name;
	// document.getElementById('g1address').value=data.address;
	// document.getElementById('g1mobile').value=data.mobile;
	// document.getElementById('g1lanline').value=data.lanline;
	// }
	// else if(data=="0"){
	// document.getElementById("g1message").style.color = "#DC3545";
	// document.getElementById('g1message').innerHTML="Blocked Guarantor";
	// cleardataguranter();
	// }
	// else{
	// document.getElementById('g1message').innerHTML="This Guarantor Is Not In Your Database";
	// document.getElementById('g1message').style.color="#FFC107";
	// cleardataguranter();
	// }
	// },
	// error:function(data){
	// alert('Error Loading');
	// }
	// });

	// 		}
	
	// }


	// function cleardataguranter(){
	// 	document.getElementById('first_guaranter_id').value=null;
	// document.getElementById('g1name').value=null;
	// document.getElementById('g1address').value=null;
	// document.getElementById('g1mobile').value=null;
	// document.getElementById('g1lanline').value=null;
	// }



// second guarantor

// function myFunctionsecondguarantor() {
// 			var c = document.getElementById("cnic").value;
// 			var g1 = document.getElementById("g1nic").value;
// 			var g2 = document.getElementById("g2nic").value;
// 			if(c==g2){
// 				alert("You can't Use Customer and First Guarantor");
// 			}else if(g1==g2){
// 				alert("You can't Use Same Guarantors");
// 			}else{

// 				$.ajax({
// 	type: "GET",
// 	url: '{{url(route('valid_nic'))}}',
// 	data: {nic:$('#g2nic').val()},
// 	headers: {
// 	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 	},
// 	success:function(data){
		 


// 	if(data.status=="1"){
// 	document.getElementById("g2message").style.color="#28A745";
// 	document.getElementById('g2message').innerHTML="Valied Guarantor";
// 	document.getElementById('second_guaranter_id').value=data.id;
// 	document.getElementById('g2name').value=data.name;
// 	document.getElementById('g2address').value=data.address;
// 	document.getElementById('g2mobile').value=data.mobile;
// 	document.getElementById('g2lanline').value=data.lanline;
// 	}
// 	else if(data=="0"){
// 	document.getElementById("g2message").style.color = "#DC3545";
// 	document.getElementById('g2message').innerHTML="Blocked Guarantor";
// 	cleardatasecondguranter();
// 	}
// 	else{
// 	document.getElementById('g2message').innerHTML="This Guarantor Is Not In Your Database";
// 	document.getElementById('g2message').style.color="#FFC107";
// 	cleardatasecondguranter();
// 	}
// 	},
// 	error:function(data){
// 	alert('Error Loading');
// 	}
// 	});

// 			}
	
// 	}


// 	function cleardatasecondguranter(){
// 		document.getElementById('second_guaranter_id').value=null;
// 	document.getElementById('g2name').value=null;
// 	document.getElementById('g2address').value=null;
// 	document.getElementById('g2mobile').value=null;
// 	document.getElementById('g2lanline').value=null;
// 	}
	</script>




	@endsection