@component('mail::message')
Hi {{ $candidate->full_name }},
<br>
<br>
We're sorry that your resume is not a good fit for this position.
<br>
You can see other jobs at the link below.
<br>
<br>
Thanks,<br>

@component('mail::button', ['url' => route('candidate.companies', ['id' => $company->id])])
Job list
@endcomponent

Best regards,
{{ $company->name }}
@endcomponent
