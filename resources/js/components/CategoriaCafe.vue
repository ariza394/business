<template>
    <div class="container my-5">
        <h2>Cafes</h2>

        <div class="row">
            <div class="col-md-4 mt-4" v-for="cafe in cafes" v-bind:key="cafe.id">
                <div class="card">
                    <!-- image for no porduction //<img class="card-img-top" :src="`storage/${cafe.imagen_principal}`" alt="img-cafe"> -->
                    <img class="card-img-top show-main" :src="`images/${cafe.imagen_principal}.jpg`" alt="img-cafe">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold text-center">{{cafe.nombre}}</h3>
                        <p class="card-text">{{cafe.direccion}}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">schedule</span>
                            {{cafe.apertura}} - {{cafe.cierre}}
                        </p>
                        <router-link :to="{name:'establecimiento',params:{id:cafe.id}}">
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
        axios.get('/api/categorias/cafe')
            .then(respuesta => {
                this.$store.commit("AGREGAR_CAFES", respuesta.data);
            })
    },
    computed:{
        cafes(){
            return this.$store.state.cafes;
        }
    }
}
</script>