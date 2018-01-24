<?php

namespace BienestarWeb\Rules;

use Illuminate\Contracts\Validation\Rule;
use BienestarWeb\Semestre;
use Log;

class NumSemestreValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
     private $anioSemestre;
    public function __construct($anioSemestre)
    {
        $this->anioSemestre = $anioSemestre;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $ciclo = ($value == 1) ? 'I' : 'II' ;
         //verificar sino hay otro registro del mismo años y ciclo
         $semestres = Semestre::where('semestre', $this->anioSemestre.'-'.$ciclo)->get();
         if (count($semestres)==0) {
              return true;
           } else {
              return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Este semestre ya se encuentra registrado, puede eliminar o editar el otro registro.';
    }
}
