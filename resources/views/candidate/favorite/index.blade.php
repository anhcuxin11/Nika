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
    <div class="my-3" style="padding: 10px 20px;
        border: 4px solid #efefef;
        color: #7D1DD8;
        text-align: center;">
        <h2>FAVORITES</h2>
        <div>
            This is where the jobs you already love are saved.<br>
            Employers can go through the favorites list to discuss more about your desired job.
        </div>
    </div>

    @include('candidate.includes.message')

    <div class="job-content d-flex justify-content-between">
        <div class="job-main">
            <div class="job-body my-3 job-paginate d-flex align-items-center justify-content-end">
                <div class="result-title"><span class="result-number">{{ $favorites->total() }}</span> matching jobs, <span class="result-number">{{ $favorites->firstItem() }}〜{{ $favorites->lastItem() }}</span>item</div>
                <div class="job-paginate-result">
                    {{ $favorites->onEachSide(4)->links('custom.pagination.bootstrap') }}
                </div>
            </div>
            @forelse ($favorites as $favorite)
                @php
                    $job = $favorite->job;
                @endphp
                <div class="job-item">
                    @if (in_array($job->id, $favoritesByLike))
                        <div class="text-primary">The company is looking for you to apply for this job</div>
                    @endif
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
                                <form action="{{ route('candidate.favorite.delete', ['job_id' => $job->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="background-color: blue" class="b-favorite mr-2">Cancel</button>
                                </form>
                            </div>
                            <a href="{{ route('candidate.job.show', ['id' => $job->id]) }}" class="job-information">Information</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="para-box">
                    <h3>There are no matching jobs</h3>
                </div>
            @endforelse
            <div class="job-body mt-3 job-paginate d-flex align-items-center justify-content-end">
                <div class="result-title"><span class="result-number">{{ $favorites->total() }}</span> matching jobs, <span class="result-number">{{ $favorites->firstItem() }}〜{{ $favorites->lastItem() }}</span>item</div>
                <div class="job-paginate-result">
                    {{ $favorites->onEachSide(4)->links('custom.pagination.bootstrap') }}
                </div>
            </div>
        </div>
        <div class="job-add" style="padding-top: 77px">
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
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
