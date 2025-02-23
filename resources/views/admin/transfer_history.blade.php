@include('admin.header')
<div class="main-panel">
	<div class="content bg-light">
		<div class="page-inner">
			@if(session('message'))
			<div class="alert alert-success mb-2">{{ session('message') }}</div>
			@endif
			<div class="mt-2 mb-4">
				<h1 class="title1 text-dark">Transfer Histories</h1>
			</div>

			<div class="mb-5 row">
				<div class="col-md-12 shadow card p-4 bg-light">
					<div class="row">
						<div class="col-12">
							<form class="form-inline" method="GET" action="{{ route('admin.transfers.index') }}">
								<div class="form-group mr-2">
									<select class="form-control bg-light text-dark" name="per_page"
										onchange="this.form.submit()">
										@foreach([10, 20, 50, 100, 200, 500] as $size)
										<option value="{{ $size }}" {{ $size==$transfers->perPage() ? 'selected' : ''
											}}>{{ $size }}</option>
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
									<input type="text" name="search" placeholder="Search by reference or user"
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
									<th>Type</th>
									<th>Amount</th>
									<th>From Account</th>
									<th>Details</th>
									<th>Status</th>
									<th>Completed At</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($transfers as $transfer)
								<tr>
									<td>{{ $transfer->reference }}</td>
									<td>
										@if($transfer->user)
										{{ $transfer->user->name }}<br>
										<small>{{ $transfer->user->email }}</small>
										@else
										User Deleted
										@endif
									</td>
									<td>{{ ucfirst($transfer->type) }}</td>
									<td>{{ $transfer->currency }} {{ number_format($transfer->amount, 2) }}</td>
									<td>{{ $transfer->from_account }}</td>
									<td>
										<pre class="m-0">{{ json_encode($transfer->details, JSON_PRETTY_PRINT) }}</pre>
									</td>
									<td>
										<span class="badge badge-{{ 
                                            $transfer->status == 'pending' ? 'warning' : 
                                            ($transfer->status == 'completed' ? 'success' : 'danger') 
                                        }}">
											{{ ucfirst($transfer->status) }}
										</span>
									</td>
									<td>{{ $transfer->completed_at?->format('Y-m-d H:i') ?? 'N/A' }}</td>
								</tr>
								@empty
								<tr>
									<td colspan="8" class="text-center">No transfer records found</td>
								</tr>
								@endforelse
							</tbody>
						</table>

						@if ($transfers->hasPages())
						<div class="mt-3">
							{{ $transfers->withQueryString()->links() }}
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('admin.footer')