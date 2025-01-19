<template>

<div class="form control">
     <button type="button" class="btn btn-success btn-lg ml-3" data-toggle="modal"
        data-target="#mimodalequipo" id="boton_modal" style="border-radius:5px;">
        Nuevo Equipo
    </button>

    <br>
    <br>
    <div>
        <table class="table table-bordered">
            <thead v-show="arrayEnsayos.length">
                <tr>
                    <th scope="col" class="text-center">Identificador</th>
                    <th scope="col" class="text-center">Nombre del Equipo</th>
                    <th scope="col" class="text-center">Descripcion del Equipo</th>
                    <th scope="col" class="text-center">Cantidad</th>
                    <th scope="col" class="text-center">Fabricante</th>
                    <th scope="col" class="text-center">Descripcion Ficha Tecnica</th>
                    <th scope="col" class="text-center">URL Ficha Tecnica</th>
                    <th scope="col" class="text-center">Nueva Prueba</th>
                    <th scope="col" class="text-center">Listado de Pruebas</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(ensayo,index) in arrayEnsayos" :key="index">
                    <td scope="row" class="text-center" v-text="ensayo.CODEP_Codigo"></td>
                    <td class="text-center" v-text="ensayo.CODEC_Nombre_Equipo"></td>
                    <td class="text-center" v-text="ensayo.CODEC_Descripcion_Equipo"></td>
                    <td class="text-center" v-text="ensayo.CODEC_Cantidad"></td>
                    <td class="text-center" v-text="ensayo.CODEC_Fabricante_Equipo"></td>
                    <td class="text-center" v-text="ensayo.CODEC_Descripcion_Ficha_Tecnica_Equipo"></td>
                    <td class="text-center" v-text="ensayo.CODEC_Url_Ficha_Tecnica_Equipo"></td>
                    <td class="text-center">
                       <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mimodalnuevaprueba"
                               id="boton_modal">
                            Prueba
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-dark btn-sm text-white m-auto" data-toggle="modal"
                            data-target="#mimodallistaprueba" id="boton_modal">
                            Listado
                        </button>
                    </td>
                    <th class="text-center">
                        <button type="button" class="btn btn-warning btn-sm m-auto" style="border-radius:5px;" data-toggle="modal"
                                data-target="#modaleditarequipo">
                            Editar
                        </button>
                        <button class="btn btn-danger btn-sm m-auto" style="border-radius:5px;" @click="deleteEnsayos(index, ensayo)">
                            Eliminar
                        </button>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

        <!-- MODAL PARA AGREGAR EQUIPO -->
        <div class="modal fade" id="mimodalequipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                        <h1 style="text-align: center;color:black;font-size:30px;margin-bottom:10px;">
                            <b>Agregar Equipos a la Cotizacion</b>
                        </h1>
                        <hr>
                            <div class="form-horizontal form-control" style="width:400px;height:900px;margin:0 auto">
                                <label>Nombre del Equipo:</label>
                                <br>
                                <input v-model="CODEC_Nombre_Equipo" type="text" class="form-control">

                                <label>Descripcion del Equipo:</label>
                                <br>
                                <textarea v-model="CODEC_Descripcion_Equipo" style="resize: none" class="form-control"
                                          rows="5" cols="5"></textarea>

                                <label>Cantidad de Equipos:</label>
                                <input v-model="CODEC_Cantidad" class="form-control" type="text" >

                                <label>Fabricante del Equipo:</label>
                                <input v-model="CODEC_Fabricante_Equipo" class="form-control" type="text" >

                                <label>Descripcion Tecnica del Equipo:</label>
                                <textarea v-model="CODEC_Descripcion_Ficha_Tecnica_Equipo" style="resize: none" class="form-control"
                                          rows="5" cols="5"></textarea>

                                <label>URL de la Ficha Tecnica del Equipo:</label>
                                <textarea v-model="CODEC_Url_Ficha_Tecnica_Equipo" style="resize: none" class="form-control"
                                          rows="5" cols="5"></textarea>

                                <div class="form-group">
                                    <label for="archiv_descrip_equipo">Adjuntar un archivo de la descripcion del equipo</label>
                                    <input type="file">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button @click="getEnsayos" class="btn btn-primary btn-lg m-auto" data-dismiss="modal">
                                    Añadir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL PARA AGREGAR EQUIPO -->

        <!-- MODAL PARA EDITAR EQUIPO -->
        <div class="modal fade" id="modaleditarequipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                        <h1 style="text-align: center;color:black;font-size:30px;margin-bottom:10px;">
                            <b>Editar Equipos de la Cotizacion</b>
                        </h1>
                        <hr>
                            <div class="form-horizontal form-control" style="width:400px;height:900px;margin:0 auto">
                                <label>Nombre del Equipo:</label>
                                <br>
                                <input v-model="this.arrayEnsayos.CODEC_Nombre_Equipo" type="text" class="form-control">

                                <label>Descripcion del Equipo:</label>
                                <br>
                                <textarea v-model="CODEC_Descripcion_Equipo" style="resize: none"
                                          class="form-control" rows="5" cols="5"></textarea>

                                <label>Cantidad de Equipos:</label>
                                <br>
                                <input v-model="CODEC_Cantidad" class="form-control" type="text" >

                                <label>Fabricante del Equipo:</label>
                                <br>
                                <input v-model="CODEC_Fabricante_Equipo" class="form-control" type="text" >

                                <label>Descripcion Tecnica del Equipo:</label>
                                <br>
                                <textarea v-model="CODEC_Descripcion_Ficha_Tecnica_Equipo" style="resize: none" class="form-control"
                                          rows="5" cols="5"></textarea>

                                <label>URL de la Ficha Tecnica del Equipo:</label>
                                <br>
                                <textarea v-model="CODEC_Url_Ficha_Tecnica_Equipo" style="resize: none" class="form-control"
                                          rows="5" cols="5"></textarea>

                                <div class="form-group">
                                    <label>Adjuntar un archivo de la descripcion del equipo</label>
                                    <input type="file">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary btn-lg m-auto" data-dismiss="modal">
                                    Editar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL PARA EDITAR EQUIPO -->

        <!-- MODAL PARA PRUEBA EQUIPO -->
        <div class="modal fade" id="mimodalnuevaprueba" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              <div class="modal-body">

                <!-- formulario -->
                <div class="container">
                <h1 style="text-align: center;color:black;font-size:30px;"><b>Agregar una Prueba al Equipo</b></h1>
                <hr>
                <div class="form-horizontal form-control" style="width:400px;height:550px;margin:0 auto">
                Descripcion de la Prueba a Realizar
                <br>
                <textarea style="resize: none" class="form-control" rows="5" cols="5"></textarea>
                Norma Asociada a la Prueba:
                <br>
                <input class="form-control" type="text" id="primero" />
                Descripcion de la Norma:
                <br>
                <textarea style="resize: none" class="form-control" rows="5" cols="5"></textarea>

                <div class="form-group">
                    <label for="ejemplo_archivo_1">Adjuntar un archivo de la descripcion de la Norma Tecnica</label>
                    <input type="file" id="ejemplo_archivo_1">
                </div>

                <br>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-lg m-auto" data-dismiss="modal">
                        Guardar
                    </button>
                </div>
                </div>
                <!-- formulario -->
              </div>
            </div>
          </div>
        </div>
        <!-- END MODAL PARA PRUEBA EQUIPO -->
