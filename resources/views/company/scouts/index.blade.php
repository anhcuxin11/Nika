@extends('company.layouts.app')

@section('title',"Nika")
@section('meta')
    <meta property="og:title" content="">
    <meta property="og:type" content="Web site">
    <meta property="og:image" content="">
    <meta property="og:keywords" content="">
    <meta name="description" content="">
@endsection

@section('content')
@php
    use App\Models\Job;
    use App\Models\Resume;
@endphp
    <div class="body-content" id="messages">
        <div class="container-fluid">
            <div class="row">
                <div class="mt-3 w-100">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item ml-2 mr-5" role="presentation">
                            <h2>Scouts</h2>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mx-1 {{ $activeTab == 1 ? 'active' : 'inactive' }}" id="tab1-tab" href="{{ route('company.scouts.search', ['tab' => 1]) }}">
                                <img src="{{ asset('images/icon-edit-underline.svg') }}">Search</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mx-1 {{ $activeTab == 2 ? 'active' : 'inactive' }}" id="tab2-tab" href="{{ route('company.scouts.search', ['tab' => 2]) }}">
                                <img src="{{ asset('images/icon-monitor-gray.svg') }}">Review</a>
                        </li>
                    </ul>
                    @include('company.includes.messages')
                    <div style="margin: 0 136px">
                        <div class="mt-3">
                            <h2>Candidate selection</h2>
                        </div>
                        <form class="form-search mt-3" action="{{ route('company.scouts.result') }}" method="GET">
                            {{-- @csrf --}}
                            <div class="d-flex align-items-center" style="column-gap: 45px">
                                <input type="text" class="form-control ml-10" name="key_basic"
                                maxlength="100"
                                placeholder="ID/Name/Address"
                                value="{{ old('key_basic', request()->input('key_basic')) }}">
                                <input type="text" class="form-control ml-10" name="key_exp"
                                maxlength="100"
                                placeholder="Certificate/Skill"
                                value="{{ old('key_exp', request()->input('key_exp')) }}">
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-3">
                                <div>
                                    <div>Age</div>
                                    <div class="d-flex align-items-center" style="width: 376px;">
                                        <select class="custom-select w-140" name="age_min" style="margin: 0; width: 172px">
                                            <option value="">No limit</option>
                                            @foreach (range(18,60) as $age)
                                                <option value="{{ $age }}" @if (request()->input('age_min') == $age) selected @endif>{{ $age }} Age</option>
                                            @endforeach
                                        </select>
                                        <span class="ml-2 mr-2">〜</span>
                                        <select class="custom-select w-140" name="age_max" style="margin: 0; width: 172px">
                                            <option value="">No limit</option>
                                            @foreach (range(18,60) as $age)
                                                <option value="{{ $age }}" @if (request()->input('age_max') == $age) selected @endif>{{ $age }} Age</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div>Salary/Month</div>
                                    <div class="d-flex align-items-center" style="width: 376px;">
                                        <select class="custom-select w-140" name="salary_min" style="margin: 0; width: 172px">
                                            <option value="">No limit</option>
                                            @foreach (range(200, 3000, 200) as $salary)
                                                <option value="{{ $salary }}" @if (request()->input('salary_min') == $salary) selected @endif>{{ $salary }} USD</option>
                                            @endforeach
                                        </select>
                                        <span class="ml-2 mr-2">〜</span>
                                        <select class="custom-select w-140" name="salary_max" style="margin: 0; width: 172px">
                                            <option value="">No limit</option>
                                            @foreach (range(200, 3000, 200) as $salary)
                                                <option value="{{ $salary }}" @if (request()->input('salary_max') == $salary) selected @endif>{{ $salary }} USD</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-3" style="border-bottom: 2px solid #eee; padding-bottom: 15px">
                                <div>Occupation</div>
                                <div class="pt-2" >
                                    <company-select-job
                                    name="occupation"
                                    :title-label="`Please select the desired occupation`"
                                    :data-collapse="{{ $occupations }}"
                                    :data-selected="{{ collect(request()->input('occupation')) }}"
                                    inline-template>
                                        @include('company.component.select_job', ['buttonName' => 'Select occupation'])
                                    </company-select-job>
                                </div>
                            </div>
                            <div class="pt-3" style="border-bottom: 2px solid #eee; padding-bottom: 15px">
                                <div>Industry</div>
                                <div class="pt-2">
                                    <company-select-job
                                    name="industry"
                                    :title-label="`Please select the desired industry`"
                                    :data-collapse="{{ $industries }}"
                                    :data-selected="{{ collect(request()->input('industry')) }}"
                                    inline-template>
                                        @include('company.component.select_job', ['buttonName' => 'Select industry'])
                                    </company-select-job>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-purple mt-4 mb-2">
                                <img src="{{ asset('images/icon-search-lg.svg') }}">Search
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
