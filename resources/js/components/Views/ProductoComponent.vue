<template>
	
		<tr>
			<div id='ajax-overlay' v-show="loadin">
	            <div id='ajax-overlay-body' class='center'>
	                <i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i>
	                <span class='sr-only'>Loading...</span>
	            </div>
	        </div>
			<template v-if="editar==0">
				<td>{{producto.codigo}}</td>
	       		<td>{{producto.nombre}}</td>
	        	<td>{{producto.descripcion}}</td>
			</template>
			<template v-else>
				<td><input type="text" v-model="producto.codigo" class="form-control form-control-sm"></td>
	        	<td><input type="text" v-model="producto.nombre" class="form-control form-control-sm"></td>
	        	<td><input type="text" v-model="producto.descripcion" class="form-control form-control-sm"></td>
			</template>
	        <td>
	        	<button class="btn btn-sm btn-info" v-if="editar==0" @click="editar=1" >Editar</button>
	        	<button class="btn btn-sm btn-primary"  v-else  @click="ActualizarCampo(producto,index)">Actualziar</button>
	        	<button class="btn btn-sm btn-danger"  @click="Eliminar(producto.id,index)">Eliminar</button>
	        </td>
		</tr>
</template>

<script>
    export default {
    	props:['producto','index'],
         name:'ProductoComponent',
         data(){
         	return {
         		editar:0,
         		loadin:false,
         	}
         },
         methods:{
         	ActualizarCampo(data=[],index){
         		  this.loadin=true;
         		axios.put('productos/'+data['id'],{
         			codigo:data['codigo'],
         			nombre:data['nombre'],
         			descripcion:data['descripcion'],
         		}).then((res)=>{
         			  this.loadin=false;
         			this.$emit('AtulizaData',res.data,index);
         		});
         		this.editar = 0;
         	},
         	Eliminar(id,index){
         		if (confirm("Está seguro de eliminar el procuto")) {
         			axios.delete('productos/'+id);
         			this.$emit('EliminarProducto',index);
         		}

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
