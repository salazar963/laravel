@extends('layouts.libro')
@section('title', 'Título del sitio web')
@section('description', 'Descripción del sitio web')
@section('keywords', 'palabras, clave, del, sitio, web')

@section('content')

{!!Form::open(['route'=>'libro.store', 'method'=>'POST'])!!}
	<div class="form-group">
		{!!Form::label('nombre','Nombre:')!!}
		{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('descripcion','Correo:')!!}
		{!!Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>
	{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}
@stop