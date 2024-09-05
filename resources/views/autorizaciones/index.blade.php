
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
@extends('layouts.app')

@section('content')

<div class="container">


        @if (Session::has('Mensaje'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('Mensaje') }}
            </div>
        @endif

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Listado de Autorizaciones</div>
                <div class="card-body">
<a href="{{ url('autorizaciones/create') }} " class="btn btn-sm btn-success">Generar Autorización</a>
<label for="">Autorizaciones: {{ number_format($AutTotal) }} </label> /
<label for="">Total Dosis: {{ number_format($DosisTotal) }}</label> /
<label for="">Dosis Aftosa: {{ number_format($DosisAftosa) }}</label> /
<label for="">Dosis Rabia: {{ number_format($DosisRabia) }}</label>
<!-- SEARCH -->
<form action="{{route('searchdate')}}" method="get" >
    {{ csrf_field() }}
        <br />
            <div class="row input-daterange">
                <div class="col-md-2">
                    <!-- <input type="date" name="from_date" id="from_date" class="form-control" placeholder="Desde" value="{{ date('Y-m-d',strtotime(date('Y-m-d').'- 2 days')) }}"/> -->
                   <input type="date" name="from_date" id="from_date" class="form-control" placeholder="Desde" value="{{ $from_date ?? ''  }}"/>
                </div>
                <div class="col-md-2">
                   <input type="date" name="to_date" id="to_date" class="form-control" placeholder="Hasta"  value="{{ $to_date ?? '' }}" />
                </div>
                <div class="col-md-4" >

                      <button type="submit" name="filter" id="filter" class="btn btn-primary">Filtrar</button>
                      <button type="submit" name="refresh" id="refresh" class="btn btn-default">Actualizar</button>

                    <button type="submit" name="export" id="export" class="btn btn-primary" value=1>Exportar en Excel</button>
                </div>
                <div class="col-md-3">
                    <input type="text" name="patron" id="patron" class="form-control" placeholder="Buscador..."  value="{{ $patron ?? '' }}" />

                </div>
            </div>
            <br />
</form>
<!-- ENDSEARCH -->

<table class="table table-light table-hover" style="font-size: 15px">
    <thead class="thead-light">
        <tr>

            <th>No Aut</th>
            <th>Vacuna</th>
            <th>Productor</th>
            <th>Propiedad</th>
            <th>Dosis</th>
            <th style="width:100px">Municipio</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($autorizaciones as $autorizacion)
          @if($autorizacion->autstatus == 1)
            <tr >
          @else
            <tr style="background-color:#ea899a">
          @endif

                <td style="font-size:80%"><center>{{$autorizacion->id}}</center></td>
                <td style="font-size:80%">{{$autorizacion->autvac}}</td>
                <td style="font-size:80%">{{$autorizacion->autprod}}</td>
                <td style="font-size:80%">{{$autorizacion->autprop}}</td>
                <td style="font-size:80%" >{{$autorizacion->autdosis}}</td>
                <td style="font-size:80%">{{$autorizacion->autmun}}</td>

                <td style="font-size:80%">{{ date_format(new datetime(substr($autorizacion->updated_at,1,10)),"d/m/Y") }}</td>
                <td>
                    <a class="btn btn-sm btn-warning" style="display:inline" href="{{ url('/autorizaciones/'.$autorizacion->id.'/edit') }}">Editar</a> |
                    <form method="post" action="{{ url('/autorizaciones/'. $autorizacion->id) }}" style="display:inline">

                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    </form>
                    @if($autorizacion->autstatus == 1)
            		  <a class="btn btn-danger btn-sm" style="display:inline" href="{{ route('anular', $autorizacion->id ) }}" type="submit" onclick="return confirm('Anular?');">Anular</a> |
                    @else
                      <a class="btn btn-success btn-sm" style="display:inline" href="{{ route('anular', $autorizacion->id ) }}" type="submit" onclick="return confirm('Activar?');" >Activar</a> |
                    @endif

                    <a class="btn btn-sm btn-primary" style="display:inline" href="{{ route('descargarPDF', $autorizacion->id ) }}" target="_blank">Imprimir</a>
                </td>
            </tr>
        @endforeach

    </tbody>

</table>
{{ $autorizaciones->links() }}

</div>

</div>
</div>
</div>
</div>



@endsection
