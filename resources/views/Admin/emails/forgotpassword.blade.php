@component('mail::message')

<p>Hello {{ $user->name }}</p>

<p>Please click on reset your password</p>

@component('mail::button', ['url' => url('/admin/resetpassword/'.$user->remember_token)])
Reset Your Password
@endcomponent

Thank You <br/>
{{ config('app.name') }}

@endcomponent