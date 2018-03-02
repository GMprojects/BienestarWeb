@component('mail::message')
  # {{ $subject }}
  <br>
  {{--@component('mail::panel')
   ![Imagen de la Actividad][imagenActividad]
   @if($actividad->rutaImagen != null)
    [imagenActividad]: {{ asset('storage/'.$actividad->rutaImagen) }}
   @else
    [imagenActividad]: {{ asset('storage/'.$actividad->tipoActividad['rutaImagen']) }}
   @endif
 @endcomponent--}}
  # **{{ $actividad->titulo }}** #
 <dl>
   <dt>
     {{ $mensaje }}
     @if($actividad->estado == '3' || $actividad->estado == '5')
       Puede ponerse en contacto con el programador de la actividad. {{ $actividad->programador['nombre'].' '. $actividad->programador['apellidoPaterno'].' '.$actividad->programador['apellidoMaterno'] }}
     @endif
   </dt>
   @if($actividad->estado == '1')
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

 @if($actividad->estado == '1')
   @if ($soyResponsable == 0 && $soyInscrito == 0)
   @component('mail::button', ['url' => $url, 'color' => 'green'])
   Inscribirme
   @endcomponent
   @else
   @component('mail::button', ['url' => $url, 'color' => 'blue'])
   Ver Actividad
   @endcomponent
   @endif
 @endif

 @if($actividad->estado == '1')
 Te esperamos!!
 @else
 Nos estaremos comunicando.
 @endif

 Gracias,<br>
 {{ config('app.name') }}
 [Pagina Web]({{ config('app.url') }})
@endcomponent
