@extends('candidate.layouts.main')
@push('styles')
@endpush
@section('content')
@php
    use App\Models\Resume;
@endphp
<job-requirement :resume-requirement="{{$resumeRequirement}}" :occupations="{{$occupations}}"
    :industries="{{$industries}}" :locations="{{$locations}}" inline-template>
<div class="content-full">
    <div class="mt-3 desired-job">
        <h2 class="des">Desired job</h2>
        <div class="resume">
            <div class="resume-title text-center mt-1">
                <p class="note">Be confident in your CV, maybe some employers will see potential from you</p>
                <p>Jobs posted on Nika can be applied directly to companies or through agents (recruitment agencies).</p>
            </div>
            <div class="personal mt-4">
                <div class="personal-header">
                    <img class="icon-header" src="{{ asset('images/icon-user.svg') }}" height="18" width="18" alt="">
                    Personal information
                </div>
                <div class="personal-content">
                    <table>
                        <tbody>
                            <tr>
                                <th style="padding: 20px 0"><span>Work location</span></th>
                                <td>
                                    <a href="javascript:void(0)"
                                    class="btn btn-gray" data-toggle="modal"
                                    data-target="#location_requirement_modal">
                                    <img src="{{ asset('images/icon-edit-black.svg') }}">&ensp;Edit</a>
                                    <div class="pt-1">
                                        <span v-if="locationLabels" v-text="locationLabels"></span>
                                    </div>
                                    <div class="d-flex">
                                        <input type="hidden" v-model="form.location_ids">
                                        <v-form-error :form="form" field="location_ids" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th style="padding: 20px 0"><span>Industries</span></th>
                                <td>
                                    <a href="javascript:void(0)"
                                    class="btn btn-gray" data-toggle="modal"
                                    data-target="#industry_requirement_modal">
                                    <img src="{{ asset('images/icon-edit-black.svg') }}">&ensp;Edit</a>
                                    <div class="pt-1">
                                        <span v-if="industryLabels" v-text="industryLabels"></span>
                                    </div>
                                    <div class="d-flex">
                                        <input type="hidden" v-model="form.industry_ids">
                                        <v-form-error :form="form" field="industry_ids" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th style="padding: 20px 0"><span>Occupations</span></th>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-gray" data-toggle="modal"
                                        data-target="#occupation_requirement_modal">
                                        <img src="{{ asset('images/icon-edit-black.svg') }}">&ensp;Edit
                                    </a>
                                    <div class="pt-1">
                                        <span v-if="occupationLabels" v-text="occupationLabels"></span>
                                    </div>
                                    <div class="d-flex">
                                        <input type="hidden" v-model="form.occupation_ids">
                                        <v-form-error :form="form" field="occupation_ids" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th style="padding: 20px 0"><span>Salary</span></th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input type="number" class="form-control w-140" style="width: 125px;" v-model="form.requirementSalary" min="0">
                                        <span>&ensp;Thousand VND</span>
                                      </div>
                                    <v-form-error :form="form" field="requirementSalary" />
                                </td>
                            </tr>
                            <tr>
                                <th style="padding: 20px 0"><span>Job format</span></th>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-gray" data-toggle="modal"
                                        data-target="#requirement_employment_modal">
                                        <img src="{{ asset('images/icon-edit-black.svg') }}">&ensp;Edit
                                    </a>
                                    <div class="pt-1">
                                        <span v-if="requirementEmploymentLabel" v-text="requirementEmploymentLabel"></span>
                                    </div>
                                    <div class="d-flex">
                                        <input type="hidden" v-model="form.requirementEmployment">
                                        <v-form-error :form="form" field="requirementEmployment" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @include('candidate.settings.partials.job_requirement_modal')
                </div>
            </div>
            <div class="mt-4">
                <button type="button" @click="updateJobRequirement" class="btn btn-purple border-circle" form="form-set-auto-login"><img
                    src="{{ asset('images/icon-check.svg') }}">Setting</button>
            </div>
        </div>
    </div>
</div>
</job-requirement>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
