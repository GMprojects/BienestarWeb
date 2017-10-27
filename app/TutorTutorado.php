<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TutorTutorado extends Pivot
{
    protected $table = 'TutorTutorado';
    protected $primaryKey = 'idTutorTutorado';
    protected $fillable = [
      'anioSemestre',
      'numeroSemestre',
      'habitoEstudioRespondido',
      'idAlumo',
      'idDocente'];

    public $timestamps = true;

    public function habitosEstudio(){
    	return $this->hasMany('BienestarWeb\HabitoEstudio','idTutorTutorado','idTutorTutorado');
    }
}
