@extends('layouts.admin')

@section('content')

<!-- Content Header -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Listado de Cotizaciones</h1>
      </div>
      <div class="col-sm-6 text-right">
        <a class="btn btn-info" href="{{ route('createCotizacion') }}">Agregar Cotizacion</a>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /Content Header -->

<!-- Main Content-->
<section class="content">
    <indexcotizacion-component></indexcotizacion-component>
</section>

@endsection