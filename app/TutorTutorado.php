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

    public function habitoEstudio()
    {
        return $this->hasOne('BienestarWeb\EncuestaRespondida', 'idTutorTutorado');
    }
    public function tutorado()
    {
        return $this->belongsTo('BienestarWeb\Alumno', 'idAlumno');
    }
    public function tutor()
    {
        return $this->belongsTo('BienestarWeb\Docente', 'idDocente');
    }
    public function getCreatedAtColumn()
   {
       return $this->pivotParent->getCreatedAtColumn();
   }
   public function getUpdatedAtColumn()
   {
      if ($this->pivotParent) {
            return $this->pivotParent->getUpdatedAtColumn();
        }
        return static::UPDATED_AT;
   }
}
