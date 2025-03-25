@extends('employee.layouts.auth')

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">{{__('Login')}}</h2>
            <form method="POST" action="{{ route('employee.login') }}" autocomplete="off" novalidate>
                <div class="mb-3">
                    <label class="form-label">{{__('Email')}}</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" value="{{old('email')}}" required autofocus autocomplete="username">
                    <ul class="list-unstyled text-danger mt-2">
                        @foreach ((array) $errors->get('email') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-2">
                    <label class="form-label">
                        {{__('Password')}}
                        @if (Route::has('employee.password.request'))
                        <span class="form-label-description">
{{--                            <a href="{{ route('employee.password.request') }}">{{__('Forgot Your Password ?')}}</a>--}}
                        </span>
                        @endif
                    </label>
                    <input type="password" class="form-control" id="password" placeholder="{{__('Password')}}" name="password" required autocomplete="current-password">
                    <ul class="list-unstyled text-danger mt-2">
                        @foreach ((array) $errors->get('password') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mb-2">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <span class="form-check-label">{{__('Remember me on this device')}}</span>
                    </label>
                </div>
                <div class="form-footer">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100">{{__('Login')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
