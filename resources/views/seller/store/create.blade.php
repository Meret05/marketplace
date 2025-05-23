<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>
<body class="bg-light">
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="rounded bg-white px-5 py-5 w-100" style="max-width: 500px;">
        <h1 class="text-center">{{ __('layout.create-store') }}</h1>
        <div class="container mt-5">
            <form action="{{ route('seller.store.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('seller.title') }}</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">{{ __('seller.add') }}</button>
            </form>
        </div>
    </div>
</body>
</html>
