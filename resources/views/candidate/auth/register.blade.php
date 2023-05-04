@extends('candidate.layouts.main')
@section('content')
<div class="content-full">
    <div class="form-login" style="width: 100%; margin: 0 auto;">
        <div class="border-login" style="margin-top: 50px;
        display: flex;
        border-radius: 8px;
        border-top: 5px solid #000066;
        border-right: 1px solid #DFDFDF;
        border-left: 1px solid #DFDFDF;
        border-bottom: 6px solid #DFDFDF;"
        >
        <div class="left" style="
        width: 50%;
        min-height: 300px;
        ">
            <div class="frame" style="position: relative;
            margin: 20px 40px;
            padding: 10px;
            border: 4px solid #EFEFEF;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;">
                <div>
                    <img height="24" width="24" src="{{ asset('images/email-icon-big.png') }}" alt=""> Job mail
                </div>
                <div class="c-job-mail" style="border-bottom: 1px solid #DFDFDF;
                margin: 10px 0;
                padding: 2px 0;">
                    You can receive the newest job postings based on your preferences.
                </div>
                <div>
                    <img height="24" width="24" src="{{ asset('images/news-icon-big.png') }}" alt=""> Newsletters
                </div>
                <div class="c-job-mail" style="border-bottom: 1px solid #DFDFDF;
                margin: 10px 0;
                padding: 2px 0;">
                    You can view job sharing newsletters.
                </div>

                <div class="c-img">
                    <img height="24" width="24" src="{{ asset('images/icon-search-lg-black.svg') }}" alt=""> Selective
                </div>
                <div class="c-job-mail" style="border-bottom: 1px solid #DFDFDF;
                margin: 10px 0;
                padding: 2px 0;">
                    You will have more career options.
                </div>
            </div>
        </div>
        <div class="right" style="padding: 20px 40px; width: 50%;">
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
                <div class="f-name" style="display: flex; justify-content: center;">
                    <div>
                        <label for="firstname">Firstname:</label>
                        <input type="text" name="firstname" id="firstname"
                        style="margin: 0px;
                        border-radius: 5px;
                        padding: 4px 10px;
                        border: 2px solid #111111;
                        -webkit-box-sizing: border-box;
                        box-sizing: border-box;
                        background: #FFFFFF;
                        font-weight: bold;">
                    </div>
                    <div style="padding-left: 38px;">
                        <label for="lastname">LastName:</label>
                        <input type="text" name="lastname" id="lastname"
                        style="margin: 0px;
                        border-radius: 5px;
                        padding: 4px 10px;
                        border: 2px solid #111111;
                        -webkit-box-sizing: border-box;
                        box-sizing: border-box;
                        background: #FFFFFF;
                        font-weight: bold;">
                    </div>
                </div>
                <div>
                    <label for="email">Email:</label><br>
                    <input type="email" name="email" id="email" style="width: 70%;
                    margin: 0px;
                    border-radius: 5px;
                    padding: 4px 10px;
                    border: 2px solid #111111;
                    -webkit-box-sizing: border-box;
                    box-sizing: border-box;
                    background: #FFFFFF;
                    font-weight: bold;">
                </div>
                <div>
                    <label for="password">Password:</label><br>
                    <input type="password" name="password" id="password" style="width: 70%;
                    margin: 0px;
                    border-radius: 5px;
                    padding: 4px 10px;
                    border: 2px solid #111111;
                    -webkit-box-sizing: border-box;
                    box-sizing: border-box;
                    background: #FFFFFF;
                    font-weight: bold;">
                </div>
                <div>
                    <label for="password-confirmation">Password confirmation:</label><br>
                    <input type="password" name="password_confirmation" id="password-confirmation" style="width: 70%;
                    margin: 0px;
                    border-radius: 5px;
                    padding: 4px 10px;
                    border: 2px solid #111111;
                    -webkit-box-sizing: border-box;
                    box-sizing: border-box;
                    background: #FFFFFF;
                    font-weight: bold;">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 15px">REGISTER</button>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection


{{-- <form method="POST" action="{{ route('company.register') }}">
    @csrf

    <!-- Firstname -->
    <div>
        <x-label for="firstname" :value="__('Firstname')" />

        <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus />
    </div>

    <!-- Lastname -->
    <div class="mt-4">
        <x-label for="lastname" :value="__('Lastname')" />

        <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-label for="email" :value="__('Email')" />

        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-label for="password" :value="__('Password')" />

        <x-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-input id="password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" required />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('company.login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-button class="ml-4">
            {{ __('Register') }}
        </x-button>
    </div>
</form> --}}
