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
    <div class="mt-4">
        <div class="j-detail pb-3" style="border-bottom: 3px solid;">
            <div class="j-d-content d-flex align-items-center">
                <div class="j-d-content-left">
                    <img src="{{ $company->upload_file_path ? asset('storage/' . $company->upload_file_path) : asset('images/img_company.jpg') }}" alt="" style="width: 130px; padding-right: 15px;">
                </div>
                <div class="j-d-content-right">
                    <div class="j-des">{{ $company->name }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="job-content d-flex justify-content-between">
        <div class="job-main resume">
            <div class="personal mt-3">
                <div class="personal-header">
                    <img class="icon-header" src="{{ asset('images/icon-user.svg') }}" height="18" width="18" alt="">
                    Company profile
                </div>
                <div class="personal-content">
                    <table>
                        <tbody>
                            <tr>
                                <th><span>Recruiter</span></th>
                                <td>{{ $company->name }}</td>
                            </tr>
                            <tr>
                                <th><span>Headquarter</span></th>
                                <td>{{ $company->address }}</td>
                            </tr>
                            <tr>
                                <th><span>Manager</span></th>
                                <td>{{ $company->name_person }}</td>
                            </tr>
                            <tr>
                                <th><span>Phone</span></th>
                                <td>{{ $company->phone_company }}</td>
                            </tr>
                            <tr>
                                <th><span>Email</span></th>
                                <td>{{ $company->email_company }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="{{ route('candidate.job.index', ['company_id' => $company->id]) }}">
                @csrf
                <div class="j-apply text-center mt-5">
                    <button type="button" class="j-app">
                        <img src="{{ asset('images/icon-answer-white.svg') }}" alt="" class="pr-1">
                        List jobs of company</button>
                </div>
            </a>
        </div>
        <div class="job-add mt-3">
            <div class="j-recently">
                <div class="sec-title">
                    <img src="{{ asset('images/icon-guide.svg') }}" alt=""> List Jobs
                </div>
                @forelse ($jobs as $job)
                    <p class="sec-content">
                        <a href="{{ route('candidate.job.show', ['id' => $job->id]) }}"><span> {{ $job->job_title }} </span></a>
                    </p>
                @empty
                    <p class="sec-content">There are no recently viewed jobs.</p>
                @endforelse
            </div>
        </div>
    </div>
    <hr>
    <div class="job-content d-flex justify-content-between mt-5">
        <div class="job-main resume">
            <div class="d-flex justify-content-start company-flex" style="column-gap: 18px; row-gap: 30px; flex-wrap: wrap;">
                @foreach ($companies as $company)
                <a href="{{ route('candidate.companies', ['id' => $company->id]) }}" class="c-detail" style="width: 260px;">
                    <div class="c-d-content d-flex">
                        <div class="c-d-content-left">
                            <img src="{{ $company->upload_file_path ? asset('storage/' . $company->upload_file_path) : asset('images/img_company.jpg') }}" alt="">
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
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
