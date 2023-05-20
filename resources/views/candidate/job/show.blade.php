@extends('candidate.layouts.main')
@push('styles')
@endpush
@section('content')
@php
    use App\Models\Job;
    use App\Models\Location;
    use App\Models\Language;
@endphp
<div class="content-full">
    <div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
