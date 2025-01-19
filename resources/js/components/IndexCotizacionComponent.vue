<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <!--div class="card-header">
          <h3 class="card-title">DataTable with minimal features & hover style</h3>
        </div-->
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr class="text-center">
              <th scope="col">Codigo</th>              
              <th scope="col">Numero</th>
              <th scope="col">Solicitante</th>
              <th scope="col">Fecha</th>
              <th scope="col">Total S/.</th>
              <th scope="col" colspan="2">Acciones</th>
            </tr>
            </thead>
            <tbody>
              <tr v-for="(cotizacion,indice) of cotizaciones" :key="cotizacion.COTIP_Codigo" class="text-center">
                <td>{{cotizacion.COTIP_Codigo}}</td>
                <td>{{cotizacion.COTIC_Numero}}</td>
                <td>{{cotizacion.SOLIC_Nombre}}</td>
                <!--td>{{cotizacion.COTIC_Fecha_Cotizacion.split(' ')[0]}}</td-->
                <td>{{cotizacion.COTIC_Fecha_Cotizacion}}</td>
                <td class="text-right">{{cotizacion.COTIC_Total}}</td>
                <td>
                  <button class="btn btn-info" @click="btnEditar(cotizacion.COTIP_Codigo)">Editar</button>
                </td>
                <td><button class="btn btn-danger" v-on:submit.prevent="btnBorrar(indice)" @click="btnBorrar(cotizacion, indice) in cotizaciones">Eliminar</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        data(){
            return {
                cotizaciones: [],
                saveData:null
            }
        },
        created(){
            this.listar();
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            listar(){
              var url = '/cotizacion/list';
              axios.get(url).then(response=>{
                this.cotizaciones = response.data;
                //console.log(this.cotizaciones);
              });
            },
            btnBorrar(cotizacion,indice){
              let _this = this;
              let url = '/cotizacion/delete/'+cotizacion.COTIP_Codigo;
              axios.delete(url).then(function(response){
                alert(response.data.message);
                _this.listar();
              }).catch(function(error){
                console.log(error);
              });
            },
            btnEditar(id){
                location.href = '/cotizacion/'+id+'/edit';
            },
            btnNuevo(){
                location.href = '/cotizacion/create';
            }
        }
    }
</script>