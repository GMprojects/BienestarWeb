<?php

namespace BienestarWeb\Rules;

use Illuminate\Contracts\Validation\Rule;
use BienestarWeb\Semestre;
use Log;

class SemestreValidation implements Rule
{
      function getFecha($fechaIn){
         $dia = substr( $fechaIn,0 ,2);
         $mes =substr( $fechaIn,3 ,2);
         $anio=substr( $fechaIn,-4 ,4);
         return $anio."-".$mes."-".$dia;
      }
      private $id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)//llega fecha
    {

        //convertir Fecha a formato de la bd
         $fecha = SemestreValidation::getFecha($value);
        //verificar que no este dentro del palzo de ningun otro registro
        if ($this->id == '') {
            $semestres = Semestre::whereDate('fechaFin','>',$fecha)->get();
        } else {
            $semestres = Semestre::whereDate('fechaFin','>',$fecha)->where('idSemestre','<>',$this->id)->get();
        }

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
        return 'El campo :attribute se encuentra dentro de otro semestre o es una fecha anterior al semestre registrado.';
    }
}
