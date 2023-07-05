<div id="sidebar">
    <ul class="sticky-ul">
        <li class="text-right move-left-li"><span id="sidebarCollapse"><img src="{{ asset('images/icon-move-left.svg') }}" class="move-left"></span></li>
        <li class="">
            <a href="{{ route('company.dashboard') }}" class="nav-item">
              <img src="{{ asset('images/icon-home.svg') }}">
              <span class="nav-txt">Top Page
                @if (!empty($notificationNum)) <span class="bubble">{{ $notificationNum }}</span> @endif
                @if (!empty($companyData['notificationNum'])) <span class="bubble">{{ $companyData['notificationNum'] }}</span> @endif
              </span>
            </a>
        </li>
        <li class="">
            <a href="{{ route('company.jobs') }}" class="nav-item">
            <img src="{{ asset('images/icon-job.svg') }}"><span class="nav-txt">Jobs</span></a>
        </li>
        <li class="">
            <a href="{{ route('company.applications') }}" class="nav-item">
            <img src="{{ asset('images/icon-scout.svg') }}">
            <span class="nav-txt">Application
            </span>
            </a>
        </li>
        <li class="">
            <a href="{{ route('company.favorites') }}" class="nav-item">
            <img src="{{ asset('images/icon-interest.svg') }}">
            <span class="nav-txt">Favorite
            </span>
            </a>
        </li>
        <li class="">
          <a href="{{ route('company.scouts.search') }}" class="nav-item">
          <img src="{{ asset('images/icon-search-lg.svg') }}"><span class="nav-txt">Scouts</span></a>
        </li>
    </ul>
</div>
