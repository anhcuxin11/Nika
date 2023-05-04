@extends('candidate.layouts.main')
@section('content')
<div class="content-full">
    <div class="form-login">
        <div class="border-login">
        <div class="left">
            <div class="frame" style="top: 0;">
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
            <div class="form-login" style="width: 60%">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label for="email">Email:</label><br>
                        <input class="input-name" type="email" name="email" id="email" style="width: 100%;" required autofocus>
                    </div>
                    <div>
                        <label for="password">Password:</label><br>
                        <input class="input-name" type="password" name="password" id="password" style="width: 100%;">
                    </div>
                    <button type="submit" class="mt-3 btn btn-primary login">LOGIN</button>
                </form>
            </div>
            <div class="text-center"><a href="#" style="text-decoration: underline">Click here</a> if you can't login or forgot your password</div>
            <div class="text-center mt-3"><a href="{{ route('register') }}" class="member">First, please register as a member</a></div>
        </div>
        </div>
    </div>
</div>
@endsection
