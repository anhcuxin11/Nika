@extends('candidate.layouts.main')
@push('styles')
@endpush
@section('content')
@php
    use App\Models\Message;
@endphp
<div class="content-full">
    <show-message inline-template>
        <div style="margin: 20px 40px;" id="messages">
            <h2>Messages</h2>
            <div class="mt-3 d-flex" style="font-size: 23px;">
                <a class="m-0 px-2 {{ $activeTab == 1 ? 'border-line' : '' }}" style="padding: 4px; border-right: 3px solid orange;" href="{{ route('candidate.messages', ['tab' => 1]) }}">Job</a>
                <a class="m-0 px-2 {{ $activeTab == 2 ? 'border-line' : '' }}" style="padding: 4px;" href="{{ route('candidate.messages', ['tab' => 2]) }}">Company</a>
            </div>
            @if ($activeTab == 1)
                <div class="message mt-4">
                    @foreach ($jobs as $job)
                        <div class="d-flex card-message mb-2 p-2">
                            <div class="left-content">
                                <div class="pb-3 l-title">{{ $job->job_title }}</div>
                                <div class="l-company"><span>Company: </span>{{ $job->company->name }}</div>
                            </div>
                            <div class="right-content">
                                <button type="button" class="btn btn-message" @click.prevent="showMessage({{$job->id}})">
                                    Show
                                </button>
                            </div>
                        </div>
                    @endforeach
                    @include('candidate.messages.message-modal')
                </div>
            @else
                <div class="message mt-4">
                    @foreach ($companies as $company)
                        <div class="d-flex card-message mb-2 p-2">
                            <div class="left-content">
                                <div class="pb-3 l-title">{{ $company->name }}</div>
                                <div class="l-company"><span>Address: </span>{{ $company->address }}</div>
                            </div>
                            <div class="right-content">
                                <button type="button" class="btn btn-message" @click.prevent="showCompanyMessage({{$company->id}})">
                                    Show
                                </button>
                            </div>
                        </div>
                    @endforeach
                    @include('candidate.messages.company-message-modal')
                </div>
            @endif
        </div>
    </show-message>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
