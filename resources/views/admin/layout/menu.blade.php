<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
            @php
                $logo = \App\Models\Logo::first();
            @endphp
                @if($logo)
                    <img src="{{ asset('storage/' . $logo->image) }}" alt class="w-px-50 h-auto rounded-circle"/>
                @endif
            </span>
            <div class="marquee">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">
                @if($logo)
                    {{ $logo->title }}
                @endif
            </span>
            </div>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @if(auth()->user()->can('show-grammar-lessons'))
            <li class="menu-item @if(Route::is('dashboard.index')) active @endif">
                <a href="{{ route('dashboard.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-home"></i>
                    <div data-i18n="Analytics">Asosiy sahifa</div>
                </a>
            </li>
        @endif

        @role('super-user')
        <li class="menu-item @if(Route::is('lessons.index')) active @endif">
            <a href="{{ route('lessons.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-plus-circle"></i>
                <div data-i18n="Analytics">Dars</div>
            </a>
        </li>
        <li class="menu-item @if(Route::is('role.index')) active @endif">
            <a href="{{ route('role.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Analytics">Rollar</div>
            </a>
        </li>

        <li class="menu-item @if(Route::is('users.index')) active @endif">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Analytics">Mijozlar</div>
            </a>
        </li>

        <li class="menu-item @if(Route::is('main-screen.index')) active @endif">
            <a href="{{ route('main-screen.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div data-i18n="Analytics">Asosiy Ekran</div>
            </a>
        </li>

        <li class="menu-item @if(Route::is('logo.index')) active @endif">
            <a href="{{ route('logo.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-meh-blank"></i>
                <div data-i18n="Analytics">Logotip</div>
            </a>
        </li>

        <li class="menu-item @if(Route::is('gallery.index')) active @endif">
            <a href="{{ route('gallery.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-grid-alt"></i>
                <div data-i18n="Analytics">Galereya</div>
            </a>
        </li>

        <li class="menu-item @if(Route::is('team.index')) active @endif">
            <a href="{{ route('team.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-badge"></i>
                <div data-i18n="Analytics">Jamoa a'zolari</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div data-i18n="Extended UI">Darslarning Turlari</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if(Route::is('online.index')) active @endif">
                    <a href="{{ route('online.index') }}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Onlayn Dars</div>
                    </a>
                </li>
                <li class="menu-item @if(Route::is('offline.index')) active @endif">
                    <a href="{{ route('offline.index') }}" class="menu-link">
                        <div data-i18n="Text Divider">Oflayn Darslar</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item @if(Route::is('abouts.index')) active @endif">
            <a href="{{ route('abouts.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-account"></i>
                <div data-i18n="Analytics">Biz Haqimizda</div>
            </a>
        </li>
        @endrole

        @if(auth()->user()->can('show-message'))
            <li class="menu-item @if(Route::is('contacts.index')) active @endif">
                <a href="{{ route('contacts.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-chat"></i>
                    <div data-i18n="Analytics">Xabarlar</div>
                </a>
            </li>
        @endif

        @if(auth()->user()->can('show-grammar-lessons'))
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-detail"></i>
                    <div data-i18n="Layouts">Darslar</div>
                </a>
                @php
                    $lessons = \App\Models\Lesson::all();
                @endphp
                <ul class="menu-sub">
                    @foreach($lessons as $lesson)
                        <li class="menu-item @if(Route::is('lessons.show') && request()->route('lesson') && request()->route('lesson')->id == $lesson->id) active @endif">
                            <a href="{{ route('lessons.show', ['lesson' => $lesson->id]) }}" class="menu-link">
                                <div data-i18n="Without menu">{{ $lesson->name }}</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
    </ul>
</aside>
<!-- / Menu -->
