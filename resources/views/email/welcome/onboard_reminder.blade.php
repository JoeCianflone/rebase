o
@component('mail::message')
# Quick Reminder: Please Finish your Onboarding!

Hi {{ $email }}

We noticed that someone was trying to log into your account, however, they are not allowed access
until you complete the onboarding process.

@component('mail::button', ['url' => $link])
Complete Your Onboarding
@endcomponent

Thanks,<br>
The {{ config('app.name') }} Team

##### PS -- if that link doesn't work in your browser, you can just copy and paste this link: {{$link}}
@endcomponent
