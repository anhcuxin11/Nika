<div class="card card-row">
    <div class="card-body d-flex align-items-center">
        <div class="d-flex align-items-center mr-2">
            <input
              type="checkbox"
              class=""
              style="width: 19px; height: 19px"
              id="row-job-{{$job->id}}"
              value="{{$job->id}}"
              :checked="selectedIds.includes({{$job->id}})"
              @change="onChangeCheckbox">
            <label class="" for="row-job-{{$job->id}}"></label>
        </div>
        <div class="d-block ttl-sec" style="color: black">
            <div class="title">{{ $job->job_title }}</div>
            <div class="sub-title">{{ $job->location_detail }}</div>
        </div>
        <div class="media-area">
            <span class="media-title ">
              {{ \App\Models\Job::$jobStatusLabel[$job->job_status] }}
            </span>
            @if ($job->job_status != 2)
            <div class="d-flex mt-3">
                <span style="width: 62px"></span>

                <div class="custom-control custom-checkbox cus-mt">
                <input type="checkbox" class="custom-control-input"
                    id="play-pause"
                    data-toggle="tooltip"
                    data-placement="top"
                    status="{{$job->status}}"
                    @if($job->job_status == 1)
                    @change="onChangeStatus({{$job->id}}, '3')"
                    title="posting pause"
                    @else
                    checked
                    @change="onChangeStatus({{$job->id}}, '1')"
                    title="Posting resume"
                    @endif
                >
                <label class="custom-control-label mt-18" for="play-pause"></label>
                </div>
                <span class="stop-btn" data-toggle="tooltip"
                    data-placement="top"
                    @click.prevent="onChangeStatus({{$job->id}}, '4')"
                    title="censored">
                </span>
            </div>
            @endif
        </div>
        {{-- <div class="btn-area">
            <img src="{{ asset('images/icon-interest-black.svg') }}">
            <span class="val" data-toggle="tooltip" data-placement="top" title="@lang('company/front.concern')">{{$job->favorites_count}}</span>
        </div>
        <div class="btn-area">
            <img src="{{ asset('images/icon-archive-black.svg') }}">
            <span class="val" data-toggle="tooltip" data-placement="top"
                title="@lang('company/front.entry')">{{$job->applications_count}}</span>
        </div>
        @if(!$job->isHrbcJob()) --}}
        <a href="{{ route('company.jobs.edit', ['id' => $job->id]) }}" class="btn btn-maroon btn-table-edit" style="display: flex;
        align-items: center; justify-content:center; margin: auto;">
            <img src="{{ asset('images/icon-edit.svg') }}">
            Edit
        </a>
    </div>
  </div>
