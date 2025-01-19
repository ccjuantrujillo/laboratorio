<template>

  <!--Form content-->
  <div class="invoice p-3 mb-3">
      <form ref="form" method="POST" :action="computedAction">

        <!-- Cabecera fila 1 -->
        <input name="_method" type="hidden" value="PATCH">
        <input name="_token" type="hidden" v-model="token">
        <input name="id_cotizacion" type="hidden" v-model="cotizacion.COTIP_Codigo">
        <div class="row row-sm invoice-info">
          <div class="col-sm-4 invoice-col">
              <div class="row form-group">
                <label class="col-sm-3 col-form-label col-form-label-sm">Contacto</label>
                <select v-model="cotizacion.id_contacto" class="col-sm-6 form-control-sm" name="contacto">
                  <option v-for="contacto in contactos" v-bind:value="contacto.id_contacto" v-bind:key="contacto.id_contacto">{{ contacto.nombre_contacto }}</option>
                </select>
              </div>
          </div>
          <div class="col-sm-4 invoice-col">
            <div class="row form-group">
                <label class="col-sm-3 col-form-label col-form-label-sm">Fecha</label>
                <input type="date" class="col-sm-6 form-control-sm" v-model="cotizacion.COTIC_Fecha" autocomplete="off" name="fecha" readonly="readonly">
            </div>
          </div>

          <div class="col-sm-4 invoice-col">
              <div class="row form-group">
                <label class="col-sm-3 col-form-label col-form-label-sm">Numero</label>
                <input type="text" v-model="cotizacion.COTIC_Numero" class="col-sm-3 form-control-sm" maxlength="11" autocomplete="off" readonly="readonly" style="text-align: right;">
              </div>
          </div>
        </div>
        <!-- /.Cabecera fila 1 -->

        <!-- Cabecera fila 2 -->
        <div class="row row-sm invoice-info">
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
                <select v-model="cotizacion.USUA_Codigo" class="col-sm-6 form-control-sm" name="usuario">
                  <option v-for="usuario in usuarios" v-bind:value="usuario.id" v-bind:key="usuario.id">{{ usuario.name }}</option>
                </select>
              </div>
          </div>
          <div class="col-sm-4 invoice-col">
              <div class="row form-group"></div>
          </div>
        </div>
        <!-- /.Cabecera fila 2 -->

        <!--Detalle Cotizacion-->
        <div class="row invoice-info">
          <label class="col-sm-2 col-form-label col-form-label-sm">Agregar</label>
          <a href="#" @click="addEquipo()">
            <i class="fas fa-plus form-control-sm" id="agregar"></i>
          </a>
          <div class="col-12 table-responsive">
            <table class="table table-striped table-sm">
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
                <tr class="text-center" v-for="(cotdetalle,index) in equipos" :key="cotdetalle.CODEP_Codigo">
                  <td>
                    <label style="border: 1px solid red;color: blue;"><a href="#" @click="deleteEquipo(index)">x</a></label>
                    <input type="hidden" name="codigodet[]" v-model="cotdetalle.CODEP_Codigo" class="form-control-sm">
                  </td>
                  <td>
                    <input type="text" class="form-control-sm w-100" name="nombre[]" v-model="cotdetalle.CODEC_Nombre_Equipo" autocomplete="off">
                  </td>
                  <td><input type="text" class="form-control-sm w-100" name="descripcion[]" v-model="cotdetalle.CODEC_Descripcion_Equipo" autocomplete="off"></td>
                  <td><input type="text" class="form-control-sm w-100" name="fabricante[]" v-model="cotdetalle.CODEC_Fabricante_Equipo" autocomplete="off"></td>
                  <td><input type="text" class="form-control-sm w-100" name="ficha[]" v-model="cotdetalle.CODEC_Descripcion_Ficha_Tecnica_Equipo" autocomplete="off"></td>
                  <td><input type="text" class="form-control-sm w-100" name="url[]" v-model="cotdetalle.CODEC_Url_Ficha_Tecnica_Equipo" autocomplete="off"></td>                                    
                  <td class="pb-0 mb-0"><i class="far fa-file-pdf" style="color:red;font-size: 23px;"></i></td>
                  <td><button type="button" class="btn btn-outline-success btn-lg btn-sm" data-toggle="modal" data-target="#exampleModal" @click="editEquipo(index)">Lista</button></td>
                  <td><input type="text" style="text-align: right;" class="form-control-sm w-100" name="cantidad[]" v-model.number="cotdetalle.CODEC_Cantidad" id="cantidad" autocomplete="off"></td>
                  <td><input type="text" style="text-align: right;" class="form-control-sm w-100" name="unitario[]" v-model.number="cotdetalle.CODEC_Costo" autocomplete="off"></td>
                  <td><input type="text" style="text-align: right;" class="form-control-sm w-100" name="subtotaldet[]" :value="(cotdetalle.CODEC_Cantidad*cotdetalle.CODEC_Costo).toFixed(2)" readonly="readonly" autocomplete="off"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!--/Detalle Cotizacion-->

        <!--Subtotales-->
        <div class="row">
          <div class="col-8"></div>
          <div class="col-4">
            <div class="table-responsive table-sm">
              <table class="table float-right">
                <tr>
                  <td class="text-right">
                    <span class="mr-2">Subtotal S/.</span>
                    <input type="text" class="form-control-sm w-25" v-model="setSubTotal" name="subtotal" style="text-align: right;"></td>
                </tr>
                <tr>
                  <td class="text-right">
                    <span class="mr-2">I.G.V. S/. (18%)</span>
                    <input type="text" v-model="setIgv" class="form-control-sm w-25" name="igv" style="text-align: right;"></td>
                </tr>
                <tr>
                  <td class="text-right">
                    <span class="mr-2">Total S/.</span>
                    <input type="text" v-model="setTotal" class="form-control-sm w-25" name="total" style="text-align: right;"></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <!--/Subtotales-->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">Pruebas del Equipo :: {{equipo.CODEC_Nombre_Equipo}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                Descripcion de la Prueba:
                                <br>
                                <input type="hidden" class="form-control-sm" v-model="equipo.CODEP_Codigo"/>
                                <textarea style="resize: none" class="form-control" ref="descripcion_prueba" rows="3" cols="5" v-model="prueba.Descripcion_Prueba"></textarea>
                                <label for="ejemplo_archivo_1">Adjuntar Norma Tecnica</label>
                                <input type="file" id="file" ref="file"  v-on:change="onChangeFileUpload()"><span id="file_back" ref="file_back"></span>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-9">
                                  Norma Asociada:
                                  <br>
                                  <input class="form-control" v-model="prueba.Norma_Asoc_Prueba" ref="norma_asociada"/>
                                </div>
                                <div class="col-md-3">
                                  Costo
                                  <br>
                                  <input class="form-control" v-model.number="prueba.Costo" ref="costo_prueba"/>
                                </div>
                              </div>
                              <div class="row">
                                Descripcion de la Norma:
                                <br>
                                <textarea style="resize: none" class="form-control" rows="2" cols="5" v-model="prueba.Descripcion_Norma"></textarea>
                                <span v-if="prueba.id_prueba_a_realizar>0">
                                  <input class="btn btn-default btn-sm" type="button"  value="Actualizar" @click="updatePrueba()"/>
                                </span>
                                <span v-else>
                                  <input class="btn btn-default btn-sm" type="button"  value="Agregar" @click="addPrueba()"/>
                                </span>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table table-bordered table-sm">
                                <tr>
                                  <th class="text-center" width="5%">Item</th>
                                  <th class="text-center" width="45%">Descripcion de la Prueba</th>
                                  <th class="text-center" width="20%">Norma Asociada</th>
                                  <th class="text-center" width="10%">Costo</th>
                                  <th class="text-center" width="20%">Acciones</th>
                                </tr>
                                <tr v-for="(prueba,indice) in equipo.pruebas" :key="prueba.indice">
                                    <td class="text-center">
                                      {{indice+1}}<input type="hidden" class="form-control-sm w-25" v-model="prueba.id_prueba_a_realizar">
                                    </td>
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
                        <div class="row float-right pb-2">
                          <button type="button" class="btn btn-warning" data-dismiss="modal" @click="closePruebas()">Cerrar</button>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <!--/Modal-->

        <!--Botones-->
        <div class="row text-left">
            <div class="col text-left">
                <a class="btn btn-info" @click="updateCotizacion()">Editar</a>
                <a class="btn btn-danger" href="/cotizacion">Cancelar</a>
            </div>
        </div>
        <!--/Botones-->

      </form>
  </div>
  <!--/Form content-->

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
              idxPrueba:null,
              file:''            
            }
        },
        props:{
            codigo:String,
            token:String
        },
        created(){
            this.getEquipos(this.codigo);
            this.getCotizacion(this.codigo);
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
            return this.equipos.reduce((suma,cotdetalle)=>suma+(cotdetalle.CODEC_Costo*cotdetalle.CODEC_Cantidad),0);
          },
          setIgv:function(){
            return (Number(this.setSubTotal)*0.18).toFixed(2);
          },
          setTotal:function(){
            return (Number(this.setSubTotal)+Number(this.setIgv)).toFixed(2);
          },
          computedAction:function(){
            return '/cotizacion/'+this.codigo;
          }
        },
        methods:{
            /*Equipos*/
            getEquipos(id){
                var url = '/cotizaciondetalle/'+id+'/list';
                axios.get(url).then(response=>{
                    this.equipos = response.data;
                });
            },
            addEquipo(){
              let fila = {
                CODEP_Codigo:"",
                CODEC_Nombre_Equipo:"",
                CODEC_Descripcion_Equipo:"",
                CODEC_Fabricante_Equipo:"",
                CODEC_Cantidad:"",
                CODEC_Costo:"",
                CODEC_Url_Ficha_Tecnica_Equipo:"",
                CODEC_Descripcion_Ficha_Tecnica_Equipo:"",
                pruebas:[]};
              this.equipos.push(fila);
            },
            editEquipo(index){
              this.idxEquipo = index;
              this.equipo = this.equipos[index];
            },
            deleteEquipo(index){
              let _this = this;
              let idequipo = this.equipos[index].CODEP_Codigo;
              let url = '/cotizaciondetalle/delete/'+idequipo;
              axios.delete(url).then(function(response){
                this.equipos.splice(index, 1);
                //_this.getEquipos(_this.codigo);
              }).catch(function(error){
                console.log(error);
              });
            },   
            /*Pruebas */
            onChangeFileUpload(){
              this.file = this.$refs.file.files[0];
            },
            addPrueba(){
              let _this  = this;
              let codequipo = this.equipo.CODEP_Codigo;
              let formData = new FormData();
              formData.append("CODEP_Codigo",this.equipo.CODEP_Codigo);
              formData.append("Descripcion_Prueba",this.prueba.Descripcion_Prueba);
              formData.append("Descripcion_Norma",this.prueba.Descripcion_Norma);
              formData.append("Norma_Asoc_Prueba",this.prueba.Norma_Asoc_Prueba);
              formData.append("Costo",this.prueba.Costo);
              formData.append("Archivo",this.file);
              if(typeof this.prueba.Descripcion_Prueba == 'undefined'){
                this.$refs.descripcion_prueba.focus();
                alert("Debe ingresar una descripcion");
              }
              else if(typeof this.prueba.Costo == 'undefined'){
                this.$refs.costo_prueba.focus();
                alert("Debe ingresar un costo");
              }
              else{
                let url = '/prueba/store';
                axios.post(url,
                  formData,
                  {headers:{'Content-Type':'multipart/form-data'}}
                ).then(function(response){
                  _this.file   = '';
                  _this.prueba = [];   
                  _this.getPruebas(codequipo);               
                }).catch(function(error){
                  console.log(error);
                });
              }
            },
            getPruebas(id){
              var url = '/prueba/'+id+'/list';
              axios.get(url).then(response=>{
                this.equipo.pruebas = response.data;
                //console.log(this.equipo);
              });
            },
            editPrueba(indice){
              this.idxPrueba = indice;
              //this.prueba    = this.equipo.pruebas[indice];
              let idprueba   = this.equipo.pruebas[indice].id_prueba_a_realizar;
              let url = '/prueba/'+idprueba+'/get';
              axios.get(url).then(response=>{
                this.prueba = response.data;
                document.getElementById('file_back').innerHTML = response.data.Arch_Norma_Tecnica;
                console.log(this.prueba);
              });
            }, 
            updatePrueba(indice){
              let _this = this;
              let url   = "/prueba/update";
              let codequipo = this.equipo.CODEP_Codigo;
              let formData = new FormData();
              formData.append("id_prueba_a_realizar",this.prueba.id_prueba_a_realizar);
              formData.append("CODEP_Codigo",this.equipo.CODEP_Codigo);
              formData.append("Descripcion_Prueba",this.prueba.Descripcion_Prueba);
              formData.append("Descripcion_Norma",this.prueba.Descripcion_Norma);
              formData.append("Norma_Asoc_Prueba",this.prueba.Norma_Asoc_Prueba);
              formData.append("Costo",this.prueba.Costo);
              formData.append("Archivo",this.file);
              formData.append("ArchivoAnt",document.getElementById('file_back').innerHTML);
              formData.append('_method', 'PUT'); 
              axios.post(url,
                formData,
                {headers:{'Content-Type':'multipart/form-data'}}
              ).then(function(response){
                _this.file   = '';
                _this.prueba = [];   
                _this.getPruebas(codequipo);   
                _this.idxPrueba = null;   
                document.getElementById('file_back').innerHTML = '';             

              }).catch(function(error){
                console.log(error);
              });
            },
            deletePrueba(indice){
              let _this = this;
              let datos = this.equipo.pruebas[indice];
              let id_prueba = datos.id_prueba_a_realizar;
              let url = "/prueba/delete/"+id_prueba;
              axios.delete(url).then(function(response){
                _this.getPruebas(datos.CODEP_Codigo);
              }).catch(function(error){
                console.log(error);
              });
            },
            closePruebas(){
              this.prueba = [];
            },
            /*Cotizaciones */
            getCotizacion(id){
                var url = '/cotizacion/'+id+'/get';
                axios.get(url).then(response=>{
                    let resultado   = response.data;
                    resultado.COTIC_Fecha = resultado.COTIC_Fecha_Cotizacion.split(' ')[0];
                    this.cotizacion = resultado;
                    console.log(resultado);
                });
            },
            updateCotizacion(){
              let url = '/cotizacion/update';
              axios.put(url,{
                id_cotizacion:this.cotizacion.COTIP_Codigo,
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