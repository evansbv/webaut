<?php

namespace App\Exports;

use App\Models\Autorizaciones;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class AutorizacionesExport implements FromArray
{
    protected $DataAutorizaciones;
    
    public function __construct(array $DatosAutorizaciones)
    {
        $this->DataAutorizaciones = $DatosAutorizaciones;
    }
    public function array(): array
    {
        return $this->DataAutorizaciones;
    }
   
}
