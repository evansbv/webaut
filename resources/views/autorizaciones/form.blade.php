<meta charset="utf-8">
<div class="panel panel-info">
    <div class="panel-heading">
          <h3 class="panel-title">{{ $Modo=='crear' ? 'Agregar Autorización':'Modificar Autorización' }} @if($Modo!='crear') {{$autorizacion->id }} @endif</h3>
    </div>
    <br>


<input id="autciclo" name="autciclo" type="hidden" value="{{ isset($autorizacion->autciclo)?$autorizacion->autciclo:'.' }}">

<div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title">Selecionar Tipo de Vacunación</h3>
    </div>
    <div class="panel-body">
        <label for="Vacunacion">{{'Vacunacion'}}:</label>
        <select  style="width:200px" name="autvac" id="autvac">
            <option value="{{ isset($autorizacion->autvac)?$autorizacion->autvac:'AFTOSA' }}" selected>{{ isset($autorizacion->autvac)?$autorizacion->autvac:'AFTOSA' }}</option>
            <option value="AFTOSA">AFTOSA</option>
            <option value="RABIA">RABIA</option>
        </select>
        
        <label for="Autorización Local:">{{'Autorización Local'}}:</label>
        @if($Modo!='crear')
             @if ($autorizacion->autlocal=='LOCAL')
                   <input type="checkbox" name="autlocal" checked>
             @else
                   <input type="checkbox" name="autlocal" >
             @endif  
         @else
               <input type="checkbox" name="autlocal" >    
        @endif
        </select>
    </div>

</div>


<div class="panel panel-success">

    <div class="panel-heading">
        <h3 class="panel-title">Datos Generales de la Autorización</h3>
      </div>

<div class="panel-body">


    <label for="Productor">{{'Productor'}}:</label>
    <input class="" type="text"  name="autprod" id="autprod" value="{{ isset($autorizacion->autprod)?$autorizacion->autprod:old('autprod') }}">

    <label for="Propiedad">{{'Propiedad'}}:</label>
    <input type="text"  name="autprop" id="autprop" value="{{ isset($autorizacion->autprop)?$autorizacion->autprop:old('autprop') }}">

    <label for="Dosis">{{'Dosis'}}:</label>
    <input type="number" name="autdosis" id="autdosis" value="{{ isset($autorizacion->autdosis)?$autorizacion->autdosis:'0' }}">
    <br>
    <br>
    <label for="Provincia">{{'Provincia'}}:</label>
    <select  style="width:200px" name="autprov" id="autprov">
        <option value="{{ isset($autorizacion->autprov)?$autorizacion->autprov:'0' }}" selected>{{ isset($autorizacion->autprov)?$autorizacion->autprov:'Elija una Provincia' }}</option>
        @foreach ($provincias as $provincia)
            <option value="{{ $provincia->provnom }}">{{ $provincia->provnom }}</option>
        @endforeach
      </select>


    <label for="Municipio">{{'Municipio'}}:</label>
    <select  style="width:200px" name="autmun" id="autmun">
        <option value="{{ isset($autorizacion->autmun)?$autorizacion->autmun:'0' }}" selected>{{ isset($autorizacion->autmun)?$autorizacion->autmun:'Elija un Municipio' }}</option>
        @foreach ($municipios as $municipio)
            <option value="{{ $municipio->munnom }}">{{ $municipio->munnom }}</option>
        @endforeach
      </select>


    <label for="Localidad">{{'Localidad'}}:</label>
    <input type="text"  name="autloc" id="autloc" value="{{ isset($autorizacion->autloc)?$autorizacion->autloc:'' }}">
    <br>
</div>
</div>



<div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title">Selecionar Tipo de Vacunación</h3>
    </div>
    <div class="panel-body">
        <label for="Vacunacion">{{'Vacunacion'}}:</label>
        <select  style="width:200px" name="autmotivo" id="autmotivo">
            <option value="{{ isset($autorizacion->autmotivo)?$autorizacion->autmotivo:'CICLO' }}" selected>{{ isset($autorizacion->autmotivo)?$autorizacion->autmotivo:'CICLO'}}</option>
            <option value="CICLO">CICLO</option>
            <option value="ENERGENCIA">EMERGENCIA</option>
	    <option value="COMPULSIVA">COMPULSIVA</option>
            <option value="ESTRATEGICA">ESTRATEGICA</option>
          </select>

    </div>
</div>

<input id="autlugar" name="autlugar" type="hidden" value="{{ isset($autorizacion->autlugar)?$autorizacion->autlugar:'Santa Cruz' }}">
<!--

-->
<input id="tecid" name="tecid" type="hidden" value="{{ auth()->user()->username }}">
<input id="autstatus" name="autstatus" type="hidden" value="1">
<!-- <input id="created_at" name="created_at" type="date" value="2020-10-30">
<input id="updated_at" name="updated_at" type="date" value="2020-10-30">
 -->

 @if ($Modo=='crear')
 <label for="autlugar">Fecha Creacion :</label>
  <input id="created_at" name="created_at" type="date" value="{{ date('Y-m-d',strtotime(now())) }}">
  <input id="updated_at" name="updated_at" type="date" value="{{ date('Y-m-d',strtotime(now())) }}" hidden>
 @else
 <label for="autlugar">Fecha Modificacion :</label>
 <input id="updated_at" name="updated_at" type="date" value="{{ date('Y-m-d',strtotime(now())) }}">
 @endif

 <!--
 <input id="created_at" name="created_at" type="date" value="{{ date('Y-m-d',strtotime(now())) }}">
 <input id="updated_at" name="updated_at" type="date" value="{{ date('Y-m-d',strtotime(now())) }}">
  -->
<br>
<br>
 <label for="autlugar">Santa Cruz, {{ date('l d F Y',strtotime(now())) }}</label>
 <br>

<input type="submit" class="btn btn-success btn-sm" value="{{ $Modo=='crear' ? 'Generar Autorización':'Modificar Autorización' }}">
 <a class="btn btn-primary btn-sm" href="{{ url('autorizaciones') }} ">Regresar</a>
