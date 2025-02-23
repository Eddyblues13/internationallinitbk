@include('admin.header')
<div class="main-panel">
	<div class="content bg-light">
		<div class="page-inner">
			<div class="mt-2 mb-4">
				<div class="d-flex justify-content-between align-items-center">
					<h1 class="title1 text-dark">Cheque Deposit Details</h1>
					<a href="{{ route('admin.cheque-deposits.index') }}" class="btn btn-secondary">
						<i class="fas fa-arrow-left"></i> Back to List
					</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
					<div class="card shadow">
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<h4 class="text-primary">User Information</h4>
									@if($chequeDeposit->user)
									<dl class="row">
										<dt class="col-sm-4">Name:</dt>
										<dd class="col-sm-8">{{ $chequeDeposit->user->name }}</dd>

										<dt class="col-sm-4">Email:</dt>
										<dd class="col-sm-8">{{ $chequeDeposit->user->email }}</dd>

										<dt class="col-sm-4">Account ID:</dt>
										<dd class="col-sm-8">{{ $chequeDeposit->user->id }}</dd>
									</dl>
									@else
									<div class="alert alert-warning">User account no longer exists</div>
									@endif
								</div>

								<div class="col-md-6">
									<h4 class="text-primary">Deposit Details</h4>
									<dl class="row">
										<dt class="col-sm-4">Reference ID:</dt>
										<dd class="col-sm-8">#{{ $chequeDeposit->id }}</dd>

										<dt class="col-sm-4">Submitted At:</dt>
										<dd class="col-sm-8">{{ $chequeDeposit->created_at->format('M d, Y H:i') }}</dd>

										<dt class="col-sm-4">Status:</dt>
										<dd class="col-sm-8">
											<span class="badge badge-{{ 
                                                $chequeDeposit->status == 'pending' ? 'warning' : 
                                                ($chequeDeposit->status == 'approved' ? 'success' : 'danger') 
                                            }}">
												{{ ucfirst($chequeDeposit->status) }}
											</span>
										</dd>

										<dt class="col-sm-4">Remarks:</dt>
										<dd class="col-sm-8">{{ $chequeDeposit->remarks ?? 'N/A' }}</dd>
									</dl>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="card shadow">
						<div class="card-body">
							<h4 class="text-primary mb-4">Cheque Images</h4>

							<div class="mb-4">
								<h5>Front Side</h5>
								<a href="{{ asset('storage/' . $chequeDeposit->front) }}" target="_blank">
									<img src="{{ asset('storage/' . $chequeDeposit->front) }}" alt="Front side"
										class="img-fluid rounded border">
								</a>
							</div>

							<div class="mb-4">
								<h5>Back Side</h5>
								<a href="{{ asset('storage/' . $chequeDeposit->back) }}" target="_blank">
									<img src="{{ asset('storage/' . $chequeDeposit->back) }}" alt="Back side"
										class="img-fluid rounded border">
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-4">
				<div class="col-md-12">
					<div class="card shadow">
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<div class="btn-group">
									<button class="btn btn-success" onclick="updateStatus('approved')">
										<i class="fas fa-check"></i> Approve Deposit
									</button>
									<button class="btn btn-danger" onclick="updateStatus('rejected')">
										<i class="fas fa-times"></i> Reject Deposit
									</button>
								</div>

								<form id="deleteForm"
									action="{{ route('admin.cheque-deposits.destroy', $chequeDeposit) }}" method="POST">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-outline-danger"
										onclick="return confirm('Are you sure you want to delete this record?')">
										<i class="fas fa-trash"></i> Delete Record
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function updateStatus(status) {
        if(confirm(`Are you sure you want to mark this as ${status}?`)) {
            fetch("{{ route('admin.cheque-deposits.update', $chequeDeposit) }}", {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => {
                if(response.ok) {
                    window.location.reload();
                } else {
                    alert('Error updating status');
                }
            });
        }
    }
</script>

@include('admin.footer')