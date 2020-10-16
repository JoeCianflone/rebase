@component('mail::message')
# Welcome to Rebase!

Hi,

Your new account is ready for use, but before, you need to go here and do the thing:

@component('mail::button', ['url' => '#'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
