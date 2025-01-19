<template>
  <!--Form content-->
  <div class="invoice p-3 mb-3">
      <form ref="form">
        <input name="_token" type="hidden" v-model="token">
        <!-- Cabecera fila 1 -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
              <div class="row form-group">
                <label class="col-sm-3 col-form-label col-form-label-sm">Contacto</label>
                <select v-model="cotizacion.id_contacto" class="col-sm-6 form-control-sm" name="contacto" ref="contacto">
                  <option v-for="contacto in contactos" v-bind:value="contacto.id_contacto" v-bind:key="contacto.id_contacto">{{ contacto.nombre_contacto }}</option>
                </select>
              </div>
          </div>
          <div class="col-sm-4 invoice-col">
            <div class="row form-group">
                <label class="col-sm-3 col-form-label col-form-label-sm">Fecha</label>
                <input type="date" class="col-sm-6 form-control-sm" v-model="cotizacion.COTIC_Fecha" autocomplete="off" name="fecha">
            </div>
          </div>
          <div class="col-sm-4 invoice-col">
              <div class="row form-group">
                <label class="col-sm-3 col-form-label col-form-label-sm">Numero</label>
                <input v-model.number="cotizacion.COTIC_Numero" class="col-sm-3 form-control-sm" maxlength="11" autocomplete="off" name="numero" ref="numero">
              </div>
          </div>
        </div>
        <!-- /Cabecera fila 1 -->

        <!-- Cabecera fila 2 -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
              <div class="row form-group">
                <label class="col-sm-3 col-form-label col-form-label-sm">Solicitante</label>
                <select class="col-sm-6 form-control-sm" name="contacto">
                  <option v-for="solicitante in solicitantes" v-bind:value="solicitante.SOLIP_Codigo" v-bind:key="solicitante.SOLIP_Codigo">{{ solicitante.SOLIC_Nombre }}</option>
                </select>
              </div>
          </div>
          <div class="col-sm-4 invoice-col">
              <div class="row form-group">
                <label class="col-sm-3 col-form-label col-form-label-sm">Usuario</label>
                <select v-model="cotizacion.USUA_Codigo" class="col-sm-6 form-control-sm" name="usuario" ref="usuario">
                  <option v-for="usuario in usuarios" v-bind:value="usuario.id" v-bind:key="usuario.id">{{ usuario.name }}</option>
                </select>
              </div>
          </div>
          <div class="col-sm-4 invoice-col">
              <div class="row form-group">

            </div>
          </div>
        </div>
        <!-- /Cabecera fila 2 -->

        <!--Detalle Cotizacion-->
        <div class="row invoice-info">
          <label class="col-sm-2 col-form-label col-form-label-sm">Agregar</label>
          <a href="#" @click="addEquipo()"><i class="fas fa-plus form-control-sm" id="agregar"></i></a>
          <div class="col-12 table-responsive">
          <table class="table table-striped">
              <thead>
              <tr class="text-center">
                  <th style="width:5%;">No</th>
                  <th style="width:20%;">Nombre</th>
                  <th style="width:20%;">Descripcion</th>
                  <th style="width:10%;">Fabricante</th>
                  <th style="width:10%;">Ficha</th>
                  <th style="width:10%;">URL</th>
                  <th style="width:5%;">Archivo</th>
                  <th style="width:5%;">Pruebas</th>
                  <th style="width:5%;">Cantidad</th>
                  <th style="width:5%;">P.Unitario</th>
                  <th style="width:5%;">Subtotal</th>
              </tr>
              </thead>
                <tbody>
                    <tr class="text-center" v-for="(equipo, index) in equipos" :key="equipo.index">
                      <td>
                        <label style="border: 1px solid red;color: blue;"><a href="#" @click="deleteEquipo(index)">x</a></label>
                        <input type="hidden" name="codigodet[]" v-model="equipo.CODEP_Codigo">
                      </td>
                      <td><input type="text" class="form-control-sm w-100" name="nombre[]" v-model="equipo.CODEC_NombreEquipo" autocomplete="off"></td>
                      <td><input type="text" class="form-control-sm w-100" name="descripcion[]" v-model="equipo.CODEC_Descripcion" autocomplete="off"></td>
                      <td><input type="text" class="form-control-sm w-100" name="fabricante[]" v-model="equipo.CODEC_Fabricante" autocomplete="off"></td>
                      <td><input type="text" class="form-control-sm w-100" name="ficha[]" v-model="equipo.CODEC_Descripcion_Ficha_Tecnica_Equipo" autocomplete="off"></td>
                      <td><input type="text" class="form-control-sm w-100" name="url[]" v-model="equipo.CODEC_Url" autocomplete="off"></td>  
                      <td class="pb-0 mb-0"><i class="far fa-file-pdf" style="color:red;font-size: 23px;"></i></td>
                      <td>
                        <button type="button" class="btn btn-outline-success btn-lg btn-sm" data-toggle="modal" data-target="#exampleModal" @click="editEquipo(index)">Lista</button>
                      </td>
                      <td><input type="text" class="form-control-sm w-100" name="cantidad[]" v-model.number="equipo.CODEC_Cantidad" autocomplete="off"></td>
                      <td><input type="text" class="form-control-sm w-100" name="unitario[]" v-model.number="equipo.CODEC_PrecioUnitario" autocomplete="off"></td>
                      <td><input type="text" class="form-control-sm w-100" name="subtotaldet[]" :value="equipo.CODEC_Cantidad*equipo.CODEC_PrecioUnitario"  readonly="readonly" autocomplete="off"></td>
                    </tr>
                </tbody>
            </table>
          </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="myModalLabel">Pruebas del Equipo :: {{equipo.CODEC_NombreEquipo}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    Descripcion de la Prueba:
                                    <br>
                                    <textarea style="resize: none" class="form-control" rows="3" cols="5" v-model="prueba.Descripcion_Prueba" name="descprueba"></textarea>
                                    <label for="ejemplo_archivo_1">Adjuntar Norma Tecnica</label>
                                    <input type="file" id="ejemplo_archivo_1">
                                </div>
                                <div class="col-md-6">
                                  <div class="row">
                                    <div class="col-md-9">
                                      Norma Asociada:
                                      <br>
                                      <input class="form-control" v-model="prueba.Norma_Asoc_Prueba" />
                                    </div>
                                    <div class="col-md-3">
                                      Costo
                                      <br>
                                      <input class="form-control" v-model="prueba.Costo" />
                                    </div>
                                  </div>
                                  <div class="row">
                                    Descripcion de la Norma:
                                    <br>
                                    <textarea style="resize: none" class="form-control" rows="2" cols="5" v-model="prueba.Descripcion_Norma"></textarea>
                                    <input class="btn btn-default btn-sm" type="button"  value="Agregar" @click="addPrueba()"/>
                                    <input class="btn btn-default btn-sm" type="button"  value="Actualizar" @click="updatePrueba()"/>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table table-bordered">
                              <tr>
                                <th class="text-center">Item</th>
                                <th class="text-center">Descripcion de la Prueba</th>
                                <th class="text-center">Norma Asociada</th>
                                <th class="text-center">Costo</th>
                                <th class="text-center">Acciones</th>
                              </tr>
                              <tr v-for="(prueba,indice) in equipo.pruebas" :key="prueba.indice">
                                <td class="text-center">{{indice+1}}</td>
                                <td class="text-left">{{prueba.Descripcion_Prueba}}</td>
                                <td class="text-left">{{prueba.Norma_Asoc_Prueba}}</td>
                                <td class="text-right">{{prueba.Costo}}</td>
                                <td class="text-center">
                                    <a class="btn btn-default btn-sm" @click="editPrueba(indice)">Editar</a>
                                    <a class="btn btn-default btn-sm" @click="deletePrueba(indice)">Eliminar</a>
                                </td>
                              </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" @click="updateEquipo()">Aceptar</button>
                    </div>
                  </div>
                </div>
            </div>
            <!--/Modal-->
        </div>
        <!--/Detalle Cotizacion-->

        <!--Subtotales-->
        <div class="row invoice-info">
          <!-- accepted payments column -->
          <div class="col-9">&nbsp;</div>
          <!-- /.col -->
          <div class="col-3">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal S/.:</th>
                  <td><input type="text" v-model="setSubTotal" name="subtotal" class="form-control-sm w-50" ></td>
                </tr>
                <tr>
                  <th>I.G.V. S/. (18%)</th>
                  <td><input type="text" v-model="setIgv" name="igv" class="form-control-sm w-50"></td>
                </tr>
                <tr>
                  <th>Total S/.:</th>
                  <td><input type="text" v-model="setTotal" name="total" class="form-control-sm w-50"></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <!--/Subtotales-->

        <!--Botones-->
        <div class="row text-left">
            <div class="col text-left">
              <a class="btn btn-info" @click="addCotizacion()">Agregar</a>
              <a class="btn btn-danger" href="/cotizacion">Cancelar</a>
            </div>
        </div>
        <!--/Botones-->

      </form>
      <!--/Form content-->

    </div>

</template>

<script>
    export default {
        data(){
            return {
              cotizacion:[],
              equipo:[],
              prueba:[],
              equipos : [],
              pruebas:[],
              contactos:[],
              usuarios:[],  
              solicitantes:[],            
              saveData:null,
              idxEquipo:null,
              idxPrueba:null
            }
        },
        props:{
            token:String
        },
        created(){
            this.listarContactos();
            this.listarUsuarios();
            this.listarSolicitantes();
        },        
        mounted() {
            console.log('Component mounted.')
        },
        computed:{
          setSubTotal:function(){
            var suma = 0;
            return this.equipos.reduce((suma,cotdetalle)=>suma+(cotdetalle.CODEC_PrecioUnitario*cotdetalle.CODEC_Cantidad),0).toFixed(2);
          },
          setIgv:function(){
            return (Number(this.setSubTotal)*0.18).toFixed(2);
          },
          setTotal:function(){
            return (Number(this.setSubTotal)+Number(this.setIgv)).toFixed(2);
          }
        },
        methods:{
            /*Equipos*/
            addEquipo(){
              let fila = {
                CODEP_Codigo:"",CODEC_NombreEquipo:"",CODEC_Descripcion:"",CODEC_Fabricante:"",CODEC_Cantidad:"",CODEC_PrecioUnitario:"",CODEC_Descripcion_Ficha_Tecnica_Equipo:"",pruebas:[]};
              this.equipos.push(fila);
            },
            editEquipo(index){
              this.idxEquipo = index;
              this.equipo = this.equipos[index];
            },
            updateEquipo(){
              this.equipos[this.idxEquipo] = this.equipo;
              this.equipo = [];
              this.idxEquipo = null;
            },
            deleteEquipo(index){
              this.equipos.splice(index, 1);
            },
            /*Pruebas*/
            addPrueba(){
              let fila = {
                Descripcion_Prueba:this.prueba.Descripcion_Prueba,
                Descripcion_Norma:this.prueba.Descripcion_Norma,
                Norma_Asoc_Prueba:this.prueba.Norma_Asoc_Prueba,
                Descripcion_Prueba:this.prueba.Descripcion_Prueba,
                Costo:this.prueba.Costo
              };
              this.equipo.pruebas.push(fila);
              //console.log(JSON.stringify(this.equipo));
              this.prueba = [];
            },
            editPrueba(indice){
              this.idxPrueba = indice;
              this.prueba = this.equipo.pruebas[indice];
            },
            updatePrueba(){
              this.prueba = [];
              this.idxPrueba = null;
            },
            deletePrueba(indice){
              this.equipo.pruebas.splice(indice, 1);
            },
            /*Cotizaciones */
            addCotizacion(){
              let url = '/cotizacion/store';
              if(typeof this.cotizacion.COTIC_Fecha == 'undefined'){
                alert("Debe ingresar la fecha");
              }
              else if(typeof this.cotizacion.COTIC_Numero == 'undefined'){
                this.$refs.numero.focus();
                alert("Debe ingresar el numero");
              }
              else if(typeof this.cotizacion.id_contacto == 'undefined'){
                this.$refs.contacto.focus();
                alert("Debe seleccionar un contacto");
              }
              else if(typeof this.cotizacion.USUA_Codigo == 'undefined'){
                this.$refs.usuario.focus();
                alert("Debe seleccionar un usuario");
              }
              else if(this.equipos.length==0){
                alert("Debe ingresar al menos 1 equipo");
              }
              else{
                console.log(this.equipos);
                axios.post(url,{
                  contacto:this.cotizacion.id_contacto,
                  fecha:this.cotizacion.COTIC_Fecha,
                  numero:this.cotizacion.COTIC_Numero,
                  usuario:this.cotizacion.USUA_Codigo,
                  equipos:this.equipos,
                  subtotal:this.setSubTotal,
                  igv:this.setIgv,
                  total:this.setTotal
                }).then(function(response){
                    alert(response.data);
                    location.href = '/cotizacion';
                }).catch(function(error){
                  console.log(error);
                });
              }
            },
            listarContactos(){
                var url = '/contacto/list';
                axios.get(url).then(response=>{
                    this.contactos = response.data;
                });
            },
            listarUsuarios(){
                var url = '/usuario/list';
                axios.get(url).then(response=>{
                    this.usuarios = response.data;
                    console.log(this.cotizacion);
                });
            },
            listarSolicitantes(){
              var url = '/solicitante/list';
              axios.get(url).then(response=>{
                  this.solicitantes = response.data;
                  console.log(this.cotizacion);
              });
            }                               

        }
    }
</script>