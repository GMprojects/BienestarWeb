<?php

namespace BienestarWeb;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BeneficiarioComedor extends Pivot
{
   protected $table = 'BeneficiarioComedor';
   protected $primaryKey = 'idBeneficiarioComedor';
   protected $fillable = [
     'fechaBeneficio',
     'tipoBeneficiario'];

   public $timestamps = true;
}
