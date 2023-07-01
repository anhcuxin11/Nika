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
                    <h2>Company information</h2>
                </div>
                <form action="{{route('admin.company.update', ['id' => $company->id])}}" method="POST" class="mt-3 form-create">
                    @csrf
                    <input type="hidden" name="preview" id="preview_value" value="">
                    <div class="form-header d-flex">
                        <img src="{{ asset('images/icon-job.svg') }}">
                        <h3 class="m-0">Information</h3>
                    </div>
                    <div class="form-content">
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Name
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('name')}}">
                                    <input type="text" placeholder="name" class="form-control" name="name" value="{{ old('name', $company->name) }}">
                                    {!! render_error('name') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                CEO name
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('name_person')}}">
                                    <input type="text" placeholder="name_person" class="form-control" name="name_person" value="{{ old('name_person', $company->name_person) }}">
                                    {!! render_error('name_person') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Email company
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('email_company')}}">
                                    <input type="text" placeholder="email_company" class="form-control" name="email_company" value="{{ old('email_company', $company->email_company) }}">
                                    {!! render_error('email_company') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Phone company
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('phone_company')}}">
                                    <input type="text" placeholder="phone_company" class="form-control" name="phone_company" value="{{ old('phone_company', $company->phone_company) }}">
                                    {!! render_error('phone_company') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Fax company
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('fax_company')}}">
                                    <input type="text" placeholder="fax_company" class="form-control" name="fax_company" value="{{ old('fax_company', $company->fax_company) }}">
                                    {!! render_error('fax_company') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Address
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('address')}}">
                                    <textarea maxlength="2000" class="form-control" name="address" placeholder="Address" style="height: 100px;"
                                    >{{ old('address', $company->address) }}</textarea>
                                    {!! render_error('address') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-3" style="position: relative">
                        <button type="submit" class="btn button-purple border-circle" style="min-width: 145px;" ><img
                            src="{{ asset('images/icon-check.svg') }}">Save</button>
                        <a href="{{ route('admin.companies') }}" class="btn btn-dark-back" style="position: absolute;
                        margin: 0;
                        top: 11px;">
                            <img src="{{ asset('images/icon-back.svg') }}">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
