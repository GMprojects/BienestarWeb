<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-email-{{ $tutorado->idAlumno }}-{{ $idTutor }}">
	{{Form::Open(['action'=>['TutorTutoradoController@enviarEmail'],'method'=>'post'])}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
                <h4 class="modal-title"> <b>Mensaje para Tutorado</b> </h4>
			</div>

			<div class="modal-body">
            {{ Form::hidden('idAlumno', $tutorado->idAlumno) }}
            {{ Form::hidden('idTutor', $idTutor) }}
            <p>Notificar que debe llenar el hábito de estudio</p>
				<div class="row">
	            <div class="col-md-12">
	                <div class="form-group">
	                    <label >Tutorado</label><br>
	                    &nbsp; &nbsp;<strong>{{ $tutorado->codigo.' - '.$tutorado->nombre.' '.$tutorado->apellidoPaterno.' '.$tutorado->apellidoMaterno  }}</strong><br>
	                </div>
	            </div>
	        </div>
           <div  class="row">
             <div class="col-lg-6 col-sm-6 col-xs-13">
                 @if (count($errors) >0)
                 <div class="alert alert-danger">
                    <ul>
                    @foreach($errors->all() as $error)
                       <li>{{$error}}</li>
                    @endforeach
                    </ul>
                 </div>
                 @endif
             </div>
          </div>
				<div class="row">
	            <div class="col-md-6">
	                <div class="form-group">
	                    <label for="subject">Asunto</label>
	                    <input id="subject" type="text" required name="subject" class="form-control" value="Recordatorio: Llenar Habito Estudio">
	                    <div class="help-block with-errors"></div>
	                </div>
	            </div>
	        </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <label for="mensaje">Mensaje </label>
                       <textarea id="mensaje" name="mensaje" required class="form-control" style="resize: none;" rows="4" >Se le pide por favor que llenen la encuesta de hábito de estudio, la cual es muy necesaria para las próximas sesiones de tutoría.</textarea>
                       <div class="help-block with-errors"></div>
                   </div>
               </div>
            </div>
            <small> <i class="fa fa-question"></i> Modifique el mensaje de ser necesario</small>
			</div>

			<div class="modal-footer">
            <div class="pull-left">
               <button class="btn btn-ff-default" type="button" data-dismiss="modal"><i class="fa fa-remove"></i>Cerrar</button>
      		</div>
      		<div class="pull-right">
      			<button class="btn btn-ff" type="submit"><i class="fa fa-send"></i> Enviar Correo </button>
      		</div>
			</div>
		</div>
	</div>
   {!! Form::close() !!}
</div>

<script type="text/javascript">
</script>

<style type="text/css">
</style>
