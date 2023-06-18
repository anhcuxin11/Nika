<nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('admin.users') }}" class="m-auto-0"><img src="{{asset('images/nika5.svg')}}" class="logo-white"></a>
            </div>
            <div class="col-9">
                <ul>
                    <li>{{ auth('admin')->user()->name }}</li>
                    <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <img src="{{ asset('images/icon-log-out.svg') }}" class="logout"></a>
                        <x-forms.post :action="route('admin.logout')" id="logout-form" class="d-none" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
