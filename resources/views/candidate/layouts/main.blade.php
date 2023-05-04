<!DOCTYPE html>
<html lang="en">
@include('candidate.shared.head')
<body>
	@include('candidate.shared.nav-bar')
	<div class="wrapper" id="app">
        @yield('content')
    </div>
    @include('candidate.shared.content-footer')
	@include('candidate.shared.script')
</body>
</html>
