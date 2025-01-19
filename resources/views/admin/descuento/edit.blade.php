@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Editar Descuento</h1>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
<div class="grid-hor">

    {!!Form::model($descuento, ['route'=>['descuento.update', $descuento->id_descuento],'method'=>'PATCH', 'class'=>'col-sm-10'])!!}

        <div class="form-group">
            {!!Form::label('nombre','Nombre')!!}
            {!!Form::select('nombre', $productos, $descuento->id_curso, ['class' => 'form-control', 'placeholder'=>'-Seleccionar Curso-','id'=>'nombre']) !!}
        </div>

        <div class="form-group">
            {!!Form::label('cant_min','Cantidad Mínima')!!}
            {!!Form::text('cant_min', $descuento->cantidad_min,['class'=>'form-control','id'=>'cant_min'])!!}
        </div>

        <div class="form-group">
        {!!Form::label('cant_max','Cantidad Máxima')!!}
            {!!Form::text('cant_max', $descuento->cantidad_max,['class'=>'form-control','id'=>'cant_max'])!!}
        </div>

        <div class="form-group">
        {!!Form::label('descuento','Descuento (%)')!!}
            {!!Form::text('descuento', $descuento->descuento,['class'=>'form-control','id'=>'descuento'])!!}
        </div>

    {!!Form::submit('Editar',['class'=>'btn btn-info'])!!}
    <a class="btn btn-danger" href="{{ route('descuento.index') }}">Cancelar</a>

    {!!Form::close()!!}
</div>
</section>

@endsection