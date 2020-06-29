<template>
    <div class="container my-5">
        <h2>Restaurants</h2>

        <div class="row">
            <div class="col-md-4 mt-4" v-for="restaurante in restaurantes" v-bind:key="restaurante.id">
                <div class="card">
                    <img class="card-img-top show-main" :src="`storage/${restaurante.imagen_principal}`" alt="img-cafe">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold text-center">{{restaurante.nombre}}</h3>
                        <p class="card-text">{{restaurante.direccion}}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">schedule</span>
                            {{restaurante.apertura}} - {{restaurante.cierre}}
                        </p>
                        <router-link :to="{name:'establecimiento',params:{id:restaurante.id}}">
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
        axios.get('/api/categorias/restaurant')
            .then(respuesta => {
                this.$store.commit("AGREGAR_RESTAURANTES",respuesta.data);
            })
    },
    computed:{
        restaurantes(){
            return this.$store.state.restaurantes
        }
    }
}
</script>