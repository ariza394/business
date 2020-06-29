<template>
    <div>
        <listado-categorias></listado-categorias>
        <mapa-establecimientos></mapa-establecimientos>
        <categoria-restaurant></Categoria-restaurant>
        <categoria-cafe></Categoria-cafe>
        <categoria-hotel></categoria-hotel>
        <categoria-bar></categoria-bar>
        <categoria-hospital></categoria-hospital>
        <categoria-gimnasio></categoria-gimnasio>
        <categoria-doctor></categoria-doctor>
    </div>
</template>
<script>

    import ListadoCategorias from './ListadoCategorias';
    import MapaEstablecimientos from './MapaEstablecimientos';
    import CategoriaCafe from './CategoriaCafe'; 
    import CategoriaRestaurant from './CategoriaRestaurant'; 
    import CategoriaHotel from './CategoriaHotel';
    import CategoriaBar from './CategoriaBar';
    import CategoriaHospital from './CategoriaHospital';
    import CategoriaGimnasio from './CategoriaGimnasio';
    import CategoriaDoctor from './CategoriaDoctor';

    export default {
        components:{            
            ListadoCategorias,
            MapaEstablecimientos,
            CategoriaCafe,
            CategoriaRestaurant,
            CategoriaHotel,
            CategoriaBar,
            CategoriaHospital,
            CategoriaGimnasio,
            CategoriaDoctor         
        }
    }
</script>