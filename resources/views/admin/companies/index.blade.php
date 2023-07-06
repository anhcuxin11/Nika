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
<div class="body-content">
    <div class="container-fluid">
        <div class="row">
            <div class="mt-3 mx-3 w-100">
                @include('admin.includes.messages')
                <form class="form-search" action="{{ route('admin.companies') }}" method="GET">
                    <div class="d-flex align-items-center">
                        <div class="d-flex radio-area mt-1 mb-2">
                            <div class="custom-control custom-radio mr-5">
                                <input type="radio" id="no" value="1" class="custom-control-input"
                                  name="status" @if (request()->input('status') == "1") checked @endif>
                                <label class="custom-control-label" for="no">Active</label>
                              </div>
                            <div class="custom-control custom-radio mr-5">
                              <input type="radio" id="yes" value="0" class="custom-control-input"
                                name="status" @if (request()->input('status') == "0") checked @endif>
                              <label class="custom-control-label" for="yes">Blacklist</label>
                            </div>
                        </div>
                        <input type="text" class="form-control ml-10" name="key"
                        maxlength="100"
                        placeholder="ID/Name person/Email"
                        value="{{ old('key', request()->input('key')) }}">
                    </div>
                    <div class="d-flex align-items-center justify-content-center pt-3" style="gap: 80px;">
                        <input type="text" class="form-control ml-10" name="name" style="width: 300px;"
                        maxlength="100"
                        placeholder="Name company"
                        value="{{ old('name', request()->input('name')) }}">

                        <input type="text" class="form-control ml-10" name="address" style="width: 300px;"
                        maxlength="100"
                        placeholder="Address company"
                        value="{{ old('address', request()->input('address')) }}">
                    </div>
                    <button type="submit" class="btn btn-purple mt-4 mb-2">
                        <img src="{{ asset('images/icon-search-lg.svg') }}">Search
                    </button>
                </form>
                @if ($companies->total() > 0)
                    <div class="mt-5">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="w1">ID</th>
                                <th scope="col" class="w3">Name</th>
                                <th scope="col" class="w3">CEO</th>
                                <th scope="col" class="w3">Email</th>
                                <th scope="col" class="w3">Address</th>
                                <th scope="col" class="w6">Status</th>
                                <th scope="col" class="w6"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $index => $company)
                                    <tr class="height1">
                                        <td scope="row">{{ $company->id }}</td>
                                        <td class="des" title="{{ $company->name }}">{{ $company->name }}</td>
                                        <td class="des" title="{{ $company->name_person }}">{{ $company->name_person }}</td>
                                        <td class="des" title="{{ $company->email_company }}">{{ $company->email_company }}</td>
                                        <td class="des" title="{{ $company->address }}">{{ $company->address }}</td>
                                        <td class="user-status">{{ $company->status ? 'Active' : 'Blacklist' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.company.edit', ['id' => $company->id]) }}" class="btn btn-success text-light" title="{{ __('user.edit') }}">
                                                <i class="fas fa-edit" style="width: 13px"></i>
                                            </a>
                                            @if ($company->status)
                                                <button class="btn btn-danger text-light delete"
                                                    data-title="block"
                                                    data-url="{{ route('admin.company.delete', ['id' => $company->id]) }}" title="block">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-success text-light delete"
                                                    data-title="restore"
                                                    data-url="{{ route('admin.company.restore', ['id' => $company->id]) }}" title="restore">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="job-body mt-3 job-paginate d-flex align-items-center justify-content-end">
                            <div class="job-paginate-result pb-3">
                                {{ $companies->onEachSide(4)->links('custom.pagination.bootstrap') }}
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
        $(document).on('click', '.delete', function() {
            let dataTitle = $(this).data('title');

            Swal.fire({
                title: `Do you want to ${dataTitle} this company?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = $(this).data('url');
                    let text = $(this).closest('tr');

                    $.ajax({
                        url: url,
                        method: 'POST',
                        success: function(res) {
                            if (res.result) {
                                deleteSuccess('Successfull');
                                text.remove();
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
            'Blocked!',
            $text,
            'error'
        );
    };

    function addSuccess($text) {
        Swal.fire({
            icon: 'success',
            title: $text,
            showConfirmButton: false,
            timer: 1500
        });
    }
    </script>
@endpush
