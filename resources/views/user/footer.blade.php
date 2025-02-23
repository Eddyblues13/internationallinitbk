@if(session('success'))
<script>
    toastr.success("{{ session('success') }}");
</script>
@endif

@if(session('error'))
<script>
    toastr.error("{{ session('error') }}");
</script>
@endif
<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="{{route('profile')}}" class="item active">
        <div class="col">
            <i class="fas fa-cog fa-2x"></i>
            <strong>Settings</strong>
        </div>
    </a>
    <a href="{{route('notifications.index')}}" class="item active">
        <div class="col">
            <i class="far fa-envelope fa-2x"></i>
            <strong>Notifications</strong>
        </div>
    </a>
    <a href="{{route('home')}}" class="item active">
        <div class="col">
            <i class="fas fa-house-user fa-2x"></i>
            <strong>Home</strong>
        </div>
    </a>
    <a href="{{route('user.support')}}" class="item active">
        <div class="col">
            <i class="far fa-comment-dots fa-2x"></i>
            <strong>Support</strong>
        </div>
    </a>



    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a href="#" onclick="document.getElementById('logout-form').submit();" class="item active">
        <div class="col">
            <i class="fas fa-sign-out-alt fa-2x"></i>
            <strong>Logout</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->
</div>
<!-- Pay Bills -->
<div class="modal fade action-sheet" id="payBills" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">
                    First&nbsp;Pay Bills</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="card">
                        <div class="transactions">
                            <!-- item -->
                            <a href="user/alert" class="item">
                                <div class="detail"> <span class="fas fa-helicopter image-block imaged w48"></span>
                                    <div> <strong>Plane Tickets</strong>
                                        <p>Buy Flight tickets from your Everguard Trust Bank's Account.</p>
                                    </div>
                                </div>
                            </a>
                            <!-- * item -->
                            <!-- item -->
                            <a href="user/alert" class="item">
                                <div class="detail"> <span class="fas fa-hotel image-block imaged w48"></span>
                                    <div> <strong>Hotel Booking</strong>
                                        <p>Book your favourite Hotel</p>
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
<!-- * Pay Bills  -->


<!--- ************ ALERT*****************--->
<!--- ************ALERT*****************--->


<!--- ************ PROFILE*****************--->
<div class="modal fade dialogbox" id="ProfileModal" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title">
                    {{Auth::user()->name}} </h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content text-center">
                    <a href="{{route('profile')}}" class="btn btn-primary btn-block">My profile</a>
                    <div class="row mt-2">
                        <div class="col-6">
                            <button type="button" class="btn btn-info btn-block" data-bs-dismiss="modal"><i
                                    class="fas fa-times"></i>
                                &nbsp;Close</button>
                        </div>
                        <div class="col-6">

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="btn btn-danger btn-block">
                                <i class="fas fa-sign-out-alt"></i> &nbsp;Sign Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-inline">
                    <a href="#" class="btn" data-bs-dismiss="modal">CLOSE</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--- ************PROFILE*****************--->



<!--- ************ Code ALERT*****************--->
<!--- ************COT ALERT*****************--->



<!--- ************DEPOSIT ALERT*****************--->
<!--- ************DEPOSIT ALERT*****************--->

<!-- * Android Add to Home Action Sheet -->
<div id="cookiesbox" class="offcanvas offcanvas-bottom cookies-box" tabindex="-1" data-bs-scroll="true"
    data-bs-backdrop="false">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">We use cookies</h5>
    </div>
    <div class="offcanvas-body">
        <div>
            Everguard Trust Bank uses cookies to provide necessary website functionality, improve your experience and
            analyze our traffic. By using our website, you agree to our Privacy Policy and our Cookies Policy.
        </div>
        <div class="buttons">
            <a href="#" class="btn btn-primary btn-block" data-bs-dismiss="offcanvas">I understand</a>
        </div>
    </div>
</div>

<!-- * App Bottom Menu -->
<!-- Logout -->
<div class="modal fade dialogbox" id="logout" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="pt-3 text-center">
                <img src="uploads/1738445913_f45f5257f3ed5793bdc7.jpeg" alt="image" class="imaged"
                    style="width:50px;height:50px;border-radius:50%">
            </div>
            <div class="modal-header pt-2">
                <h5 class="modal-title">You are about to logout</h5>
            </div>
            <div class="modal-body">
                Are you sure about this?
            </div>
            <div class="modal-footer">
                <div class="btn-inline">
                    <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>

                    <a href="#" class="btn btn-text-primary"
                        onclick="document.getElementById('logout-form').submit();">Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>


                </div>
            </div>
        </div>
    </div>
    <!-- * Logout-->
    <!-- ========= JS Files =========  -->
    <script language="javascript">
        populateCountries("country", "state");
            populateCountries("country2");
            populateCountries("country2");
    </script>
    <!-- Bootstrap -->
    <script src="{{asset('themes/finapp-light/css/src/bootstrap/bootstrap.min.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('themes/finapp-light/js/lib/bootstrap.bundle.min.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('themes/finapp-light/js/plugins/splide/splide.min.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('themes/finapp-light/js/main.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/finapp-light/js/plugins/datatable/datatables.min.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('themes/finapp-light/js/fontawesome.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/finapp-light/js/all.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/finapp-light/js/html2canvas.js')}}" type=" text/javascript "></script>
    <!-- ========= JS Files =========  -->

    <!-- ========= Custom JS Files =========  -->
    <script>
        function copyRef() {
    document.getElementById(" copy_ref ").innerHTML = 'Copied!';
    new ClipboardJS('.clip');
  }
    </script>
    <!-- ========= Custom JS Files =========  -->

    </body>

    </html>