@extends('candidate.layouts.main')
@push('styles')
@endpush
@section('content')
@php
    use App\Models\Job;
    use App\Models\Location;
    use App\Models\Language;
@endphp
<div class="content-full">
    <div class="mt-4 information">
        <div>
            @foreach ($job->locations as $location)
                <span class="j-location-item mr-1">
                    <span>{{ $location->name }}</span>
                </span>
            @endforeach
        </div>
        <div class="mt-1">
            @foreach ($job->languages as $language)
            <span class="item-language mr-2">
                <span>★ {{ $language->name }}</span>
            </span>
            @endforeach
        </div>
        <div class="my-2">
            <h3 class="job-title font-weight-bold">{{ $job->job_title }}</h3>
        </div>
    </div>
    <div class="infor-content mt-3">
        <div class="update-date text-right">
            <div>Create: <span>{{  date_format($job->created_at,"Y/m/d") }}</span></div>
            <div>Update: <span>{{  date_format($job->updated_at,"Y/m/d") }}</span></div>
        </div>
        <div class="j-content p-3">
            <table class="mb-2">
                <tbody>
                    <tr>
                        <th><span>Recruiter</span></th>
                        <td>{{ $company->name }}</td>
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
                    <tr>
                        <th><span>Detail</span></th>
                        <td>
                            <p style="
                            word-break: break-word;
                            word-wrap: break-word;">{!! nl2br(e($job->job_detail)) !!}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4" style="border-bottom: 2px solid">
        <h3 class="job-title font-weight-bold">{{ $company->name }}</h3>
    </div>
    <div class="infor-content mt-3">
        <div class="j-content p-3">
            <table class="mb-2">
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
    <div class="j-apply text-center mt-3">
        <a href="{{ route('candidate.job.application', ['id' => $job->id]) }}">
            <img src="{{ asset('images/icon-answer-white.svg') }}" alt="" class="pr-1">
            Application</a>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
