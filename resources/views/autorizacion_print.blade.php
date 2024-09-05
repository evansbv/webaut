<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>WebAutorizaciones</title>

        <style>
                .fondo {                      
                @if ($data->autvac=='AFTOSA')              
                    background: url('fondo_aut_aftosa.jpg');
                @else
                    background: url('fondo_aut_rabia.jpg');
                @endif 
                    height:1000px;
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: cover;
                    position: relative;
                }
            </style>
            <?php
                    $fechaPrn = date('d-m-Y',strtotime(now()));
                    $fechaAut = date_format(new datetime(substr($data->updated_at,1,10)),"d/m/Y");
                    $QR_string = 'Autorizacion:'. $data->id . ';'
                                .'Ciclo:'. $data->autciclo . ';'
                                .'Vacuna Anti:'. $data->autvac . ';'
                                .'Productor:'. $data->autprod . ';'
                                .'Propiedad:'. $data->autprop . ';'
                                .'Dosis:'. $data->autdosis . ';'
                                .'Fecha:'. date_format(new datetime(substr($data->updated_at,1,10)),"d-m-Y") . ';'
                                .'Fecha impresión:' . $fechaPrn


            ?>



    </head>
    <body >
    <!-- Aqui debes colocar el cofigo html para la impresion -->
    <div class="fondo">
        <br><br><br><br><br><br>
        <table CELLPADDING="0" CELLSPACING="1" style="font-size: 13px;" border=0>
        <tr>
            <td style="padding-left:100px" colspan="3">AUTORIZACION PARA LA COMPRA DE VACUNA ANTI:  <b>{{ $data->autvac }}</b></td>
        </tr>
        <tr>
            <td align="right" style="padding-right:200px" colspan="3">Autorización <b>Nº {{ $data->id }} </b></td>
        </tr>
        <tr>
            @if ($data->autvac=='AFTOSA') 
                <td style="padding-left:10px" colspan="3">El Programa Nacional de Erradicación de la Fiebre Aftosa PRONEFA autoriza al:</td>
            @else
                <td style="padding-left:10px" colspan="3">El Programa Nacional de Prevención y Control de Rabia de los herbivoros autoriza al:</td>
            @endif    
        </tr>
        <tr>
            <td style="padding-left:10px" colspan="3">Sr(a): <b>{{ $data->autprod }}</b></td>
        </tr>
        <tr>
            <td style="padding-left:10px" colspan="3">Propietario(a) de la(s) Propiedad(es): <b>{{ $data->autprop }}</b></td>
        </tr>
        <tr>
            <td style="padding-left:10px"  colspan="3" > Provincia: <b>{{ $data->autprov}}</b> ; Municipio: <b>{{ $data->autmun}}</b> ; Localidad: <b>{{ $data->autloc}}</b> </td>
           </tr>
        <tr>
            <td style="padding-left:10px" colspan="3"  >La compra de: ---<b>{{ number_format($data->autdosis) }}</b> dosis. Para realizar la vacunación del Ciclo:<b>{{ $data->autciclo }}</b></td>

        </tr>
        <tr>
            <td style="padding-left:10px" colspan=2 valign=top >Motivo de la vacunación: <b>{{ $data->autmotivo }}</b></td>
            <td  rowspan=3 ALIGN="center" VALIGN="center"width="255"> <img src="{{ route('Generador_QR',$QR_string) }}" width="85" height="85">
                <p style="padding-right:100px" ALIGN="center"  VALIGN="bottom"><span >Fecha de Registro: <?php echo $fechaAut ?></span></p>
            </td>
        </tr>
        <tr>
            <td  style="padding-left:10px" width="5">Nota</td>
            <td width="290" valign=top>
            El Propietario o Encargado de la unidad productiva, debe comunicar la
            fecha de la vacunación a la oficina local de su jurisdicción.
            La vacunación no será Certificada si no es Fiscalizada y/o Asistida
            por la oficina local o por su fiscalizador acreditado para su respectiva
            acreditación.</td>

        </tr>
        <tr height=0>
            <td width=54 style='border:none'></td>
            <td width=330 style='border:none'></td>
            <td width=192 style='border:none'></td>
           </tr>


    </table>
