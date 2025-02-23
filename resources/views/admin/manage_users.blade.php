@include('admin.header')
<div class="main-panel">
	<div class="content bg-light">
		<div class="page-inner">
			@if(session('message'))
			<div class="alert alert-success mb-2">{{ session('message') }}</div>
			@endif
			<div class="mt-2 mb-4">
				<h1 class="title1 text-dark">User Management</h1>
			</div>

			<div class="mb-5 row">
				<div class="col-md-12 shadow card p-4 bg-light">
					<div class="row">
						<div class="col-12">
							<form class="form-inline" method="GET" action="{{ route('manage.users.page') }}">
								<div class="form-group mr-2">
									<select class="form-control bg-light text-dark" name="per_page"
										onchange="this.form.submit()">
										@foreach([10, 25, 50, 100] as $size)
										<option value="{{ $size }}" {{ $size==$users->perPage() ? 'selected' : '' }}>{{
											$size }}</option>
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
									<input type="text" name="search" placeholder="Search by name, email, or phone"
										class="form-control bg-light text-dark" value="{{ request('search') }}">
								</div>
							</form>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table table-hover text-dark">
							<thead>
								<tr>
									<th>SN</th>
									<th>Client Name</th>
									<th>Location</th>

									<th>User Status</th>
									<th>Email Status</th>

									<th>Action</th>

								</tr>
							</thead>
							<tbody>
								@forelse ($users as $user)

								<tr id="user-row-{{ $user->id }}">
									<td>{{ $loop->iteration }}</td>
									<td style="display: flex; align-items: center;">
										<div
											style="width: 40px; height: 40px; border-radius: 50%; background: #007bff; color: white; display: flex; justify-content: center; align-items: center; font-weight: bold; margin-right: 10px;">
											{{ strtoupper(substr($user->name, 0, 1)) }}{{
											strtoupper(substr(strrchr($user->name, ' '), 1, 1)) }}
										</div>
										<div>
											{{ $user->name }} <br>
											<small>{{ strtolower($user->email) }}</small>
										</div>
									</td>
									<td>
										{{ $user->city }}, {{ $user->country }}<br>
										<small>{{ $user->address }}</small>
									</td>


									<td>
										<button class="btn btn-sm toggle-user-status" data-id="{{ $user->id }}"
											data-status="{{ $user->user_status }}">
											@if($user->user_status == 0)
											<span class="badge badge-danger">Inactive</span>
											@else
											<span class="badge badge-success">Active</span>
											@endif
										</button>
									</td>
									<td>
										<button class="btn btn-sm toggle-email-status" data-id="{{ $user->id }}"
											data-status="{{ $user->email_status }}">
											@if($user->email_status == 0)
											<span class="badge badge-danger">Unverified</span>
											@else
											<span class="badge badge-success">Verified</span>
											@endif
										</button>
									</td>

									<td>
										<a class="btn btn-secondary btn-sm"
											href="{{ route('admin.user.view', $user->id) }}" role="button">
											Manage
										</a>
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="7" class="text-center">No users found</td>
								</tr>
								@endforelse
							</tbody>
						</table>

						@if ($users->hasPages())
						<div class="mt-3">
							{{ $users->withQueryString()->links() }}
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function confirmDelete(userId) {
        if(confirm('Are you sure you want to delete this user?')) {
            fetch(`/admin/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if(response.ok) {
                    window.location.reload();
                } else {
                    alert('Error deleting user');
                }
            });
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function() {
		$('.toggle-email-status').click(function() {
			var button = $(this);
			var userId = button.data('id');
			var currentStatus = button.data('status');

			$.ajax({
				url: "{{ route('admin.user.toggleEmailStatus') }}",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					user_id: userId,
					status: currentStatus
				},
				success: function(response) {
					if (response.success) {
						button.data('status', response.new_status);
						button.find('span').removeClass('badge-danger badge-success')
							.addClass(response.new_status == 1 ? 'badge-success' : 'badge-danger')
							.text(response.new_status == 1 ? 'Verified' : 'Unverified');
							toastr.success("Email status updated successfully!");
					} else {
						alert("Error updating status.");
					}
				},
				error: function() {
					alert("Something went wrong!");
				}
			});
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('.toggle-user-status').click(function() {
			var button = $(this);
			var userId = button.data('id');
			var currentStatus = button.data('status');

			$.ajax({
				url: "{{ route('admin.user.toggleUserStatus') }}",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					user_id: userId, 
					status: currentStatus
				},
				success: function(response) {
					if (response.success) {
						button.data('status', response.new_status);
						button.find('span').removeClass('badge-danger badge-success')
							.addClass(response.new_status == 1 ? 'badge-success' : 'badge-danger')
							.text(response.new_status == 1 ? 'Active' : 'Inactive');
							toastr.success("User status updated successfully!");
					} else {
						alert("Error updating status.");
					}
				},
				error: function() {
					alert("Something went wrong!");
				}
			});
		});
	});
</script>

@include('admin.footer')