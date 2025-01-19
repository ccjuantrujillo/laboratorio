@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Nuevo Descuento</h1>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
<div class="grid-hor">
    {!!Form::open(['route'=>'descuento.store','method'=>'POST','class'=>'col-sm-10'])!!}
        <div class="form-group">
            {!!Form::label('nombre','Nombre del Curso')!!}
            {!!Form::select('nombre', $productos, 'null', ['class' => 'form-control', 'placeholder'=>'-Seleccionar Curso-','id'=>'nombre']) !!}
            @error('nombre')
            <small class="text-danger">Seleccionar el curso</small>
            @enderror
        </div>

        <div class="form-group">
            {!!Form::label('cant_min','Cantidad Mínima')!!}
            {!!Form::text('cant_min',null,['class'=>'form-control','placeholder'=>'Ingrese la cantidad mínima ...','id'=>'cant_min'])!!}
            @error('cant_min')
            <small class="text-danger">Escribir cantidad mínima</small>
            @enderror
        </div>

        <div class="form-group">
            {!!Form::label('cant_max','Cantidad Máxima')!!}
            {!!Form::text('cant_max',null,['class'=>'form-control','placeholder'=>'Ingrese la cantidad máxima','id'=>'cant_max'])!!}
            @error('cant_max')
            <small class="text-danger">Escribir cantidad máxima</small>
            @enderror
        </div>

<!--         <div class="form-group">
            {!!Form::label('costo','Costo')!!}
            {!!Form::text('costo',null,['class'=>'form-control','placeholder'=>'Ingrese el costo ...','id'=>'costo'])!!}
            @error('costo')
            <small class="text-danger">Falta escribir el costo</small>
            @enderror
        </div> -->

        <div class="form-group">
            {!!Form::label('descuento','Descuento (%)')!!}
            {!!Form::text('descuento',null,['class'=>'form-control','placeholder'=>'Ingrese el descuento ...','id'=>'descuento'])!!}
            @error('descuento')
            <small class="text-danger">Falta escribir el descuento</small>
            @enderror
        </div>

        {!!Form::submit('Agregar',['class'=>'btn btn-info'])!!}
        <!-- Agregar boton de cancelar -->
        <a class="btn btn-danger" href="{{ route('descuento.index') }}">Cancelar</a>
    {!!Form::close()!!}

</div>
</section>

@endsection