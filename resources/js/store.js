import Vue from 'vue';
import Vuex from 'vuex';
import Axios from 'axios';

Vue.use(Vuex)
export default new  Vuex.Store({
  state: {
    BaseUrl:'',
    STATE_CONNECT:0,
    NAME_SELECTED:'',
    cliente:{
      genero:'masculino',
      nombre:'',
      num_docu:'',
      prim_apellido:'',
      seg_apellido:'',
      direccion:'',
      fecha_nacimiento:'',
      telefonos:[],
      envios:[],},
    stores:[],
    arrayFamilias:[],
    arrayPaquetes:[],
    arrayDetalles:[],
    arrayDetallePedido:[],
    sotoreSelected:{
      id: '0',
      StrNombre: '',
      StrDireccion: '',
      url_api:'',
      api_token:'',
    },
      // lISTA PAQUETE POR FAMILIA
    arrayPaqueteFamilias:[],
    arrayDetallePaquete:[],
  },
  mutations: {
    SET_URL (state , data) {
      state.BaseUrl = data;
    },
    SET_NAME_SELECTED(state, data){

      state.NAME_SELECTED = data;
    },
    SET_CLIENTE (state, cliente) {
      state.cliente = Object.assign({},state.cliente, cliente)
    },
    SET_CLIENTE_TELEFONO ( state , cliente ) {
       state.cliente.telefonos.push(cliente.data);
    },
    SET_CLIENTE_ENVIO ( state , cliente ) {
       state.cliente.envios.push(cliente.data);
    },
    SET_CLIENTE_TELEFONO_DELETE ( state , cliente ) {
        state.cliente.telefonos.splice(cliente.data,1);
    },
    SET_CLIENTE_ENVIO_DELETE ( state , cliente ) {
        state.cliente.envios.splice(cliente.data,1);
    },
    SET_STORES (state, stores) {
       state.stores = stores;
    },
    GET_SELECTED_TOKEN (state,id) {
      var op = false;
      for (var i = 0; i < state.stores.length; i++) {
        if (state.stores[i]['id'] == id) {
            state.sotoreSelected = state.stores[i];
            this.dispatch({type:'loadFamiliaPaqueteTiendaAsync',data:state.sotoreSelected});
            op=true;
        }
        if (op) {
            break;
        }
      }
      if (!op) {
        state.STATE_CONNECT = 2;
        state.arrayFamilias = [];
        state.arrayPaquetes = [];
        state.arrayDetalles = [];
      }
   },
   GET_FAMILIA_PAQUETES_TIENDA_AUTH (state,data) {
      state.arrayFamilias = data.familias;
      state.arrayPaquetes = data.paquetes;
      state.arrayDetalles = data.detalles;
   },
   GET_PAQUETE_FAMILIA ( state, id ) {
      state.arrayPaqueteFamilias = [];
      for (var i = 0; i < state.arrayPaquetes.length; i++) {
        if (state.arrayPaquetes[i].familia_id == id) {
          state.arrayPaqueteFamilias.push(state.arrayPaquetes[i]);
        }
      }
   },
   GET_DETALLE_PAQUETE ( state, id ) {
      state.arrayDetallePaquete = [];
      for (var i = 0; i < state.arrayDetalles.length; i++) {
       if (state.arrayDetalles[i].paquete_id == id) {
            state.arrayDetallePaquete.push(state.arrayDetalles[i]);
          }
      }
   },
   AgregarPedido ( state, data ) {
    state.arrayDetallePedido.push(data);
  },
  EliminaItemPedido (  state, data  ) {
    state.arrayDetallePedido.splice(data, 1);
  },
  },
  actions:{
    async loadStoreAsync({commit,state},data) {
        if (data.data == 0) {
           try {
              let response = await fetch(
                state.BaseUrl+'/api/getStores',
              );
              let responseJson = await response.json();
                let stores =  responseJson.data;
                commit('SET_STORES',stores)
            } catch (error) {
              console.error(error);
            }
          }
      },
    async loadFamiliaPaqueteTiendaAsync({commit,state},data) {
         try {
           
            let response = await fetch(data.data.url_api+data.data.api_token);
            let responseJson = await response.json();
            state.STATE_CONNECT = 1;
            commit('GET_FAMILIA_PAQUETES_TIENDA_AUTH',responseJson)
           
            
          } catch (error) {
            console.error(error);
            state.STATE_CONNECT = 2;
          }
      },
    }
});