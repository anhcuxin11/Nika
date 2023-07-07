<nav class="nav-bar" id="navbar">
    <div class="starter d-flex">
        <a href="{{ route('candidate.home') }}" class="m-auto-0"><img width="158" height="37"  src="{{asset('images/nika5.svg')}}" alt="nika" class="logo-white my-auto"></a>
        <p class="mr-auto sp-hide">
            NIKA is a job change information site in Vietnam <br> with <span>{{ $job_counts }}</span> job postings
        </p>
        <p class="mr-auto my-auto pc-hide">
            Number of job postings<span>{{ $job_counts }}</span>
        </p>
        <div class="d-flex align-items-center">
            @auth('web')
                <span class="user-name my-auto">
                    <span class="user-name-body">{{ auth('web')->user()->full_name }}</span>
                    <img width="16" height="16" src="{{asset('images/icon-log-out.svg')}}" class="log-out" alt="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                </span>
                <x-forms.post :action="route('logout')" id="logout-form" class="d-none" />
            @else
                <button class="btn btn-white sp-hide">
                    <a href="{{ route('login') }}" class="text-dark">
                        <img width="20" height="20" src="{{asset('images/icon-login-maroon.svg')}}" class="" alt="">Login
                    </a>
                </button>
                <button class="btn btn-white my-auto pc-hide">
                    <a href="{{ route('register') }}" class="text-dark"><img width="12" height="12" src="{{asset('images/icon-edit-maroon.svg')}}" class="" alt="">Register</a>
                </button>
            @endauth
            <div class="menu-icon pc-hide" onclick="change()"><img width="16" height="13" src="{{asset('images/menu-icon.svg')}}" id="change" class="" alt=""></div>
        </div>
    </div>
</nav>
<div class="menu-bar">
    <div class="starter">
        <ul>
           <li><a href="{{ route('candidate.job.index') }}" class="nav-underline" ><img src="{{asset('images/icon-search-lg.svg')}}" alt="">Job search</a></li>
           <li><a href="{{ route('candidate.favorite.index') }}" class="nav-underline" ><img src="{{asset('images/icon-interest.svg')}}" alt="">Favorite</a>@auth @if(!empty($favoriteNum)) <span class="bubble">{{ $favoriteNum }}</span>@endif @endauth</li>
           <li><a href="{{ route('candidate.messages') }}" class="nav-underline" ><img src="{{asset('images/icon-scout.svg')}}" alt="">Message</a></li>
           <li><a href="{{ route('candidate.resume') }}" class="nav-underline" ><img src="{{asset('images/icon-guide.svg')}}" alt="">Resume</a></li>
           <li><a href="{{ route('candidate.desired-job') }}" class="nav-underline" ><img src="{{asset('images/icon-heart.svg')}}" alt="">Desired condition</a></li>
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
