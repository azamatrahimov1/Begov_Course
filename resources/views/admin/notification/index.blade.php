@role('super-user')
<div id="myToast" class="toast-time bs-toast toast fade bg-primary position-fixed top-0 end-0 p-3" role="alert" aria-live="assertive" aria-atomic="true" data-delay="60000">
    <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div id="toastTitle" class="me-auto fw-semibold"></div>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div id="toastBody" class="toast-body"></div>
</div>

<!-- Notification Bell -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle hide-arrow me-3" href="javascript:void(0)" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bx bx-bell"></i>
        @php
            $notifications = \App\Models\Notification::whereNull('read_at')->get();
        @endphp

        <div class="notification-container">
            @if($notifications->count() > 0)
                <small class="count">{{ $notifications->count() }}</small>
            @else
                <small></small>
            @endif
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
        <li>
            <a class="dropdown-item" href="#">
                @php
                    $notifications = \App\Models\Notification::paginate(5);
                @endphp
                <div class="scrollable-dropdown-content">
                    @if($notifications->count() > 0)
                    @foreach($notifications as $notification)
                        <div class="d-flex mb-2">
                            <div class="flex-shrink-0 me-3">
                                <i class="bx bx-message"></i>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-semibold d-block">{{ $notification->data['full_name'] }}</span>
                                <small class="text-muted">{{ $notification->data['desc'] }}</small>
                            </div>
                        </div>
                    @endforeach
                    @else
                        Yangi xabar yo'q!
                    @endif
                </div>
            </a>
        </li>

        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <form action="{{ route('notification.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-center">Barcha xabarlarni ko'rish</button>
            </form>
        </li>
    </ul>
</li>

<style>
    .notification-container {
        position: relative;
        display: inline-block;
    }

    .notification-container .count {
        position: absolute;
        top: -25px;
        right: -10px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 3px 8px;
        font-size: 10px;
    }

    .scrollable-dropdown-content {
        max-height: 100px;
        overflow-y: auto;
        padding-right: 10px;
    }

    .scrollable-dropdown-content::-webkit-scrollbar {
        width: 4px;
    }

    .scrollable-dropdown-content::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2); /* Color of the scrollbar thumb */
        border-radius: 10px; /* Rounded corners */
    }

    .scrollable-dropdown-content::-webkit-scrollbar-thumb:hover {
        background-color: rgba(0, 0, 0, 0.4); /* Darker color on hover */
    }
</style>
@endrole
