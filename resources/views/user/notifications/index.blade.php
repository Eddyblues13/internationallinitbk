@include('user.header')
<div id="appCapsule" class="appCap">
    <div class="container">
        <div class="section">
            <div class="row mt-2 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-primary">Notifications</h3>
                    </div>
                    <div class="card-body">
                        <small class="text-center mobile">
                            Click the <span class="text-white"
                                style="padding:2px 7px;border-radius:50%;background-color:#0d6efd">+</span> icon for
                            details
                        </small>
                        <hr>
                        <table class="table table-striped table-bordered dt-responsive nowrap" id="NotificationsTable"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Reference</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.footer')

<script>
    $(document).ready(function () {
        $('#NotificationsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("notifications.data") }}',
            columns: [
                { data: 'created_at', name: 'created_at' },
                { data: 'title', name: 'title' },
                { data: 'reference', name: 'reference' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']]
        });
    });
</script>