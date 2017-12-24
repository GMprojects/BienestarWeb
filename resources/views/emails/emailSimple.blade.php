@component('mail::message')
  # {{$subject}}
  <br>
  @if ($sexo == 'm')
  Estimada
  @else
  Estimado
  @endif {{ ucwords(strtolower($destinatario)) }},
  <br>
  {{ $mensaje }}
  @switch($opcion)
     @case(1)
      @component('mail::button', ['url' => url(route('habitoEstudio.create')), 'color' => 'blue'])
         Llenar Hábito Estudio
      @endcomponent
     @break
     @case(2){{-- Comunicarse con el programador y responsable --}}
     @break
  @endswitch()

  <br><br><br>

  Atentamente, {{  ucwords(strtolower($remitente))  }}

  Gracias,<br>
  {{ config('app.name') }}
  [Pagina Web]({{ config('app.url') }})
@endcomponent
