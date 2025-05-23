@extends('layouts.authorization')

@section('content')

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="rounded bg-white px-5 py-5 w-100" style="max-width: 500px;">
            <h1 class="text-center">{{ __('reg.registration') }}</h1>
            <div class="container mt-5">
                <div class="tab-content mt-3 mb-2" id="loginTabContent">
                    <!-- Вход по Email -->
                    <div class="tab-pane fade show active" id="email-login" role="tabpanel">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('reg.username') }}</label>
                                <input id="name" type="text" name="name" class="form-control" placeholder="{{ __('reg.username-placeholder') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control" placeholder="example@gmail.com" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('reg.password') }}</label>
                                <input id="password" type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">{{ __('reg.registration-button') }}</button>
                        </form>
                    </div>
                </div>
                <a class="text-black-50" href="{{ route('login') }}">{{ __('reg.sign-in') }}</a>
            </div>
        </div>
    </div>

@endsection
