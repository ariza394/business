<template>
    <div class="container my-5">
        <h2>Doctors</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for="doctor in doctores" :key="doctor.id">
                <div class="card">
                    <!--<img class="card-img-top" :src="`storage/${doctor.imagen_principal}`" alt="img-cafe">-->
                    <img class="card-img-top" :src="`images/${doctor.imagen_principal}.jpg`" alt="img-cafe">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold text-center">{{doctor.nombre}}</h3>
                        <p class="card-text">{{doctor.direccion}}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">schedule</span>
                            {{doctor.apertura}} - {{doctor.cierre}}
                        </p>
                        <router-link :to="{name:'establecimiento',params:{id:doctor.id}}">
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
        axios.get('/api/categorias/doctor')
            .then(respuesta => {
                this.$store.commit("AGREGAR_DOCTORES",respuesta.data)
            })
    },
    computed:{
        doctores(){
            return this.$store.state.doctores;
        }
    }
}
</script>

<style scoped>
img{
    height: 250px;
}
</style>