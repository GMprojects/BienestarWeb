<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-email-r">
	{{Form::Open(['action'=>['ActividadController@enviarMensaje'],'method'=>'post'])}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
				<h4 class="modal-title"><b>Mensaje para Responsable</b></h4>
			</div>
			<div class="modal-body">
         {{ Form::hidden('idEmisor',  Auth::user()->id ) }}
			{{ Form::hidden('idReceptor', $actividad->responsable->id) }}
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
				  <div class="col-md-12">
						 <div class="form-group">
							  <label for="to">To</label>
							  <input id="to" readonly type="text" name="to" class="form-control" value="{{ $actividad->responsable->email }}">
						 </div>
				  </div>
			 </div>
				<div class="row">
	            <div class="col-md-12">
	                <div class="form-group">
	                    <label for="subject">Asunto</label>
	                    <input id="subject" required type="text" name="subject" class="form-control" value="Asunto">
	                    <div class="help-block with-errors"></div>
	                </div>
	            </div>
	        </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <label for="mensaje">Mensaje </label>
                       <textarea id="mensaje" required name="mensaje" required class="form-control" style="resize: none;" rows="4" >Se le pide por favor que llenen la encuesta de hábito de estudio, la cual es muy necesaria para las próximas sesiones de tutoría.</textarea>
                       <div class="help-block with-errors"></div>
                   </div>
               </div>
            </div>
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

<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-email-p">
	{{Form::Open(['action'=>['ActividadController@enviarMensaje'],'method'=>'post'])}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
            <h4 class="modal-title"><b>Mensaje para Programador</b></h4>
			</div>
			<div class="modal-body">
         {{ Form::hidden('idEmisor',  Auth::user()->id ) }}
			{{ Form::hidden('idReceptor',  $actividad->programador->id) }}
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
					 <div class="col-md-12">
							<div class="form-group">
								 <label for="to">To</label>
								 <input id="to" readonly type="text" name="to" class="form-control" value="{{ $actividad->programador->email }}">
							</div>
					 </div>
				</div>
				<div class="row">
	            <div class="col-md-12">
	                <div class="form-group">
	                    <label for="subject">Asunto</label>
	                    <input id="subject" required type="text" name="subject" class="form-control" value="Asunto">
	                    <div class="help-block with-errors"></div>
	                </div>
	            </div>
	        </div>
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <label for="mensaje">Mensaje </label>
                       <textarea id="mensaje" required name="mensaje" required class="form-control" style="resize: none;" rows="4" >Escriba su mensaje.</textarea>
                       <div class="help-block with-errors"></div>
                   </div>
               </div>
            </div>
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

{{--@if($actividad->invitado != null)
	<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-email-ri">
		{{Form::Open(['action'=>['ActividadController@enviarMensaje'],'method'=>'post'])}}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-remove"></span></button>
					<h4 class="modal-title"><b>Mensaje para Responsable Invitado</b></h4>
				</div>
				<div class="modal-body">
	         {{ Form::hidden('idEmisor',  Auth::user()->id ) }}
				{{ Form::hidden('idReceptor', '0') }}
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
					  <div class="col-md-12">
							 <div class="form-group">
								  <label for="to">To</label>
								  <input id="to" readonly type="text" name="to" class="form-control" value="{{preg_split("/[-]/",$actividad->invitado)[2] }}">
							 </div>
					  </div>
				 </div>
					<div class="row">
		            <div class="col-md-12">
		                <div class="form-group">
		                    <label for="subject">Asunto</label>
		                    <input id="subject" required type="text" name="subject" class="form-control" value="Asunto">
		                    <div class="help-block with-errors"></div>
		                </div>
		            </div>
		        </div>
	            <div class="row">
	               <div class="col-md-12">
	                   <div class="form-group">
	                       <label for="mensaje">Mensaje </label>
	                       <textarea id="mensaje" required name="mensaje" required class="form-control" style="resize: none;" rows="4" >Se le pide por favor que llenen la encuesta de hábito de estudio, la cual es muy necesaria para las próximas sesiones de tutoría.</textarea>
	                       <div class="help-block with-errors"></div>
	                   </div>
	               </div>
	            </div>
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
@endif--}}
