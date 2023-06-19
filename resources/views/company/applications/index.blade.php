@extends('company.layouts.app')

@section('title',"NINJA")
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
    use App\Models\Application;
    use App\Models\Resume;
@endphp
<chat-messages inline-template>
    <div class="body-content" id="messages">
        <div class="container-fluid">
            <div class="row">
                <div class="nav-tabs w-100 mt-3 mx-3">
                    <h2>Applications</h2>
                </div>
                <div class="mt-3 mx-3 w-100">
                    @include('company.includes.messages')
                    <form class="form-search mt-3" action="{{ route('company.applications') }}" method="GET">
                        <div class="d-flex align-items-center" style="column-gap: 45px">
                            <input type="text" class="form-control ml-10" name="key_job"
                            maxlength="100"
                            placeholder="ID/Title/Description (Job)"
                            value="{{ old('key_job', request()->input('key_job')) }}">
                            <input type="text" class="form-control ml-10" name="name_candidate"
                            maxlength="100"
                            placeholder="ID/Name/Occuption (Candidate)"
                            value="{{ old('name_candidate', request()->input('name_candidate')) }}">
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
                            <div>
                                <div>Status</div>
                                <div class="d-flex align-items-center">
                                    <select class="custom-select w-140" name="status" style="margin: 0; width: 172px">
                                        <option value="">Choose status</option>
                                        @foreach (Application::$status as $key => $item)
                                            <option @if (request()->input('status') != '' && request()->input('status') == $key) selected @endif value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-purple mt-4 mb-2">
                            <img src="{{ asset('images/icon-search-lg.svg') }}">Search
                        </button>
                    </form>
                    <div class="mt-5">
                        <div class="job-body job-paginate d-flex align-items-center justify-content-end" style="color: black">
                            <div class="result-title"><span class="result-number">{{ $applications->total() }}</span> matching applications, <span class="result-number">{{ $applications->firstItem() }}〜{{ $applications->lastItem() }}</span>item</div>
                            <div class="job-paginate-result">
                                {{ $applications->onEachSide(4)->links('custom.pagination.bootstrap') }}
                            </div>
                        </div>
                    </div>
                    @foreach ($applications as $application)
                        @php
                            $candidate = $application->candidate;
                            $job = $application->job;
                        @endphp

                        <div class="form-search m-2 d-flex p-0" style="font-size: 15px;">
                            <div class="f-person p-3 d-flex">
                                <div class="person-basic pr-1">
                                    <div class="d-flex justify-content-center">
                                        @if($candidate->resume->sex == Resume::$sex['female'])
                                            <img src="{{ asset('images/image-woman-circle.svg') }}" class="woman-circle">
                                        @else
                                            <img src="{{ asset('images/image-man-circle.svg') }}" class="woman-circle">
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        No.{{ $candidate->id }}
                                    </div>
                                    <div class="text-center pb-3">
                                        {{ $candidate->resume->age }} / {{ $candidate->full_name }}
                                    </div>
                                    <div class="text-left text-des" title="{{ $candidate->resume->hobby }}">
                                        <span class="font-weight-bold">Hobby:</span> {!! $candidate->resume->hobby !!}
                                    </div>
                                    <div class="text-left text-des" title="{{ $candidate->resume->certificate }}">
                                        <span class="font-weight-bold">Certificate:</span> {!! $candidate->resume->certificate !!}
                                    </div>
                                    <div class="text-left">
                                        <p class="font-weight-bold p-0 m-0">CV:</p>
                                        @if ($candidate->attachment)
                                            <a href="{{ asset('storage/' . optional($candidate->attachment)->upload_file_path) }}">{{ optional($candidate->attachment)->upload_file_name }}</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="person-exp pl-1">
                                    <div class="text-left mb-2 text-des" title="{{ $candidate->resume->skill }}">
                                        <span class="font-weight-bold">Skill:</span> {{ $candidate->resume->skill }}
                                    </div>
                                    <div class="text-left mb-2 text-des" title="{{ $candidate->resume->industry_labels }}">
                                        <span class="font-weight-bold">Industries:</span> {{ $candidate->resume->industry_labels }}
                                    </div>
                                    <div class="text-left mb-2 text-des" title="{{ $candidate->resume->occupation_labels }}">
                                        <span class="font-weight-bold">Occupations:</span> {{ $candidate->resume->occupation_labels }}
                                    </div>
                                    <div class="text-left mb-2 text-des" style="margin-bottom: 45px">
                                        <span class="font-weight-bold">Current salary:</span> {{ $candidate->resume->current_salary }} USD
                                    </div>
                                    <div class="d-flex justify-content-end justify-self-end btn-area">
                                        <div class="d-flex">
                                            @if ($application->status == 0)
                                            <button type="button" class="btn-custom" style="background-color: red" @click.prevent="updateStatus({{$application->id}}, '2')">Incompatible</button>
                                            <button type="button" class="btn-custom" style="background-color: #339f0f" @click.prevent="updateStatus({{$application->id}}, '1')">Compatible</button>
                                            @else
                                                <div class="btn-custom" style="background-color: #999">@if ($application->status == 1) Compatible @else Incompatible @endif</div>
                                            @endif
                                            <button type="button" class="btn-custom" @click.prevent="showMessage({{$job->id}}, {{$candidate->id}})">Chat</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="f-job p-3">
                                <small style="color: #BFBFBF">{{$job->job_no}}</small>
                                <div class="heading" style="font-size: 16px;">{{ $job->job_title }}</div>
                                <div style="font-size: 14px; color: #C7C7C7">{{ $job->company->name }}</div>
                                <div class="pt-2">
                                    Occupation:&ensp;{{ $job->occupation_labels }}
                                </div>
                                <div>
                                    Salary: {{ $job->salary_min }} ~ {{ $job->salary_max }} {{ Job::$money[$job->salary_type] }}
                                </div>
                                <small class="date-time" style="color: #BFBFBF">{{ $application->created_at }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
                @include('company.component.message-modal')
            </div>
        </div>
    </div>
</chat-messages>
@endsection
@push('scripts')
@endpush
