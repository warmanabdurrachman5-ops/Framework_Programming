<style>
    @include('partials.style')
</style>
<nav class="main-nav">
    <div class="nav-menu">
        @foreach (config('menu') as $menu)
        @can($menu['permission'])
        <a href="{{ route($menu['route']) }}">{{ $menu['lable'] }}</a>
        @endcan
        @endforeach

        @role('admin')
        <a href="{{ route('role.index') }}">Role</a>
        <a href="{{ route('pengguna.index') }}">Pengguna</a>
        @endrole
    </div>

    @auth
    <div class="nav-user">
        <span class="user-info">
            {{ auth()->user()->name }}
            {{ auth()->user()->getRoleNames()->implode(', ') }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">logout</button>
        </form>
    </div>
    @endauth
</nav>