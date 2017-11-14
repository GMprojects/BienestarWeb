<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-email-{{ $tutorado->idAlumno }}-{{ $idTutor }}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Mensaje para Tutorado <strong>{{ $tutorado->codigo  }}-{{ $tutorado->apellidoPaterno.', '.$tutorado->nombre  }}</strong></h4>
			</div>

			<div class="modal-body">
            <p>Notificar que debe llenar el hábito de estudio</p>
				<div class="row">
	            <div class="col-md-6">
	                <div class="form-group">
	                    <label for="subject">Subject</label>
	                    <input id="subject" type="text" name="subject" class="form-control" value="Recordatorio: Llenar Habito Estudio">
	                    <div class="help-block with-errors"></div>
	                </div>
	            </div>
	        </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <label for="mensaje">Mensaje </label>
                       <textarea id="mensaje" name="mensaje" required class="form-control" rows="4" >Se le pide por favor que llenen la encuesta de hábito de estudio, la cual es muy necesaria para las proximas sesiones de tutoría. Revise el siguiente link .... </textarea>
                       <div class="help-block with-errors"></div>
                   </div>
               </div>
            </div>
            <small> <i class="fa fa-question"></i> Modifique el mensaje de ser necesario</small>
			</div>

			<div class="modal-footer">
            <button type="button" onclick="enviar({{ $tutorado->idAlumno }})" class="btn btn-success btn-sendt" data-dismiss="modal">Enviar Correo </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$.ajaxSetup({
   headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});
function enviar(idAlumno){
	var subject;
   var mensaje;
   var idTutor = {{ $idTutor }}
	if ($('#subject').val() != null || $('#subject').val() != '') {
		subject = $('#subject').val();
	} else {
		subject = 'Recordatorio: Llenar Habito Estudio';
	}
	if ($('#mensaje').val() != null || $('#mensaje').val() != '') {
		mensaje = $('#mensaje').val();
	} else {
		mensaje = 'Se le pide por favor que llenen la encuesta de hábito de estudio, la cual es muy necesaria para las proximas sesiones de tutoría. Revise el siguiente link .... ';
	}


   $.ajax({
      type:'POST',
      url: '/enviarMail',
      data: {idAlumno:idAlumno, mensaje:mensaje, idTutor:idTutor, subject:subject},
      //dataType: 'json',
      success:function() {
         console.log('Enviado');
      },
      error:function() {
            console.log("Error ");
      }
   });
}
</script>
