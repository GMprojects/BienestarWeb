@component('mail::message')
  # Registrar Hábito de Estudio
  <br>
  @if ($user->sexo == 'm')
  Estimada
  @else
  Estimado
@endif {{ ucwords(strtolower($user->nombre)) }} {{ ucwords(strtolower($user->apellidoPaterno)) }} {{ ucwords(strtolower($user->apellidoMaterno)) }},
  <br>
  Se le pide por favor que llenen la encuesta de hábito de estudio, la cual es muy necesaria para las próximas sesiones de tutoría.

  @component('mail::button', ['url' => $url, 'color' => 'blue'])
     Llenar Hábito Estudio
  @endcomponent

  Gracias,<br>
  {{ config('app.name') }}
  [Pagina Web]({{ config('app.url') }})
@endcomponent
