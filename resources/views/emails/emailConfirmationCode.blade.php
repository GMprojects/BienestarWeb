@component('mail::message')
# Hola!!
<br>
@if ($sexo == 'm')
Estimada
@else
Estimado
@endif {{ ucwords(strtolower($destinatario)) }},
<br><br>
Por favor verifique su correo electrónico, así podrá estar al tanto de las actividades programadas y recibir correos.
Para ello simplemente debe hacer click en el siguiente botón:
<br><br>
@component('mail::button', ['url' => url('register/verify/'.$confirmation_code), 'color' => 'blue'])
  Confirma tu Email
@endcomponent
<br><br>
Gracias,<br>
{{ config('app.name') }}
[Pagina Web]({{ config('app.url') }})
@endcomponent
