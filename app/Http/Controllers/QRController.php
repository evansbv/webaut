<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autorizaciones;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class QRController extends Controller
{
    public function Generador_QR($QR_cadena){

        return QrCode::generate($QR_cadena);
    }
}
