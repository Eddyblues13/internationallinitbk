@include('user.header');
<div id="appCapsule" class="appCap">
    <div class="container">
        <div class="section">
            <div class="row mt-2 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-primary">Notification Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Date:</strong> {{ $notification->created_at->format('d M Y, h:i A') }}
                        </div>
                        <div class="mb-3">
                            <strong>Title:</strong> {{ $notification->title }}
                        </div>
                        <div class="mb-3">
                            <strong>Reference:</strong> {{ $notification->reference }}
                        </div>
                        <div class="mb-3">
                            <strong>Status:</strong>
                            @if($notification->status == 'unread')
                            <span class="badge bg-warning text-dark">Unread</span>
                            @else
                            <span class="badge bg-success">Read</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <strong>Message:</strong>
                            <p>{{ $notification->message }}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    Mark as Read
                                </button>
                            </form>

                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this notification?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('notifications.index') }}" class="btn btn-secondary">Back to
                                Notifications</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.footer')