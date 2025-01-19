<template>
  <div class="grid-hor">

    <form ref="form" method="POST" action="/contacto" class="col-sm-10"> 
      <input name="_token" type="hidden" v-model="token">    
        <div class="form-group">
          <label>Solicitante</label>
          <select v-model="contacto.SOLIP_Codigo" class="form-control" name="solicitante">
            <option v-for="solicitante in solicitantes" v-bind:value="solicitante.SOLIP_Codigo" v-bind:key="solicitante.SOLIP_Codigo">{{ solicitante.SOLIC_Nombre }}</option>
          </select>
        </div>      
        <div class="form-group">
          <label>Nombres</label>
          <input type="text" class="form-control" v-model="contacto.nombre_contacto" autocomplete="off" name="nombres" placeholder="Ingrese el nombre">
        </div>
        <div class="form-group">
          <label>Correo electronico</label>
          <input type="text" class="form-control" v-model="contacto.correo_contacto" autocomplete="off" name="correo" placeholder="Ingrese el correo">
        </div>
        <div class="form-group">
          <label>Celular</label>
          <input type="text" class="form-control" v-model="contacto.celular_contacto" autocomplete="off" name="celular" placeholder="Ingrese el celular">
        </div>                           
        <a class="btn btn-info" v-on:click="submit">Agregar</a>
        <a class="btn btn-danger" href="/contacto">Cancelar</a>
    </form>

  </div>
</template>

<script>
    export default {
        data(){
            return {
              contacto:[],
              solicitantes:[],           
              saveData:null
            }
        },
        props:{
            token:String
        },          
        created(){
            this.listarSolicitantes();
        }, 
        methods:{
            listarSolicitantes(){
                var url = '/solicitante/list';
                axios.get(url).then(response=>{
                    this.solicitantes = response.data;
                });
            },
            submit(){
              this.$refs.form.submit();
            }                        
        }                
    }
</script>