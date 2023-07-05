@extends('admin.layouts.app')

@section('title',"Nika")
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
@endphp
<div class="body-content">
    <div class="container-fluid">
        <div class="row">
            <div class="mt-3 mx-3 w-100">
                <h2>Overview</h2>
                <div class="form-search">
                    <div class="d-flex flex-column">
                        <div class="p-1 home-title">Reality!</div>
                        <div class="p-1">The total number of registered candidates is <span class="count-job">{{ $data['totalCandidates'] }}</span></div>
                        <div class="p-1">The total number of registered companies is <span class="count-job">{{ $data['totalCompanies'] }}</span></div>
                        <div class="p-1">The total number of registered jobs is <span class="count-job">{{ $data['totalJobs'] }}</span></div>
                    </div>
                </div>
                <div class="content-page mt-4">
                    <div class="p-2 overview"><img src="{{ asset('images/icon-agreement.svg') }}">Statistical</div>
                    <div class="row">
                        <div class="col-6 chart d-flex" style="border-right: 3px solid #c2c2c2;">
                            <div class="text-center" style="padding: 20px 40px">
                                <!-- Progress bar -->
                                @php $progresss = (($data['totalActiveCandidates'] / $data['totalCandidates'])*100) @endphp
                                <div class="progresss mx-auto" data-value='@php echo $progresss @endphp'>
                                    <span class="progress-left">
                                        <span class="progress-bar border-maroon"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar border-maroon"></span>
                                    </span>
                                    <div class="progress-value">
                                        <div class="top-num">{{ $data['totalActiveCandidates'] }}</div>
                                        <small style="font-size: 18px;">~ {{ $data['totalCandidates'] - $data['totalActiveCandidates'] }}</small>
                                    </div>
                                </div>
                                <!-- END -->
                                <div class="pro-heading mt-2">The graph of the total number of candidates in the system</div>
                            </div>
                            <div class="d-flex flex-column">
                                <div style="margin-top: 46px">
                                    <span class="pad-1 mr-1"></span>Total number of active candidates
                                </div>
                                <div>
                                    <span class="pad-2 mr-1"></span>Total number of inactive candidates
                                </div>
                            </div>
                        </div>
                        <div class="col-6 chart d-flex">
                            <div class="text-center" style="padding: 20px 40px">
                                <!-- Progress bar -->
                                @php $progresss = (($data['totalActiveCompanies'] / $data['totalCompanies'])*100) @endphp
                                <div class="progresss mx-auto" data-value='@php echo $progresss @endphp'>
                                    <span class="progress-left">
                                        <span class="progress-bar border-maroon"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar border-maroon"></span>
                                    </span>
                                    <div class="progress-value">
                                        <div class="top-num">{{ $data['totalActiveCompanies'] }}</div>
                                        <small style="font-size: 18px">~ {{ $data['totalCompanies'] - $data['totalActiveCompanies'] }}</small>
                                    </div>
                                </div>
                                <!-- END -->
                                <div class="pro-heading mt-2">The graph of the total number of companies in the system</div>
                            </div>
                            <div class="d-flex flex-column">
                                <div style="margin-top: 46px">
                                    <span class="pad-1 mr-1"></span>Total number of active companies
                                </div>
                                <div>
                                    <span class="pad-2 mr-1"></span>Total number of inactive companies
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-page mt-4">
                    <div class="p-2 overview"><img src="{{ asset('images/icon-agreement.svg') }}">Jobs Statistical</div>
                    <div class="row mb-4" style="padding-bottom: 10px;">
                        <div class="col-6">
                            <div class="chart">
                                @php
                                    $result = intdiv($data['totalJobs'], 10);
                                    $max = 10 * ($result + 1);
                                    $heightPixel = 50;
                                @endphp
                                <div class="" style="min-height: 100px; padding: 0 100px 80px 100px; font-size: 16px; position:relative">
                                    <div>
                                        @foreach(range(5, 0) as $item)
                                            <div style="position: relative; height: {{ $heightPixel }}px; border-bottom: 1px solid #E3E3E3; color: black;">
                                                <div style="position: absolute; bottom: -14px; left: -206px;">
                                                    <div style="width: 200px; text-align: end;">{{ $max / 5 * $item }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div style="padding: 10px 50px; position: absolute" class="d-flex">
                                        @foreach($data['jobCategories'] as $key => $value)
                                            <div style="width: 60px; position: relative;">
                                                <div class="result" style="position: absolute; width: 40px; height: {{ round($value / $max * ($heightPixel * 5)) }}px; background-color:aquamarine;bottom: 11px;">
                                                    <div style="position: relative">
                                                        <div style="content: '{{ $value }}';
                                                        top: -22px;
                                                        position: absolute;
                                                        display: flex;
                                                        align-items: center;
                                                        justify-content: center;
                                                        width: 100%;">{{ $value }}</div>
                                                    </div>
                                                </div>
                                                <div style="width: 200px; text-align: end; position: absolute; top: 36px; left: -156px; transform: rotatez(329deg) translatex(-1rem);">{{ Job::$jobStatusLabel[$key] }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="pt-3" style="font-size: 18px; font-weight: 600; display: flex; justify-content: center;">Statistics of job status in the system</div>
                        </div>
                        <div class="col-6 pt-5">
                            <div style="font-size: 20px; font-weight: 400;">- Total number of unposted jobs: {{ $data['jobCategories'][0] }}</div>
                            <div style="font-size: 20px; font-weight: 400;">- Total number of jobs posted: {{ $data['jobCategories'][1] }}</div>
                            <div style="font-size: 20px; font-weight: 400;">- Total number of jobs that have been banned: {{ $data['jobCategories'][2] }}</div>
                            <div style="font-size: 20px; font-weight: 400;">- Total number of jobs pause: {{ $data['jobCategories'][3] }}</div>
                            <div style="font-size: 20px; font-weight: 400;">- Total number of jobs canceled: {{ $data['jobCategories'][4] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $(".progresss").each(function() {
                var value = $(this).attr('data-value');
                var left = $(this).find('.progress-left .progress-bar');
                var right = $(this).find('.progress-right .progress-bar');

                if (value > 0) {
                    if (value <= 50) {
                    right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
                    } else {
                    right.css('transform', 'rotate(180deg)')
                    left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
                    }
                }
            })
            function percentageToDegrees(percentage) {
                return percentage / 100 * 360
            }
        })
    </script>
@endpush
