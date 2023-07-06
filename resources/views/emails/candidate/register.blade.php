@component('mail::message')
Hi {{ $candidate->full_name }},
<br>
<br>
Thank you for trusting our website.
<br>
Hope you find the job you want!
<br>
Thanks,<br>

@component('mail::button', ['url' => route('candidate.home')])
Nika
@endcomponent

Best regards, Nika.
@endcomponent
