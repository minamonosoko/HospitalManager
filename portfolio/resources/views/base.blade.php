<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Hospital Manager</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    </head>
    <body>
        <div class="vh-100 col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-bland text-black text-decoration-none fw-bold" href="#">通院管理アプリ</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            {{-- <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">About</a>
                            </li> --}}
                        </ul>
                        @if (Route::has('login'))
                        <ul class="navbar-nav">
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="{{ url('/dashboard') }}">ダッシュボード</a>
                                </li>
                                <li class="nav-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <div class="nav-item">
                                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        this.closest('form').submit(); " role="button">
                                                <i class="fas fa-sign-out-alt"></i>
                                                {{ __('Log Out') }}
                                            </a>
                                        </div>
                                    </form>                                
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                                </li>
                                @endif
                            @endauth
                        </ul>
                        @endif
                    </div>
                </div>
            </nav>
            @yield('content')
        </div>
    </body>
</html>