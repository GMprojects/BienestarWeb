$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#selectIdTipoActividad").change(function(){
      //console.log("esta cambiando");
      //console.log("Val "+ $(this).val());

      var tamSelectIdResponsable=document.getElementById("selectIdResponsable").length;
      var tamSelectIdAlumno=document.getElementById("selectIdAlumnoI").length;

      if(tamSelectIdResponsable>0){
        $("#selectIdResponsable").children('option').remove();
        ////console.log('Borrando');
      }
      if(tamSelectIdAlumno>0){
        $("#selectIdAlumnoI").children('option').remove();
        ////console.log('Borrando');
      }

      tamSelectIdAlumno=document.getElementById("selectIdAlumnoTutorado").length;
      if(tamSelectIdAlumno>0){
        $("#selectIdAlumnoTutorado").children('option').remove();
        ////console.log('Borrando');
      }
      document.getElementById('selectResponsables').style.display = 'none';
			document.getElementById('selectAlumnosI').style.display = 'none';
      document.getElementById('selectAlumnosTutorados').style.display = 'none';

			document.getElementById('divCuposTotales').style.display = 'none';
			document.getElementById('divListaAlumnos').style.display = 'none';
			document.getElementById('divModalidad').style.display = 'none';
			document.getElementById('boxDatosAdicionales').style.display = 'none';
			document.getElementById('boxResponsableInvitado').style.display = 'none';

      document.getElementById('divNoHayTutor').style.display = 'none';
			document.getElementById('inputFechaFinConvocatoria').style.display = 'none';
      document.getElementById('etiquetaResponsable').innerHTML = 'Responsable';

      switch ($(this).val()) {
              case '1':        case '2':
                    document.getElementById('selectAlumnosI').style.display = 'block';
                    dListaAlumnos('listaAlumnos','Alumnos');
                break;
              case '3':
                    document.getElementById('selectResponsables').style.display = 'block';
        						document.getElementById('divModalidad').style.display = 'block';
              			//document.getElementById('selectAlumnosI').style.display = 'block';
                    document.getElementById('rIndividual').checked = true;
                    dListaResponsables('listaResponsablesAdm','Responsable');
                    dListaAlumnos('listaAlumnos','Alumnos');
                break;
              case '4':
                    document.getElementById('selectResponsables').style.display = 'block';
                    document.getElementById('divModalidad').style.display = 'block';
              		//	document.getElementById('selectAlumnosI').style.display = 'block';
                  //  document.getElementById('rIndividual').checked = true;
                    document.getElementById('etiquetaResponsable').innerHTML = 'Tutor';
                    var numeroSemestre = $('#numeroSemestre').val();
                    var anioSemestre = $('#anioSemestre').val();
                    dListaTutores('listaResponsablesTutores','Tutor',anioSemestre,numeroSemestre);
                break;
              case '5':        case '6':        case '7':
                    document.getElementById('selectResponsables').style.display = 'block';
              			document.getElementById('divCuposTotales').style.display = 'block';
                    dListaResponsables('listaResponsablesGen','Responsable');
                break;
              case '8':
                    document.getElementById('selectResponsables').style.display = 'block';
        						document.getElementById('boxDatosAdicionales').style.display = 'block';
        						document.getElementById('inputFechaFinConvocatoria').style.display = 'block';
                    dListaResponsables('listaResponsablesAdmDoc','Responsable');
                break;
              case '9':
                    document.getElementById('selectResponsables').style.display = 'block';
      							document.getElementById('boxDatosAdicionales').style.display = 'block';
      						  dListaResponsables('listaResponsablesAdm','Responsable');
                break;
              case '10':
                    document.getElementById('selectResponsables').style.display = 'block';
                    document.getElementById('divModalidad').style.display = 'block';
              		//	document.getElementById('selectAlumnosI').style.display = 'block';
                //    document.getElementById('rIndividual').checked = true;
                    dListaResponsables('listaResponsablesGen','Responsable');
                    dListaAlumnos('listaAlumnos','Alumnos');
                break;
              default:
              // code...
              break;
      }

});

