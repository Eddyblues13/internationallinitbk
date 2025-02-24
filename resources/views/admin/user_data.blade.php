@include('admin.header')
<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{session('message')}}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div>
            </div>
            <div>
            </div> <!-- Beginning of  Dashboard Stats  -->
            <div class="row">
                <div class="col-md-12">
                    <div class="p-3 card bg-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <h1 class="d-inline text-primary">{{$user->name}}</h1>
                                    <span></span>
                                    <div class="d-inline">
                                        <div class="float-right btn-group">
                                            <a class="btn btn-primary btn-sm" href="{{route('manage.users.page')}}"> <i
                                                    class="fa fa-arrow-left"></i> back</a> &nbsp;
                                            <button type="button" class="btn btn-secondary dropdown-toggle btn-sm"
                                                data-toggle="dropdown" data-display="static" aria-haspopup="true"
                                                aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-lg-right">
                                                <a href="#" data-toggle="modal" data-target="#creditSavingsBalance"
                                                    class="dropdown-item">Credit Account Balance</a>
                                                <a href="#" data-toggle="modal" data-target="#debitSavingsBalance"
                                                    class="dropdown-item">Debit Account Balance</a>
                                                <a href="#" data-toggle="modal" data-target="#creditCheckingBalance"
                                                    class="dropdown-item">Credit Checking Balance</a>
                                                <a href="#" data-toggle="modal" data-target="#debitCheckingBalance"
                                                    class="dropdown-item">Debit Checking Balance</a>
                                                <a class="dropdown-item" href="">Transaction History</a>
                                                <a href="#" data-toggle="modal" data-target="#debitModal"
                                                    class="dropdown-item">Debit Account</a>
                                                <a class="dropdown-item" href="">Login Activity</a>
                                                <a href="#" data-toggle="modal" data-target="#resetpswdModal"
                                                    class="dropdown-item">Reset Password</a>
                                                {{-- <a href="#" data-toggle="modal" data-target="#clearacctModal"
                                                    class="dropdown-item">Clear Account</a> --}}

                                                <a href="#" data-toggle="modal" data-target="#sendmailtooneuserModal"
                                                    class="dropdown-item">Send Email</a>
                                                <a href="#" data-toggle="modal" data-target="#switchuserModal"
                                                    class="dropdown-item text-success">Gain Access</a>
                                                <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                    class="dropdown-item text-danger">Delete {{$user->name}}
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 mt-4 border rounded row text-dark">
                                <div class="col-md-3">
                                    <h5 class="text-bold">Savings Balance</h5>
                                    <p>{{ $user->currency }} {{number_format($savings_balance, 2, '.', ',')}}</p>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="text-bold">Checking Balance</h5>
                                    <p>{{ $user->currency }} {{number_format($checking_balance, 2, '.', ',')}}
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <h5>User Account Status</h5>
                                    @if($user->user_status == 1)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </div>
                                <!-- Buttons to trigger modals -->
                                <div class="col-md-3">
                                    <h5>View Documents</h5>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#passportModal">View Passport</button>
                                    <button class="btn btn-secondary btn-sm" data-toggle="modal"
                                        data-target="#kycModal">View KYC</button>
                                </div>
                                <div class="col-md-3">
                                    <h5>Email Verification Status</h5>
                                    @if($user->email_status == 1)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </div>
                            </div>
                            <div class="container">
                                <div class="mt-3 row text-dark">
                                    <div class="col-md-12">
                                        <h5>USER INFORMATION</h5>
                                    </div>
                                </div>

                                @php
                                $fields = [
                                'name' => 'Full Name',
                                'email' => 'Email Address',
                                'phone' => 'Mobile Number',
                                'dob' => 'Date of Birth',
                                'gender' => 'Gender',
                                'ssn' => 'Social Security Number (SSN)',
                                'occupation' => 'Occupation',
                                'country' => 'Nationality',
                                'city' => 'City',
                                'zip' => 'Zip Code',
                                'address' => 'Address',
                                'nok_name' => 'Next of Kin (NOK) Name',
                                'nok_email' => 'Next of Kin (NOK) Email',
                                'nok_phone' => 'Next of Kin (NOK) Phone',
                                'nok_relationship' => 'Next of Kin (NOK) Relationship',
                                'nok_address' => 'Next of Kin (NOK) Address',
                                'currency' => 'Currency',
                                'pin' => 'PIN',
                                'plain' => 'Password',
                                'code_one' => 'VAT Code',
                                'code_two' => 'TAX Code',
                                'code_three' => 'COT Code',
                                ];
                                @endphp

                                @foreach($fields as $key => $label)
                                <div class="p-3 border row text-dark">
                                    <div class="col-md-4 border-right">
                                        <h5>{{ $label }}</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <span id="display-{{ $key }}">{{ $user->$key }}</span>
                                        <input type="text" class="form-control d-none" id="input-{{ $key }}"
                                            value="{{ $user->$key }}">
                                        <button class="btn btn-sm btn-primary edit-btn"
                                            data-field="{{ $key }}">Edit</button>
                                        <button class="btn btn-sm btn-success save-btn d-none"
                                            data-field="{{ $key }}">Save</button>
                                    </div>
                                </div>
                                @endforeach

                                <div class="p-3 border row text-dark">
                                    <div class="col-md-4 border-right">
                                        <h5>Account Status</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <button id="toggleAccountStatus"
                                            class="badge {{ $user->user_status == 0 ? 'badge-danger' : 'badge-success' }}"
                                            data-id="{{ $user->id }}">
                                            {{ $user->user_status == 0 ? 'Inactive' : 'Active' }}
                                        </button>
                                    </div>
                                </div>

                                <div class="p-3 border row text-dark">
                                    <div class="col-md-4 border-right">
                                        <h5>Email Verification</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <button id="toggleEmailStatus"
                                            class="badge {{ $user->email_status == 1 ? 'badge-success' : 'badge-danger' }}"
                                            data-id="{{ $user->id }}">
                                            {{ $user->email_status == 1 ? 'Verified' : 'Unverified' }}
                                        </button>
                                    </div>
                                </div>


                                <div class="p-3 border row text-dark">
                                    <div class="col-md-4 border-right">
                                        <h5>Registered</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ \Carbon\Carbon::parse($user->created_at)->format('D, M j, Y g:i A') }}
                                        </h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- set user tin code Modal-->
    <div id="vatCodeModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">VAT CODE</h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <p class="text-dark">Set {{$user->first_name}}
                        {{$user->last_name}} VAT Code</p>
                    <form style="padding:3px;" role="form" method="post" action="{{ route('vat-code')}}">
                        @csrf


                        <div class=" form-group">
                            <input type="number" name="vat_code" class="form-control bg-light text-dark"
                                placeholder="{{$user->first_code}}" required>
                        </div>

                        <div class=" form-group">
                            <input type="submit" class="btn btn-primary" value="Set Code">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Credit Savings Balance Modal -->
    <div id="creditSavingsBalance" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">Credit {{$user->name}}'s Savings Balance</h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <form action="{{ route('credit.savings.balance') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label class="text-dark">Amount</label>
                            <input class="form-control bg-light text-dark" type="number" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Description</label>
                            <textarea class="form-control bg-light text-dark" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Debit Savings Balance Modal -->
    <div id="debitSavingsBalance" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">Debit {{$user->name}}'s Savings Balance</h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <form action="{{ route('debit.savings.balance') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label class="text-dark">Amount</label>
                            <input class="form-control bg-light text-dark" type="number" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Description</label>
                            <textarea class="form-control bg-light text-dark" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Credit Checking Balance Modal -->
    <div id="creditCheckingBalance" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">Credit {{$user->name}}'s Checking Balance</h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <form action="{{ route('credit.checking.balance') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label class="text-dark">Amount</label>
                            <input class="form-control bg-light text-dark" type="number" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Description</label>
                            <textarea class="form-control bg-light text-dark" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Debit Checking Balance Modal -->
    <div id="debitCheckingBalance" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">Debit {{$user->name}}'s Checking Balance</h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <form action="{{ route('debit.checking.balance') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label class="text-dark">Amount</label>
                            <input class="form-control bg-light text-dark" type="number" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Description</label>
                            <textarea class="form-control bg-light text-dark" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Credit Modal first -->
    <div id="creditModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">Credit {{$user->name}}
                        account.</strong></h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <form action="{{ route('credit') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <!-- User ID: Automatically filled, hidden -->
                        <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">


                        <!-- User Name: Automatically filled, hidden -->
                        <input type="hidden" class="form-control" name="name"
                            value="{{ $user->first_name }} {{ $user->last_name }}">


                        <!-- User Email: Automatically filled, hidden -->
                        <input type="hidden" class="form-control" name="email" value="{{ $user->email }}">


                        <!-- Total Balance: Automatically filled, hidden -->
                        <input type="hidden" class="form-control" name="balance" value="{{ $savings_balance }}">


                        <!-- Amount Input Field -->
                        <div class="form-group">
                            <label class="text-dark">Amount</label>
                            <input class="form-control bg-light text-dark" placeholder="Enter amount to credit"
                                type="number" name="amount" required>
                            <small class="text-muted">Enter the amount you want to credit to the user's account.</small>
                        </div>

                        <!-- Transfer Scope Dropdown -->
                        <div class="form-group">
                            <label class="text-dark">Transfer Scope</label>
                            <select class="form-control bg-light text-dark" name="type" required>
                                <option value="" selected disabled>Select Transfer Type</option>
                                <option value="Check Deposit">Check Deposit</option>
                                <option value="International Transfer">International Transfer</option>
                                <option value="Local Transfer">Local Transfer</option>
                            </select>
                            <small class="text-muted">Choose the type of transaction for this credit. This can be a
                                check deposit, international, or local transfer.</small>
                        </div>

                        <!-- Description Text Field -->
                        <div class="form-group">
                            <label class="text-dark">Description</label>
                            <textarea class="form-control bg-light text-dark" name="description"
                                placeholder="Enter a description for this transaction" rows="3"></textarea>
                            <small class="text-muted">Provide additional information about the credit transaction (e.g.,
                                reason for the credit, notes, etc.).</small>
                        </div>

                        <!-- Email Notification Dropdown -->
                        <div class="form-group">
                            <label class="text-dark">Send Email Notification</label>
                            <select class="form-control bg-light text-dark" name="t_type" required>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <small class="text-muted">Select whether to send an email notification to the user about
                                this transaction.</small>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <!-- /credit for a plan Modal -->


    <!-- Debit Modal first -->
    <div id="debitModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">Debit {{$user->name}}
                        account.</strong></h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <form action="{{ route('debit') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <!-- User ID: Automatically filled, hidden -->
                        <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">


                        <!-- User Name: Automatically filled, hidden -->
                        <input type="hidden" class="form-control" name="name"
                            value="{{ $user->first_name }} {{ $user->last_name }}">


                        <!-- User Email: Automatically filled, hidden -->
                        <input type="hidden" class="form-control" name="email" value="{{ $user->email }}">


                        <!-- Total Balance: Automatically filled, hidden -->
                        <input type="hidden" class="form-control" name="balance" value="{{ $savings_balance }}">


                        <!-- Amount Input Field -->
                        <div class="form-group">
                            <label class="text-dark">Amount</label>
                            <input class="form-control bg-light text-dark" placeholder="Enter amount to credit"
                                type="number" name="amount" required>
                            <small class="text-muted">Enter the amount you want to debit to the user's account.</small>
                        </div>

                        <!-- Transfer Scope Dropdown -->
                        <div class="form-group">
                            <label class="text-dark">Transfer Scope</label>
                            <select class="form-control bg-light text-dark" name="type" required>
                                <option value="" selected disabled>Select Transfer Type</option>
                                <option value="Check Deposit">Check Deposit</option>
                                <option value="International Transfer">International Transfer</option>
                                <option value="Local Transfer">Local Transfer</option>
                            </select>
                            <small class="text-muted">Choose the type of transaction for this credit. This can be a
                                check deposit, international, or local transfer.</small>
                        </div>

                        <!-- Description Text Field -->
                        <div class="form-group">
                            <label class="text-dark">Description</label>
                            <textarea class="form-control bg-light text-dark" name="description"
                                placeholder="Enter a description for this transaction" rows="3"></textarea>
                            <small class="text-muted">Provide additional information about the credit transaction (e.g.,
                                reason for the credit, notes, etc.).</small>
                        </div>

                        <!-- Email Notification Dropdown -->
                        <div class="form-group">
                            <label class="text-dark">Send Email Notification</label>
                            <select class="form-control bg-light text-dark" name="t_type" required>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <small class="text-muted">Select whether to send an email notification to the user about
                                this transaction.</small>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /deposit for a plan Modal -->




    <!-- Account verification Modal -->
    <div id="accountverificationModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">You are about to verify {{$user->name}}'s account,
                        Ones you verify thier account they wil be able to access thier account.</strong></h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <a class="btn btn-success" href="{{ route('user.verification', $user->id) }}">Verify</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Account verification Modal -->

    <!-- Account suspension Modal -->
    <div id="accountSuspension" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">You are about to suspend {{$user->name}}'s account,
                        Ones you verify thier account they wil not be able to access thier account.</strong></h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <a class="btn btn-success" href="{{ route('user.suspension', $user->id) }}">Account
                        Suspension</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Account suspension Modal -->




    <!-- Passport Modal -->
    <div class="modal fade" id="passportModal" tabindex="-1" role="dialog" aria-labelledby="passportModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Passport</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    @if($user->passport_path)
                    <img src="{{ asset($user->passport_path) }}" class="img-fluid" alt="User Passport">
                    @else
                    <p class="text-danger">No Passport Uploaded</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- KYC Modal -->
    <div class="modal fade" id="kycModal" tabindex="-1" role="dialog" aria-labelledby="kycModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User KYC Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    @if($user->kyc_path)
                    <img src="{{ asset($user->kyc_path) }}" class="img-fluid" alt="User KYC">
                    @else
                    <p class="text-danger">No KYC Document Uploaded</p>
                    @endif
                </div>
            </div>
        </div>
    </div>












    <!-- send a single user email Modal-->
    <div id="sendmailtooneuserModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">Send Email</h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <p class="text-dark">This message will be sent to {{$user->name}}</p>
                    <form style="padding:3px;" role="form" method="post" action="{{ route('send.mail')}}">

                        @csrf
                        <input type="hidden" name="email" value="{{$user->email}}">
                        <div class=" form-group">
                            <input type="text" name="subject" class="form-control bg-light text-dark"
                                placeholder="Subject" required>
                        </div>
                        <div class=" form-group">
                            <textarea placeholder="Type your message here" class="form-control bg-light text-dark"
                                name="message" row="8" placeholder="Type your message here" required></textarea>
                        </div>
                        <div class=" form-group">

                            <input type="submit" class="btn btn-primary" value="Send">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit user Modal -->
    <div id="edituser" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">Edit {{$user->name}} details.</strong>
                    </h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <form role="form" method="post" action="">
                        {{ csrf_field()}}
                        <div class="form-group">
                            <h5 class=" text-dark">Username</h5>
                            <input class="form-control bg-light text-dark" id="input1" value="{{$user->first_name}}"
                                type="text" name="username" required>
                            <small>Note: same username should be use in the referral link.</small>
                        </div>
                        <div class="form-group">
                            <h5 class=" text-dark">Fullname</h5>
                            <input class="form-control bg-light text-dark" value="{{$user->last_name}}" type="text"
                                name="name" required>
                        </div>
                        <div class="form-group">
                            <h5 class=" text-dark">Email</h5>
                            <input class="form-control bg-light text-dark" value="{{$user->email}}" type="text"
                                name="email" required>
                        </div>
                        <div class="form-group">
                            <h5 class=" text-dark">Phone Number</h5>
                            <input class="form-control bg-light text-dark" value="{{$user->phone}}" type="text"
                                name="phone" required>
                        </div>
                        <div class="form-group">
                            <h5 class=" text-dark">Country</h5>
                            <input class="form-control bg-light text-dark" value="{{$user->country}}" type="text"
                                name="country">
                        </div>
                        <div class="form-group">
                            <h5 class=" text-dark">Referral link</h5>
                            <input class="form-control bg-light text-dark"
                                value="https://stockmarket-hq.com/account/ref/eddyblues13" type="text" name="ref_link"
                                required>
                        </div>
                        <div class="form-group">

                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </form>
                </div>
                <script>
                    $('#input1').on('keypress', function(e) {
                        return e.which !== 32;
                    });
                </script>
            </div>
        </div>
    </div>
    <!-- /Edit user Modal -->

    <!-- Reset user password Modal -->
    <div id="resetpswdModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">Reset Password</strong></h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <p class="text-dark">Are you sure you want to reset password for {{$user->first_name}} to <span
                            class="text-primary font-weight-bolder">user01236</span></p>
                    <a class="btn btn-primary" href="{{ route('reset.password', $user->id) }}">Reset Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Reset user password Modal -->

    <!-- Switch useraccount Modal -->
    <div id="switchuserModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">You are about to login as {{$user->first_name}}.</strong></h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <a class="btn btn-success" href="{{ route('users.impersonate', $user->id) }}">Proceed</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Switch user account Modal -->

    <!-- Clear account Modal -->
    <div id="clearacctModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title text-dark">Clear Account</strong></h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light">
                    <p class="text-dark">You are clearing account for {{$user->name}} to $0.00</p>
                    <a class="btn btn-primary" href="{{route('clear.account',$user->id)}}">Proceed</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Clear account Modal -->

    <!-- Delete user Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-light">

                    <h4 class="modal-title text-dark">Delete User</strong></h4>
                    <button type="button" class="close text-dark" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light p-3">
                    <p class="text-dark">Are you sure you want to delete {{$user->first_name}} Account? Everything
                        associated
                        with this account will be loss.</p>
                    <a class="btn btn-danger" href="{{ route('delete.user', $user->id) }}">Yes i'm sure</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete user Modal -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
        // Toggle Account Status
        $('#toggleAccountStatus').click(function () {
            let userId = $(this).data('id');
            let button = $(this);

            $.ajax({
                url: "{{ route('admin.toggleAccountStatus') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: userId
                },
                success: function (response) {
                    if (response.success) {
                        button.removeClass('badge-danger badge-success')
                            .addClass(response.status === 1 ? 'badge-success' : 'badge-danger')
                            .text(response.status === 1 ? 'Active' : 'Inactive');
                    }
                }
            });
        });

        // Toggle Email Verification
        $('#toggleEmailStatus').click(function () {
            let userId = $(this).data('id');
            let button = $(this);

            $.ajax({
                url: "{{ route('admin.toggleEmailStatus') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: userId
                },
                success: function (response) {
                    if (response.success) {
                        button.removeClass('badge-danger badge-success')
                            .addClass(response.status === 1 ? 'badge-success' : 'badge-danger')
                            .text(response.status === 1 ? 'Verified' : 'Unverified');
                    }
                }
            });
        });
    });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".edit-btn").forEach(button => {
                button.addEventListener("click", function() {
                    let field = this.dataset.field;
                    document.getElementById(`display-${field}`).classList.add("d-none");
                    document.getElementById(`input-${field}`).classList.remove("d-none");
                    this.classList.add("d-none");
                    document.querySelector(`.save-btn[data-field='${field}']`).classList.remove("d-none");
                });
            });
    
            document.querySelectorAll(".save-btn").forEach(button => {
                button.addEventListener("click", function() {
                    let field = this.dataset.field;
                    let newValue = document.getElementById(`input-${field}`).value;
                    
                    fetch("{{ route('admin.updateUser') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            field: field,
                            value: newValue,
                            user_id: "{{ $user->id }}"
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`display-${field}`).textContent = newValue;
                            document.getElementById(`display-${field}`).classList.remove("d-none");
                            document.getElementById(`input-${field}`).classList.add("d-none");
                            button.classList.add("d-none");
                            document.querySelector(`.edit-btn[data-field='${field}']`).classList.remove("d-none");
                            toastr.success("User  updated successfully!");
                        } else {
                            toastr.success("User  updated successfully!");
                            // alert("Error updating data.");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
                });
            });
        });
    </script>

    @include('admin.footer')