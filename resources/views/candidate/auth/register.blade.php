@extends('candidate.layouts.main')
@section('content')
<div class="content-full">
    <div class="form-login">
        <div class="border-login">
        <div class="left">
            <div class="frame">
                <div>
                    <img height="24" width="24" src="{{ asset('images/email-icon-big.png') }}" alt=""> Job mail
                </div>
                <div class="c-job-mail">
                    You can receive the newest job postings based on your preferences.
                </div>
                <div>
                    <img height="24" width="24" src="{{ asset('images/news-icon-big.png') }}" alt=""> Newsletters
                </div>
                <div class="c-job-mail">
                    You can view job sharing newsletters.
                </div>
                <div class="c-img">
                    <img height="24" width="24" src="{{ asset('images/icon-search-lg-black.svg') }}" alt=""> Selective
                </div>
                <div class="c-job-mail">
                    You will have more career options.
                </div>
            </div>
        </div>
        <div class="right">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
            @csrf
                <div class="f-name d-flex justify-content-center">
                    <div>
                        <label for="firstname">Firstname:</label>
                        <input class="input-name" type="text" name="firstname" id="firstname">
                    </div>
                    <div style="padding-left: 38px;">
                        <label for="lastname">LastName:</label>
                        <input class="input-name" type="text" name="lastname" id="lastname">
                    </div>
                </div>
                <div>
                    <label for="email">Email:</label><br>
                    <input class="input-name" type="email" name="email" id="email" style="width: 100%;">
                </div>
                <div>
                    <label for="password">Password:</label><br>
                    <input class="input-name" type="password" name="password" id="password" style="width: 100%;">
                </div>
                <div>
                    <label for="password-confirmation">Password confirmation:</label><br>
                    <input class="input-name" type="password" name="password_confirmation" id="password-confirmation" style="width: 100%;">
                </div>
                <button type="submit" class="btn btn-primary register">REGISTER</button>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection
