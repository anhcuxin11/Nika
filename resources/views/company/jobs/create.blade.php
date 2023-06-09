@extends('company.layouts.app')

@section('title', 'Nika')
@section('meta')
    <meta property="og:title" content="">
    <meta property="og:type" content="Web site">
    <meta property="og:image" content="">
    <meta property="og:keywords" content="">
    <meta name="description" content="">
@endsection

@php
  use App\Models\Job;
  use App\Models\Company;
  use App\Models\Location;
  use App\Models\Language;
@endphp

@section('content')
<div class="body-content">
    <div class="container-fluid">
        <div class="row">
            <div class="mt-3 mx-3 w-100">
                @include('company.includes.messages')
                <div>
                    <h2>Jobs register</h2>
                </div>
                <form action="{{route('company.jobs.store')}}" method="POST" class="mt-3 form-create">
                    @csrf
                    <input type="hidden" name="preview" id="preview_value" value="">
                    <div class="form-header d-flex">
                        <img src="{{ asset('images/icon-job.svg') }}">
                        <h3 class="m-0">Information</h3>
                    </div>
                    <div class="form-content">
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Job no
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('job_no')}}">
                                    <input type="text" placeholder="Job no" class="form-control" name="job_no" value="{{ old('job_no', request()->input('job_no')) }}">
                                    {!! render_error('job_no') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Title
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('job_title')}}">
                                    <input type="text" placeholder="Job title" class="form-control" name="job_title"
                                    value="{{ old('job_title', request()->input('job_title')) }}">
                                    {!! render_error('job_title') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Description
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('job_detail')}}">
                                    <textarea maxlength="2000" class="form-control" name="job_detail" placeholder="Job description" style="height: 100px;"
                                    >{{ old('job_detail') }}</textarea>
                                    {!! render_error('job_detail') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Location
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('location')}}">
                                    <select class="search-select" name="location" id="">
                                        @foreach (Location::$name as $key => $item)
                                            <option @if (old('location') == $key) selected @endif value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    {!! render_error('location') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Location detail
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('location_detail')}}">
                                    <textarea maxlength="2000" class="form-control" name="location_detail" placeholder="Location detail" style="height: 100px;">
                                        {{ old('location_detail') }}</textarea>
                                    {!! render_error('location_detail') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Education
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('education')}}">
                                    <textarea maxlength="2000" class="form-control" name="education" placeholder="Education" style="height: 100px;">{{ old('education') }}</textarea>
                                    {!! render_error('education') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Language level
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('language')}}">
                                    <select class="search-select w-25" name="language" id="">
                                        @foreach (Language::$name as $key => $item)
                                            <option @if (old('language', request()->input('language')) == $key) selected @endif value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    {!! render_error('language') !!}
                                </div>
                                <div class="mt-2 d-flex flex-wrap">
                                    @foreach (Job::$levels as $key => $item)
                                        @if ($key != 4)
                                        <div style="width: 30%; display:inline-block; pr-2">
                                            <input type="radio" name="language_level" id="language_{{ $key }}" @if (old('language_level', request()->input('language_level')) == $key) checked @endif value="{{ $key }}"><label for="language_{{ $key }}" class="pl-2">{{ $item }}</label>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Occupation
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('occupation')}}">
                                    <div class="search-job-condition w-75 pl-2">
                                        <company-select-job
                                        name="occupation"
                                        :title-label="`Please select the desired occupation`"
                                        :data-collapse="{{ $occupations }}"
                                        :data-selected="{{ old('occupation') ? collect(old('occupation')) : collect() }}"
                                        inline-template>
                                            @include('company.component.select_job', ['buttonName' => 'Select occupation'])
                                        </company-select-job>
                                        {!! render_error('occupation') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Industry
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('industry')}}">
                                    <div class="search-job-condition w-75 pl-2">
                                        <company-select-job
                                        name="industry"
                                        :title-label="`Please select the desired industry`"
                                        :data-collapse="{{ $industries }}"
                                        :data-selected="{{ old('industry') ? collect(old('industry')) : collect() }}"
                                        inline-template>
                                            @include('company.component.select_job', ['buttonName' => 'Select industry'])
                                        </company-select-job>
                                        {!! render_error('industry') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Feature
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('feature')}}">
                                    <select class="search-select w-25" name="feature" id="search-select">
                                        @foreach ($features as $feature)
                                            <option @if (old('feature') == $feature->id) selected @endif value="{{ $feature->id }}">{{ $feature->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! render_error('feature') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Experienced count
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('experienced_count')}}">
                                    <input type="text" placeholder="Experienced count" value="{{ old('experienced_count') }}" class="form-control" name="experienced_count">
                                    {!! render_error('experienced_count') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Age
                            </div>
                            <div class="content-right p-2">
                                <div class="search-job-condition w-75 pl-2">
                                    <div class="{{has_error('age_min')}}">
                                        <input type="text" name="age_min" class="w-25 input-job" value="{{ old('age_min', request()->input('age_min')) }}" placeholder="Age min">
                                        {!! render_error('age_min') !!}
                                    </div>
                                     ~
                                    <div class="{{has_error('age_max')}}">
                                        <input type="text" name="age_max" class="w-25 input-job" value="{{ old('age_max', request()->input('age_max')) }}" placeholder="Age max">
                                        {!! render_error('age_max') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Must condition
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('must_condition')}}">
                                    <textarea maxlength="2000" class="form-control" name="must_condition" placeholder="Must condition" style="height: 100px;">{{ old('must_condition') }}</textarea>
                                    {!! render_error('must_condition') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Salary
                            </div>
                            <div class="content-right p-2">
                                <div class=" w-75 pl-2">
                                    <div class="{{has_error('salary_min')}}">
                                        <input type="text" name="salary_min" class="w-25 input-job" value="{{ old('salary_min', request()->input('salary_min')) }}" placeholder="Salary min">
                                        {!! render_error('salary_min') !!}
                                    </div>
                                     ~
                                    <div class="{{has_error('salary_max')}}">
                                        <input type="text" name="salary_max" class="w-25 input-job" value="{{ old('salary_max', request()->input('salary_max')) }}" placeholder="Salary max">
                                        {!! render_error('salary_max') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Salary detail
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('salary_detail')}}">
                                    <textarea maxlength="2000" class="form-control" name="salary_detail" placeholder="Salary detail" style="height: 100px;">{{ old('salary_detail') }}</textarea>
                                    {!! render_error('salary_detail') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3">
                                Position name
                            </div>
                            <div class="content-right p-2">
                                <div class="{{has_error('position_name')}}">
                                    <input type="text" placeholder="Position name" value="{{ old('position_name', request()->input('position_name')) }}" class="form-control" name="position_name">
                                    {!! render_error('position_name') !!}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="content-left p-3" style="border-bottom-color: #1a1a1a;">
                                Publishing status
                            </div>
                            <div class="content-right p-2">
                                <select class="search-select w-25" name="job_status" id="search-select">
                                    @foreach (Job::$jobStatusLabel as $key => $item)
                                        @if (in_array($key, [0, 1]))
                                        <option @if (old('job_status') == $key) selected @endif value="{{ $key }}">{{ $item }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="my-3" style="position: relative">
                        <button type="submit" class="btn btn-purple border-circle" style="min-width: 145px;" ><img
                            src="{{ asset('images/icon-check.svg') }}">Save</button>
                        <a href="{{ route('company.jobs') }}" class="btn btn-dark-back" style="position: absolute;
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

@push('scripts')
<script>
$(function () {
  $('.input-number').on('input change', function (evt) {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');
  });

  $('.input-integer').on('input change', function (evt) {
    $(this).val(toASCII($(this).val()).replace(/[^0-9０-９]/gi, ''));
  });
})
</script>
@endpush
