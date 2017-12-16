@extends('template')
@section ('contenido')
<div class="caja">
   <div class="caja-header">
      <div class="caja-icon">1</div>
      <div class="caja-title">Datos del Beneficiario</div>
   </div>
   <div class="caja-body">
      <div class="panel-body">
         <div class="row">
            <div class="col-md-12">
               <label><i class="fa fa-qrcode margin-r-5"></i>&nbsp; &nbsp;Código:  </label> &nbsp; &nbsp; {{ $alumno->user->codigo }} <br>
               <label><i class="fa fa-user margin-r-5"></i>&nbsp; &nbsp;Beneficiario:  </label> &nbsp; &nbsp; {{ $alumno->user->nombre.' '.$alumno->user->apellidoPaterno.' '.$alumno->user->apellidoMaterno }} <br>
               <label><i class="fa fa-calendar margin-r-5"></i>&nbsp; &nbsp;Periodo de Movilidad:  </label> &nbsp; &nbsp;{{ date("d/m/Y",strtotime($actividadMovilidad->pivot->fechaInicio)) }} - {{ date("d/m/Y",strtotime($actividadMovilidad->pivot->fechaFin)) }}<br>
               <label><i class="fa fa-building-o margin-r-5"></i>&nbsp; &nbsp;Institución:  </label> &nbsp; &nbsp;{{ $actividadMovilidad->pivot->institucion }}<br>
               <label><i class="fa fa-flag margin-r-5"></i>&nbsp; &nbsp;País:  </label> &nbsp; &nbsp;{{ $actividadMovilidad->pivot->pais }}<br>


            </div>
         </div>
      </div>
   </div>
