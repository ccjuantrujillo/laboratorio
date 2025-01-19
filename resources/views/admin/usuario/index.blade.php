@extends('layouts.admin')

@section('content')

<!-- Content Header -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Listado de Usuarios</h1>
      </div>
      <div class="col-sm-6 text-right">
        <a class="btn btn-info" href="{{ route('usuario.create') }}">Agregar Usuario</a>
      </div>        
    </div>
  </div>
</section>
<!-- /Content Header -->
    
<!-- Main Content-->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr class="text-center">
              <th scope="col">Codigo</th>
              <!-- <th scope="col">Id</th> -->
              <th scope="col">Nombre</th>
              <th scope="col">Email</th>
              <th scope="col">Rol</th>
              <!-- <th scope="col">Editar</th>
              <th scope="col">Eliminar</th> -->
              <th scope="col" colspan="2" class="text-center">Acciones</th>
<!--               <th scope="col" class ="no-exportar">Acciones</th> -->
           </tr>
            </thead>
            <tbody>
              @forelse($usuarios as $item=>$user)
                <tr class="text-center">
                  <th scope="row">{{$item+1}}</th>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{ $user->ROL_Descripcion }}</td>
                  <td><a class="btn btn-info" href="{{ route('usuario.edit', $user->id) }}">Editar</a></td>
                  <td>
                    {!!Form::open(['route'=>['usuario.destroy',$user->id],'method'=>'DELETE'])!!}
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
            </tbody>          
          </table>
        </div>

      </div>
    </div>
  </div>
</section>
<!-- /Main Content-->

@endsection

@section('scripts')
<!--script>
  $(document).ready(function() {
   var table= $('#example2').DataTable({
    dom: 'Bfrtip',
    buttons: [ 
      
      // {
			// 	extend:    'excelHtml5',
			// 	text:      '<i class="fas fa-file-excel"></i> ',
			// 	titleAttr: 'Exportar a Excel',
      //   className: 'btn btn-success',
      //   exportOptions: {
      //         columns: ":not(.no-exportar)"}
			// },
			{
				extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
        className: 'btn btn-danger',
        exportOptions: {
              columns: ":not(.no-exportar)"}
			},
			{
				extend:    'print',
				text:      '<i class="fa fa-print"></i> ',
				titleAttr: 'Imprimir',
        className: 'btn btn-info',
        exportOptions: {
              columns: ":not(.no-exportar)"}
			}, ],
      processing: true,
      serverSider: true,
      responsive: true,
      autoWidth: false,


      

      ajax: '{!! route('dataTableUser')!!}',
      columns:[
        {data: 'DT_RowIndex', nombre: 'DT_RowIndex'},
       /*  {data: 'id'},*/
        {data: 'name'},
        {data: 'email'},
        {data: 'ROL_Codigo'},
        /* {data: 'edit'},
        {data: 'delete'}, */
        {data: 'created_at'},
        {data: 'btn'},
      ],
      


      
      
      "language": idioma_spanish

      /* para traducir */
        
     /*  "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Ningun dato encontrado",
            "info": "Mostrando la _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtrado de _MAX_ registros totales)"
            'search':'Buscar',
        } */


    });   
  } );

      var idioma_spanish ={
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
    }
}
</script-->
@endsection