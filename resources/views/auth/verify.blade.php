@extends('layouts.guest')
@section('title', 'Verify Email')
@section('content')
    <div class="card-header">{{ __('Login') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Konten form lainnya... --}}

        </form>
    </div>
@endsection
<div class="card-header">{{ __('Verify Your Email Address') }}</div>

<div class="card-body">
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit"
            class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
    </form>
</div>
@endsection
