@include('admin.header')
<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-dark">Cheque Deposit Records</h1>
            </div>

            <div class="mb-5 row">
                <div class="col-md-12 shadow card p-4 bg-light">
                    <div class="row">
                        <div class="col-12">
                            <form class="form-inline" method="GET" action="{{ route('admin.cheque-deposits.index') }}">
                                <div class="form-group mr-2">
                                    <select class="form-control bg-light text-dark" name="per_page"
                                        onchange="this.form.submit()">
                                        @foreach([10, 20, 50, 100] as $size)
                                        <option value="{{ $size }}" {{ $size==$chequeDeposits->perPage() ? 'selected' :
                                            '' }}>{{ $size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mr-2">
                                    <select class="form-control bg-light text-dark" name="sort"
                                        onchange="this.form.submit()">
                                        <option value="desc" {{ request('sort')==='desc' ? 'selected' : '' }}>Newest
                                            First</option>
                                        <option value="asc" {{ request('sort')==='asc' ? 'selected' : '' }}>Oldest First
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="search" placeholder="Search by remarks or user"
                                        class="form-control bg-light text-dark" value="{{ request('search') }}">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover text-dark">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>User</th>
                                    <th>Front Image</th>
                                    <th>Back Image</th>
                                    <th>Remarks</th>
                                    <th>Submitted At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($chequeDeposits as $deposit)
                                <tr>
                                    <td>#{{ $deposit->id }}</td>
                                    <td>
                                        @if($deposit->user)
                                        {{ $deposit->user->name }}<br>
                                        <small>{{ $deposit->user->email }}</small>
                                        @else
                                        User Deleted
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $deposit->front) }}" alt="Front"
                                            class="img-thumbnail" style="max-width: 150px;">
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $deposit->back) }}" alt="Back"
                                            class="img-thumbnail" style="max-width: 150px;">
                                    </td>
                                    <td>{{ $deposit->remarks ?? 'N/A' }}</td>
                                    <td>{{ $deposit->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary"
                                            onclick="viewDeposit({{ $deposit->id }})">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No cheque deposits found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        @if ($chequeDeposits->hasPages())
                        <div class="mt-3">
                            {{ $chequeDeposits->withQueryString()->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function viewDeposit(id) {
        // Implement view modal or detail page
        window.location.href = `/admin/cheque-deposits/${id}`;
    }
</script>

@include('admin.footer')