@component('mail::message')
  # Actividad Actualizada
  **{{ $actividad->tipoActividad['tipo'] }}**
  <br>
  @component('mail::panel')
    ![Imagen de la Actividad][imagenActividad]
    @if($actividad->rutaImagen != null)
      [imagenActividad]: {{ asset('storage/'.$actividad->rutaImagen) }} "Actividad"
    @else
      [imagenActividad]: {{ asset('storage/'.$actividad->tipoActividad['rutaImagen']) }} "Actividad"
    @endif
  @endcomponent
  # **{{ $actividad->titulo }}** #
  <br>
  <dd> {{ $actividad->descripcion }} </dd>
  @if($actividad->estado == '3')
    Esta actividad ha sido cancelada, de ser el caso que la habiliten le estaremos notificando.
    Puede ponerse en contacto con el programador de la actividad. {{ $actividad->programador['nombre'].' '. $actividad->programador['apellidoPaterno'].' '.$actividad->programador['apellidoMaterno'] }}
  @else
    <dl>
      <dt> Hora: </dt>
      <dd> {{ date('g:i A',strtotime($actividad->horaProgramacion)) }} </dd>
      @if($actividad->cuposTotales > 1)
      <dt> Cupos Totales: </dt>
      <dd> {{ $actividad->cuposTotales }} </dd>
      @endif
      <dt> Lugar: </dt>
      <dd> {{ $actividad->lugar }} </dd>
      <dt> Referencia: </dt>
      <dd> {{ $actividad->referencia }} </dd>
    </dl>
  @endif

  <br>
  Te esperamos!!
  Gracias,<br>
  {{ config('app.name') }}
  [Pagina Web](www)
@endcomponent
