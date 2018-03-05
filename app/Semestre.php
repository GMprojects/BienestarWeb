<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
      protected $table = 'Semestre';
      protected $primaryKey = 'idSemestre';
      protected $fillable = [
        'fechaInicio',
        'fechaFin',
        'anioSemestre',
        'numeroSemestre',
        'semestre'
      ];

      public $timestamps = true;

}
