@extends('candidate.layouts.main')

@section('content')
@php
    use App\Models\Location;
    use App\Models\Language;
    use App\Models\Occupation;
@endphp
<div class="content-full">
    <div class="avatar">
        <img width="1102" height="364" src="{{ asset('images/my-home.png') }}" alt="my home avatar">
    </div>
    <form action="{{ route('candidate.job.index') }}" method="GET">
        <div class="quick-search">
            <div class="search-title">Quick search</div>
            <p class="counter">Jobs that match your search criteria
                <span class="roboto">0</span>Jobs
            </p>
            <div class="search-condition">
                <div class="s-c-select">
                    <select class="search-select" name="location" id="">
                        <option value="">Choose Country</option>
                        @foreach (Location::$name as $key => $item)
                            <option @if (request()->input('location') == $key) selected @endif value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="s-c-select">
                    <select class="search-select" name="language" id="">
                        <option value="">Choose Language</option>
                        @foreach (Language::$name as $key => $item)
                            <option @if (request()->input('language') == $key) selected @endif value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="s-c-select">
                    <select class="search-select" name="" id="">
                        <option value="">Choose Occupation</option>
                        @foreach (Occupation::$name as $key => $item)
                            <option value="{{ $key + 1 }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="s-c-keyword">
                    <input class="s-c-input" type="text" placeholder="Search by Keyword">
                </div>
            </div>
            <div class="d-flex flex-row-reverse quick-search-submit">
                <button type="submit" class="btn btn-primary d-flex align-items-end">Search</button>
                <a href="#" class="d-flex align-items-center">Advanced Search</a>
            </div>
        </div>
    </form>
    <div class="mt-4">
        <div class="card-jobs">
            <div class="card card-location" style="width: 72%;">
                <div class="card-header">
                    <div>
                        <img width="24" height="24" src="{{ asset('images/icon-spot.svg') }}"  alt="">
                        <span class="small-sub-title mb-sub-title">Jobs By Location</span>
                        <div class="card-border"></div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="location content-location">
                        @foreach ($data['locations'] as $location)
                            <a href="{{route('candidate.job.index', ['location_id' => $location->id])}}">- {{ $location->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card card-location" style="width: 25%;">
                <div class="card-header">
                    <img width="24" height="24" src="{{ asset('images/icon-book.svg') }}"  alt="">
                    <span class="small-sub-title mb-sub-title">Language</span>
                    <div class="card-border"></div>
                </div>
                <div class="card-content">
                    <div class="location d-flex flex-column">
                        @foreach ($data['languages'] as $language)
                            <a href="{{ route('candidate.job.index', ['language_id' => $language->id]) }}">- {{ $language->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 feature">
        <div class="feature-jobs">
            <div class="card">
                <div class="card-header">
                    <img width="24" height="24" src="{{ asset('images/icon-job-black.svg') }}"  alt="">
                    <span class="small-sub-title mb-sub-title">Jobs By Feature</span>
                    <div class="card-border"></div>
                </div>
                <div class="card-content">
                    <div class="feature-flex d-flex justify-content-between">
                        @foreach ($data['features'] as $index => $feature)
                            <a href="{{ route('candidate.job.index' , ['feature_id' => [$feature->id]]) }}">
                                <div class="feature-item">
                                    <img src="{{ asset("images/feature/feature_{$index}.png") }}" alt="" class="img-content">
                                    <div class="l-content" style="">
                                        <div class="location-title">{{ $feature->name }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 company">
        <div class="r-company d-flex justify-content-between">
            <div class="c-j-name" style="width: 66%;">
                <div class="c-header">
                    <img width="24" height="24" src="{{ asset('images/icon-building-white.svg') }}"  alt="">
                    <span class="small-sub-title mb-sub-title">Recommended Company</span>
                    <div class="c-border" style="width: 235px;"></div>
                </div>
                <div class="c-content mt-3">
                    <div class="d-flex justify-content-between company-flex">
                        @foreach ($data['companies'] as $company)
                            <a href="{{ route('candidate.companies', ['id' => $company->id]) }}" class="c-detail">
                                <div class="c-d-content d-flex">
                                    <div class="c-d-content-left">
                                        <img src="{{ asset('storage/' . $company->upload_file_path) }}" alt="">
                                    </div>
                                    <div class="c-d-content-right">
                                        <div class="c-des">{{ $company->name }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="c-j-name" style="width: 31%;">
                <div class="c-header">
                    <span class="small-sub-title mb-sub-title">Recommended Jobs</span>
                    <div class="c-border" style="width: 175px;"></div>
                </div>
                <div class="j-content" style="padding: 20px 0;">
                    <div class="job-flex d-flex justify-content-between">
                        @foreach ($data['jobs'] as $job)
                            <a href="{{ route('candidate.job.show', ['id' => $job->id]) }}" class="j-detail">
                                <div class="j-d-content d-flex">
                                    <div class="j-d-content-left">
                                        <img src="{{ asset('storage/' . $job->company->upload_file_path) }}" alt="">
                                    </div>
                                    <div class="j-d-content-right">
                                        <div class="j-des">{{ $job->job_title }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <a href="{{ route('candidate.job.index') }}" class="mt-2 d-block all-job">All jobs
                        <img src="{{ asset('images/icon-arrow-line-right-gray.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 news">
        <div class="news-header">
            <img width="24" height="24" src="{{ asset('images/icon-light.svg') }}"  alt="">
            <span class="small-sub-title mb-sub-title">Useful Tips & Info</span>
            <div class="news-border"></div>
        </div>
        <div class="my-2">Let's use it for job change activities and career advancement! !</div>
        <div class="news-content d-flex justify-content-between">
            @foreach (range(1, 4) as $item)
                <a href="#">
                    <img class="news-img" src="{{ asset('images/feature/recommend.webp') }}" alt="">
                    <div>-2023/05/05</div>
                    <div>News title</div>
                    <div>News des</div>
                    <div class="mt-2 d-block news-detail">Detail
                        <img src="{{ asset('images/icon-arrow-line-right-gray.svg') }}" alt="">
                    </div>
                </a>
            @endforeach
        </div>
        <a href="#" class="mt-2 d-flex justify-content-center click-here">Click here for the list of news
            <img src="{{ asset('images/icon-arrow-line-right-gray.svg') }}" alt="">
        </a>
    </div>
</div>
@endsection
