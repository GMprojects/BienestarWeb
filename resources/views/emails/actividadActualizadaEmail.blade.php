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
    <dl>
      <dt>
         @if($actividad->estado == '3')
           Esta actividad ha sido cancelada, de ser el caso que la habiliten le estaremos notificando.
           Puede ponerse en contacto con el programador de la actividad. {{ $actividad->programador['nombre'].' '. $actividad->programador['apellidoPaterno'].' '.$actividad->programador['apellidoMaterno'] }}
         @endif
      </dt>
      <dt> {{ $actividad->descripcion }} </dt>
      <br>
      @if($actividad->informacionAdicional != null)
         <dt> Información Adicional: </dt>
         <dd> {{ $actividad->cuposTotales }} </dd>
      @endif
      <dt> Fecha y Hora Inicio:</dt>
      <dd> {{ date("d",strtotime($actividad->fechaInicio))." de ".date("F",strtotime($actividad->fechaInicio))." del ".date("Y",strtotime($actividad->fechaInicio))." a las ".date('g:i A',strtotime($actividad->horaInicio)) }} </dd>
      <dt> Fecha y Hora Fin:</dt>
      <dd> {{ date("d",strtotime($actividad->fechaFin))." de ".date("F",strtotime($actividad->fechaFin))." del ".date("Y",strtotime($actividad->fechaFin))." a las ".date('g:i A',strtotime($actividad->horaFin)) }} </dd>
      @if($actividad->cuposTotales > 1)
         <dt> Cupos Totales:</dt>
         <dd> {{ $actividad->cuposTotales }} </dd>
      @endif
         <dt> Lugar: </dt>
         <dd> {{ $actividad->lugar }} </dd>
      @if ($actividad->referencia != null)
        <dt> Referencia: </dt>
        <dd> {{ $actividad->referencia }} </dd>
      @endif
  <br>
  Te esperamos!!
  Gracias,<br>
  {{ config('app.name') }}
  [bienestarweb.com](/)
@endcomponent
