@include('user.header')

<!-- * App Header -->
<div id="appCapsule" class="appCap">
    <div class="container mb-3 mt-2">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">Loan</div>
            <div class="card-body">
                <div class="contact-form">
                    <form method="post" action="{{ route('loan.apply') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <input type="text" name="occupation" class="form-control" placeholder="Occupation"
                                value="{{ old('occupation') }}" required>
                            @error('occupation')
                            <script>
                                toastr.error("{{ $message }}");
                            </script>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <input class="form-control" type="number" name="amount" placeholder="Amount Needed"
                                value="{{ old('amount') }}" required>
                            @error('amount')
                            <script>
                                toastr.error("{{ $message }}");
                            </script>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <textarea class="form-control" name="message" cols="30" rows="5" placeholder="Purpose"
                                required>{{ old('message') }}</textarea>
                            @error('message')
                            <script>
                                toastr.error("{{ $message }}");
                            </script>
                            @enderror
                        </div>

                        <input type="submit" name="apply" value="Apply" class="btn btn-primary w-100">
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">Loan History</div>
            <div class="card-body">
                <table class="table table-striped table-bordered dt-responsive nowrap table-condensed" id="Loan"
                    width="100%">
                    <thead>
                        <tr class="table-primary">
                            <th>Date</th>
                            <th>Details</th>
                            <th>Reference</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                        <tr>
                            <td>{{ $loan->created_at->format('d M Y') }}</td>
                            <td>{{ $loan->message }}</td>
                            <td>{{ $loan->reference }}</td>
                            <td>
                                @if($loan->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                                @elseif($loan->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                                @else
                                <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>

@include('user.footer')