</div>
@include('programador.actividad.beneficiario.evidencia.modalNueva')
<div class="caja">
   <div class="caja-header">
      <div class="caja-icon">2</div>
      <div class="caja-title">
         Evidencias
         <button type="button" name="button" data-target="#modal-evidenciaBeneficiario" data-toggle="modal" class="btn btn-ff-green pull-right" style="margin-top:4px;">
            <i class="fa fa-plus "></i>Nueva Evidencia
          </button>
      </div>
   </div>
   <div class="caja-body">
      <div class="panel-body">
         <div class="row">
            @foreach($beneficiarioMovilidad->evidenciasMovilidad as $evidenciaMovilidad)
               @php($array = preg_split("/[.]/",$evidenciaMovilidad->ruta))
               @php($count = count($array))
               <div class="col-lg-2 col-md-4 col-sm-3 col-xs-12">
                  <div class="panel panel-default">
                     @if($array[$count-1] == 'jpg'|| $array[$count-1] == 'png' || $array[$count-1] == 'jpeg' || $array[$count-1] == 'gif')
                        <div class="panel-body">
                           <img src="{{ asset('storage/'.$evidenciaMovilidad->ruta) }}" alt="{{ $evidenciaMovilidad->ruta }}"  height="100px"  class="img-responsive">
                        </div>
                        <div class="panel-footer">
                           {{ $evidenciaMovilidad->nombre }}
                           <div class="pull-right">
                              <a href="{{ action('BeneficiarioController@descargarEvidenciaBeneficiario',['idEvidenciaMovilidad' => $evidenciaMovilidad->idEvidenciaMovilidad ])}}" id="{{$evidenciaMovilidad->idEvidenciaMovilidad}}"><span class="fa fa-download"></span> </a>
                              <a href="" data-target="#modal-delete-{{$evidenciaMovilidad->idEvidenciaMovilidad}}" data-toggle="modal"><span class="fa fa-times-rectangle"></span>  </a>
                           </div>
                        </div>
                     @elseif ($array[$count-1] == 'docx'|| $array[$count-1] == 'doc')
                        <div class="panel-body" width="90px" >
                           <img src="{{asset('images/Iconos/word.png')}}" alt=""  height="80px" width="50px" class="img-responsive">
                        </div>
                        <div class="panel-footer">
                           {{ $evidenciaMovilidad->nombre }}
                           <div class="pull-right">
                              <a href="{{ action('BeneficiarioController@descargarEvidenciaBeneficiario',['idEvidenciaMovilidad' => $evidenciaMovilidad->idEvidenciaMovilidad ])}}" id="{{$evidenciaMovilidad->idEvidenciaMovilidad}}"><span class="fa fa-download"></span> </a>
                              <a href="" data-target="#modal-delete-{{$evidenciaMovilidad->idEvidenciaMovilidad}}" data-toggle="modal"><span class="fa fa-times-rectangle"></span>  </a>
                           </div>
                        </div>
                     @elseif ($array[$count-1] == 'pdf')
                        <div class="panel-body">
                           <img src="{{asset('images/Iconos/pdf.png')}}" alt=""  height="80px" width="50px" class="img-responsive">
                        </div>
                        <div class="panel-footer">
                           {{ $evidenciaMovilidad->nombre }}
                           <div class="pull-right">
                              <a href="{{asset('storage/'.$evidenciaMovilidad->ruta)}}" target="_blank"><span class="fa fa-eye"></span></a>
                              <a href="{{ action('BeneficiarioController@descargarEvidenciaBeneficiario',['idEvidenciaMovilidad' => $evidenciaMovilidad->idEvidenciaMovilidad ])}}" id="{{$evidenciaMovilidad->idEvidenciaMovilidad}}"><span class="fa fa-download"></span>  </a>
                              <a href="" data-target="#modal-delete-{{$evidenciaMovilidad->idEvidenciaMovilidad}}" data-toggle="modal"><span class="fa fa-times-rectangle"></span>  </a>
                           </div>
                        </div>
                     @elseif ($array[$count-1] == 'xlsx' || $array[$count-1] == 'xls' || $array[$count-1] == 'xlsm')
                        <div class="panel-body">
                           <img src="{{asset('images/Iconos/excel.png')}}" alt=""  height="80px" width="50px" class="img-responsive">
                        </div>
                        <div class="panel-footer">
                           {{ $evidenciaMovilidad->nombre }}
                           <div class="pull-right">
                              <a href="{{ action('BeneficiarioController@descargarEvidenciaBeneficiario',['idEvidenciaMovilidad' => $evidenciaMovilidad->idEvidenciaMovilidad ])}}" id="{{$evidenciaMovilidad->idEvidenciaMovilidad}}"><span class="fa fa-download"></span>  </a>
                              <a href="" data-target="#modal-delete-{{$evidenciaMovilidad->idEvidenciaMovilidad}}" data-toggle="modal"><span class="fa fa-times-rectangle"></span>  </a>
                           </div>
                        </div>
                     @elseif ($array[$count-1] == 'pptx' || $array[$count-1] == 'ppt' || $array[$count-1] == 'pptm')
                        <div class="panel-body">
                           <img src="{{asset('images/Iconos/ppt.png')}}" alt=""  height="80px" width="50px" class="img-responsive">
                        </div>
                        <div class="panel-footer">
                           {{ $evidenciaMovilidad->nombre }}
                           <div class="pull-right">
                              <a href="{{ action('BeneficiarioController@descargarEvidenciaBeneficiario',['idEvidenciaMovilidad' => $evidenciaMovilidad->idEvidenciaMovilidad ])}}" id="{{$evidenciaMovilidad->idEvidenciaMovilidad}}"><span class="fa fa-download"></span>  </a>
                              <a href="" data-target="#modal-delete-{{$evidenciaMovilidad->idEvidenciaMovilidad}}" data-toggle="modal"><span class="fa fa-times-rectangle"></span>  </a>
                           </div>
                        </div>
                     @else
                        <div class="panel-body">
                           <img src="{{asset('images/Iconos/otro.png')}}" alt=""  height="80px" width="50px" alt="Otro Archivo" class="img-responsive">
                        </div>
                        <div class="panel-footer">
                           {{ $evidenciaMovilidad->nombre }}
                           <div class="pull-right">
                              <a href="{{ action('BeneficiarioController@descargarEvidenciaBeneficiario',['idEvidenciaMovilidad' => $evidenciaMovilidad->idEvidenciaMovilidad ])}}" id="{{$evidenciaMovilidad->idEvidenciaMovilidad}}"><span class="fa fa-download"></span>  </a>
                              <a href="" data-target="#modal-delete-{{$evidenciaMovilidad->idEvidenciaMovilidad}}" data-toggle="modal"><span class="fa fa-times-rectangle"></span>  </a>
                           </div>
                        </div>
                     @endif
                  </div>
                  @include('programador.actividad.beneficiario.evidencia.modal')
               </div>
            @endforeach
         </div>
      </div>
   </div>
</div>
@endsection
