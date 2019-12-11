<template>
    <div>
        <div id='ajax-overlay' v-show="loadin">
            <div id='ajax-overlay-body' class='center'>
                <i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i>
                <span class='sr-only'>Loading...</span>
            </div>
        </div>
        <form>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Codigo</label>
              <input type="text" class="form-control" v-model.number="codigo" id="inputEmail4" placeholder="Codigo">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Nombre</label>
              <input type="text" class="form-control" v-model="nombre" id="inputPassword4" placeholder="Nombre">
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Descripcion</label>
            <input type="text" class="form-control" v-model="descripcion" id="inputAddress" placeholder="Descripcion">
          </div>
          <button type="button" class="btn btn-primary" @click="saveProducto()">SAVE</button>
        </form>
    </div>
</template>

<script>
    export default {
        name:'FormProductoComponent',
        data () {
            return {
                codigo:'',
                loadin:false,
                nombre:'',
                descripcion:'',
            }
        },
        methods:{
            saveProducto(){
                this.loadin=true;
                axios.post('productos',{
                    codigo:this.codigo,
                    nombre:this.nombre,
                    descripcion:this.descripcion
                }).then((res)=>{
                    this.LimpiarCampos();
                    this.loadin=false;
                    this.$emit('ActualziaArray',res.data);
                });
            },
            LimpiarCampos(){
                this.codigo="";
                this.nombre ="";
                this.descripcion="";
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>
 #ajax-overlay{
            position: absolute;
            color:#FFFFFF;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            position: fixed;
            background: rgba(39, 38, 46, 0.67);
            text-align: center;
            z-index: 9999;
        }
        #ajax-overlay-body{
            position: absolute;
            top: 40%;
            left: 50%;
            width: 120px;
            height: 48px;
            margin-top: -12px;
            margin-left: -60px;
            -webkit-border-radius:  10px;
            -moz-border-radius:     10px;
            border-radius:          10px;
        }

</style>
