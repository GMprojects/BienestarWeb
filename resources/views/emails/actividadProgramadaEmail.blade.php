@component('mail::message')
  # Nueva Actividad Programada
  {{ $mensaje }}  **{{ $actividad->tipoActividad['tipo'] }}**
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
  <br>
  @component('mail::button', ['url' => '', 'color' => 'green'])
  Inscribirme
  @endcomponent
  Gracias,<br>
  {{ config('app.name') }}
  [Pagina Web](www)
@endcomponent
