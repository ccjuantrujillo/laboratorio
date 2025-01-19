@extends('layouts.admin')

@section('content')
    
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Nuevo Solicitante</h1>
        </div>
    </div>
    </div>
</section>
<!-- /Content Header (Page header) -->
    
<section class="content">
    <div class="grid-hor">
        {!!Form::open(['route'=>'solicitante.store','method'=>'POST','class'=>'col-sm-10'])!!}  
            <div class="form-group">
                {!!Form::label('tipo','Tipo')!!}
                {!!Form::select('tipo', $tiposolicitante, 'null', ['class' => 'form-control', 'placeholder'=>'Seleccione tipo de Solicitante','id'=>'tipo']) !!}
                @error('tipo')
                <small class="text-danger">Escribir el tipo de solicitante</small>    
                @enderror
            </div>                     
            <div class="form-group">
                {!!Form::label('nombre','Nombres')!!}
                {!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre','id'=>'nombre'])!!}
                @error('nombre')
                <small class="text-danger">Escribir el nombre del solicitante</small>    
                @enderror
            </div>        
            <div class="form-group">
                {!!Form::label('ruc','R.U.C.')!!}
                {!!Form::text('ruc',null,['class'=>'form-control','placeholder'=>'Ingrese el RUC de Solicitante','id'=>'ruc','maxlength'=>'11'])!!}
                @error('ruc')
                <small class="text-danger">Escribir el RUC del solicitante</small>    
                @enderror
            </div>
            <div class="form-group">
            {!!Form::label('email','Email')!!}
                {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingrese el Correo Electronico','id'=>'email'])!!}
                @error('email')
                <small class="text-danger">Escribir el email del solicitante</small>    
                @enderror
            </div>
            <div class="form-group">
            {!!Form::label('direccion','Direccion')!!}
                {!!Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Ingrese la dirección','id'=>'direccion'])!!}
                @error('direccion')
                <small class="text-danger">Escribir la dirección del solicitante</small>    
                @enderror
            </div>
            <div class="form-group">
                {!!Form::label('telefono','Telefono')!!}
                {!!Form::tel('telefono',null,['class'=>'form-control','placeholder'=>'Ingrese el telefono','id'=>'telefono'])!!}
                @error('telefono')
                <small class="text-danger">Escribir el telefono del solicitante</small>    
                @enderror
            </div>  
            <div class="form-group">
                {!!Form::label('ubigeo','Ubigeo')!!}
                {!!Form::text('ubigeo','010104',['class'=>'form-control','placeholder'=>'Ingrese el Correo Electronico','id'=>'ubigeo'])!!}
                @error('ubigeo')
                <small class="text-danger">Escribir el ubigeo</small>    
                @enderror
            </div>  
            {!!Form::submit('Agregar',['class'=>'btn btn-info'])!!}
            <a class="btn btn-danger" href="{{ route('solicitante.index') }}">Cancelar</a>            

        {!!Form::close()!!}
    </div>
    
</section>

@endsection