<div id="sidebar">
    <ul class="sticky-ul">
        <li class="text-right move-left-li"><span id="sidebarCollapse"><img src="{{ asset('images/icon-move-left.svg') }}" class="move-left"></span></li>
        <li class="">
            <a href="#" class="nav-item">
              <img src="{{ asset('images/icon-home.svg') }}">
              <span class="nav-txt">Top Page
                @if (!empty($notificationNum)) <span class="bubble">{{ $notificationNum }}</span> @endif
                @if (!empty($companyData['notificationNum'])) <span class="bubble">{{ $companyData['notificationNum'] }}</span> @endif
              </span>
            </a>
        </li>
        <li class="">
            <a href="#" class="nav-item">
            <img src="{{ asset('images/icon-job.svg') }}"><span class="nav-txt">Jobs</span></a>
        </li>
        <li class="">
            <a href="#" class="nav-item">
            <img src="{{ asset('images/icon-scout.svg') }}">
            <span class="nav-txt">Application
            </span>
            </a>
        </li>
        <li class="">
            <a href="#" class="nav-item">
            <img src="{{ asset('images/icon-interest.svg') }}">
            <span class="nav-txt">Favorite
            </span>
            </a>
        </li>
        <li class="">
          <a href="#" class="nav-item">
          <img src="{{ asset('images/icon-gear.svg') }}"><span class="nav-txt">Settings</span></a>
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