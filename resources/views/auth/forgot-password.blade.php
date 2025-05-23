@extends('layouts.authorization')

@section('content')

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="rounded bg-white px-5 py-5 w-100" style="max-width: 500px;">
            <h1 class="text-center">Reset password</h1>
            <div class="container mt-5">
                <div class="tab-content mt-3 mb-2" id="loginTabContent">
                    <div class="tab-pane fade show active" id="email-login" role="tabpanel">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control"
                                       placeholder="your@mail.com" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-success">Reset password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection

