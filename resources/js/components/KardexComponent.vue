<template>
    <div class="h-vh-100">
      <div class="card">
        <div class="card-header bg-orange fg-white m-0 b-0">
          
            <div class="form-group row">
                <span class="col-sm-3">TOMA DE PEDIDOS</span>
                <div class="col-sm-4">
                    <select class="custom-select" :disabled="arrayDetallePedido.length>0" :value="sotoreSelected.id" @input="MutationEvento" @change="abrirModal('producto','selected',sotoreSelected)" id="selectedTienda">
                        <option value="0" >--SELECCIONE TIENDA ENVIO--</option>
                        <option v-for="st in stores" :key="st.id" :value="st.id" v-text="st.nombre"></option>
                    </select>
                </div>
                <div class="col-sm-5 bg-warning" v-if="$store.state.STATE_CONNECT!=0">
                    <strong> <span v-if="$store.state.STATE_CONNECT == 1" class="text-info">ESTABLISHED CONNECTION =>{{ NAME_SELECTED }}</span>
                              <span v-if="$store.state.STATE_CONNECT == 2" class="text-primary">LOST CONNECTION => {{ NAME_SELECTED }}</span></strong>
                </div>
            </div>
        </div>
            <div class="card-content p-1 ">
                <div class="row m-1 p-0">
                    <div class="cell-sm-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="social-box m-0">
                                    <div class="header bg-cyan fg-white"  @click="abrirModal('cliente','nuevo')">
                                        <div class="title">CLIENTE</div>
                                        <div class="subtitle">YOEL COTONEL ARAUJO</div>
                                    </div>
                                    <ul class="skills p-0">
                                        <li>
                                            <div>TEL/CEL</div>
                                            <div class="text-bold">943403849</div>
                                            <div class="text-bold">943403848</div>
                                        </li>
                                    </ul>
                                    <ul class="skills p-0">
                                        <li>
                                            <div>DIR. ACTUAL</div>
                                            <div class="text-bold">Av.prueba fosdfbn ksdjfk kisdjfksd</div>
                                            
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="social-box p-0 m-0">
                                    <div class="header bg-orange fg-white">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="fac" value="F" >
                                        <label class="form-check-label" for="fac">
                                            FACTURA
                                        </label>
                                        </div>
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="bol" value="B" checked>
                                        <label class="form-check-label" for="bol">
                                            BOLETA
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell-sm-8">
                        <div class="table-responsive">
                                <table class="table table-sm table-hover compact">
                                    <thead class="bg-info">
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th style="width: 30%;">PRODUCTO</th>
                                            <th>CANT</th>
                                            <th>PRECIO</th>
                                            <th>TOTAL</th>
                                            <th width="310">
                                                   <span v-if="sotoreSelected.id>0"
                                                     @click="abrirModal('producto','selected',sotoreSelected)"> 
                                                     <i class="btn btn-sm btn-danger mif mif-add mif-lg fg-info"></i></span></span>
                                               
                                            </th>
                                            <th width="100">
                                                <span v-if="clickver==0" @click="clickver = 1"><i class="btn btn-sm mif-arrow-down btn-dark mif-lg fg-info"></i></span>
                                                <span v-else @click="clickver = 0"><i class="btn btn-sm btn-dark mif mif-arrow-up mif-lg fg-info"></i></span>
                                            </th>
                                            <th>
                                                <span class="btn btn-sm btn-block btn-outline-success" @click="AbrirModalMemo()">Memo</span>
                                            </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for ="(pedido,index) in arrayDetallePedido" :key="index" style="font-size: 13px; height: 35px;font-weight: 600;font-style: italic;">
                                            <td v-text="index+1" style="width: 5%" class="text-center text-primary"></td>
                                            <td style="width: 28%;font-size: 10px; line-height: 1;" class="text-wrap">
                                                <span v-text="pedido.nomPaquete"></span>
                                                <ul v-if="clickver==1">
                                                    <li v-for="(sublista,i) in pedido.body" :key="i" v-text="sublista.nombre_medida +' '+sublista.nombre_producto"></li>
                                                </ul>
                                            </td>
                                            <td width="50"><input type="text"
                                                    style="border-radius: 0px!important;" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"
                                                    maxlength="4"  v-model="pedido.cantidad"
                                                    class="input-small form-control form-control-sm"></td>
                                            <td style="margin-right: 100px; width: 50px"
                                                class="text-center"
                                                v-text="pedido.precio">
                                            </td>
                                            <td style="margin-left: 30px!important; width: 80px"
                                                class="text-center"
                                                v-text="pedido.total = ((pedido.precio*pedido.cantidad)-(pedido.precio*pedido.cantidad)*(pedido.descuento/100)).toFixed(2)">
                                            </td>
                                            <td colspan="2" style="width: 300px!important;">
                                                <input type="text" placeholder="Observaciones..." class="input-small form-control form-control-sm" style="border-radius: 0px!important;" v-model="pedido.descripcion">
                                            </td>
                                            <td colspan="2" style="width: 100px!important;">
                                                <button class="btn btn-outline-danger btn-sm" style="border-radius: 0px!important;" @click="EventoEliminar(index)"><i class="mif mif-cancel mif-lg fg-info"></i></button>
                                                <button class="btn btn-outline-secondary btn-sm" style="border-radius: 0px!important;"><i class="mif mif-add mif-lg fg-primary"></i></button>
                                            </td>
                                        </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                Card Footer
            </div>
        </div>
    <!-- modals -->
    <!-- CLIENTES -->
        <div class="modal fade" tabindex="-1" :class="{'mostrar':modal}" role="dialog" >
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-header bg-success fg-white">
                    <h5 class="modal-title" v-text="tituloModal"></h5>
                    <button type="button" class="close" aria-label="Close" @click="CloseModal()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" @click="CloseModal()">Close</button>
                </div>
                </div>
            </div>
        </div>


        <!-- ERROR DE CONEXION -->
        <div class="modal fade" tabindex="-1" :class="{'mostrar':modalError}" role="dialog" >
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger fg-white">
                        <h5 class="modal-title">Error Connection</h5>
                    <button type="button" class="close" aria-label="Close" @click="CloseModalError()">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="text-bold">
                                <h5 class="text-muted">Error en la conexión con la tienda {{ NAME_SELECTED }}, por favor verificar el internet.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Familias y Productos -->

        <div class="modal fade" tabindex="-1" :class="{'mostrar':modalFamilia}" role="dialog" >
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content" style="padding:0px!important; top:5px">
                <div class="modal-header bg-success fg-white">
                    <h5 class="modal-title" v-text="tituloModal"></h5>
                    <button type="button" class="close" aria-label="Close" @click="CloseModalProducto()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body b-0 m-0">
                    <div class="card b-0 m-0">
                        <div class="card-body b-0 m-0">
                            <div class="row">
                                <div class="col-sm-5 card-1">
                                    <input class="form-control form-control-lg col-12" style="border-radius: 0px!important;" v-model="nomfamilia" type="search" placeholder="Buscar familia" aria-label="Search">
                                        <div class="list-group">
                                            <a href="#" v-for ="fam in searchFamilias" :key="fam.id" @click="SELECTED_PAQUETES(fam.id)" class="list-group-item list-group-item-action menu_familia">
                                            <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{fam.nomfamilia}}</h5>
                                            <small class="text-muted">Activo</small>
                                            </div>
                                            <small class="text-muted">Comunicacón establecida</small>
                                        </a>
                                        </div>   
                                </div>
                                <div class="col-sm-7 card-1">
                                    <div class="input-group">
                                        <input type="text" 
                                                v-model="terminoBusqueda" 
                                                @input="BuscarTerminoProducto" 
                                                class="form-control form-control-lg col-12" 
                                                placeholder="Search ...">
                                        <div class="input-group-append" id="button-addon4">
                                            <button class="btn btn-outline-danger" type="button">-</button>
                                        </div>
                                        </div>
                                    <div class="list-group">
                                        <a href="#" v-for="paquete in arrayPaqueteFamilias" :key="paquete.id"  class="list-group-item list-group-item-action menu_paquete" @click="AbrirModal(paquete)">

                                            <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{paquete.nomPaquete}}</h5>
                                            <small class="text-muted">S/  {{paquete.precio}}</small>
                                            </div>
                                            <small v-if="paquete.ini_fecha!=null" class="text-muted">Desde {{paquete.ini_fecha}} hasta {{paquete.fin_fecha}} </small>
                                        </a>
                                        </div>
                                </div>
                            </div>
                                                    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Agregar</button>
                    <button type="button" class="btn btn-secondary" @click="CloseModalProducto()">Close</button>
                </div>
                </div>
            </div>
        </div>

        <!-- mdodal botonera -->

        <!-- Modal de toma de pedidos -->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modalBotonera}" id="modals1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title text-white"  v-text="tituloModalPedido+' S/ :'"></h4>
                        <h3 class="bg-header  text-white ">{{CalculaTotalPaquete}}</h3>
                        <button type="button" class="close" @click="cerrarModalBotonera()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-4" v-for = "detalle in arrayDetallePaquete" :key="detalle.id">
                                <h6 class="text-success" v-text="'***'+detalle.nombre+'***'"></h6>
                                <div class="list-group row">
                                    <form action="" class="formulario">
                                         <div  v-for="(op,index) in detalle.body" :key="index">
                                            <div v-if="detalle.preferencia == 0">
                                                 <input v-if="op.selected" checked  type="radio"
                                                    :name="'detalle'+detalle.id"
                                                    :id="detalle.id+'-'+op.producto_id"
                                                    :value="detalle.id+'*'+op.producto_id"
                                                    @click="actualiza()">
                                                <input v-else type="radio"
                                                        :name="'detalle'+detalle.id"
                                                        :id="detalle.id+'-'+op.producto_id"
                                                        :value="detalle.id+'*'+op.producto_id"
                                                         @click="actualiza()">
                                                <label :for="detalle.id+'-'+op.producto_id" class="list-group-item list-group-item-action">{{op.nombre_producto}}
                                                   <span v-if="op.precio>0" class="btn btn-sm btn-danger">+{{op.precio}}</span>
                                                </label>
                                            </div>
                                            <div v-else class="radio list-group-item list-group-item-action">
                                                <input v-if="op.selected" checked  type="radio"
                                                    :name="'detalle'+detalle.id"
                                                    :id="detalle.id+'-'+op.producto_id"
                                                    :value="detalle.id+'*'+op.producto_id"
                                                    @click="actualiza()">
                                                <input v-else type="radio"
                                                        :name="'detalle'+detalle.id"
                                                        :id="detalle.id+'-'+op.producto_id"
                                                        :value="detalle.id+'*'+op.producto_id"
                                                         @click="actualiza()">
                                                <label style="font-size: 9px" @dblclick="unselect('detalle'+detalle.id)" :for="detalle.id+'-'+op.producto_id" class="list-group-item list-group-item-action">{{op.nombre_producto}}
                                                    <span  v-if="op.precio>0" class="btn btn-sm btn-danger">+{{op.precio}}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-outline-danger" v-if="cantidad >= 2" @click="cantidad -= 1">-</button>
                            <input type="text"  maxlength="4" class="text-center" v-model.number="cantidad" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" style="width: 50px;">
                            <button type="button" class="btn btn-outline-success" @click="cantidad+=1">+</button>
                        </div>
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" class="btn btn-lg btn-outline-success btn-block" @click="AgreagaPedido()">Crear</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- fin modals -->
    </div>
