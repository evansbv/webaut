<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autorizaciones;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class PDFController extends Controller
{
    public function PDF($id){

        $data=Autorizaciones::find($id);
        /*
         * echo "<br>"
        echo $data->id.'<br>';
        echo $data->autvac.'<br>';
        echo $data->autprod.'<br>';
        echo $data->autprop.'<br>';
        echo $data->dosis.'<br>';
        dd($data);
        */
        //Codigo Erick en la vista con Blade... se debe mejorar
        $tecnom=Auth()->user()->name;
        $pdf = \PDF::loadview('autorizacion_print',compact('data','tecnom'));
        return $pdf->stream('autorizacion'.$id.date('Ymdhis',strtotime(now())).'.pdf');// 620201106112830->6 - 2020-11-06 11:28:30
    }

}
