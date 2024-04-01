<nav class="header__nav">
    <ul class="header__nav--list">
        <li class="nav--list__item"><a href="/stamp">ホーム</a></li>
        <li class="nav--list__item"><a href="{{ route('works.day', ['date' => now()->format('Y-m-d')]) }}">日付一覧</a></li>
        <li class="nav--list__item"><a href="{{ route('users.index') }}">会員一覧</a></li>
        <form action="/logout" method="post">
            @csrf
            @if(Auth::check())
            <button type=" submit" class="nav--list__item">ログアウト</button>
        </form>
        @else
        <li class="nav--list__item">ログインしていません</li>
        @endif
    </ul>
</nav>