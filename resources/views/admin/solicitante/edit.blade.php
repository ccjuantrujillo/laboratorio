@extends('layouts.admin')

@section('content')
    
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Editar Solicitante</h1>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
<!---->

<section class="content">
    <div class="grid-hor">
        {!!Form::model($solicitante , ['route'=>['solicitante.update', $solicitante->SOLIP_Codigo],'method'=>'PATCH','class'=>'col-sm-10'])!!}
            <div class="form-group">
                {!!Form::label('codigo','Codigo')!!}
                {!!Form::text('codigo',$solicitante->SOLIP_Codigo,['class'=>'form-control','placeholder'=>'Ingrese el nombre','id'=>'codigo','readonly'=>'readonly'])!!}
            </div> 
            <div class="form-group">
                {!!Form::label('tipo','Tipo')!!}
                {!!Form::select('tipo', $tiposolicitante, $solicitante->TIPSOLIP_Codigo, ['class' => 'form-control', 'placeholder'=>'Seleccione tipo de Solicitante','id'=>'tipo']) !!}
            </div>                    
            <div class="form-group">
                {!!Form::label('nombre','Nombres')!!}
                {!!Form::text('nombre',$solicitante->SOLIC_Nombre,['class'=>'form-control','placeholder'=>'Ingrese el nombre','id'=>'nombre'])!!}
            </div>           
            <div class="form-group">
                {!!Form::label('ruc','R.U.C.')!!}
                {!!Form::text('ruc',$solicitante->SOLIC_Ruc,['class'=>'form-control','placeholder'=>'Ingrese el RUC de Solicitante','id'=>'ruc','maxlength'=>'11'])!!}
            </div>
            <div class="form-group">
            {!!Form::label('email','Email')!!}
                {!!Form::text('email',$solicitante->SOLIC_Email,['class'=>'form-control','placeholder'=>'Ingrese el Correo Electronico','id'=>'email'])!!}
            </div>
            <div class="form-group">
            {!!Form::label('direccion','Direccion')!!}
                {!!Form::text('direccion',$solicitante->SOLIC_Direccion,['class'=>'form-control','placeholder'=>'Ingrese la dirección','id'=>'direccion'])!!}
            </div>
            <div class="form-group">
                {!!Form::label('telefono','Telefono')!!}
                {!!Form::text('telefono',$solicitante->SOLIC_Telefono,['class'=>'form-control','placeholder'=>'Ingrese el telefono','id'=>'telefono'])!!}
            </div>  
            <div class="form-group">
                {!!Form::label('ubigeo','Ubigeo')!!}
                {!!Form::text('ubigeo',$solicitante->UBIGP_Codigo,['class'=>'form-control','placeholder'=>'Ingrese el Correo Electronico','id'=>'ubigeo'])!!}
            </div>  
            {!!Form::submit('Editar',['class'=>'btn btn-info'])!!}
            <a class="btn btn-danger" href="{{ route('solicitante.index') }}">Cancelar</a>
        {!!Form::close()!!}
    </div>
    
</section>

@endsection