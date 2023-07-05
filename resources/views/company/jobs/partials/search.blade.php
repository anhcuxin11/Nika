<div class="card">
    <div class="card-body">
        <form action="" method="GET" class="search-form">
            <div class="d-flex">
                <input type="hidden" name="tab" value="{{ request()->tab }}">
                <input type="text" maxlength="255" class="form-control @if($activeTab == 2) inpt-wid @else mr-4 @endif"
                    placeholder="Title/Description" name="keyword" value="{{request()->query('keyword')}}">
                    @if($activeTab == 2)
                        <select class="custom-select w-240" name="status">
                            <option value="">No select</option>
                            @foreach ($toolbarStatuses as $key => $label)
                                <option value="{{$key}}" {{ request()->query('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    @endif
                <button type="submit" class="btn btn-maroon mt-0 float-right">
                    <img src="{{ asset('images/icon-search-lg.svg') }}">
                    Search
                </button>
            </div>
        </form>
    </div>
  </div>
