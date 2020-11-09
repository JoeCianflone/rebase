@component('mail::message')
# Needed to update your token

Hi {{ $member }}

Something happened, we updated your link...please click below

@component('mail::button', ['url' => $link])
Log In
@endcomponent

Thanks,<br>
The {{ config('app.name') }} Team

##### PS -- if that link doesn't work in your browser, you can just copy and paste this link: {{$link}}
@endcomponent
