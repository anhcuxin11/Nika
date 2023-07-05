@extends('candidate.layouts.main')
@push('styles')
@endpush
@section('content')
@php
    use App\Models\Resume;
@endphp
<resume-edit-job
    :job="{{$job}}"
    :occupations="{{$occupations}}"
    :industries="{{$industries}}"
    inline-template>
<div class="content-full">
    <div class="mt-3 desired-job">
        <div class="resume">
            <div class="text-center mt-1">
                <h2 class="des">job summary</h2>
            </div>
            <div class="personal mt-4">
                <div class="personal-header">
                    <img class="icon-header" src="{{ asset('images/icon-user.svg') }}" height="18" width="18" alt="">
                    Experience
                </div>
                <div class="personal-content">
                    <table>
                        <tbody>
                            <tr>
                                <th><span>Certificate</span></th>
                                <td>
                                    <textarea class="form-control" maxlength="2000" style="height: 100px"
                                    v-model="form.certificate"></textarea>
                                    <div class="word-count">
                                    <v-form-error :form="form" field="certificate" />
                                </td>
                            </tr>
                            <tr>
                                <th><span>Skill</span></th>
                                <td>
                                    <textarea class="form-control" maxlength="2000" style="height: 100px"
                                    v-model="form.skill"></textarea>
                                    <div class="word-count">
                                    <v-form-error :form="form" field="skill" />
                                </td>
                            </tr>
                            <tr>
                                <th><span>Industries</span></th>
                                <td>
                                    <a href="javascript:void(0)"
                                    class="btn btn-gray" data-toggle="modal"
                                    data-target="#industry_modal">
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
                                <th><span>Occupations</span></th>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-gray" data-toggle="modal"
                                        data-target="#occupation_modal">
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
                                <th><span>Current salary</span></th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input type="number" class="form-control w-140" style="width: 125px;" v-model="form.current_salary" min="0">
                                        <span>&ensp;USD</span>
                                    </div>
                                    <v-form-error :form="form" field="current_salary" />
                                </td>
                            </tr>
                            <tr>
                                <th><span>Curriculum vitae</span></th>
                                <td>
                                    <div class="custom-file single-upload">
                                        <input type="file" id="curriculum_vitae" @change="handleFile"  name="attachment" accept=".doc,.pdf,.docx,.xlsx,.xls,.txt" class="custom-file-input">
                                        <div class="custom-file-seletor ">
                                            <button type="button" class="btn custom-file-button">Choose</button>
                                            <label for="curriculum_vitae" class="custom-file-name "> {{ $job->candidate->attachment->upload_file_name ?? 'Upload curriculum vitae' }}
                                            </label>
                                        </div>
                                    </div>
                                    <small v-if="form.errors.has('attachment')"
                                    v-html="form.errors.get('attachment')" style="color: #dc3545 !important;"></small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @include('candidate.settings.partials.edit-job-modal')
                </div>
            </div>
            <div class="mt-4" style="position: relative">
                <button type="button" @click="updateResumeJob" class="btn btn-purple border-circle" form="form-set-auto-login"><img
                    src="{{ asset('images/icon-check.svg') }}">Setting</button>
                <a href="{{ url()->previous() }}" class="btn btn-dark-back btn-dark" style="position: absolute;
                margin: 0;
                top: 11px;">
                    <img src="{{ asset('images/icon-back.svg') }}">Back</a>
            </div>
        </div>
    </div>
</div>
</resume-edit-job>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        $(function() {
            var fileInput = $('#curriculum_vitae');

            $('.custom-file-button').on('click', function() {
                fileInput.click();
            })

            $('.single-upload .custom-file-input').on('change', function(e){
                const file = e.target.files[0];
                const $label = $(this).closest('.single-upload').find('.custom-file-name');
                file && $label.text(file.name);
            })
        })

    </script>
@endpush
