import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        cafes:[],
        restaurantes:[],
        hoteles:[],
        bares:[],
        hospitales:[],
        gimnasios:[],
        doctores:[],
        establecimiento:{},
        establecimientos:[],
        categorias:[],
        categoria:''
    },
    mutations:{
        AGREGAR_CAFES(state, cafes){
            state.cafes = cafes;
        },
        AGREGAR_RESTAURANTES(state,restaurantes){
            state.restaurantes = restaurantes;
        },
        AGREGAR_HOTELES(state,hoteles){
            state.hoteles = hoteles;
        },
        AGREGAR_BARES(state,bares){
            state.bares = bares;
        },
        AGREGAR_HOSPITALES(state,hospitales){
            state.hospitales = hospitales;
        },
        AGREGAR_GIMNACIO(state,gimnasios){
            state.gimnasios = gimnasios;
        },
        AGREGAR_DOCTORES(state,doctores){
            state.doctores = doctores;
        },
        AGREGAR_ESTABLECIMIENTO(state,establecimiento){
            state.establecimiento = establecimiento;
        },
        AGREGAR_ESTABLECIMIENTOS(state,establecimientos){
            state.establecimientos = establecimientos;
        },
        AGREGAR_CATEGORIAS(state,categorias){
            state.categorias = categorias;
        },
        SELECCIONAR_CATEGORIA(state,categoria){
            state.categoria = categoria
        }
    },
    getters:{
        obtenerImagenes: state => {
            return state.establecimiento.imagenes;
        },
        obtenerEstablecimientos: state => {
            return state.establecimientos;
        },
        obtenerCategorias: state => {
            return state.categorias;
        },
        obtenerCategoria: state => {
            return state.categoria;
        }
    }
});