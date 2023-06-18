<div class="card card-row">
    <div class="card-body d-flex">
        <div class="d-flex align-items-center mr-2">
            <input type="checkbox"
                class=""
                id="row-job-{{$job->id}}"
                value="{{$job->id}}"
                :checked="selectedIds.includes({{$job->id}})"
                @change="onChangeCheckbox"
            >
            <label class="" for="row-job-{{$job->id}}"></label>
        </div>
        <div class="d-block ttl-main mr-auto" style="color: black;">
            <div class="title">{{ $job->job_title }}</div>
            <div class="sub-title">{{ $job->location_detail }}</div>
        </div>
        <div class="d-flex">
            <span class="posted my-auto">Not posted</span>
            <a href="{{ route('company.jobs.edit', ['id' => $job->id]) }}" class="btn btn-maroon btn-table-edit" style="display: flex;
            align-items: center; justify-content:center; margin: auto; margin-left: 24px;">
                <div>
                    <img src="{{ asset('images/icon-edit.svg') }}"> Edit
                </div>
            </a>
            <button type="button"
                class="btn btn-success my-auto"
                @click.prevent="onChangeStatus({{$job->id}}, '1')"
            >
                @lang('Start posting')
            </button>
        </div>
    </div>
</div>
