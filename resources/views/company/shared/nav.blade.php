<nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('company.dashboard') }}" class="m-auto-0"><img src="{{asset('images/nika5.svg')}}" class="logo-white"></a>
            </div>
            <div class="col-9">
                <ul>
                    <li>{{ auth('company')->user()->name }}</li>
                    <li><a href="javascript:void(0)" class="black-btn">{{ auth('company')->user()->name_person }}</a></li>
                    <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <img src="{{ asset('images/icon-log-out.svg') }}" class="logout"></a>
                        <x-forms.post :action="route('company.logout')" id="logout-form" class="d-none" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
