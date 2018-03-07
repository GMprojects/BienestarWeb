<?php

namespace BienestarWeb\Rules;

use Illuminate\Contracts\Validation\Rule;
use BienestarWeb\Semestre;

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
         //verificar sino hay otro registro del mismo años y ciclo
         $semestres = Semestre::where([['anioSemestre', $this->anioSemestre], ['numeroSemestre', $value]])->get();
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
        return 'Este semestre ya se encuentra registrado, puede eliminar o editar el registro.';
    }
}
