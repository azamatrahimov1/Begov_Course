<!-- Layout container -->
<div class="layout-page">
    <!-- Navbar -->
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
         id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                @role('super-user')
                <div id="myToast" class="toast-time bs-toast toast fade bg-primary position-fixed top-0 end-0 p-3"
                     role="alert" aria-live="assertive" aria-atomic="true" data-delay="60000">
                    <div class="toast-header">
                        <i class="bx bx-bell me-2"></i>
                        <div id="toastTitle" class="me-auto fw-semibold"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div id="toastBody" class="toast-body"></div>
                </div>

                <!-- Notification Bell -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow me-3" href="javascript:void(0)"
                       id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
                                                <div class="flex-grow-1">
                                                    <span
                                                        class="fw-semibold d-block">{{ $notification->data['full_name'] }}</span>
                                                    <small class="text-muted">{{ $notification->data['desc'] }}</small>
                                                </div>
                                                <div class="flex-shrink-0 me-3">
                                                    <i class="bx bx-message"></i>
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
                            <form action="{{ route('notification.show') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-center bg-success text-dark">korish
                                </button>
                            </form>
                        </li>

                        <li>
                            <form action="{{ route('notification.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-center bg-danger text-dark">Barcha
                                    xabarlarni o'chirish
                                </button>
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
                        background-color: rgba(0, 0, 0, 0.2);
                        border-radius: 10px;
                    }

                    .scrollable-dropdown-content::-webkit-scrollbar-thumb:hover {
                        background-color: rgba(0, 0, 0, 0.4);
                    }
                </style>
                @endrole

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            @php
                                $logo = \App\Models\Logo::first();
                            @endphp
                            @if($logo)
                                <img src="{{ asset('storage/' . $logo->image) }}" alt
                                     class="w-px-45 h-auto rounded-circle"/>
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                        <small class="text-muted">End Date: {{ Auth::user()->end_date }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">Log Out</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>
    <!-- / Navbar -->

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            @yield('content')
        </div>
    </div>
</div>
<!-- / Layout page -->