var dListaResponsables = function(url, placeholder) {
    var op ="";
    ////console.log(document.getElementById("selectIdResponsable").length);
    //Preparando el AJAX
    $.ajax({
      type:'GET',
      url: '/'+url+'',
      data: '',
      dataType: 'json',
      success:function(data) {
          op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
          $("#selectIdResponsable").append(op);
          for (var i = 0; i < data.length; i++) {
            op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idPersona+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
            $("#selectIdResponsable").append(op);
            ////console.log(op);
          }
          $("#selectIdResponsable").selectpicker("refresh");
          //console.log("Bien");
          //console.log( 'Responsables:  '+document.getElementById("selectIdResponsable").length);
      },
      error:function() {
          //console.log("nada");
      }
    });
    //Fin del AJAX
};

var dListaTutores = function(url, placeholder,anioSemestre, numeroSemestre) {
    var op ="";
    //console.log('anioSemestre:  '+anioSemestre);
    //console.log('numeroSemestre:  '+numeroSemestre);
    //Preparando el AJAX
    $.ajax({
      type:'GET',
      url: '/'+url+'',
      data: {anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
      dataType: 'json',
      success:function(data) {
        if(data.length == 0){
              document.getElementById('divNoHayTutor').style.display = 'block';
              document.getElementById('mensajeTutor').innerHTML = 'No existen tutores registrados en el ciclo académico '+anioSemestre+'-'+numeroSemestre+'.';
        }else {
              op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
              $("#selectIdResponsable").append(op);
              for (var i = 0; i < data.length; i++) {
                op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idPersona+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
                $("#selectIdResponsable").append(op);
                ////console.log(op);
              }
              $("#selectIdResponsable").selectpicker("refresh");
              //console.log("Bien");
              //console.log( 'Tutores:  '+document.getElementById("selectIdResponsable").length);
        }
      },
      error:function() {
          //console.log("nada");
      }
    });
    //Fin del AJAX
};

var dListaAlumnos = function(url, placeholder) {
    var op ="";
    ////console.log(document.getElementById("selectIdResponsable").length);
  //  var tamSelectIdResponsable=document.getElementById("selectIdAlumno").length;
    //if(tamSelectIdResponsable>0){
  //    $("#selectIdAlumno").children('option').remove();
      ////console.log('Borrando');
  //  }
    //Preparando el AJAX
    $.ajax({
      type:'GET',
      url: '/'+url+'',
      data: "",
      dataType: 'json',
      success:function(data) {
          op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
          $("#selectIdAlumnoI").append(op);
          for (var i = 0; i < data.length; i++) {
            op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idAlumno+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
            $("#selectIdAlumnoI").append(op);
            ////console.log(op);
          }
          $("#selectIdAlumnoI").selectpicker("refresh");
          //console.log("Bien");
          //console.log( 'Alumnos:  '+document.getElementById("selectIdAlumno").length);
      },
      error:function() {
          //console.log("nada");
      }
    });
    //Fin del AJAX
};

$("#selectIdResponsable").change(function(){
    if($('#selectIdTipoActividad').val() == 4){
          var op ="";
          ////console.log(document.getElementById("selectIdResponsable").length);
          var tamSelectIdAlumno=document.getElementById("selectIdAlumnoI").length;
          if(tamSelectIdAlumno>0){
            $("#selectIdAlumnoI").children('option').remove();
            console.log('Borrando');
          }
          var tamSelectIdAlumno=document.getElementById("selectIdAlumnoTutorado").length;
          if(tamSelectIdAlumno>0){
            $("#selectIdAlumnoTutorado").children('option').remove();
            console.log('Borrando');
          }
          var numeroSemestre = $('#numeroSemestre').val();
          var anioSemestre = $('#anioSemestre').val();
        //  //console.log('anioSemestre:  '+anioSemestre);
        //  //console.log('numeroSemestre:  '+numeroSemestre);
        //  //console.log('idPersona:  '+$(this).val());
          //Preparando el AJAX
          //Pvar
          console.log("TutorTutoradoooo");
          $.ajax({
            type:'GET',
            url: '/listaTutorados',
            data: {idPersona:$(this).val(), anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
            dataType: 'json',
            success:function(data) {
              console.log($('input:radio[name=modalidad]').val());
        //        if($('input:radio[name=modalidad]').val() == '1'){
                  //console.log("TutorTutoradoooo INDIVIDUAL");
                //  op ='<option value="" selected> Seleccione Alumno </option>';
              //    $("#selectIdAlumnoTutorado").append(op);
                  for (var i = 0; i < data.length; i++) {
                    op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idAlumno+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
                    $("#selectIdAlumnoTutorado").append(op);
                    console.log(op);
                  }
                  $("#selectIdAlumnoTutorado").selectpicker("refresh");
//                }

                //console.log("Bien");
                //console.log( 'Alumnos:  '+document.getElementById("selectIdAlumno").length);
            },
            error:function() {
                //console.log("nada");
            }
          });
          //Fin del AJAX
    }
});

$("#anioSemestre").click(function(){
        document.getElementById('divNoHayTutor').style.display = 'none';
        if($('#selectIdTipoActividad').val() == 4){
          var op ="";
          //console.log('anioSemestre:  '+anioSemestre);
          //console.log('numeroSemestre:  '+numeroSemestre);
          //Preparando el AJAX
          $.ajax({
            type:'GET',
            url: '/listaResponsablesTutores',
            data: {anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
            dataType: 'json',
            success:function(data) {
              if(data.length == 0){
                    document.getElementById('divNoHayTutor').style.display = 'block';
                    document.getElementById('mensajeTutor').innerHTML = 'No existen tutores registrados en el ciclo académico '+anioSemestre+'-'+numeroSemestre+'.';
              }else {
                    op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
                    $("#selectIdResponsable").append(op);
                    for (var i = 0; i < data.length; i++) {
                      op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idPersona+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
                      $("#selectIdResponsable").append(op);
                      ////console.log(op);
                    }
                    $("#selectIdResponsable").selectpicker("refresh");
                    //console.log("Bien");
                    //console.log( 'Tutores:  '+document.getElementById("selectIdResponsable").length);
              }
            },
            error:function() {
                //console.log("nada");
            }
          });
          //Fin del AJAX
        }
});
$("#numeroSemestre").change(function(){
        document.getElementById('divNoHayTutor').style.display = 'none';
  /*      if($('#selectIdTipoActividad').val() == 4){
          var op ="";
          //console.log('anioSemestre:  '+anioSemestre);
          //console.log('numeroSemestre:  '+numeroSemestre);
          //Preparando el AJAX
          $.ajax({
            type:'GET',
            url: '/listaResponsablesTutores',
            data: {anioSemestre:anioSemestre, numeroSemestre:numeroSemestre},
            dataType: 'json',
            success:function(data) {
              if(data.length == 0){
                    document.getElementById('divNoHayTutor').style.display = 'block';
                    document.getElementById('mensajeTutor').innerHTML = 'No existen tutores registrados en el ciclo académico '+anioSemestre+'-'+numeroSemestre+'.';
              }else {
                    op ='<option value="" selected> Seleccione un '+placeholder+' </option>';
                    $("#selectIdResponsable").append(op);
                    for (var i = 0; i < data.length; i++) {
                      op ='<option data-tokens="'+data[i].codigo+'" data-subtext="'+data[i].codigo+'" value="'+data[i].idPersona+'">'+data[i].apellidoPaterno+' '+data[i].apellidoMaterno+' '+data[i].nombre+'</option>';
                      $("#selectIdResponsable").append(op);
                      ////console.log(op);
                    }
                    $("#selectIdResponsable").selectpicker("refresh");
                    //console.log("Bien");
                    //console.log( 'Tutores:  '+document.getElementById("selectIdResponsable").length);
              }
            },
            error:function() {
                //console.log("nada");
            }
          });
          //Fin del AJAX
        }*/
});
