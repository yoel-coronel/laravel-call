<template>
    <div class="container-fluid">
        <div id='ajax-overlay' v-show="loadin">
                <div id='ajax-overlay-body' class='center'>
                    <i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i>
                    <span class='sr-only'>Loading...</span>
                </div>
            </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Lista de productos</div>
                    <div class="card-body">
                        <button class="button success btn-sm" v-if="control!=true" @click="cambiaActivo()" >Registrar</button>
                        <button class="button alert btn-sm" v-else @click="cambiaInactivo()" >Volver</button>
                        <template v-if="control">
                             <form-productos @ActualziaArray="ActualziaArray(...arguments)" ></form-productos>
                        </template>
                        <template v-else>
                            <div class="table-response">
                                <table class="table striped table-border mt-4"
                                        data-role="table"
                                        data-cls-table-top="row flex-nowrap"
                                        data-cls-search="cell-md-8"
                                        data-cls-rows-count="cell-md-4"
                                       data-view-save-path="storage_key|url"
                                        data-rows="5"
                                        >
                                    <thead class="bg-success">
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <producto-productos v-for="(item,index) in arrayProductos" :producto="item" :index="index" :key="item.id" @AtulizaData="AtulizaData(...arguments)" @EliminarProducto="EliminarProducto(...arguments)"></producto-productos>
                                    </tbody>
                                </table>
                            </div>

                        </template>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default ({
        name:'valores',
        data (){
            return {
                control:false,
                loadin:false,
                arrayProductos:[],
            }
        },
        methods:{
            cambiaActivo(){
                this.control = true;
            },
            cambiaInactivo(){
                this.control = false;
            },
            AtulizaData(data=[],index){
                this.arrayProductos[index] = data;
                alert('Actualizado con exito');
            },
            EliminarProducto(index){
                this.arrayProductos.splice(index, 1);
                alert('Eliminado con exito');
            },
            ActualziaArray(data=[]){
                this.arrayProductos.push(data);
                alert('Guardado con exito');
                this.cambiaInactivo();
            },
            ListarProductos(){
                 this.loadin=true;
                axios.get('productos').then((data)=>{
                    this.arrayProductos = data.data.data;
                    this.loadin=false;
                },(error) => { alert('Erorr al traer los datos'); this.loadin=false; });
            },

        },
        mounted() {
            this.ListarProductos();
        }
    });
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