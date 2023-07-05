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
        <div class="result-title"><span class="result-number">{{ $jobs->total() }}</span> matching jobs</div>
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
                    @if (request()->input('salary_min') || request()->input('salary_max'))
                        <div>Salary: <span>{{ request()->input('salary_min') ?? 'No limit' }} ~ {{ request()->input('salary_max') ?? 'No limit' }} USD</span></div>
                    @endif
                    @if (request()->input('language'))
                        <div>Language: <span>{{ Language::$name[request()->input('language')] }}</span></div>
                    @endif
                    @if (request()->input('location'))
                        <div>Country: <span>{{ Location::$name[request()->input('location')] }}</span></div>
                    @endif
                    @if (request()->input('age_min') ||  request()->input('age_max'))
                        <div>Age: <span>{{ request()->input('age_min') ?? 'No limit' }} ~ {{ request()->input('age_max') ?? 'No limit' }}</span></div>
                    @endif
                </div>
            </div>
            <form action="{{ route('candidate.job.index') }}" class="form-job-search mt-3 d-none" method="GET">
                <div class="d-flex form-search">
                    <div class="search-title w-25">
                        Work Location
                    </div>
                    <div class="search-job-condition w-75 pl-2">
                        <select class="search-select w-25" name="location" id="search-select">
                            <option value="">Choose Location</option>
                            @foreach (Location::$name as $key => $item)
                                <option @if (request()->input('location') == $key) selected @endif value="{{ $key }}">{{ $item }}</option>
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
                        :title-label="`Please select the desired occupation`"
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
                        <div>
                            <input type="text" value="{{ request()->input('salary_min') ?? '' }}" name="salary_min" class="w-25 input-salary" placeholder="Salary min"> ~ <input type="text" value="{{ request()->input('salary_max') ?? '' }}" name="salary_max" class="w-25 input-salary" placeholder="Salary max"> USD
                        </div>
                    </div>
                </div>
                <div class="d-flex form-search">
                    <div class="search-title w-25">
                        Language Level
                    </div>
                    <div class="search-job-condition w-75 pl-2">
                        <select class="search-select w-25 mb-2" name="language" id="">
                            <option value="">Choose Language</option>
                            @foreach (Language::$name as $key => $item)
                                <option @if (request()->input('language') == $key) selected @endif value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <div class="mt-2 d-flex flex-wrap">
                            @foreach (Job::$levels as $key => $item)
                                <div style="width: 30%; display:inline-block; pr-2">
                                    <input type="checkbox" name="language_levels[]" @if (in_array($key, request()->input('language_levels') ?? [])) checked @endif id="language_{{ $key }}" value="{{ $key }}"><label for="language_{{ $key }}" class="pl-2">{{ $item }}</label>
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
                        <input type="text" value="{{ request()->input('age_min') ?? '' }}" name="age_min" class="w-25 input-job" placeholder="Age min"> ~ <input type="text" value="{{ request()->input('age_max') ?? '' }}" name="age_max" class="w-25 input-job" placeholder="Age max">
                    </div>
                </div>
                <div class="d-flex form-search">
                    <div class="search-title w-25">
                        Keyword
                    </div>
                    <div class="search-job-condition w-75 pl-2">
                        <input type="text" name="key" id="key" class="input-job w-100" value="{{ request()->input('key') ?? '' }}" placeholder="Title, description, education,...">
                    </div>
                </div>
                <input type="submit" class="button-search btn btn-primary mt-3 m-auto d-block" value="Search">
            </form>
            @include('candidate.includes.message')
            <div class="job-body my-3 job-paginate d-flex align-items-center">
                <div class="job-body-time d-flex mr-auto" style="font-size: 20px;
                font-weight: bold;">
                    <a href="{{ request()->fullUrlWithQuery(['new' => '0']) }}" class="mr-3 {{ request()->input('new') == 0 ? 'bor-bottom' : '' }}">All</a>
                    <a href="{{ request()->fullUrlWithQuery(['new' => '1']) }}" class="{{ request()->input('new') == 1 ? 'bor-bottom' : '' }}">New</a>
                </div>
                @if ($jobs->total() > 0)
                <div class="result-title"><span class="result-number">{{ $jobs->total() }}</span> matching jobs, <span class="result-number">{{ $jobs->firstItem() }}〜{{ $jobs->lastItem() }}</span>item</div>
                <div class="job-paginate-result">
                    {{ $jobs->onEachSide(4)->links('custom.pagination.bootstrap') }}
                </div>
                @endif
            </div>
            @forelse ($jobs as $job)
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
                                    <td>{{ $job->salary_min }} ~ {{ $job->salary_max }} USD</td>
                                </tr>
                                <tr>
                                    <th><span>Required skills</span></th>
                                    <td>
                                        <p style="font-weight: 700">Required skills</p>
                                        @if ($job->languages->first())
                                            <p>{{ $job->languages->first()->name }}: {{ Job::$levels[$job->languages->first()->pivot->level] }}</p>
                                        @endif
                                        <p>{!! $job->must_condition !!}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="item-c-button">
                            @if (auth('web')->check() && $job->isFavorite(auth('web')->user()->id))
                                <div class="item-favorite">
                                    <form action="{{ route('candidate.favorite.store', ['job_id' => $job->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" style="opacity: 0.6" disabled class="b-favorite mr-2">Favorite</button>
                                    </form>
                                </div>
                            @else
                                <div class="item-favorite">
                                    <form action="{{ route('candidate.favorite.store', ['job_id' => $job->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="b-favorite mr-2">Favorite</button>
                                    </form>
                                </div>
                            @endif

                            <a href="{{ route('candidate.job.show', ['id' => $job->id]) }}" class="job-information">Information</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="para-box">
                    <h3>There are no matching jobs</h3>
                </div>
            @endforelse
            @if ($jobs->total() > 0)
            <div class="job-body mt-3 job-paginate d-flex align-items-center justify-content-end">
                <div class="result-title"><span class="result-number">{{ $jobs->total() }}</span> matching jobs, <span class="result-number">{{ $jobs->firstItem() }}〜{{ $jobs->lastItem() }}</span>item</div>
                <div class="job-paginate-result">
                    {{ $jobs->onEachSide(4)->links('custom.pagination.bootstrap') }}
                </div>
            </div>
            @endif
        </div>
        <div class="job-add">
            <div class="j-recently">
                <div class="sec-title">
                    <img src="{{ asset('images/icon-guide.svg') }}" alt=""> Recently Viewed Jobs
                </div>
                @forelse ($jobRecents as $jobRecent)
                    <p class="sec-content">
                        <a href="{{ route('candidate.job.show', ['id' => $jobRecent->id]) }}"><span> {{ $jobRecent->job_title }} </span></a>
                    </p>
                @empty
                    <p class="sec-content">There are no recently viewed jobs.</p>
                @endforelse
            </div>
            <div class="j-favorite">
                <div class="sec-title">
                    <img src="{{ asset('images/icon-interest.svg') }}" alt=""> Favorites list
                </div>
                @forelse ($favorites as $favorite)
                <p class="sec-content" style="word-wrap: break-word;
                word-break: break-word;">
                  <a href="{{ route('candidate.job.show', ['id' => $favorite->job->id]) }}"><span> {{ $favorite->job->job_title }} </a>
                </p>
                @empty
                <p class="sec-content">There are no jobs marked as interested.</p>
                @endforelse
            </div>
            <a href=" {{route('candidate.favorite.index')}} " class="sec-detail"> show all <img src="{{ asset('images/icon-arrow-line-right-black.svg') }}" alt=""></a>
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
