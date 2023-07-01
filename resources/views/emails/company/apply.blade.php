@component('mail::message')
Hi {{ $candidate->full_name }},
<br>
Curriculum Vitae has been approved!
We will talk to you in the message
<br>
Thanks,<br>

@component('mail::button', ['url' => route('candidate.job.show', ['id' => $job->id])])
Job details
@endcomponent

Best regards,
{{ $company->name }}
@endcomponent
