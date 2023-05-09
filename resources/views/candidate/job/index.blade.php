@extends('candidate.layouts.main')
@push('styles')
    <style>
        .job-item::before {
            position: absolute;
            top: -2px;
            right: -2px;
            display: block;
            width: 30px;
            height: 60px;
            background: url(/images/common_bg01.png) right top no-repeat;
            content: "";
        }
    </style>
@endpush
@section('content')
@php
    use App\Models\Job;
    use App\Models\Location;
    use App\Models\Language;
@endphp
<div class="content-full">
    <div class="jobs-header my-4">
        <div class="result-title"><span class="result-number">24</span> matching jobs</div>
    </div>
    <div class="job-content d-flex justify-content-between">
        <div class="job-main">
            <div class="job-condition d-flex justify-content-between">
                <div class="j-c-title">
                    <div class="j-c-t-left">Current Search Conditions</div>
                    <button type="button" class="button-search btn btn-primary mt-3">
                        <span>Search again <img src="{{ asset('images/common_arrow20.png') }}" alt=""></span>
                    </button>
                </div>
                <div class="j-c-des">
                    <div>Job type</div>
                    <div>Salary</div>
                    <div>Language</div>
                    <div>Country</div>
                </div>
            </div>
            <form action="" class="form-job-search mt-3 d-none">
                <div class="d-flex form-search">
                    <div class="search-title w-25">
                        Work Location
                    </div>
                    <div class="search-job-condition w-75 pl-2">
                        <select class="search-select w-25" name="" id="">
                            <option value="">Choose Location</option>
                            @foreach (Location::$name as $key => $item)
                                <option value="{{ $key + 1 }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex form-search">
                    <div class="search-title w-25">
                        Occupation
                    </div>
                    <div class="search-job-condition w-75 pl-2">
                        <select-job
                        name="occupation"
                        :title-label="`Please select the desired industry`"
                        :data-collapse="{{ $occupations }}"
                        :data-selected="{{ collect(request()->input('occupation')) }}"
                        inline-template>
                            @include('candidate.component.select_job', ['buttonName' => 'Select occupation'])
                        </select-job>
                    </div>
                </div>
                <div class="d-flex form-search">
                    <div class="search-title w-25">
                        Industry
                    </div>
                    <div class="search-job-condition w-75 pl-2">
                        <select-job
                        name="industry"
                        :title-label="`Please select the desired industry`"
                        :data-collapse="{{ $industries }}"
                        :data-selected="{{ collect(request()->input('industry')) }}"
                        inline-template>
                            @include('candidate.component.select_job', ['buttonName' => 'Select industry'])
                        </select-job>
                    </div>
                </div>
                <div class="d-flex form-search">
                    <div class="search-title w-25">
                        Desired Salary
                    </div>
                    <div class="search-job-condition w-75 pl-2">
                        <select class="search-select w-25 mb-2" name="" id="">
                            @foreach (Job::$money as $key => $item)
                                <option value="{{ $key + 1 }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <div>
                            <input type="text" class="w-25 input-salary" placeholder="Salary min"> ~ <input type="text" class="w-25 input-salary" placeholder="Salary max">
                        </div>
                    </div>
                </div>
                <div class="d-flex form-search">
                    <div class="search-title w-25">
                        Language Level
                    </div>
                    <div class="search-job-condition w-75 pl-2">
                        <select class="search-select w-25 mb-2" name="" id="">
                            @foreach (Language::$name as $key => $item)
                                <option value="{{ $key + 1 }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <div class="mt-2 d-flex flex-wrap">
                            @foreach (Job::$levels as $key => $item)
                                <div style="width: 30%; display:inline-block; pr-2">
                                    <input type="checkbox" value="{{ $key }}"><span class="pl-2">{{ $item }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="d-flex form-search">
                    <div class="search-title w-25">
                        Age
                    </div>
                    <div class="search-job-condition w-75 pl-2">
                        <input type="text" class="w-25 input-job" placeholder="Age min"> ~ <input type="text" class="w-25 input-job" placeholder="Age max">
                    </div>
                </div>
                <div class="d-flex form-search">
                    <div class="search-title w-25">
                        Keyword
                    </div>
                    <div class="search-job-condition w-75 pl-2">
                        <input type="text" name="" id="" class="input-job w-100" placeholder="Industry, occupation, location,...">
                    </div>
                </div>
                <input type="submit" class="button-search btn btn-primary mt-3 m-auto d-block" value="Search">
            </form>
            <div class="job-body my-3 job-paginate d-flex align-items-center">
                <div class="job-body-time mr-auto">
                    <select class="search-select w-100" name="" id="" style="width: 100%;">
                        <option value="">New</option>
                        <option value="">Salary</option>
                    </select>
                </div>
                <div class="result-title"><span class="result-number">{{ $jobs->total() }}</span> matching jobs, <span class="result-number">{{ $jobs->firstItem() }}〜{{ $jobs->lastItem() }}</span>item</div>
                <div class="job-paginate-result">
                    {{ $jobs->onEachSide(4)->links('custom.pagination.bootstrap') }}
                </div>
            </div>
            @foreach ($jobs as $job)
                <div class="job-item">
                    <div>
                        @foreach ($job->locations as $location)
                            <span class="j-location-item mr-1">
                                <span>{{ $location->name }}</span>
                            </span>
                        @endforeach
                    </div>
                    <div class="my-3">
                        <a href="#" class="j-item-title" style="font-size: 18px;">{{ $job->job_title }}</a>
                    </div>
                    <div class="j-language">
                        @foreach ($job->languages as $language)
                            <span class="item-language mr-2">
                                <span>★ {{ $language->name }}</span>
                            </span>
                        @endforeach
                    </div>
                    <div class="job-item-content pt-3">
                        <table class="mb-2">
                            <tbody>
                                <tr>
                                    <th><span>Recruiter</span></th>
                                    <td>Hina Inc.</td>
                                </tr>
                                <tr>
                                    <th><span>Industry</span></th>
                                    <td>{{ $job->industry_labels }}</td>
                                </tr>
                                <tr>
                                    <th><span>Workplace</span></th>
                                    <td>{{ $job->location_labels }}</td>
                                </tr>
                                <tr>
                                    <th><span>Salary</span></th>
                                    <td>{{ $job->salary_min }} ~ {{ $job->salary_max }} {{ Job::$money[$job->salary_type] }}</td>
                                </tr>
                                <tr>
                                    <th><span>Required skills</span></th>
                                    <td>
                                        <p style="font-weight: 700">Required skills</p>
                                        <p>English: {{ Job::$levels[$job->english_level] }}</p>
                                        <p>{!! $job->must_condition !!}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="item-c-button">
                            <div class="item-favorite">
                                <form action="">
                                    <input type="hidden">
                                    <button type="submit" class="b-favorite mr-2">Favorite</button>
                                </form>
                            </div>
                            <a href="" class="job-information">Information</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="job-body mt-3 job-paginate d-flex align-items-center justify-content-end">
                <div class="result-title"><span class="result-number">{{ $jobs->total() }}</span> matching jobs, <span class="result-number">{{ $jobs->firstItem() }}〜{{ $jobs->lastItem() }}</span>item</div>
                <div class="job-paginate-result">
                    {{ $jobs->onEachSide(4)->links('custom.pagination.bootstrap') }}
                </div>
            </div>
        </div>
        <div class="job-add">
            <div class="j-recently">
                <div class="sec-title">
                    <img src="{{ asset('images/icon-guide.svg') }}" alt=""> Recently Viewed Jobs
                </div>
                <p class="sec-content">There are no recently viewed jobs.</p>
            </div>
            <div class="j-favorite">
                <div class="sec-title">
                    <img src="{{ asset('images/icon-interest.svg') }}" alt=""> Favorites list
                </div>
                <p class="sec-content">There are no jobs marked as interested.</p>
            </div>
            <a href="#" class="sec-detail"> show all <img src="{{ asset('images/icon-arrow-line-right-black.svg') }}" alt=""></a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        $(function () {
            $('.button-search').on('click', function () {
                if ($('.form-job-search').hasClass('d-block')) {
                    $('.form-job-search').removeClass('d-block');
                    $('.form-job-search').addClass('d-none');
                } else {
                    $('.form-job-search').removeClass('d-none');
                    $('.form-job-search').addClass('d-block');
                }
            })
        });
    </script>
@endpush
