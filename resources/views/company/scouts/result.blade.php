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
    use App\Models\Resume;
@endphp
<scout-chat-messages inline-template>
    <div class="body-content" id="messages">
        <div class="container-fluid">
            <div class="row">
                <div class="mt-3 w-100">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item ml-2 mr-5" role="presentation">
                            <h2>Scouts</h2>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mx-1 {{ $activeTab == 1 ? 'active' : 'inactive' }}" id="tab1-tab" href="{{ route('company.scouts.search', ['tab' => 1]) }}">
                                <img src="{{ asset('images/icon-edit-underline.svg') }}">Search</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mx-1 {{ $activeTab == 2 ? 'active' : 'inactive' }}" id="tab2-tab" href="{{ route('company.scouts.search', ['tab' => 2]) }}">
                                <img src="{{ asset('images/icon-monitor-gray.svg') }}">Review</a>
                        </li>
                    </ul>
                    <div class="mx-3 mt-3">
                        @include('company.includes.messages')
                        <div class="pb-2">
                            <h2>Compatible candidate</h2>
                        </div>
                        <a href="{{ route('company.scouts.search', request()->all()) }}" class="search-scout">Search again</a>
                        <div class="mt-3">
                            <div class="job-body job-paginate d-flex align-items-center justify-content-end" style="color: black">
                                <div class="result-title"><span class="result-number">{{ $candidates->total() }}</span> matching candidates, <span class="result-number">{{ $candidates->firstItem() }}〜{{ $candidates->lastItem() }}</span>item</div>
                                <div class="job-paginate-result">
                                    {{ $candidates->onEachSide(4)->links('custom.pagination.bootstrap') }}
                                </div>
                            </div>
                        </div>
                        @foreach ($candidates as $candidate)
                            <div class="form-search m-2 d-flex p-0" style="font-size: 15px;">
                                <div class="f-person p-3 d-flex">
                                    <div class="person-basic pr-1">
                                        <div class="d-flex justify-content-center">
                                            @if($candidate->resume->sex == Resume::$sex['female'])
                                                <img src="{{ asset('images/image-woman-circle.svg') }}" class="woman-circle">
                                            @else
                                                <img src="{{ asset('images/image-man-circle.svg') }}" class="woman-circle">
                                            @endif
                                        </div>
                                        <div class="text-center">
                                            No.{{ $candidate->id }}
                                        </div>
                                        <div class="text-center pb-3">
                                            {{ $candidate->resume->age }} / {{ $candidate->full_name }}
                                        </div>
                                        <div class="text-left text-des" title="{{ $candidate->resume->hobby }}">
                                            <span class="font-weight-bold">Hobby:</span> {!! $candidate->resume->hobby !!}
                                        </div>
                                        <div class="text-left text-des" title="{{ $candidate->resume->certificate }}">
                                            <span class="font-weight-bold">Certificate:</span> {!! $candidate->resume->certificate !!}
                                        </div>
                                        <div class="text-left">
                                            <p class="font-weight-bold p-0 m-0">CV:</p>
                                            @if ($candidate->attachment)
                                                <a href="{{ asset('storage/' . optional($candidate->attachment)->upload_file_path) }}">{{ optional($candidate->attachment)->upload_file_name }}</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="person-exp pl-1">
                                        <div class="text-left mb-2 text-des" title="{{ $candidate->resume->skill }}">
                                            <span class="font-weight-bold">Skill:</span> {{ $candidate->resume->skill }}
                                        </div>
                                        <div class="text-left mb-2 text-des" title="{{ $candidate->resume->industry_labels }}">
                                            <span class="font-weight-bold">Industries:</span> {{ $candidate->resume->industry_labels }}
                                        </div>
                                        <div class="text-left mb-2 text-des" title="{{ $candidate->resume->occupation_labels }}">
                                            <span class="font-weight-bold">Occupations:</span> {{ $candidate->resume->occupation_labels }}
                                        </div>
                                        <div class="text-left mb-2 text-des" style="margin-bottom: 45px">
                                            <span class="font-weight-bold">Current salary:</span> {{ $candidate->resume->current_salary }} USD
                                        </div>
                                        <div class="d-flex justify-content-end justify-self-end btn-area">
                                            @if (!in_array($candidate->id, $candidateIds))
                                                <div class="d-flex">
                                                    <button type="button" class="btn-custom" style="color: #1a1a1a; border: 1px solid #1a1a1a; background-color: white" @click.prevent="addMark({{ $candidate->id }})">
                                                        <img src="{{ asset('images/icon-plus-circle-black.svg') }}" alt="">Save review
                                                    </button>
                                                </div>
                                            @endif
                                            @if ($activeTab == 2)
                                                <div class="d-flex">
                                                    <button type="button" class="btn-custom" style="color: #1a1a1a; border: 1px solid #1a1a1a; background-color: white" @click.prevent="removeMark({{ $candidate->id }})">
                                                        <img src="{{ asset('images/icon-plus-circle-black.svg') }}" alt="">Remove
                                                    </button>
                                                </div>
                                            @endif
                                            <div class="d-flex">
                                                <button type="button" class="btn-custom" @click.prevent="showMessage({{$candidate->id}})">Chat</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="f-job p-3">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @include('company.component.scout-message-modal')
            </div>
        </div>
    </div>
</scout-chat-messages>
@endsection
@push('scripts')
@endpush
