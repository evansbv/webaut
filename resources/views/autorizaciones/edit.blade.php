
  @extends('layouts.app')

  @section('content')
  <div class="container">


<meta charset="ISO-8859-1">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<form action="{{ url('/autorizaciones/'. $autorizacion->id) }}" method="post">

{{ csrf_field() }}
{{ method_field('PATCH') }}

@include('autorizaciones.form',['Modo'=>'Editar'])


</form>

</div>
@endsection
