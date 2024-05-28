    @if(auth()->check())
        @php
            $user = auth()->user();
            $userInfo = $user->getUserInfo();
        @endphp
        <div class="d-none d-xl-block ps-2">
            <div>{{ $userInfo['name'] }}</div>
            <div class="mt-1 small text-secondary">{{ $userInfo['role_str'] }}</div>
        </div>
    @endif
  </a>
  <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
    <div class="dropdown-divider"></div>
    <p class="block w-full px-4 py-2 text-sm leading-5 text-white text-start badge bg-info">{{ Auth::user()->email }}</p>
    <div class="dropdown-divider"></div>
    @if(auth()->check() && auth()->user()->hasRole('admin'))
    <x-dropdown-link :href="secure_url(route('profile.edit')">
        {{ __('Profile') }}
    </x-dropdown-link>
    <div class="dropdown-divider"></div>
    @endif
    <form method="POST" action="{{ secure_url(route('logout') }}">
        @csrf
        <x-dropdown-link :href="secure_url(route('logout')"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>
    <div class="dropdown-divider"></div>
  </div>
