@extends('candidate.layouts.main')
@push('styles')
    <style>
        .location-title::before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            margin-top: -8px;
            width: 16px;
            height: 16px;
            background-image: url(/images/icon-briefcase.svg);
            background-size: 16px;
            background-position: center;
            background-repeat: no-repeat;
        }
        .c-d-content-right::after {
            content: "";
            position: absolute;
            right: 0;
            margin-top: -40px;
            width: 16px;
            height: 16px;
            text-decoration: none;
            background: url(/images/common_arrow03.png) no-repeat right center;
        }
    </style>
@endpush
@section('content')
<div class="content-full">
    <div class="avatar">
        <img width="1102" height="364" src="{{ asset('images/my-home.png') }}" alt="my home avatar">
    </div>
    <form action="">
        <div class="quick-search" style="position: relative;
        background: url(/images/pixels.gif) repeat right top;
        width: 1102px;
        margin: 30px auto 0 auto;
        padding: 24px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;">
            <div class="search-title" style="
            padding: 0 0 0 48px;
            margin-bottom: 16px;
            background: url(/images/quick-search.png) no-repeat left center;
            font-size: 24px;
            font-weight: bold;">Quick search</div>
            <p class="counter" style="position: absolute;
            top: 16px;
            right: 30px;
            font-weight: 700;">Jobs that match your search criteria
                <span class="roboto" style="font-size: 36px;
                margin: 0 3px 0 8px;
                color: #1eb216;">0</span>Jobs
            </p>
            <div class="search-condition" style="display: flex; height: 36px;margin: 0;
            padding: 0;">
                <div style="width: 20%; margin-right: 16px;">
                    <select class="search-select" name="" id="" style="width: 100%;">
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
                <div style="width: 20%; margin-right: 16px;">
                    <select class="search-select" name="" id="" style="width: 100%;">
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
                <div style="width: 20%; margin-right: 16px;">
                    <select class="search-select" name="" id="" style="width: 100%;">
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
                <div style="width: calc(40% - 48px);">
                    <input type="text" style=" background-color: white !important;
                    width: 100%;
                    height: 34px;
                    padding: 6px 5px;
                    border: 2px solid #111111;
                    border-radius: 4px;
                    box-sizing: border-box;
                    background: none;
                    font-size: 16px;
                    line-height: 22px;
                    cursor: pointer;">
                </div>
            </div>
            <div class="d-flex flex-row-reverse" style="
            margin-top: 30px">
                <button type="submit" class="btn btn-primary" style="width: 100px;">Search</button>
                <a href="#" style="margin-right: 13px;
                display: flex;
                align-items: end;">Advanced Search</a>
            </div>
        </div>
    </form>
    <div class="mt-4">
        <div class="card-jobs" style=" display: flex;
        justify-content: space-between;">
            <div class="card" style="width: 72%; border: 2px solid; padding: 10px 20px;">
                <div class="card-header" style="background-color: white; border: none; padding: 0;">
                    <div>
                        <img width="24" height="24" src="{{ asset('images/icon-spot.svg') }}"  alt="">
                        <span class="small-sub-title mb-sub-title">Jobs By Location</span>
                        <div style="border: 1px solid #1a1a1a;
                        margin-top: 5px;"></div>
                    </div>
                </div>
                <div class="card-content" style="padding: 14px 0;">
                    <div class="location" style="display: flex;
                    justify-content: space-between;
                    flex-wrap: wrap;">
                        @foreach (range(1, 16) as $item)
                            <a href="#" style="width: 180px; line-height: 26px;">$item</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card" style="width: 25%; border: 2px solid; padding: 10px 20px;">
                <div class="card-header" style="background-color: white; border: none; padding: 0;">
                    <img width="24" height="24" src="{{ asset('images/icon-book.svg') }}"  alt="">
                    <span class="small-sub-title mb-sub-title">Language</span>
                    <div style="border: 1px solid #1a1a1a;
                        margin-top: 5px;"></div>
                </div>
                <div class="card-content" style="padding: 14px 0;">
                    <div class="location d-flex flex-column">
                        @foreach (range(1, 4) as $item)
                            <a href="#" style="width: 180px; line-height: 26px;">$item</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 feature">
        <div class="feature-jobs">
            <div class="card" style="border: 4px solid #efefef; padding: 10px 20px;">
                <div class="card-header" style="background-color: white; border: none; padding: 0;">
                    <img width="24" height="24" src="{{ asset('images/icon-job-black.svg') }}"  alt="">
                    <span class="small-sub-title mb-sub-title">Jobs By Feature</span>
                    <div style="border: 1px solid #efefef;
                        margin-top: 5px;"></div>
                </div>
                <div class="card-content" style="padding: 14px 0;">
                    <div class="location" style="display: flex;
                    justify-content: space-between;
                    row-gap: 20px;
                    flex-wrap: wrap;">
                        @foreach (range(1, 12) as $item)
                            <a href="#" style="width: 250px; line-height: 26px;">
                                <div style="display: block; position: relative">
                                    <img src="{{ asset('images/feature/recommend.webp') }}" alt="" style="width: 100%; height: 167px">
                                    <div class="l-content" style="position: absolute;
                                    width: 250px;
                                    padding: 10px;
                                    bottom:0;
                                    backdrop-filter: blur(10px);
                                    color: white">
                                        <div class="location-title" style="position: relative;
                                        padding-left: 24px;
                                        background-image: url({{ asset('images/icon-arrow-right.svg') }});
                                        background-position: center right 5px;
                                        background-repeat: no-repeat;
                                        font-size: 14px;
                                        font-weight: 700;
                                        color: white;
                                        line-height: 26px;
                                        transition: all 0.3s;">$item</div>
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
        <div class="r-company" style=" display: flex;
        justify-content: space-between;">
            <div class="c-j-name" style="width: 66%; border-top: 4px solid #1a1a1a; padding: 10px 0;">
                <div class="c-header" style="background-color: white; border: none; padding: 0; font-size: 20px;
                line-height: 28px;">
                    <img width="24" height="24" src="{{ asset('images/icon-building-white.svg') }}"  alt="">
                    <span class="small-sub-title mb-sub-title">Recommended Company</span>
                    <div style="border: 1px solid #efefef; width: 235px;
                        margin-top: 5px;"></div>
                </div>
                <div class="c-content" style="padding: 14px 0;">
                    <div class="d-flex justify-content-between" style="row-gap: 20px;
                    flex-wrap: wrap;">
                        @foreach (range(1, 4) as $item)
                            <a href="#" class="c-detail" style="width: 345px; color:#1a1a1a">
                                <div class="c-d-title pb-2">Company name</div>
                                <div class="c-d-content d-flex">
                                    <div class="c-d-content-left">
                                        <img src="{{ asset('images/feature/recommend.webp') }}" alt="" style="width: 130px; padding-right: 10px; height: 80px;">
                                    </div>
                                    <div class="c-d-content-right" style="font-weight: 700; position: relative; width: 100%;">
                                        <div class="c-des" style="color: blue">Company des</div>
                                        <div>Salary<span class="pl-1" style="font-weight: normal;">23</span></div>
                                        <div>Location<span class="pl-1">23</span></div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="c-j-name" style="width: 31%; border-top: 4px solid #1a1a1a; padding: 10px 0px;">
                <div class="c-header" style="background-color: white; border: none; padding: 0; font-size: 20px;
                line-height: 28px;">
                    <span class="small-sub-title mb-sub-title">Recommended Jobs</span>
                    <div style="border: 1px solid #efefef; width: 175px;
                        margin-top: 5px;"></div>
                </div>
                <div class="j-content" style="padding: 20px 0;">
                    <div class="d-flex justify-content-between" style="row-gap: 20px;
                    flex-wrap: wrap;">
                        @foreach (range(1, 2) as $item)
                            <a href="#" class="j-detail" style="width: 100%; color:#1a1a1a">
                                <div class="j-d-content d-flex">
                                    <div class="j-d-content-left">
                                        <img src="{{ asset('images/feature/recommend.webp') }}" alt="" style="width: 130px; padding-right: 10px;">
                                    </div>
                                    <div class="j-right" style="font-weight: 700; width: 100%;">
                                        <div class="j-des" style="color: blue">Job title</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <a href="#" class="mt-2 d-block" style="color: #1a1a1a; text-decoration: underline;">All jobs
                        <img src="{{ asset('images/icon-arrow-line-right-gray.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 news" style="border: 2px solid #1a1a1a; border-radius: 6px; padding: 10px 20px;">
        <div class="news-header">
            <img width="24" height="24" src="{{ asset('images/icon-light.svg') }}"  alt="">
            <span class="small-sub-title mb-sub-title">Useful Tips & Info</span>
            <div style="border: 1px solid #efefef;
                margin-top: 5px;"></div>
        </div>
        <div class="my-2">Let's use it for job change activities and career advancement! !</div>
        <div class="news-content" style="display: flex;
        justify-content: space-between;
        row-gap: 20px;
        flex-wrap: wrap;">
            @foreach (range(1, 4) as $item)
                <a href="#" style="width: 250px; line-height: 26px; border: 4px solid #efefef; border-radius: 6px;">
                    <img src="{{ asset('images/feature/recommend.webp') }}" alt="" style="width: 100%; height: 125px;">
                    <div>-2023/05/05</div>
                    <div>News title</div>
                    <div>News des</div>
                    <div class="mt-2 d-block" style="color: #1a1a1a">Detail
                        <img src="{{ asset('images/icon-arrow-line-right-gray.svg') }}" alt="">
                    </div>
                </a>
            @endforeach
        </div>
        <a href="#" class="mt-2 d-flex justify-content-center" style="color: #1a1a1a; text-decoration: underline;">Click here for the list of news
            <img src="{{ asset('images/icon-arrow-line-right-gray.svg') }}" alt="">
        </a>
    </div>
</div>
@endsection
