<nav class="nav-bar" id="navbar">
    <div class="starter d-flex">
        <a href="{{ route('dashboard') }}" class="m-auto-0"><img width="158" height="37"  src="{{asset('images/nika5.svg')}}" alt="nika" class="logo-white my-auto"></a>
        <p class="mr-auto sp-hide">
            NIKA is a career/job change information site in Vietnam with <span>777</span> job postings
        </p>
        <p class="mr-auto my-auto pc-hide">
            Number of job postings<span>777</span>
        </p>
        <div class="d-flex align-items-center">
            @auth
                <span class="user-name my-auto">
                    <span class="user-name-body">full_name</span>
                    <a href="#"><img src="{{asset('images/setting.svg')}}" class="settings sp-hide " alt=""></a>
                    <img width="16" height="16" src="{{asset('images/icon-log-out.svg')}}" class="log-out" alt="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                </span>
                <x-forms.post :action="route('logout')" id="logout-form" class="d-none" />
            @else
                <button class="btn btn-white sp-hide">
                    <a href="{{ route('login') }}" class="text-dark">
                        <img width="20" height="20"  src="{{asset('images/icon-login-maroon.svg')}}" class="" alt="">Login
                    </a>
                </button>
                <button class="btn btn-white my-auto pc-hide">
                    <a href="{{ route('register') }}" class="text-dark"><img width="12" height="12" src="{{asset('images/icon-edit-maroon.svg')}}" class="" alt="">Register</a>
                </button>
            @endauth
            <div class="menu-icon pc-hide" onclick="change()"><img width="16" height="13" src="{{asset('images/menu-icon.svg')}}" id="change" class="" alt=""></div>
        </div>
        <!-- Toggle Menu -->
        <div class="toggle-menu">
            <h1 class="intro">NIKA is a career/job change information site in Vietnam</h1>
            <div class="d-flex flex-column">
                <div class="d-flex mb-2">
                  <a href="#" class="btn btn-light"><img width="14" height="14" class="img-favorite " alt="" src="{{asset('images/icon-guide-line.svg')}}">resume</a>
                  <a href="#" class="btn btn-light mr-0"><img width="14" height="14" class="img-user " alt="" src="{{asset('images/icon-heart-maroon.svg')}}">Desired condition</a>
                </div>
                <a href="#" class="btn btn-light mr-0 w-100"><img class="img-user " alt="setting" width="16" height="16" src="{{asset('images/icon-gear-line.svg')}}">setting</a>
            </div>
            <ul>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">news</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">1</a></li>
                <li class="border-0"><a href="#">2</a></li>
            </ul>
            @guest
            <div class="d-flex">
                <a href="{{ route('register') }}" class="btn btn-maroon"><img src="{{asset('images/icon-edit.svg')}}" class="" alt="">Register</a>
                <a href="{{ route('login') }}" class="btn btn-white mr-0"><img src="{{asset('images/icon-login-maroon.svg')}}" class="" alt="">Login</a>
            </div>
            @endguest
        </div>

    </div>
</nav>
<div class="menu-bar">
    <div class="starter">
        <ul>
           <li><a href="{{ route('job') }}"><img src="{{asset('images/icon-search-lg.svg')}}" class="" alt="">Job search</a></li>
           <li><a href="#"><img src="{{asset('images/icon-interest.svg')}}" class="" alt="">Favorite</a>@auth @if(false) <span class="bubble">1</span> @endif @endauth</li>
           <li><a href="#"><img src="{{asset('images/icon-scout.svg')}}" class="" alt="">Scout</a>@auth @if(false) <span class="bubble">1</span>@endif @endauth</li>
           <li><a href="#"><img src="{{asset('images/icon-bell.svg')}}" class="" alt="">News</a>@auth @if(false)<span class="bubble">1</span>@endif @endauth</li>
           <li><a href="#"><img src="{{asset('images/icon-guide.svg')}}" class="" alt="">Resume</a></li>
           <li class="sp-hide"><a href="#"><img src="{{asset('images/icon-heart.svg')}}" class="" alt="">Desired condition</a></li>
        </ul>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function(){
            $(".menu-icon").click(function(){
                $(".toggle-menu").slideToggle();
            });
        });
        function change() {
           var img1 = "{{asset('images/menu-icon.svg')}}",
               img2 = "{{asset('images/e-remove.svg')}}";
           var imgElement = document.getElementById('change');
           imgElement.src = (imgElement.src === img1)? img2 : img1;
        }
    </script>
    <script>
        if (jQuery(window).width() < 601) {
            var prevScrollpos = window.pageYOffset;
            window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
              if (prevScrollpos == "-1") {
                prevScrollpos +=1;
              }
              if (prevScrollpos >= currentScrollPos) {
                document.getElementById("navbar").classList.remove("hide-navbar");
              } else {
                document.getElementById("navbar").classList.add("hide-navbar");
              }
              prevScrollpos = currentScrollPos;
            }
        }
    </script>
@endpush
