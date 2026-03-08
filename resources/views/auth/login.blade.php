@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <h1 class="h4 mb-3">ログイン</h1>

            <form action="{{ route('login.store') }}" method="POST" class="card card-body">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">パスワード</label>
                    <input id="password" type="password" name="password" required
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        ログイン状態を保持
                    </label>
                </div>

                <button class="btn btn-primary" type="submit">ログイン</button>
            </form>
        </div>
    </div>
@endsection
