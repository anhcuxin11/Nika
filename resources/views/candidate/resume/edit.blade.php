@extends('candidate.layouts.main')
@push('styles')
@endpush
@section('content')
@php
    use App\Models\Resume;
@endphp
<resume-edit
    :resume="{{$resume}}"
    {{-- :occupations="{{$occupations}}"
    :industries="{{$industries}}" --}}
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
                                <th><span>Full name</span></th>
                                <td>
                                    <div style="display: flex; gap: 30px;">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <input type="input" placeholder="firstname" class="form-control w-140" style="width: 200px;" v-model="form.firstname" min="0">
                                            </div>
                                            <v-form-error :form="form" field="firstname" />
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <input type="input" placeholder="lastname" class="form-control w-140" style="width: 200px;" v-model="form.lastname" min="0">
                                            </div>
                                            <v-form-error :form="form" field="lastname" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th><span>Email</span></th>
                                <td>{{ auth('web')->user()->email }}</td>
                            </tr>
                            <tr>
                                <th><span>Age</span></th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input type="number" class="form-control w-140" style="width: 200px;" v-model="form.age" min="0">
                                      </div>
                                    <v-form-error :form="form" field="age" />
                                </td>
                            </tr>
                            <tr>
                                <th><span>Phone</span></th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input type="number" class="form-control w-140" style="width: 200px;" v-model="form.phone" min="0">
                                      </div>
                                    <v-form-error :form="form" field="phone" />
                                </td>
                            </tr>
                            <tr>
                                <th><span>Country</span></th>
                                <td>
                                    <textarea class="form-control" maxlength="2000" style="height: 100px"
                                    v-model="form.country"></textarea>
                                    <div class="word-count">
                                    <v-form-error :form="form" field="country" />
                                </td>
                            </tr>
                            <tr>
                                <th><span>Current residence</span></th>
                                <td>
                                    <textarea class="form-control" maxlength="2000" style="height: 100px"
                                    v-model="form.address"></textarea>
                                    <div class="word-count">
                                    <v-form-error :form="form" field="address" />
                                </td>
                            </tr>
                            <tr>
                                <th><span>Facebook</span></th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input type="input" class="form-control w-140" style="width: 200px;" v-model="form.facebook" min="0">
                                    </div>
                                    <v-form-error :form="form" field="facebook" />
                                </td>
                            </tr>
                            <tr>
                                <th><span>Hobby</span></th>
                                <td>
                                    <textarea class="form-control" maxlength="2000" style="height: 100px"
                                    v-model="form.hobby"></textarea>
                                    <div class="word-count">
                                    <v-form-error :form="form" field="hobby" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4" style="position: relative">
                <button type="button" @click="updateResume" class="btn btn-purple border-circle" form="form-set-auto-login"><img
                    src="{{ asset('images/icon-check.svg') }}">Setting</button>
                <a href="{{ url()->previous() }}" class="btn btn-dark-back" style="position: absolute;
                margin: 0;
                top: 11px;">
                    <img src="{{ asset('images/icon-back.svg') }}">Back</a>
            </div>
        </div>
    </div>
</div>
</resume-edit>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        $(document).on('change', '.single-upload .custom-file-input', function(e){
            console.log(1);
            const file = e.target.files[0];
            const $label = $(this).closest('.single-upload').find('.custom-file-name');
            file && $label.text(file.name);
        })
    </script>
@endpush
