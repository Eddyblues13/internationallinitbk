@include('user.header')

<div id="appCapsule" class="appCap">
    <div class="container mb-3 mt-2">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">Support</div>
            <div class="card-body">
                <div class="contact-form">
                    <form method="post" action="{{ route('user.support.store') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <select name="dept" class="form-control" required>
                                <option value="">Select Department</option>
                                <option value="Change Password">Change Password</option>
                                <option value="Complaints">Complaints</option>
                                <option value="Get card">Get Card</option>
                                <option value="Update Profile">Update Profile</option>
                                <option value="Card Protect">Card Protect</option>
                                <option value="Card Replacement">Card Replacement</option>
                                <option value="Dispense Error">Dispense Error</option>
                                <option value="PIN Retrieval">PIN Retrieval</option>
                                <option value="Loans">Loans</option>
                                <option value="Investment">Investments</option>
                                <option value="Account Information">Account Information</option>
                                <option value="Transfer">Money Transfer</option>
                                <option value="Auto Save">Auto Save</option>
                                <option value="Budget">Budget</option>
                                <option value="Credit Journey">Credit Journey</option>
                                <option value="Home Options">Home Options</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="subject" placeholder="Subject"
                                value="{{ old('subject') }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <textarea class="form-control" name="message" cols="30" rows="5" placeholder="Message"
                                required>{{ old('message') }}</textarea>
                        </div>

                        <input type="submit" value="Submit" class="btn btn-secondary w-100">
                    </form>
                </div>
            </div>
        </div>

        <!-- Support History -->
        <div class="card">
            <div class="card-header bg-primary text-white">Support History</div>
            <div class="card-body">
                <table class="table table-striped table-bordered dt-responsive nowrap" id="SupportTable" width="100%">
                    <thead>
                        <tr class="table-primary">
                            <th>Date</th>
                            <th>Details</th>
                            <th>Reference</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supportRequests as $support)
                        <tr>
                            <td>{{ $support->created_at->format('Y-m-d') }}</td>
                            <td>{{ $support->subject }}</td>
                            <td>{{ $support->reference }}</td>
                            <td>
                                <span class="badge {{ $support->status == 'Pending' ? 'bg-warning' : 'bg-success' }}">
                                    {{ $support->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('user.footer')

<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    $(document).ready(function () {
        $('#SupportTable').DataTable();
    });
</script>