<div class="input-area d-flex justify-content-between align-items-center mt-5 mb-4" style="margin-left: 16px;">
    @if (count($jobs) > 0)
        <div class="d-flex align-items-center">
            @if(count($toolbarStatuses) > 0 && $activeTab != 3)
                <div class="d-flex align-items-center">
                    <input type="checkbox" class="" id="check-all-top" style="width: 19px; height: 19px" @change="checkAll" :checked="checkAllStatus">
                </div>
                <select class="custom-select" style="width: 180px;" id="inputGroupSelect01" v-model="status">
                    <option value="">Select</option>
                    @foreach ($toolbarStatuses as $key => $label)
                        @if ($key != 2)
                        <option value="{{$key}}">{{ $label }}</option>
                        @endif
                    @endforeach
                </select>
                <div>
                    <button
                        style="background-color: #7D1DD8; color: white"
                        type="button"
                        class="btn"
                        @click.prevent="onSubmitStatus"
                    >Change</button>
                </div>
            @endif
        </div>
        @if ($jobs->total() > 0)
        <div class="job-body job-paginate d-flex align-items-center justify-content-end" style="color: black">
            <div class="result-title"><span class="result-number">{{ $jobs->total() }}</span> matching jobs, <span class="result-number">{{ $jobs->firstItem() }}〜{{ $jobs->lastItem() }}</span>item</div>
            <div class="job-paginate-result">
                {{ $jobs->onEachSide(4)->links('custom.pagination.bootstrap') }}
            </div>
        </div>
        @endif
    @endif
</div>
