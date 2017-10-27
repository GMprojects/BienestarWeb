@component('mail::message')
  # {{$subject}}
  <br>
  Estimado,
  <br>
  {{ $mensaje }}
  <br>

  Atentamente, {{ $remitente }}

  Gracias,<br>
  {{ config('app.name') }}
  [Pagina Web](www)
@endcomponent
