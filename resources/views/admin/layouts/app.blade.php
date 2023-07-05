<!DOCTYPE html>
<html lang="en">
@include('admin.shared.head')

<body>
    @include('admin.shared.nav')
    <div class="wrapper" id="app">
        @include('admin.shared.sidebar')
        <div class="content-wrapper">
          <div class="content-scroll">
            @yield('content')
          </div>
        </div>
    </div>
    @include('admin.shared.script')
</body>

</html>
