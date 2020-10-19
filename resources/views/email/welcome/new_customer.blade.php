@component('mail::message')
# Welcome to Rebase!

Hi {{ $payload['member']->email }}

Your new account is ready! Please sign in using this link first, so you can finish setting up your account.

@component('mail::button', ['url' => $link])
Log In
@endcomponent

Thanks,<br>
I Havwe {{ config('app.name') }} Team

##### PS -- if that link doesn't work in your browser, you can just copy and paste this link: {{$link}}
@endcomponent
