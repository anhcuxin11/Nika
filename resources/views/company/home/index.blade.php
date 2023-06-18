@extends('company.layouts.app')

@section('title',"NINJA")
@section('meta')
    <meta property="og:title" content="">
    <meta property="og:type" content="Web site">
    <meta property="og:image" content="">
    <meta property="og:keywords" content="">
    <meta name="description" content="">
@endsection

@section('content')
<div class="body-content">
    <div class="container-fluid">
        <div class="row">
            <div class="mt-3 mx-3 w-100">
                <h2>Dashboard</h2>
                <div class="form-search">
                    <div class="d-flex flex-column">
                        <div class="p-1 home-title">Best regards!</div>
                        <div class="p-1">The number of jobs posted is <span class="count-job">{{ $job_active_counts }}</span></div>
                        <div class="p-1">Number of jobs created is <span class="count-job">{{ $job_counts }}</span></div>
                        <div class="p-1">Please contact us if you need help.</div>
                    </div>
                </div>
                <div class="content-page mt-4">
                    <div class="p-2 overview"><img src="{{ asset('images/icon-agreement.svg') }}">Overview</div>
                    <div class="chart d-flex">
                        <div class="text-center" style="padding: 20px 40px">
                            <!-- Progress bar -->
                            @php $progresss = (($job_active_counts / $job_all_counts)*100) @endphp
                            <div class="progresss mx-auto" data-value='@php echo $progresss @endphp'>
                                <span class="progress-left">
                                    <span class="progress-bar border-maroon"></span>
                                </span>
                                <span class="progress-right">
                                    <span class="progress-bar border-maroon"></span>
                                </span>
                                <div class="progress-value">
                                    <div class="top-num">{{ $job_active_counts }}</div>
                                    <small>/ {{ $job_all_counts }}</small>
                                </div>
                            </div>
                            <!-- END -->
                            <div class="pro-heading mt-2">Percentage of jobs in the system</div>
                        </div>
                        <div class="d-flex flex-column">
                            <div style="margin-top: 46px">
                                <span class="pad-1 mr-1"></span>Total number of jobs posted by company
                            </div>
                            <div>
                                <span class="pad-2 mr-1"></span>Total number of jobs posted by the system
                            </div>
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
