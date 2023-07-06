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
                <form class="form-search" action="{{ route('admin.jobs') }}" method="GET">
                    <div class="d-flex align-items-center" style="column-gap: 45px">
                        <input type="text" class="form-control ml-10" name="key"
                        maxlength="100"
                        placeholder="ID/Title/Description"
                        value="{{ old('key', request()->input('key')) }}">
                        <input type="text" class="form-control ml-10" name="name"
                        maxlength="100"
                        placeholder="Name company"
                        value="{{ old('name', request()->input('name')) }}">
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-3">
                        <div>
                            <div>Age</div>
                            <div class="d-flex align-items-center" style="width: 376px;">
                                <select class="custom-select w-140" name="age_min">
                                    <option value="">No limit</option>
                                    @foreach (range(18,60) as $age)
                                        <option value="{{ $age }}" @if (request()->input('age_min') == $age) selected @endif>{{ $age }} Age</option>
                                    @endforeach
                                </select>
                                <span class="ml-2 mr-2">〜</span>
                                <select class="custom-select w-140" name="age_max">
                                    <option value="">No limit</option>
                                    @foreach (range(18,60) as $age)
                                        <option value="{{ $age }}" @if (request()->input('age_max') == $age) selected @endif>{{ $age }} Age</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <div>Salary/Month</div>
                            <div class="d-flex align-items-center" style="width: 376px;">
                                <select class="custom-select w-140" name="salary_min">
                                    <option value="">No limit</option>
                                    @foreach (range(200, 3000, 200) as $salary)
                                        <option value="{{ $salary }}" @if (request()->input('salary_min') == $salary) selected @endif>{{ $salary }} USD</option>
                                    @endforeach
                                </select>
                                <span class="ml-2 mr-2">〜</span>
                                <select class="custom-select w-140" name="salary_max">
                                    <option value="">No limit</option>
                                    @foreach (range(200, 3000, 200) as $salary)
                                        <option value="{{ $salary }}" @if (request()->input('salary_max') == $salary) selected @endif>{{ $salary }} USD</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <div>Publishing status</div>
                            <div class="d-flex align-items-center">
                                <select class="custom-select w-140" name="job_status">
                                    <option value="">Choose status</option>
                                    @foreach (Job::$jobStatusLabel as $key => $item)
                                        <option @if (request()->input('job_status') != '' && request()->input('job_status') == $key) selected @endif value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-purple mt-4 mb-2">
                        <img src="{{ asset('images/icon-search-lg.svg') }}">Search
                    </button>
                </form>
                @if ($jobs->total() > 0)
                    <div class="mt-5">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="w1">ID</th>
                                <th scope="col" class="w3">Title</th>
                                <th scope="col" class="w4">Company name</th>
                                <th scope="col" class="w3">Job URL</th>
                                <th scope="col" class="w6">Stauts</th>
                                <th scope="col" class="w3">Suspended</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $index => $job)
                                    <tr class="height1">
                                        <td scope="row">{{ $job->id }}</td>
                                        <td class="des" title="{{ $job->job_title }}">{{ $job->job_title }}</td>
                                        <td class="des" title="{{ $job->company->name }}">{{ $job->company->name }}</td>
                                        <td class="des">
                                            <a href="{{ route('candidate.job.show', ['id' => $job->id]) }}">/job/{{ $job->id }}</a>
                                        </td>
                                        <td class="user-status">
                                            {{ $job->job_publish == Job::$jobPublishs['off'] ? 'Suspended' : Job::$jobStatusLabel[$job->job_status] }}
                                        </td>
                                        <td class="text-center">
                                                <div class="d-flex radio-area mt-1 mb-2 align-items-center">
                                                    <div class="mr-3">
                                                        <input type="radio" id="on_{{ $job->id }}" value="1" name="job_status_{{ $job->id }}"
                                                        @if ($job->job_publish == Job::$jobPublishs['off']) checked @endif>
                                                        <label class="custom-control-label" for="on_{{ $job->id }}">On</label>
                                                    </div>
                                                    <div class="mr-3">
                                                        <input type="radio" id="off_{{ $job->id }}" value="0" name="job_status_{{ $job->id }}"
                                                        @if ($job->job_publish == Job::$jobPublishs['on']) checked @endif>
                                                        <label class="custom-control-label" for="off_{{ $job->id }}">Off</label>
                                                    </div>
                                                    <button type="button" class="btn btn-primary px-2" id="confirm"
                                                    data-id="{{ $job->id }}"
                                                    data-url="{{ route('admin.job.update-status', ['id' => $job->id]) }}">
                                                        Confirm
                                                    </button>
                                                </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="job-body mt-3 job-paginate d-flex align-items-center justify-content-end">
                            <div class="job-paginate-result pb-3">
                                {{ $jobs->onEachSide(4)->links('custom.pagination.bootstrap') }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="mt-5" style="font-size: 20px"> No data</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $( function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        $(document).on('click', '#confirm', function() {
            Swal.fire({
                title: 'Do you want to suspend this job?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $(this).data('url');
                    let id = $(this).data('id');
                    var radioValue = $(`input[name="job_status_${id}"]:checked`).val();
                    if (['0', '1'].includes(radioValue)) {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: { job_publish: radioValue },
                            success: function(res) {
                                if (res.result) {
                                    deleteSuccess('Successfull');
                                    location.reload();
                                } else {
                                    deleteError(res.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                deleteError('Failed');
                                console.log(xhr.responseText);
                            }
                        });
                    }
                }
            });
        });

    function deleteSuccess($text) {
        Swal.fire(
            'OK!',
            $text,
            'success'
        );
    };

    function deleteError($text) {
        Swal.fire(
            'OK!',
            $text,
            'error'
        );
    };
    </script>
@endpush
