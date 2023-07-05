@extends('admin.layouts.app')

@section('title',"Nika")
@section('meta')
    <meta property="og:title" content="">
    <meta property="og:type" content="Web site">
    <meta property="og:image" content="">
    <meta property="og:keywords" content="">
    <meta name="description" content="">
@endsection

@section('content')
<div class="body-content">
    <div class="container-fluid">
        <div class="row">
            <div class="mt-3 mx-auto" style="width: 70%;">
                @include('admin.includes.messages')
                <div>
                    <h2>Candidate information</h2>
                </div>
                <form action="{{route('admin.user.update', ['id' => $user->id])}}" method="POST" class="mt-3 form-create">
                    @csrf
                    <input type="hidden" name="preview" id="preview_value" value="">
                    <div class="form-header d-flex">
                        <img src="{{ asset('images/icon-job.svg') }}">
                        <h3 class="m-0">Information</h3>
                    </div>
                    <div class="form-content">
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Firstname
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('firstname')}}">
                                    <input type="text" placeholder="firstname" class="form-control" name="firstname" value="{{ old('firstname', $user->firstname) }}">
                                    {!! render_error('firstname') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Lastname
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('lastname')}}">
                                    <input type="text" placeholder="lastname" class="form-control" name="lastname" value="{{ old('lastname', $user->lastname) }}">
                                    {!! render_error('lastname') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Email
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('email')}}">
                                    <input type="text" placeholder="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                                    {!! render_error('email') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Phone
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('phone')}}">
                                    <input type="text" placeholder="phone" class="form-control" name="phone" value="{{ old('phone', $user->resume->phone) }}">
                                    {!! render_error('phone') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Country
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('country')}}">
                                    <input type="text" placeholder="country" class="form-control" name="country" value="{{ old('country', $user->resume->country) }}">
                                    {!! render_error('country') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Address
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('address')}}">
                                    <input type="text" placeholder="address" class="form-control" name="address" value="{{ old('address', $user->resume->address) }}">
                                    {!! render_error('address') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-3" style="position: relative; background-color: #F3F4F6">
                        <button type="submit" class="btn button-purple border-circle" style="min-width: 145px;" ><img
                            src="{{ asset('images/icon-check.svg') }}">Save</button>
                        <a href="{{ route('admin.users') }}" class="btn btn-dark-back" style="position: absolute;
                        margin: 0;
                        top: 23px;">
                            <img src="{{ asset('images/icon-back.svg') }}">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
