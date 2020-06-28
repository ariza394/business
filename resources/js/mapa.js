// when the docs use an import:
//import { OpenStreetMapProvider } from 'leaflet-geosearch';
//const provider = new OpenStreetMapProvider();

document.addEventListener('DOMContentLoaded', () => {

    if(document.querySelector('#mapa')){
        const lat = document.querySelector('#lat').value === '' ? -36.849761 : document.querySelector('#lat').value;
        const lng = document.querySelector('#lng').value === '' ? 174.7628903 : document.querySelector('#lng').value;

        const mapa = L.map('mapa').setView([lat, lng], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

        // agregar el pin
        marker = new L.marker([lat, lng],{
            draggable:true,
            autoPan:true
        }).addTo(mapa);

        //Geocode service
        const geocodeService = L.esri.Geocoding.geocodeService();

        //buscador de direcciones
        const buscador = document.querySelector('#formbuscador');
        buscador.addEventListener('input',buscarDireccion)

        //detecta movimiento
        marker.on('moveend',function(e){
            marker = e.target;

            const posicion = marker.getLatLng();

            //centrar automaticamente
            mapa.panTo(new L.LatLng(posicion.lat,posicion.lng));

            //reverse geocoding
            geocodeService.reverse().latlng(posicion,16).run(function(error,resultado){
                
                marker.bindPopup(resultado.address.LongLabel);
                marker.openPopup();

                //llenar campos
                llenarInputs(resultado);
            })
        });

        function llenarInputs(resultado){
           document.querySelector('#direccion').value= resultado.address.Address || '';
           document.querySelector('#colonia').value= resultado.address.Neighborhood || '';
           document.querySelector('#lat').value= resultado.latlng.lat || '';
           document.querySelector('#lng').value= resultado.latlng.lng || '';
        }

        function buscarDireccion(e){
            if(e.target.value.length > 10){
                /*provider.search({query: e.target.value})
                    .then(resultado =>{
                        console.log(resultado)
                    });*/
            }

        }
    }
    

});