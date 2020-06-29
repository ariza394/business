<template>
    <div class="container my-5">
        <h2>Hospitals</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for="hospital in hospitales" :key="hospital.id">
                <div class="card">
                    <!--<img class="card-img-top" :src="`storage/${hospital.imagen_principal}`" alt="img-cafe">-->
                    <img class="card-img-top show-main" :src="`images/${hospital.imagen_principal}.jpg`" alt="img-cafe">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold text-center">{{hospital.nombre}}</h3>
                        <p class="card-text">{{hospital.direccion}}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">schedule</span>
                            {{hospital.apertura}} - {{hospital.cierre}}
                        </p>
                        <router-link :to="{name:'establecimiento',params:{id:hospital.id}}">
                            <a href="" class="btn btn-primary d-block">Explore</a>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted(){
        axios.get('/api/categorias/hospital')
            .then(respuesta => {
                this.$store.commit("AGREGAR_HOSPITALES",respuesta.data)
            })
    },
    computed:{
        hospitales(){
            return this.$store.state.hospitales;
        }
    }
}
</script>