</div>

</template>

<script>
    export default {
       data: function() {
            return {
                CODEP_Codigo: 1,
                CODEC_Nombre_Equipo: "",
                CODEC_Descripcion_Equipo: "",
                CODEC_Fabricante_Equipo: "",
                CODEC_Descripcion_Ficha_Tecnica_Equipo: "",
                CODEC_Archivo_Descripcion_Equipo: "",
                CODEC_Cantidad: "",
                CODEC_Url_Ficha_Tecnica_Equipo: "",
                arrayEnsayos: [],
                fillEnsayos: [],
            }
        },
        methods: {
            getEnsayos (){
                this.arrayEnsayos.push({
                    CODEP_Codigo: this.CODEP_Codigo,
                    CODEC_Nombre_Equipo: this.CODEC_Nombre_Equipo,
                    CODEC_Descripcion_Equipo: this.CODEC_Descripcion_Equipo,
                    CODEC_Cantidad: this.CODEC_Cantidad,
                    CODEC_Fabricante_Equipo: this.CODEC_Fabricante_Equipo,
                    CODEC_Descripcion_Ficha_Tecnica_Equipo: this.CODEC_Descripcion_Ficha_Tecnica_Equipo,
                    CODEC_Archivo_Descripcion_Equipo: this.CODEC_Archivo_Descripcion_Equipo,
                    CODEC_Url_Ficha_Tecnica_Equipo: this.CODEC_Url_Ficha_Tecnica_Equipo,
                });
                this.CODEP_Codigo = this.CODEP_Codigo + 1;
                this.CODEC_Nombre_Equipo = "";
                this.CODEC_Descripcion_Equipo = "";
                this.CODEC_Fabricante_Equipo = "";
                this.CODEC_Descripcion_Ficha_Tecnica_Equipo = "";
                this.CODEC_Archivo_Descripcion_Equipo = "";
                this.CODEC_Cantidad = "";
                this.CODEC_Url_Ficha_Tecnica_Equipo = "";
            },
            deleteEnsayos (index, ensayo) {
                var index = this.arrayEnsayos.indexOf(ensayo);
                if(index>-1){
                    this.arrayEnsayos.splice(index, 1);
                }
            },
            editEnsayos (index, ensayo) {
                /*
                this.fillEnsayos.push({
                    CODEP_Codigo: this.CODEP_Codigo,
                    CODEC_Nombre_Equipo: this.CODEC_Nombre_Equipo,
                    CODEC_Descripcion_Equipo: this.CODEC_Descripcion_Equipo,
                    CODEC_Cantidad: this.CODEC_Cantidad,
                    CODEC_Fabricante_Equipo: this.CODEC_Fabricante_Equipo,
                    CODEC_Descripcion_Ficha_Tecnica_Equipo: this.CODEC_Descripcion_Ficha_Tecnica_Equipo,
                    CODEC_Archivo_Descripcion_Equipo: this.CODEC_Archivo_Descripcion_Equipo,
                    CODEC_Url_Ficha_Tecnica_Equipo: this.CODEC_Url_Ficha_Tecnica_Equipo,
                });
                */
            },
        },
    }
</script>
