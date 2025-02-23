@include('admin.header')

<div class="main-panel bg-light">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{session('message')}}</div>
            @endif

            <div class="mt-2 mb-4">
                <h1 class="title1 text-dark">Payment Settings</h1>
            </div>
            <div>
            </div>
            <div>
            </div>
            <div class="mb-5 row">
                <div class="col-12">
                    <div class="card p-md-5 p-2 shadow-lg bg-light">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a href="#dep" class="nav-link active" data-toggle="tab">Payment Methods</a>
                            </li>
                            <li class="nav-item">
                                <a href="#with" class="nav-link" data-toggle="tab">Payment Preference</a>
                            </li>
                            <li class="nav-item">
                                <a href="#coin" class="nav-link" data-toggle="tab">Coinpayment</a>
                            </li>
                            <li class="nav-item">
                                <a href="#gate" class="nav-link" data-toggle="tab">Gateways</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="dep">
                                <div class="relative row" x-data="{ open: false }">
                                    <div class="col-md-12">
                                        <div>
                                            <h3 class="d-inline text-dark">Payment Methods</h3>
                                            <a href="#" data-toggle="modal" data-target="#adduser"
                                                class="float-right btn btn-primary btn-sm"> <i
                                                    class='fas fa-plus-circle'></i> Add New</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="adduser" tabindex="-1"
                                                aria-h6ledby="exampleModalh6" aria-hidden="true">
                                                <div
                                                    class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light">
                                                            <h3 class="mb-2 d-inline text-dark">Add New payment Method
                                                            </h3>
                                                            <button type="button" class="close text-dark"
                                                                data-dismiss="modal" aria-h6="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body bg-light">
                                                            <div>
                                                                <form method="POST" action=""
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field()}} <div class="form-row">
                                                                        <div class="form-group col-md-12">
                                                                            <h6 class="text-dark">Name</h6>
                                                                            <input type="text"
                                                                                class="form-control bg-light text-dark"
                                                                                name="name" id="name"
                                                                                placeholder="Payment method name"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <h6 class="text-dark">Minimum Amount</h6>
                                                                            <input type="number"
                                                                                class="form-control bg-light text-dark"
                                                                                name="min_amount" id="minamount"
                                                                                required>
                                                                            <small class="text-dark">Required but only
                                                                                applies to withdrawal</small>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <h6 class="text-dark">Maximum Amount</h6>
                                                                            <input type="number"
                                                                                class="form-control bg-light text-dark"
                                                                                name="max_amount" id="maxamount"
                                                                                required>
                                                                            <small class="text-dark">Required but only
                                                                                applies to withdrawal</small>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <h6 class="text-dark">Charges</h6>
                                                                            <input type="number"
                                                                                class="form-control bg-light text-dark"
                                                                                name="charges" id="charges" required>
                                                                            <small class="text-dark">Required but only
                                                                                applies to withdrawal</small>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <h6 class="text-dark">Charges Type</h6>
                                                                            <select name="charge_type"
                                                                                class="form-control bg-light text-dark">
                                                                                <option value="percentage">Percentage(%)
                                                                                </option>
                                                                                <option value="fixed">Fixed($)</option>
                                                                            </select>
                                                                            <small class="text-dark">Required but only
                                                                                applies to withdrawal</small>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <h6 class="text-dark">Type</h6>
                                                                            <select name="type" id="methodtype"
                                                                                class="form-control bg-light text-dark"
                                                                                required>
                                                                                <option value="currency">Currency
                                                                                </option>
                                                                                <option value="crypto">Crypto</option>
                                                                            </select>
                                                                        </div>

                                                                        <!-- <div class="form-group col-md-6">
                                            <h6 class="text-dark">Image url (Logo)</h6>
                                            <input type="text" class="form-control bg-light text-dark" name="url" id="url">
                                        </div>-->

                                                                        <div class="form-group col-md-6 currency">
                                                                            <h6 class="text-dark">Bank Name</h6>
                                                                            <input type="text"
                                                                                class="form-control bg-light text-dark currinput"
                                                                                name="bank_name" id="bank">
                                                                        </div>
                                                                        <div class="form-group col-md-6 currency">
                                                                            <h6 class="text-dark">Account Name</h6>
                                                                            <input type="text"
                                                                                class="form-control bg-light text-dark currinput"
                                                                                name="account_name" id="acnt_name">
                                                                        </div>
                                                                        <div class="form-group col-md-6 currency">
                                                                            <h6 class="text-dark">Account Number</h6>
                                                                            <input type="number"
                                                                                class="form-control bg-light text-dark currinput"
                                                                                name="account_number" id="acnt_number">
                                                                        </div>
                                                                        <div class="form-group col-md-6 currency">
                                                                            <h6 class="text-dark">Swift/Other Code</h6>
                                                                            <input type="text"
                                                                                class="form-control bg-light text-dark currinput"
                                                                                name="code" id="swift">
                                                                        </div>


                                                                        <div class="form-group col-md-6 d-none crypto">
                                                                            <h6 class="text-dark">Wallet Address</h6>
                                                                            <input type="text"
                                                                                class="form-control bg-light text-dark cryptoinput"
                                                                                name="wallet_address"
                                                                                id="walletaddress">
                                                                        </div>
                                                                        <div class="form-group col-md-6 d-none crypto">
                                                                            <h6 class="text-dark">Wallet Address
                                                                                Network Type</h6>
                                                                            <input type="text" placeholder="eg ERC"
                                                                                class="form-control bg-light text-dark cryptoinput"
                                                                                name="wallet_type" id="wallettype">
                                                                        </div>
                                                                        <div class="form-group col-md-6 d-none crypto">
                                                                            <h6 class="text-dark">Gateway Icon</h6>
                                                                            <input type="file" name="icon" id=""
                                                                                class="form-control bg-light text-dark cryptoinput">
                                                                            <small class="text-dark">Recommended Size:
                                                                                575px both width and height </small>

                                                                        </div>
                                                                        <div class="form-group col-md-6 d-none crypto">
                                                                            <h6 class="text-dark">Barcode Image
                                                                                (QR-CODE)</h6>
                                                                            <input type="file" name="bar_code" id=""
                                                                                class="form-control bg-light text-dark cryptoinput">
                                                                            <small class="text-dark">Recommended Size:
                                                                                575px both width and height </small>

                                                                        </div>

                                                                        <div class="form-group col-md-6">
                                                                            <h6 class="text-dark">Status</h6>
                                                                            <select name="status" id="status"
                                                                                class="form-control bg-light text-dark"
                                                                                required>
                                                                                <option value="enabled">Enable</option>
                                                                                <option value="disabled">Disable
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <h6 class="text-dark">Type for</h6>
                                                                            <select name="type_for" id="status"
                                                                                class="form-control bg-light text-dark"
                                                                                required>
                                                                                <option value="withdrawal">Withdrawal
                                                                                </option>
                                                                                <option value="deposit">Deposit</option>
                                                                                <option value="both">Both</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-12">
                                                                            <h6 class="text-dark">Optional Note</h6>
                                                                            <input type="text"
                                                                                class="form-control bg-light text-dark"
                                                                                name="note"
                                                                                placeholder="Payment may take up to 24 hours">
                                                                        </div>
                                                                        <div class="form-group col-md-12">
                                                                            <button type="submit"
                                                                                class="px-4 btn btn-primary">Save
                                                                                Method</button>
                                                                        </div>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 col-md-12 bg-light text-dark absolute">
                                        <div class=" table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Method Name</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Used for</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @foreach($payment as $payment)
                                                    <tr>
                                                        <th>{{$payment->name}}</th>
                                                        <td>{{$payment->type}}</td>
                                                        <td>{{$payment->type_for}}</td>
                                                        <td>
                                                            @if($payment->status === 'disabled')
                                                            <span class=" badge badge-danger">disabled</span>
                                                            @elseif($payment->status === 'enabled')
                                                            <span class=" badge badge-success">enabled</span>
                                                            @endif


                                                        </td>
                                                        <td>
                                                            <a href="{{route('edit.payment',$payment->id)}}"
                                                                class="m-1 btn btn-primary btn-sm" title="View">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            @if($payment->name === 'Ethereum')
                                                            <button class=" btn btn-danger btn-sm" disabled
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="you cannot delete default method">Delete</button>


                                                            @elseif($payment->name === 'Bitcoin')
                                                            <button class=" btn btn-danger btn-sm" disabled
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="you cannot delete default method">Delete</button>


                                                            @elseif($payment->name === 'Litecoin')
                                                            <button class=" btn btn-danger btn-sm" disabled
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="you cannot delete default method">Delete</button>

                                                            @else
                                                            <a href="{{route('delete.payment',$payment->id)}}"
                                                                class="m-1 btn btn-danger btn-sm">Delete</a>

                                                            @endif

                                                        </td>
                                                    </tr>
                                                    @endforeach --}}

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="absolute top-0 w-10 bg-light">

                                    </div>
                                </div>

                                <script>
                                    let methodtype = document.getElementById('methodtype');
    let currtype = document.querySelectorAll('.currency');
    let currinput = document.querySelectorAll('.currinput');
    let cryptotype = document.querySelectorAll('.crypto');
    let cryptoinput = document.querySelectorAll('.cryptoinput');
    
    currinput[0].setAttribute('required','');
    currinput[1].setAttribute('required','');
    currinput[2].setAttribute('required','');

    methodtype.addEventListener('change', sortfields);
    function sortfields() {
        if(methodtype.value == 'currency'){
            cryptotype.forEach(element => {
                element.classList.add('d-none');
            });
            currinput[0].setAttribute('required','');
            currinput[1].setAttribute('required','');
            currinput[2].setAttribute('required','');

            cryptoinput[0].removeAttribute('required','');
            cryptoinput[2].removeAttribute('required','');
            
            currtype.forEach(curr => {
                curr.classList.remove('d-none');
            });

        }else{
            cryptoinput[0].setAttribute('required','');
            cryptoinput[2].setAttribute('required','');

            currinput[0].removeAttribute('required','');
            currinput[1].removeAttribute('required','');
            currinput[2].removeAttribute('required','');

            cryptotype.forEach(element => {
                element.classList.remove('d-none');
            });

            currtype.forEach(curr => {
                curr.classList.add('d-none');
            });
        }
    }
                                </script>
                            </div>
                            <div class="tab-pane fade" id="with">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="javascript:void(0)" method="POST" id="paypreform">
                                            <input type="hidden" name="_token"
                                                value="vhWnzQofgzZnJJak3rZhWzGpW0aKJX7T7MJuTqHi"> <input type="hidden"
                                                name="_method" value="PUT">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <h5 class="text-dark"> Deposit option:</h5>
                                                    <select name="deposit_option"
                                                        class="form-control bg-light text-dark">
                                                        <option value="manual"> manual(Current)</option>
                                                        <option value="manual">Manual</option>
                                                        <option value="auto">Automatic</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <h5 class="text-dark"> Withdrawal option:</h5>
                                                    <select name="withdrawal_option"
                                                        class="form-control bg-light text-dark">
                                                        <option value="manual">manual(Current)</option>
                                                        <option value="manual">Manual</option>
                                                        <option value="auto">Automatic</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <h5 class="text-dark"> Minimum Deposit Amount:</h5>
                                                    <input class="form-control text-dark bg-light" type="text"
                                                        name="minamt" value="500" required>
                                                    <small class="text-dark">This amount indicates the minimum amount a
                                                        user can deposit</small>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <button type="submit" class="px-4 btn btn-primary">Save</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="coin">
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <form action="javascript:void(0)" method="POST" id="coinpayform">
                                            <input type="hidden" name="_token"
                                                value="vhWnzQofgzZnJJak3rZhWzGpW0aKJX7T7MJuTqHi"> <input type="hidden"
                                                name="_method" value="PUT">
                                            <div class="form-group">
                                                <h5 class="text-dark">Merchant ID</h5>
                                                <input class="form-control text-dark bg-light" placeholder="Merchant ID"
                                                    type="text" name="cp_m_id" value="Merchid ID" required>
                                            </div>

                                            <div class="form-group">
                                                <h5 class="text-dark">CoinPayment IPN Secret</h5>
                                                <input class="form-control text-dark bg-light"
                                                    placeholder="CoinPayment IPN Secret" type="text"
                                                    name="cp_ipn_secret" value="jnndjnhdjdj" required>
                                            </div>

                                            <div class="form-group">
                                                <h5 class="text-dark">CoinPayments debug email</h5>
                                                <input class="form-control text-dark bg-light"
                                                    placeholder="CoinPayments debug email" type="text"
                                                    name="cp_debug_email" value="super@happ.com" required>
                                            </div>
                                            <div class="form-group">
                                                <h5 class="text-dark">Public key</h5>
                                                <input class="form-control text-dark bg-light" placeholder="Public key"
                                                    type="text" name="cp_p_key" value="TYooMQauvdEDq54NiTphI7jx"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <h5 class="text-dark">Private key</h5>
                                                <input class="form-control text-dark bg-light" placeholder="Private key"
                                                    type="text" name="cp_pv_key" value="4eC39HqLyjWDarjtT1zdp7dc"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="px-5 btn btn-primary btn-lg" value="Save">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="gate">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="javascript:void(0)" method="POST" id="gatewayform">
                                            <input type="hidden" name="_token"
                                                value="vhWnzQofgzZnJJak3rZhWzGpW0aKJX7T7MJuTqHi"> <input type="hidden"
                                                name="_method" value="PUT">
                                            <h4 class="text-primary"> <i class="fa fab-stripe"></i> Stripe:</h4>
                                            <div class="form-group">
                                                <h5 class="text-dark">Stripe secret key</h5>
                                                <input type="text" name="s_s_k" class="form-control bg-light text-dark"
                                                    value="sk_test_51JP8qpSBWKZBQRLPWqHkFM8oqFEAqXLAaH3S8byZF73X0UycxijVyfebcyu6OVoZ8eeAelr3js3ADYIGU22Dk2Vo00kGkdE9xP">
                                            </div>
                                            <div class="form-group">
                                                <h5 class="text-dark">Stripe publishable key</h5>
                                                <input type="text" name="s_p_k" class="form-control bg-light text-dark"
                                                    value="pk_test_51JP8qpSBWKZBQRLPUIfQVYfUGly65fb1LiPUwAUajKy1nVM9Rvly3v3hQLvXnRqrWCrnUNz1qPQHNSxE689tSAoL00B1iOTNfd">
                                            </div>
                                            <hr>
                                            <h4 class="text-primary"><i class="fa fab-paypal"></i> Paypal:</h4>
                                            <div class="form-group">
                                                <h4 class="text-dark">Paypal client ID</h4>
                                                <input type="text" name="pp_ci" class="form-control bg-light text-dark"
                                                    value="iidjdjdj">
                                            </div>
                                            <div class="form-group">
                                                <h4 class="text-dark">Paypal client secret</h4>
                                                <input type="text" name="pp_cs" class="form-control bg-light text-dark"
                                                    value="jijdjkdkdk">
                                            </div>
                                            <hr>
                                            <h4 class="text-primary"><i class="fa fab-paypal"></i> Paystack:</h4>
                                            <div class="form-group">
                                                <h4 class="text-dark">Paystack Public Key</h4>
                                                <input type="text" name="paystack_public_key"
                                                    class="form-control bg-light text-dark" value="">
                                            </div>
                                            <div class="form-group">
                                                <h4 class="text-dark">Paystack Secret Key</h4>
                                                <input type="text" name="paystack_secret_key"
                                                    class="form-control bg-light text-dark" value="">
                                            </div>
                                            <div class="form-group">
                                                <h4 class="text-dark">Paystack URL</h4>
                                                <input type="text" name="paystack_url"
                                                    class="form-control bg-light text-dark"
                                                    value="https://api.paystack.co" readonly>
                                            </div>
                                            <div class="form-group">
                                                <h4 class="text-dark">Paystack Email</h4>
                                                <input type="text" name="paystack_email"
                                                    class="form-control bg-light text-dark"
                                                    value="victrinhoj@gmail.com">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <button type="submit" class="px-4 btn btn-primary">Save
                                                    Settings</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Submit payment option/ preference form
	$('#paypreform').on('submit', function() {
		//alert('love');
		$.ajax({
			url: "https://lockestocks.com/account/admin/dashboard/paypreference",
			type: 'POST',
			data: $('#paypreform').serialize(),
			success: function(response) {
				if (response.status === 200) {
					$.notify({
						// options
						icon: 'flaticon-alarm-1',
						title: 'Success',
						message: response.success,
					},{
						// settings
						type: 'success',
						allow_dismiss: true,
						newest_on_top: false,
						placement: {
							from: "top",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 1031,
						delay: 5000,
						timer: 1000,
						animate: {
							enter: 'animated fadeInDown',
							exit: 'animated fadeOutUp'
						},
	
					});
				} else {
					
				}
			},
			error: function(error) {
				console.log(error);
			},
		});
	});




	// Submit coinpayment form
	$('#coinpayform').on('submit', function() {
		//alert('love');
		$.ajax({
			url: "https://lockestocks.com/account/admin/dashboard/updatecpd",
			type: 'POST',
			data: $('#coinpayform').serialize(),
			success: function(response) {
				if (response.status === 200) {
					$.notify({
						// options
						icon: 'flaticon-alarm-1',
						title: 'Success',
						message: response.success,
					},{
						// settings
						type: 'success',
						allow_dismiss: true,
						newest_on_top: false,
						placement: {
							from: "top",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 1031,
						delay: 5000,
						timer: 1000,
						animate: {
							enter: 'animated fadeInDown',
							exit: 'animated fadeOutUp'
						},
	
					});
				} else {
					
				}
			},
			error: function(error) {
				console.log(error);
			},
		});
	});



	// Submit Gatway form
	$('#gatewayform').on('submit', function() {
		//alert('love');
		$.ajax({
			url: "https://lockestocks.com/account/admin/dashboard/updategateway",
			type: 'POST',
			data: $('#gatewayform').serialize(),
			success: function(response) {
				if (response.status === 200) {
					$.notify({
						// options
						icon: 'flaticon-alarm-1',
						title: 'Success',
						message: response.success,
					},{
						// settings
						type: 'success',
						allow_dismiss: true,
						newest_on_top: false,
						placement: {
							from: "top",
							align: "right"
						},
						offset: 20,
						spacing: 10,
						z_index: 1031,
						delay: 5000,
						timer: 1000,
						animate: {
							enter: 'animated fadeInDown',
							exit: 'animated fadeOutUp'
						},
	
					});
				} else {
					
				}
			},
			error: function(error) {
				console.log(error);
			},
		});
	});
    </script>
    @include('admin.footer')