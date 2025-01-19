@extends('layouts.admin')
 
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Listado de Solicitantes</h1>
      </div>
      <div class="col-sm-6 text-right">
        <!-- actualizado por marck, usando ELOQUENT -->
        <a class="btn btn-info" href="{{ route('solicitante.create') }}">Agregar Solicitante</a>
        <a class="btn" data-toggle="tooltip" data-placement="bottom" title="Generar PDF" href="{{ route('cotizaciones.pdf') }}"><i class="far fa-file-pdf" style="color:red; font-size:30px; cursor:pointer;"></i></a>      
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
    
<!-- Main Content-->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr class="text-center">
                  <th scope="col">Codigo</th>
                  <th scope="col">Nombres</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">RUC</th>
                  <th scope="col">Ver</th>
                  <th scope="col" colspan="2" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
              @forelse($solicitantes as $item => $sol)
              <tr class="text-center">
                <!--actualizado por marck -->
                <th scope="row">{{$sol->SOLIP_Codigo}}</th>
                <td class="text-left">{{$sol->SOLIC_Nombre}}</td>
                <td>{{$sol->TIPSOLIC_Descripcion}}</td>
                <td>{{$sol->SOLIC_Ruc}}</td>
                <td>
                  <a class="btn" data-toggle="tooltip" data-placement="bottom" title="Generar PDF" href="{{ route('solicitante.show', $sol->SOLIP_Codigo) }}"><i class="far fa-file-pdf" style="color:red; font-size:25px; cursor:pointer;"></i></a>
                  <a class="btn" data-toggle="tooltip" data-placement="bottom" title="Generar EXCEL" href="{{ route('solicitante.show', $sol->SOLIP_Codigo) }}"><i class="far fa-file-excel" style="color:green; font-size:25px; cursor:pointer;"></i></a>

                </td>                
                <td><button class="btn btn-info">
                  <a class="text-light" href="{{ route('solicitante.edit', $sol->SOLIP_Codigo) }}">
                    Editar
                  </a></button></td>
                <td>
                  <!-- $prod-> (debe señalar al "ID") - fijado por marck -->
                  {!!Form::open(['route'=>['solicitante.destroy',$sol->SOLIP_Codigo],'method'=>'DELETE'])!!}
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      {!!Form::submit('Eliminar',
                            ['class'=>'btn btn-danger'])
                      !!}
                  {!!Form::close()!!}
                  </td>
              </tr>
              @empty
                <p><i>No se han encontrado elementos en la base de datos ...</i></p>
              @endforelse
                <!-- -------------------- -->
            </tbody>
          </table>
          <!--{ { $s olicitantes->links() } }-->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection