<template>
    <div class="container my-5">
        <h2 class="text-center-mb-5">{{establecimiento.nombre}}</h2>

        <div class="row align-items-start">
            <div class="col-md-8 order-2">
                <img :src="`storage/${establecimiento.imagen_principal}`" class="img-fluid" alt="imagen">
                <p class="mt-3">{{establecimiento.descripcion}}</p>
                <galeria-imagenes></galeria-imagenes>
                <h6>In production images is not working due the costs</h6>
            </div>
            <aside class="col-md-4 order-1">
                <div>   
                    <mapa-ubicacion></mapa-ubicacion>
                </div>
                <div class="p-4 bg-primary">
                    <h2 class="text-center text-white mt-2 mb-4">More Information</h2>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Location:
                        </span>
                        {{establecimiento.direccion}}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Suburb:
                        </span>
                        {{establecimiento.colonia}}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Schedule:
                        </span>
                        {{establecimiento.apertura}} - {{establecimiento.ciere}}
                    </p>
                    <p class="text-white mt-1">
                        <span class="font-weight-bold">
                            Phone:
                        </span>
                        {{establecimiento.telefono}}
                    </p>
                </div>
            </aside>
        </div>
    </div>
</template>

<script>
import MapaUbicacion from './MapaUbicacion';
import GaleriaImagenes from './GaleriaImagenes';
export default { 
    components:{
        MapaUbicacion,
        GaleriaImagenes
    },   
     mounted(){
        const {id} = this.$route.params;

        axios.get('/api/establecimientos/'+id)
            .then(respuesta => {
                this.$store.commit('AGREGAR_ESTABLECIMIENTO',respuesta.data);
            })
    },
    computed:{
        establecimiento(){
            return this.$store.state.establecimiento;
        }
    }
}
</script>