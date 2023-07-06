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
                <form class="form-search" action="{{ route('admin.users') }}" method="GET">
                    <div class="d-flex align-items-center">
                        <div class="d-flex radio-area mt-1 mb-2">
                            <div class="custom-control custom-radio mr-5">
                                <input type="radio" id="no" value="0" class="custom-control-input"
                                  name="sex" @if (request()->input('sex') == "0") checked @endif>
                                <label class="custom-control-label" for="no">Male</label>
                              </div>
                            <div class="custom-control custom-radio mr-5">
                              <input type="radio" id="yes" value="1" class="custom-control-input"
                                name="sex" @if (request()->input('sex') == "1") checked @endif>
                              <label class="custom-control-label" for="yes">Female</label>
                            </div>
                        </div>
                        <input type="text" class="form-control ml-10" name="key"
                        maxlength="100"
                        placeholder="ID/Name"
                        value="{{ old('key', request()->input('key')) }}">
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-3">
                        <div class="d-flex align-items-center" style="width: 376px;">
                            <select class="custom-select w-140" name="age_from">
                                <option value="">No limit</option>
                                @foreach (range(18,60) as $age)
                                    <option value="{{ $age }}" @if (request()->input('age_from') == $age) selected @endif>{{ $age }} Age</option>
                                @endforeach
                            </select>
                            <span class="ml-2 mr-2">〜</span>
                            <select class="custom-select w-140" name="age_to">
                                <option value="">No limit</option>
                                @foreach (range(18,60) as $age)
                                    <option value="{{ $age }}" @if (request()->input('age_to') == $age) selected @endif>{{ $age }} Age</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="text" class="form-control ml-10" name="email" style="width: 300px;"
                        maxlength="100"
                        placeholder="Email"
                        value="{{ old('email', request()->input('email')) }}">
                    </div>
                    <button type="submit" class="btn btn-purple mt-4 mb-2">
                        <img src="{{ asset('images/icon-search-lg.svg') }}">Search
                    </button>
                </form>
                @if ($users->total() > 0)
                    <div class="mt-5">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="w1">ID</th>
                                <th scope="col" class="w3">Full name</th>
                                <th scope="col" class="w3">Email</th>
                                <th scope="col" class="w4">Status</th>
                                <th scope="col" class="w6"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr class="height1">
                                        <td scope="row">{{ $user->id }}</td>
                                        <td class="des" title="{{ $user->full_name }}">{{ $user->full_name }}</td>
                                        <td class="des" title="{{ $user->email }}">{{ $user->email }}</td>
                                        <td class="user-status">{{ $user->status ? 'Active' : 'Block' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-success text-light" title="Edit">
                                                <i class="fas fa-edit" style="width: 13px"></i>
                                            </a>
                                            @if ($user->status)
                                                <button class="btn btn-danger text-light delete"
                                                    data-url="{{ route('admin.user.delete', ['id' => $user->id]) }}" title="block">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-success text-light delete"
                                                    data-title="restore"
                                                    data-url="{{ route('admin.user.restore', ['id' => $user->id]) }}" title="restore">
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
                                {{ $users->onEachSide(4)->links('custom.pagination.bootstrap') }}
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
            Swal.fire({
                title: 'Do you want to block this candidate?',
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
