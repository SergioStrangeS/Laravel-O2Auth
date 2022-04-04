<h1>Привет {{ Auth::user()->name }}!</h1>
<p>
    Почта: {{ Auth::user()->email }}
</p>

<a href="{{ route('logout') }}">Выйти</a>
