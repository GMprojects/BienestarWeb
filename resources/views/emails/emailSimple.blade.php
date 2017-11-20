@component('mail::message')
  # {{$subject}}
  <br>
  EstimadX {{ ucwords(strtolower($destinatario)) }},
  <br>
  {{ $mensaje }}
  @switch($opcion)
     @case(1)
      @component('mail::button', ['url' => url(route('habitoEstudio.create')), 'color' => 'blue'])
         Llenar Hábito Estudio
      @endcomponent
     @break
  @endswitch()

  <br><br><br>

  Atentamente, {{ $remitente }}

  Gracias,<br>
  {{ config('app.name') }}
  [Pagina Web](www)
@endcomponent
