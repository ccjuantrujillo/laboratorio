@extends('layouts.admin')

@section('content')

<!-- Content Header-->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        <h1>Agregar Cotización</h1>
    </div>
  </div>
</section>
<!-- /Content Header-->

<!-- Main Content-->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <createcotizacion-component token="{{csrf_token()}}"></createcotizacion-component>
      </div>
    </div>
  </div>
</section>
<!-- /Main Content-->

@endsection