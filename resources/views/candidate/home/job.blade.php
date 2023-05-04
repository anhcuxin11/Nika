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
<div class="content-full">
    <div class="jobs-header my-4">
        <div class="result-title" style="font-size: 22px;
        font-weight: 600;"><span class="result-number" style="color: green;
        font-size: 30px;
        font-weight: bold;">24</span> matching jobs</div>
    </div>
    <div class="job-content d-flex justify-content-between" style="display: flex;">
        <div class="job-main" style="width: 75%;">
            <div class="job-condition d-flex justify-content-between" style="padding: 10px; border: 4px solid #efefef;">
                <div class="j-c-title" style="width: 22%; border-right: 2px solid #efefef;">
                    <div class="j-c-t-left" style="font-size: 18px;
                    font-weight: 600;">Current Search Conditions</div>
                    <button type="button" class="button-search btn btn-primary mt-3">
                        <span>Search again <img src="{{ asset('images/common_arrow20.png') }}" alt=""></span>
                    </button>
                </div>
                <div class="j-c-des" style="width: 75% ;line-height: 26px; font-weight: 600;">
                    <div>Job type</div>
                    <div>Salary</div>
                    <div>Language</div>
                    <div>Country</div>
                </div>
            </div>
            <div class="my-3 job-paginate d-flex align-items-center">
                <div style="width: 20%; margin-right: 16px;">
                    <select class="search-select" name="" id="" style="width: 100%;">
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
                <div class="result-title" style="font-size: 22px; margin-right: 16px;
                font-weight: 600;"><span class="result-number" style="color: green;
                font-size: 30px;
                font-weight: bold;">24</span> matching jobs, <span class="result-number" style="color: green;
                font-size: 30px;
                font-weight: bold;">1〜25</span>item</div>
                <div>paginate</div>
            </div>
            @foreach (range(1, 5) as $item)
                <div class="job-item" style="position: relative;
                border: 2px solid #1a1a1a;
                -moz-box-shadow: #e5e5e5 0 5px 0 0;
                -webkit-box-shadow: #e5e5e5 0 5px 0 0;
                box-shadow: #e5e5e5 0 5px 0 0;margin-bottom: 16px; padding: 16px 32px">
                    <div>
                        @foreach (range(1, 1) as $item)
                            <span class="j-language mr-1">
                                <span style="font-size: 12px;
                                line-height: 12px;
                                background-color: #339f0f;
                                color: #fff;
                                text-transform: uppercase;
                                padding: 3px 6px;
                                border-radius: 2px;
                                margin-right: 10px;">direct hire jobs</span>
                            </span>
                        @endforeach
                    </div>
                    <div class="my-3">
                        <a href="#" class="j-item-title" style="color: #006; text-decoration: underline;">title</a>
                    </div>
                    <div class="j-language">
                        @foreach (range(1, 2) as $item)
                            <span class="item-language mr-2" style="display: inline-block;
                            padding: 0 16px;
                            border-radius: 24px;
                            border: 1px solid #006;
                            background: #fff;">
                                <span style="font-weight: 700;
                                color: #006;">★ English</span>
                            </span>
                        @endforeach
                    </div>
                    <div class="job-item-content pt-3">
                        <table class="mb-2">
                            <tbody>
                                @foreach (range(1, 5) as $item)
                                    <tr style="border-bottom: 1px solid #dfdfdf;">
                                        <th style="width: 120px; padding: 8px 0; vertical-align: top;"><span style="display: block;
                                            background: #000;
                                            color: #fff;
                                            text-align: center;">Recruiter</span></th>
                                        <td style="width: 590px; word-break: break-word;
                                        word-wrap: break-word; padding: 8px 0 8px 24px;">$Name company</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="item-c-button" style="padding: 24px 10px;
                        background: #f8f8f8;
                        text-align: center;">
                            <div style="display: inline-block">
                                <form action="">
                                    <input type="hidden">
                                    <button type="submit" class="b-favorite mr-2" style="padding: 3px 20px;
                                    border: none;
                                    border-radius: 4px;
                                    background-color: green;
                                    color: #fff;">Favorite</button>
                                </form>
                            </div>
                            <a href="" style="display: inline-block; padding: 3px 20px;
                            border: none;
                            border-radius: 4px;
                            background-color: black;
                            color: #fff;">Information</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="job-add" style="width: 22%">
            <div class="j-recently">
                <div class="sec-title" style="font-size: 16px;
                line-height: 16px;
                background-color: #7D1DD8;
                color: #fff;
                border-radius: 4px;
                padding: 15px;">
                    <img src="{{ asset('images/icon-guide.svg') }}" alt=""> Recently Viewed Jobs
                </div>
                <p class="sec-content" style="line-height: normal;
                color: #1a1a1a;
                padding: 15px 0;
                margin: 0;
                border-bottom: 1px solid #efefef;">There are no recently viewed jobs.</p>
            </div>
            <div class="j-favorite">
                <div class="sec-title" style="font-size: 16px;
                line-height: 16px;
                background-color: #7D1DD8;
                color: #fff;
                border-radius: 4px;
                padding: 15px;">
                    <img src="{{ asset('images/icon-interest.svg') }}" alt="">Favorites list
                </div>
                <p class="sec-content" style="line-height: normal;
                color: #1a1a1a;
                padding: 15px 0;
                margin: 0;
                border-bottom: 1px solid #efefef;">There are no jobs marked as interested.</p>
            </div>
            <a href="#" class="sec-detail" style="font-size: 12px;
            line-height: 12px;
            margin-top: 14px;
            color: #1a1a1a;
            display: block;
            text-align: right;"> show all <img src="{{ asset('images/icon-arrow-line-right-black.svg') }}" alt="" style="width: 12px;
                height: 12px;
                margin: -2px 0 0 8px;"></a>
        </div>
    </div>

</div>
@endsection