<br>
    <table CELLPADDING="0" CELLSPACING="0" style="font-size: 13px;" width="100%">
        <tr>
                <td align="center" style="padding-left:10px" width="33%">Firma del Veterinario Oficial</td>
                <td align="center" width="33%" >Nombre y firma del Productor</td>
                <td align="center" width="40%">nombre y Firma del Resp. de Ventas</td>
        </tr>
        <tr>
        <td align="center" style="padding-left:10px" width="33%">Dr. {{ $tecnom }}</td>
            <td align="center" width="33%" >Propietario o Encargado</td>
            <td align="center" width="40%">de la Empresa (sello)</td>
    </tr>
    <tr>
        <td style="padding-left:10px" colspan="3" align="center"><b>ESTA AUTORIZACIÓN TIENE UNA VALIDEZ DE 5 DÍAS DESDE LA FECHA DE SU EMISIÓN</b></td>
    </tr>
    </table>


    <br>
    <br>
    <br><br><br><br><br><br><br><br>
    <table CELLPADDING="0" CELLSPACING="1" style="font-size: 13px;" border=0>
        <tr>
            <td style="padding-left:100px" colspan="3">AUTORIZACION PARA LA COMPRA DE VACUNA ANTI <b>{{ $data->autvac }}</b></td>
        </tr>
        <tr>
            <td align="right" style="padding-right:200px" colspan="3">Autorización <b>Nº {{ $data->id }} </b></td>
        </tr>
        <tr>
            <td style="padding-left:10px" colspan="3">El Programa Nacional de Erradicación de la Fiebre Aftosa PRONEFA autoriza al:</td>
        </tr>
        <tr>
            <td style="padding-left:10px" colspan="3">Sr(a): <b>{{ $data->autprod }}</b></td>
        </tr>
        <tr>
            <td style="padding-left:10px" colspan="3">Propietario(a) de la(s) Propiedad(es): <b>{{ $data->autprop }}</b></td>
        </tr>
        <tr>
            <td style="padding-left:10px"  colspan="3" > Provincia: <b>{{ $data->autprov}}</b> ; Municipio: <b>{{ $data->autmun}}</b> ; Localidad: <b>{{ $data->autloc}}</b> </td>
           </tr>
        <tr>
            <td style="padding-left:10px" colspan="3"  >La compra de: ---<b>{{ number_format($data->autdosis) }}</b> dosis. Para realizar la vacunación del Ciclo:<b>{{ $data->autciclo }}</b></td>

        </tr>
        <tr>
            <td style="padding-left:10px" colspan=2 valign=top >Motivo de la vacunación: <b>{{ $data->autmotivo }}</b></td>
            <td  rowspan=3 ALIGN="center" VALIGN="center"width="255">  <img src="{{ route('Generador_QR',$QR_string) }}" width="85" height="85">
                <p style="padding-right:100px" ALIGN="center"  VALIGN="bottom"><span >Fecha de Registro: <?php echo $fechaAut ?></span></p>
            </td>
        </tr>
        <tr>
            <td  style="padding-left:10px" width="5">Nota</td>
            <td width="290" valign=top>
            El Propietario o Encargado de la unidad productiva, debe comunicar la
            fecha de la vacunación a la oficina local de su jurisdicción.
            La vacunación no será Certificada si no es Fiscalizada y/o Asistida
            por la oficina local o por su fiscalizador acreditado para su respectiva
            acreditación.</td>

        </tr>
        <tr height=0>
            <td width=54 style='border:none'></td>
            <td width=330 style='border:none'></td>
            <td width=192 style='border:none'></td>
           </tr>


    </table>
<br>
    <table CELLPADDING="0" CELLSPACING="0" style="font-size: 13px;" width="100%">
        <tr>
                <td align="center" style="padding-left:10px" width="33%">Firma del Veterinario Oficial</td>
                <td align="center" width="33%" >Nombre y firma del Productor</td>
                <td align="center" width="40%">nombre y Firma del Resp. de Ventas</td>
        </tr>
        <tr>
        <td align="center" style="padding-left:10px" width="33%">Dr. {{ $tecnom }}</td>
            <td align="center" width="33%" >Propietario o Encargado</td>
            <td align="center" width="40%">de la Empresa (sello)</td>
    </tr>
    <tr>
        <td style="padding-left:10px" colspan="3" align="center"><b>ESTA AUTORIZACIÓN TIENE UNA VALIDEZ DE 5 DÍAS DESDE LA FECHA DE SU EMISIÓN</b></td>
    </tr>
    </table>
</div>


    </body>
</html>
