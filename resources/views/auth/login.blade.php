@extends('layouts.authorization')

@section('content')

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="rounded bg-white px-5 py-5 w-100" style="max-width: 500px;">
            <h1 class="text-center">{{ __('login.sign-in') }}</h1>
            <div class="container mt-5">
                <div class="tab-content mt-3 mb-2" id="loginTabContent">
                    <div class="tab-pane fade show active" id="email-login" role="tabpanel">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control" placeholder="example@gmail.com" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password-phone" class="form-label">{{ __('login.password') }}</label>
                                <input id="password-phone" type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">{{ __('login.sign-in-button') }}</button>
                        </form>
                    </div>
                </div>
                <a class="text-black-50 me-3" href="{{ route('password.request') }}">Forgot password?</a>
                <a class="text-black-50" href="{{ route('register') }}">{{ __('login.create-account') }}</a>
            </div>
        </div>
    </div>

@endsection

