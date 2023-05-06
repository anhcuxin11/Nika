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
            <div class="job-body my-3 job-paginate d-flex align-items-center">
                <div class="job-body-time">
                    <select class="search-select w-100" name="" id="" style="width: 100%;">
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
                <div class="result-title"><span class="result-number">24</span> matching jobs, <span class="result-number">1〜25</span>item</div>
                <div>paginate</div>
            </div>
            @foreach (range(1, 5) as $item)
                <div class="job-item">
                    <div>
                        @foreach (range(1, 1) as $item)
                            <span class="j-location-item mr-1">
                                <span>Location</span>
                            </span>
                        @endforeach
                    </div>
                    <div class="my-3">
                        <a href="#" class="j-item-title">title</a>
                    </div>
                    <div class="j-language">
                        @foreach (range(1, 2) as $item)
                            <span class="item-language mr-2">
                                <span>★ English</span>
                            </span>
                        @endforeach
                    </div>
                    <div class="job-item-content pt-3">
                        <table class="mb-2">
                            <tbody>
                                @foreach (range(1, 5) as $item)
                                    <tr>
                                        <th><span>Recruiter</span></th>
                                        <td>$Name company</td>
                                    </tr>
                                @endforeach
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
                    <img src="{{ asset('images/icon-interest.svg') }}" alt="">Favorites list
                </div>
                <p class="sec-content">There are no jobs marked as interested.</p>
            </div>
            <a href="#" class="sec-detail"> show all <img src="{{ asset('images/icon-arrow-line-right-black.svg') }}" alt=""></a>
        </div>
    </div>
</div>
@endsection
