@component('mail::message')
Hi {{ $company->name }},
<br>
<br>
Thank you for trusting our website.
<br>
Hope you find the candidate you want!
<br>
Thanks,<br>

@component('mail::button', ['url' => route('company.dashboard')])
Nika
@endcomponent

Best regards, Nika.
@endcomponent
