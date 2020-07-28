<template>
    <div class="container my-5">
        <h2>Gym</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for="gimnasio in gimnasios" :key="gimnasio.id">
                <div class="card">
                    <img class="card-img-top" :src="`storage/${gimnasio.imagen_principal}`" alt="img-cafe">
                    <!--<img class="card-img-top show-main" :src="`images/${gimnasio.imagen_principal}.jpg`" alt="img-cafe">-->
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold text-center">{{gimnasio.nombre}}</h3>
                        <p class="card-text">{{gimnasio.direccion}}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">schedule</span>
                            {{gimnasio.apertura}} - {{gimnasio.cierre}}
                        </p>
                        <router-link :to="{name:'establecimiento',params:{id:gimnasio.id}}">
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
        axios.get('/api/categorias/gimnacio')
            .then(respuesta => {
                this.$store.commit("AGREGAR_GIMNACIO",respuesta.data)
            })
    },
    computed:{
        gimnasios(){
            return this.$store.state.gimnasios;
        }
    }
}
</script>