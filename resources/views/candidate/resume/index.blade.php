@extends('candidate.layouts.main')
@push('styles')
@endpush
@section('content')
@php
    use App\Models\Resume;
@endphp
<div class="content-full">
    <div class="mt-3">
        <h2>Curriculum vitae</h2>
        <div class="resume">
            <div class="resume-title text-center mt-1">
                <p class="note">Be confident in your CV, maybe some employers will see potential from you</p>
                <p>Jobs posted on Nika can be applied directly to companies or through agents (recruitment agencies).</p>
            </div>
            <div class="personal mt-3">
                <div class="personal-header">
                    <img class="icon-header" src="{{ asset('images/icon-user.svg') }}" height="18" width="18" alt="">
                    Personal information
                    <a href="#" class="btn btn-dark">
                        <img src="{{ asset('images/icon-edit.svg') }}" height="12" width="12" alt="">Edit
                    </a>
                </div>
                <div class="personal-content">
                    <table>
                        <tbody>
                            <tr>
                                <th><span>Full name</span></th>
                                <td>{{ auth('web')->user()->full_name }}</td>
                            </tr>
                            <tr>
                                <th><span>Email</span></th>
                                <td>{{ auth('web')->user()->email }}</td>
                            </tr>
                            <tr>
                                <th><span>Phone</span></th>
                                <td>{{ $resume->phone }}</td>
                            </tr>
                            <tr>
                                <th><span>Country</span></th>
                                <td>{{ $resume->country }}</td>
                            </tr>
                            <tr>
                                <th><span>Current residence</span></th>
                                <td>{{ $resume->address }}</td>
                            </tr>
                            <tr>
                                <th><span>Facebook</span></th>
                                <td>{{ $resume->facebook }}</td>
                            </tr>
                            <tr>
                                <th><span>Hobby</span></th>
                                <td>{{ $resume->hobby }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="personal mt-3">
                <div class="personal-header">
                    <img class="icon-header" src="{{ asset('images/icon-user.svg') }}" height="18" width="18" alt="">
                    Experience
                    <a href="#" class="btn btn-dark">
                        <img src="{{ asset('images/icon-edit.svg') }}" height="12" width="12" alt="">Edit
                    </a>
                </div>
                <div class="personal-content">
                    <table>
                        <tbody>
                            <tr>
                                <th><span>Certificate</span></th>
                                <td>{!! $resume->certificate !!}</td>
                            </tr>
                            <tr>
                                <th><span>Skill</span></th>
                                <td>{!! $resume->skill !!}</td>
                            </tr>
                            <tr>
                                <th><span>Occupations</span></th>
                                <td>{{ $resume->phone }}</td>
                            </tr>
                            <tr>
                                <th><span>Industries</span></th>
                                <td>{!! $resume->industry_labels !!}</td>
                            </tr>
                            <tr>
                                <th><span>Occupations</span></th>
                                <td>{!! $resume->occupation_labels !!}</td>
                            </tr>
                            <tr>
                                <th><span>Current salary</span></th>
                                <td>{{ $resume->current_salary }} million VND</td>
                            </tr>
                            <tr>
                                <th><span>Curriculum vitae</span></th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
