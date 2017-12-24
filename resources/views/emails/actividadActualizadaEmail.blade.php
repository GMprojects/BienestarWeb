@component('mail::message')
  @if($actividad->estado == '3')
  # Actividad Cancelada
  @elseif($actividad->estado == '5')
  # Actividad Eliminada
  @else
  # Actividad Actualizada
  @endif

  <br>
  @component('mail::panel')
   ![Imagen de la Actividad][imagenActividad]
   @if($actividad->rutaImagen != null)
    [imagenActividad]: {{ asset('storage/'.$actividad->rutaImagen) }}
   @else
    [imagenActividad]: {{ asset('storage/'.$actividad->tipoActividad['rutaImagen']) }}
   @endif
  @endcomponent
  # **{{ $actividad->titulo }}** #
 <dl>
   @if($actividad->estado == '3')
   <dt>
   Esta actividad ha sido cancelada, de ser habilitada le estaremos notificando.
   Puede ponerse en contacto con el programador de la actividad. {{ $actividad->programador['nombre'].' '. $actividad->programador['apellidoPaterno'].' '.$actividad->programador['apellidoMaterno'] }}
   </dt>
   @elseif($actividad->estado == '5')
   <dt>
   Esta actividad ha sido eliminada.
   Puede ponerse en contacto con el programador de la actividad. {{ $actividad->programador['nombre'].' '. $actividad->programador['apellidoPaterno'].' '.$actividad->programador['apellidoMaterno'] }}
   </dt>
   @else
      <dt> {{ $actividad->descripcion }} </dt>
      @if($actividad->informacionAdicional != null)
      <dt> Información Adicional: </dt>
      <dd> {{ $actividad->informacionAdicional }} </dd>
      @endif

      <dt> Fecha y Hora Inicio:</dt>
      <dd> {{ date("d",strtotime($actividad->fechaInicio))." de ".date("F",strtotime($actividad->fechaInicio))." del ".date("Y",strtotime($actividad->fechaInicio))." a las ".date('g:i A',strtotime($actividad->horaInicio)) }} </dd>
      @if ($actividad->idTipoActividad != 1 || $actividad->idTipoActividad != 2)
      <dt> Fecha y Hora Fin:</dt>
      <dd> {{ date("d",strtotime($actividad->fechaFin))." de ".date("F",strtotime($actividad->fechaFin))." del ".date("Y",strtotime($actividad->fechaFin))." a las ".date('g:i A',strtotime($actividad->horaFin)) }} </dd>
      @endif

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
   @endif
 </dl>

 @if($actividad->estado != '3')
 @component('mail::button', ['url' => $url, 'color' => 'blue'])
 Ver Actividad
 @endcomponent
 @endif

 @if($actividad->estado != '3')
 Te esperamos!!
 @else
 Nos estaremos comunicando.
 @endif

 Gracias,<br>
 {{ config('app.name') }}
 [Pagina Web]({{ config('app.url') }})
@endcomponent
