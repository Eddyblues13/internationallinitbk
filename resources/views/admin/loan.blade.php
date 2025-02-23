@include('admin.header')
<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{session('message')}}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-dark">EGTB Users Lists</h1>
            </div>

            <div class="mb-5 row">
                <div class="col-md-12 shadow card p-4 bg-light">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-inline" method="GET" action="{{ route('admin.user.loan-history') }}">
                                <div class="form-group mr-2">
                                    <select class="form-control bg-light text-dark" name="per_page"
                                        onchange="this.form.submit()">
                                        @foreach([10, 20, 30, 40, 50, 100, 200, 300, 400, 500, 1000] as $size)
                                        <option value="{{ $size }}" {{ $size==$loans->perPage() ? 'selected' : '' }}>{{
                                            $size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mr-2">
                                    <select class="form-control bg-light text-dark" name="sort"
                                        onchange="this.form.submit()">
                                        <option value="desc" {{ request('sort')==='desc' ? 'selected' : '' }}>Descending
                                        </option>
                                        <option value="asc" {{ request('sort')==='asc' ? 'selected' : '' }}>Ascending
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="search" placeholder="Search by name or email"
                                        class="form-control bg-light text-dark" value="{{ request('search') }}">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover text-dark" id="userTable">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Reference</th>
                                    <th>User</th>
                                    <th>Amount</th>
                                    <th>Occupation</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="loanslisttbl">
                                @forelse ($loans as $loan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $loan->reference }}</td>
                                    <td>
                                        @if($loan->user)
                                        {{ $loan->user->name }}<br>
                                        <small>{{ $loan->user->email }}</small>
                                        @else
                                        User Deleted
                                        @endif
                                    </td>
                                    <td>{{ number_format($loan->amount, 2) }}</td>
                                    <td>{{ $loan->occupation }}</td>
                                    <td>
                                        <span class="badge badge-{{ 
                                            $loan->status == 'pending' ? 'warning' : 
                                            ($loan->status == 'approved' ? 'success' : 'danger') 
                                        }}">
                                            {{ ucfirst($loan->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $loan->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" onclick="viewloan({{ $loan->id }})">
                                            View
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No loans found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        @if ($loans->hasPages())
                        <div class="mt-3">
                            {{ $loans->withQueryString()->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add confirmation for form submission
        function viewloan(id) {
            // Implement your view loan logic here
            console.log('View loan:', id);
        }
        
        // Prevent spaces in search input
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.which === 32) e.preventDefault();
        });
    </script>

    @include('admin.footer')