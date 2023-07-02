@extends('company.layouts.app')

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
<company-job-table :jobs="{{ json_encode($jobs->items()) }}"
    inline-template>
    <div class="body-content">
        <div class="container-fluid">
            <div class="row">
                <div class="mt-3 w-100">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item mx-2" role="presentation">
                            <h2>Jobs management</h2>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mx-1 {{ $activeTab == 1 ? 'active' : 'inactive' }}" id="tab1-tab" href="{{ route('company.jobs', ['tab' => 1]) }}">
                                <img src="{{ asset('images/icon-edit-underline.svg') }}">
                                Making<span class="bubble" style="right: -7px;">{{ $countTab1 }}</span></a>

                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mx-1 {{ $activeTab == 2 ? 'active' : 'inactive' }}" id="tab2-tab" href="{{ route('company.jobs', ['tab' => 2]) }}">
                                <img src="{{ asset('images/icon-monitor-gray.svg') }}">Posted<span
                                    class="bubble" style="right: -7px;">{{ $countTab2 }}</span></a>

                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mx-1 {{ $activeTab == 3 ? 'active' : 'inactive' }}" id="tab3-tab" href="{{ route('company.jobs', ['tab' => 3]) }}">
                                <img
                                    src="{{ asset('images/icon-archive-gray.svg') }}">End of publication<span
                                    class="bubble" style="right: -7px;">{{ $countTab3 }}</span></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active">
                            <div class="content">
                                @include('company.includes.messages')

                                <div class="col-12">
                                    {{-- @include('company.jobs.partials.table.header', [
                                      'companyJobAllocationRemain' => $companyJobAllocationRemain,
                                    ]) --}}
                                    <a href="{{ route('company.jobs.create') }}" type="button" class="btn btn-orange mt-2">
                                        <img src="{{ asset('images/icon-plus-circle.svg') }}">
                                        Create
                                    </a>

                                    <div class="row mb-2 mt-2">
                                        <div class="col-12">
                                            @include('company.jobs.partials.search')

                                            @include('company.jobs.partials.toolbar', ['jobs' => $jobs, 'activeTab' => $activeTab])

                                            @if (count($jobs) > 0)
                                              @foreach ($jobs as $job)
                                                @if($activeTab == 1)
                                                    @include('company.jobs.partials.row_job_prepare', ['job' => $job])
                                                @endif

                                                @if($activeTab == 2)
                                                    @include('company.jobs.partials.row_job_ready', ['job' => $job])
                                                @endif

                                                @if($activeTab == 3)
                                                    @include('company.jobs.partials.row_job_expired', ['job' => $job])
                                                @endif
                                              @endforeach
                                            @else
                                              No data
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- tab2 | Ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</company-job-table>
@endsection
