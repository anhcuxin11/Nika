<!DOCTYPE html>
<html lang="en">
@include('company.shared.head')

<body>
    @include('company.shared.nav')
    <div class="wrapper" id="app">
        @include('company.shared.sidebar')
        <div class="content-wrapper">
          <div class="content-scroll">
            @yield('content')
          </div>
        </div>
    </div>
    @include('company.shared.script')
</body>

</html>
