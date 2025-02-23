@include('user.header')

<!-- App Capsule -->
<div id="appCapsule">
    <div class="section full bg-primary">
        <!-- carousel single -->
        <div class="carousel-single splide p-2">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <!-- card block -->
                        <div class="card-block bg-transparent border border-info">
                            <div class="card-main">
                                <div class="balance"> <span class="label">SAVINGS</span>
                                    <h1 class="title">
                                        {{ number_format($savings_balance, 2) }} </h1>
                                </div>
                                <div class="in">
                                    <div class="card-number"> <span class="label">Account Number</span> •••• {{
                                        substr(Auth::user()->account_number, -4) }}
                                    </div>
                                    <div class="bottom">
                                        <div class="card-expiry">
                                            <span class="label">Total Credit <br> {{ $currentMonth }}</span>
                                            {{ Auth::user()->currency }} {{ number_format($totalSavingsCredit, 2) }}
                                        </div>
                                        <div class="card-ccv">
                                            <span class="label">Total Debit<br> {{ $currentMonth }}</span>
                                            {{ Auth::user()->currency }} {{ number_format($totalSavingsDebit, 2) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- * card block -->
                    </li>
                    <li class="splide__slide">
                        <!-- card block -->
                        <div class="card-block bg-transparent border border-light">
                            <div class="card-main">
                                <div class="balance"> <span class="label">CHECKINGS</span>
                                    <h1 class="title">
                                        {{ number_format($checking_balance, 2) }} </h1>
                                </div>
                                <div class="in">
                                    <div class="card-number"> <span class="label">Account Number</span> •••• {{
                                        substr(Auth::user()->account_number, -4) }}
                                    </div>
                                    <div class="bottom">
                                        <div class="card-expiry">
                                            <span class="label">Total Credit <br> {{ $currentMonth }}</span>
                                            {{ Auth::user()->currency }} {{ number_format($totalCheckingCredit, 2) }}
                                        </div>
                                        <div class="card-ccv">
                                            <span class="label">Total Debit<br> {{ $currentMonth }}</span>
                                            {{ Auth::user()->currency }} {{ number_format($totalCheckingDebit, 2) }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- * card block -->
                    </li>
                </ul>
            </div>
        </div>
        <!-- * carousel single -->
    </div>

    <div class="card">
        <div class="row">

            <div class="col-lg-8">
                <div class="section wallet-card-section mb-1">
                    <div class="wallet-card">
                        <h5 class="bg-primary p-2">
                            Loan </h5>
                        <hr>
                        <h5 class="modal-title text-primary">
                            First&nbsp;Loans
                        </h5>
                        <hr>
                        <div class="card">
                            <div class="card-header">
                                <p><span class="text-primary">Your home journey starts here.</span> Let
                                    Everguard Trust Bank be your partner
                                </p>
                                <p></p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img src="https://everguardtb.com/themes/finapp-light/images/happyhome.png"
                                            width="100%" />
                                    </div>
                                    <div class="col-lg-8">
                                        <h2 class="text-primary">Buying a home</h2>
                                        <p>Buying a home can be a truly rewarding experience. It's also one of the
                                            biggest investments you'll make.
                                        </p>
                                        <p>
                                            From finding your new place to getting the keys – we're here to help.</p>

                                        <h2 class="text-primary">Get more from your home</h2>
                                        <p>Use the equity you’ve built to pay for improvements, consolidate debt, pay
                                            for college and more</p>
                                        <a href="{{route('loan.history')}}">Click here to apply</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h2 class="text-primary">Refinancing your mortgage</h2>
                                        <p>Refinancing can help you lower your monthly payment, pay off your loan
                                            sooner, or tap into the equity you've already built into your home.
                                        </p>
                                        <p>
                                            Weigh the pros and cons to see if refinancing is right for you.</p>
                                        <a href="{{route('loan.history')}}">Click here to apply</a>
                                    </div>
                                    <div class="col-lg-4">
                                        <img src="https://everguardtb.com/themes/finapp-light/images/mortgage.png"
                                            width="100%" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="section wallet-card-section mb-1">
                    <div class="wallet-card" id="cards">
                        <h5 class="text-primary">
                            Everguard&nbsp;Cards
                        </h5>
                        <hr>

                        <div class="wrapper">
                            <div class="credit-card-wrap">
                                <div class="credit-card-inner">
                                    <img src="{{asset('uploads/logo.png')}}" class="pull-right sitelogo">
                                    <div class="mk-icon-sim"></div>
                                    <div class="credit-font credit-card-number" data-text="">4716 XXXX XXXX
                                        7554 </div>
                                    <br>
                                    <footer class="footer">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <div class="credit-card-date"><span class="title">VALID
                                                        THRU</span>
                                                    <span class="credit-font">
                                                        02/28 </span>
                                                </div>
                                                <div class="credit-font credit-author">
                                                    {{Auth::user()->name}} </div>
                                            </div>
                                            <div class="pull-right">
                                                <div class="mk-icon-visa"></div>
                                            </div>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wallet-card" id="tips">
                        <h5 class="text-primary">
                            Everguard&nbsp;Tips
                        </h5>
                        <hr>
                        <div class="transactions">
                            <!-- item -->
                            <a href="#support" class="item">
                                <div class="detail"> <span
                                        class="fas fa-piggy-bank image-block imaged w48 text-warning"></span>
                                    <div> <strong>Auto Save</strong>
                                        <p>Set a goal, save automatically with
                                            Everguard Trust Bank's Auto Save and track your progress.
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- * item -->
                            <!-- item -->
                            <a href="#support" class="item">
                                <div class="detail"> <span
                                        class="fas fa-wallet image-block imaged w48 text-success"></span>
                                    <div> <strong>Budget</strong>
                                        <p>Check in with your budget and stay on top of your spending</p>
                                    </div>
                                </div>
                            </a>
                            <!-- * item -->
                            <!-- item -->
                            <a href="#support" class="item">
                                <div class="detail"> <span class="fas fa-home image-block imaged w48 text-info"></span>
                                    <div> <strong>Home Option</strong>
                                        <p>Your home purchase, refinance and insights right under one roof.</p>
                                    </div>
                                </div>
                            </a>
                            <!-- * item -->
                            <!-- item -->
                            <a href="#support" class="item">
                                <div class="detail"> <span
                                        class="fa fa-info-circle text-danger image-block imaged w48"></span>
                                    <div> <strong>Security Tip</strong>
                                        <p class="text-black">We will NEVER ask you to provide your security
                                            details such as COT Code or any sensitive details of your account.
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- * item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('user.footer')