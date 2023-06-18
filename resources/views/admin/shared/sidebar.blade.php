<div id="sidebar">
    <ul class="sticky-ul">
        <li class="text-right move-left-li"><span id="sidebarCollapse"><img src="{{ asset('images/icon-move-left.svg') }}" class="move-left"></span></li>
        <li class="">
            <a href="#" class="nav-item">
              <img src="{{ asset('images/icon-home.svg') }}">
              <span class="nav-txt">Top Page</span>
            </a>
        </li>
        <li class="">
            <a href="{{ route('admin.users') }}" class="nav-item">
                <img src="{{ asset('images/icon-scout.svg') }}">
                <span class="nav-txt">Users management</span>
            </a>
        </li>
        <li class="">
            <a href="{{ route('admin.jobs') }}" class="nav-item">
                <img src="{{ asset('images/icon-job.svg') }}">
                <span class="nav-txt">Jobs management</span>
            </a>
        </li>
        <li class="">
            <a href="{{ route('admin.companies') }}" class="nav-item">
                <img src="{{ asset('images/icon-building.svg') }}">
                <span class="nav-txt">Companies management</span>
            </a>
        </li>
    </ul>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('.wrapper').toggleClass('sidebar-close');
        });
    });
</script>
@endpush