</template>
<script>
    import {mapState, mapMutations} from 'vuex';
    export default ({
        name:'KardexComponent',
        data (){
            return {
                tituloModal:'',
                tituloModalPedido:'',
                modal:0,
                modalError:0,
                modalFamilia:0,
                modalBotonera:0,
                producto:0,
                cantidad:1,
                precio:0,
                descuento:0,

                clickver:0,

                subarrayDetalle:[],

                nomfamilia:'',
                terminoBusqueda:'',
            }
        },
        created() {
            this.$store.dispatch({type:'loadStoreAsync',data:this.sotoreSelected.id});
        },
        computed: {
            ...mapState(['arrayFamilias','arrayPaquetes','arrayPaqueteFamilias','arrayDetallePaquete','arrayDetalles','stores','cliente','sotoreSelected','NAME_SELECTED','arrayDetallePedido']),
             searchFamilias: function () {
                return this.arrayFamilias.filter((item) => item.nomfamilia.includes(this.nomfamilia.toUpperCase()));
            },
            CalculaTotalPaquete:function() {
                var total = this.cantidad*this.precio;
                for (var i = 0; i < this.arrayDetallePaquete.length; i++) {
                    var valores = $('input:radio[name=detalle'+this.arrayDetallePaquete[i]['id']+']:checked').val();
                    if (valores!=undefined) {
                         var detalle_id = valores.split('*')[0];
                         var producto_id = valores.split('*')[1];
                        for (var j = 0; j < this.arrayDetallePaquete[i].body.length; j++) {
                            if (this.arrayDetallePaquete[i].body[j]['producto_id']==producto_id) {
                                
                                total += (parseFloat(this.arrayDetallePaquete[i].body[j]['precio']))*this.cantidad;
                            }
                        }
                    }
                }
                return total.toFixed(2);
            },
            
	    },
        methods:{
            actualiza(){
                this.cantidad -=1;
                this.cantidad+=1;
            },
            BuscarTerminoProducto(){
			   this.$store.state.arrayPaqueteFamilias = [];

			   var termino  = this.terminoBusqueda.toUpperCase();
			   termino = termino.replace(/ /g, "");

				if(termino!=""){
					for (let producto of this.arrayDetalles) {

						for (let prod of producto.body) {

							var nombre = prod.nombre_producto;
							nombre = nombre.replace(/ /g, "");
							
							if(nombre.indexOf( termino ) >= 0){

								for (let paquete of this.arrayPaquetes) {

									if(paquete.id == producto.paquete_id){
										
										if(!this.validaExistencia(paquete.id)){

											this.$store.state.arrayPaqueteFamilias.push(paquete);

										}
										
									}
								}
								
							// console.log(prod);
							}
						}
						
					}
				}
                
			},
			validaExistencia(id){
				var conta = false;
				for (const iterator of this.arrayPaqueteFamilias) {
					if(iterator.id == id){
						conta = true;
						break;
					}
				}
				return conta;
            },
            AgreagaPedido(){
                var totalbase = parseFloat(this.precio);
                
                for (var i = 0; i < this.arrayDetallePaquete.length; i++) {
                    var valores = $('input:radio[name=detalle'+this.arrayDetallePaquete[i]['id']+']:checked').val();
                    if (valores!=undefined) {
                         var detalle_id = valores.split('*')[0];
                         var producto_id = valores.split('*')[1];
                        for (var j = 0; j < this.arrayDetallePaquete[i].body.length; j++) {
                            if (this.arrayDetallePaquete[i].body[j]['producto_id']==producto_id) {
                               totalbase += parseFloat(this.arrayDetallePaquete[i].body[j]['precio']);

                               this.arrayDetallePaquete[i].body[j]['cantidad'] = this.arrayDetallePaquete[i]['cantidad'];

                               this.subarrayDetalle.push(this.arrayDetallePaquete[i].body[j]);

                            }
                        }
                        if (this.arrayDetallePaquete.length-1 == i) {
                            if(isNaN(this.descuento)){
                                this.descuento = 0;
                            }
                            const data = {
                                paquete_id:this.arrayDetallePaquete[i]['paquete_id'],
                                nomPaquete:this.tituloModalPedido,
                                cantidad:this.cantidad,
                                precio:(totalbase).toFixed(2),
                                descuento:this.descuento,
                                total:this.CalculaTotalPaquete,
                                descripcion:'',
                                estado:'0',
                                body:this.subarrayDetalle,
                            }
                            this.$store.commit('AgregarPedido',data);

                            this.subarrayDetalle=[];
                            this.cantidad=1;
                            this.modalBotonera = 0;
                           // this.SuccesAgregar('Agregado con éxito');
                        }
                    }else{
                        if (this.arrayDetallePaquete.length-1 == i) {
                            if(isNaN(this.descuento)){
                                this.descuento = 0;
                            }
                            this.arrayDetallePedido.push({
                                paquete_id:this.arrayDetallePaquete[i]['paquete_id'],
                                nomPaquete:this.tituloModalPedido,
                                cantidad:this.cantidad,
                                precio:(totalbase).toFixed(2),
                                descuento:this.descuento,
                                total:this.CalculaTotalPaquete,
                                descripcion:'',
                                estado:0,
                                body:this.subarrayDetalle,
                            });
                            this.subarrayDetalle=[];
                            this.cantidad=1;
                            this.modalBotonera = 0;
                            //this.SuccesAgregar('Agregado con éxito');
                        }
                    }
                }
            },
            SuccesAgregar(title){
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
                });
                Toast.fire({
                  type: 'success',
                  title: title,
                })
            },
            abrirModal(modelo, accion, data = []){

                switch(modelo){
                    case "cliente":
                    {
                        switch(accion){
                            case 'nuevo':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Nuevo Cliente';
                                //this.tipoAccion=1;

                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                               // this.tipoAccion=2;
                               
                                break;
                            }
                        }
                        break;
                    }
                    case "producto":
                    {
                        switch(accion){
                            case 'selected':
                            {
                                if(this.$store.state.STATE_CONNECT==2){
                                    this.modalError = 1;
                                }else{

                                    this.modalFamilia = 1;
                                    this.tituloModal = 'Productos '+ this.NAME_SELECTED;
                                }
                                
                                //this.tipoAccion=1;

                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                               // this.tipoAccion=2;
                               
                                break;
                            }
                        }
                    }
                }
            },
            CloseModal(){
                this.modal=0;
            },
            CloseModalError(){
                this.modalError=0;
            },
            CloseModalProducto(){
                this.modalFamilia = 0;
            },
            cerrarModalBotonera(){
                this.modalBotonera=0;
            },
            unselect(valor){
              document.querySelectorAll('[name='+valor+']').forEach((x) => x.checked=false);
            },
            MutationEvento( e ) {
                this.$store.commit('GET_SELECTED_TOKEN', e.target.value);
                this.$store.commit('SET_NAME_SELECTED',$('#selectedTienda option:selected').text())
            },
            SELECTED_PAQUETES (id) {
				this.$store.commit('GET_PAQUETE_FAMILIA', id)
            },
            AbrirModal (data) {
                this.$store.commit('GET_DETALLE_PAQUETE', data.id);
                this.modalBotonera = 1;
                this.tituloModalPedido=data['nomPaquete'];
            },
            EventoEliminar(index){
                this.$store.commit('EliminaItemPedido',index);
			},
             
        },
        mounted: function () {
           // Metro.init();
        }
    });

</script>
<style scoped>
    .card-1{
        margin-bottom: 0.1rem!important;
        overflow-y: scroll!important;
        height: 60vh!important;
    }
    .modal-content{
        margin-top: 50px !important;
        width: 100% !important;
        position: absolute !important;
        border-radius: 10px grey!important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: transparent !important;
    }
    /* .modal-backdrop {
        position: fixed;
        top: 0!important;
        left: 0!important;
        z-index: 10000!important;
        width: 100vw!important;
        height: 100vh!important;
        background-color: rgb(7, 7, 7)!important;
    } */
</style>