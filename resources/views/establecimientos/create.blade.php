@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/> 
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.css" integrity="sha256-iDg4SF4hvBdxAAFXfdNrl3nbKuyVBU3tug+sFi1nth8=" crossorigin="anonymous" />
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Create your business</h1>

            <div class="mt-5 row justify-content-center">
                <form 
                    class="col-md-9 col-xs-12 card card-body"
                    method="POST"
                    action="{{route('establecimiento.store')}}"
                    enctype="multipart/form-data"
                >
                    @csrf

                    <fieldset class="border p-4">
                        <legend class="text-primary">Name, Category and Main Image</legend>
                        
                        {{--Nombre--}}
                        <div class="form-group">
                            <label for="nombre">Business Name</label>
                            <input 
                                id="nombre" 
                                name="nombre"
                                type="text"
                                class="form-control @error('nombre') is-invalid  @enderror"
                                placeholder="Business Name"
                                value="{{old('nombre')}}"
                            >

                            @error('nombre')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--Categoria--}}
                        <div class="form-group">
                            <label for="categoria">Categoria</label>

                            <select 
                                class="form-control 
                                @error('categoria_id') is-invalid  @enderror" 
                                name="categoria_id"
                                id="categoria"
                            >
                                <option value="" selected disable>--Choose--</option>

                                @foreach($categorias as $categoria)
                                    <option 
                                    value="{{$categoria->id}}"
                                    {{old('categoria_id') == $categoria->id ? 'selected' : ''}}
                                >{{$categoria->nombre}}</option> 
                                @endforeach
                            </select>
                        </div>

                        {{--Main Image--}}
                        <div class="form-group">
                            <label for="imagen_principal">Main Image</label>
                            <input 
                                id="imagen_principal" 
                                name="imagen_principal"
                                type="file"
                                class="form-control @error('imagen_principal') is-invalid  @enderror"
                                value="{{old('imagen_principal')}}"
                            >

                            @error('imagen_principal')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                    </fieldset>

                    <fieldset class="border p-4 mt-5">
                        <legend class="text-primary">Location</legend>
                        
                        {{--Ubicacion--}}
                        <div class="form-group">
                            <label for="formbuscador">Business Address</label>
                            <input 
                                id="formbuscador" 
                                type="text"
                                placeholder="Street"
                                class="form-control"
                                disabled
                            >
                            <h3 class="text-center">Move you pin</h3>
                        </div>
                        <div class="form-group">
                            <div id="mapa" style="height:400px"></div>
                        </div>

                        <p class="informacion">Confirm the next filds</p>

                        {{--Address--}}
                        <div class="form-group">
                            <label for="direccion">Address</label>
                            <input 
                                type="text" 
                                id="direccion"
                                class="form-control @error('direccion') is invalid @enderror"
                                placeholder="Address"
                                value="{{old('direccion')}}"
                                name="direccion"
                            >

                            @error('direccion')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--Colonia--}}
                        <div class="form-group">
                            <label for="colonia">Suburb</label>
                            <input 
                                type="text" 
                                id="colonia"
                                class="form-control @error('colonia') is invalid @enderror"
                                placeholder="Colonia"
                                value="{{old('colonia')}}"
                                name="colonia"
                            >

                            @error('colonia')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="hidden" id="lat" name="lat" value="{{old('lat')}}">
                        <input type="hidden" id="lng" name="lng" value="{{old('lng')}}">
                    </fieldset>
                    {{--cambio de fielset--}}
                    <fieldset class="border p-4 mt-5">
                        <legend  class="text-primary">Business Information: </legend>
                            {{--Telefono--}}
                            <div class="form-group">
                                <label for="telefono">Phone</label>
                                <input 
                                    type="tel" 
                                    class="form-control @error('telefono')  is-invalid  @enderror" 
                                    id="telefono" 
                                    placeholder="Teléfono Establecimiento"
                                    name="telefono"
                                    value="{{ old('telefono') }}"
                                >
        
                                @error('telefono')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
        
                            
                             {{--Descripcion--}}
                            <div class="form-group">
                                <label for="descripcion">Descripction</label>
                                <textarea
                                    class="form-control  @error('descripcion')  is-invalid  @enderror" 
                                    name="descripcion"
                                >{{ old('descripcion') }}</textarea>
        
                                @error('descripcion')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                             {{--apertura--}}
                            <div class="form-group">
                                <label for="apertura">Open:</label>
                                <input 
                                    type="time" 
                                    class="form-control @error('apertura')  is-invalid  @enderror" 
                                    id="apertura" 
                                    name="apertura"
                                    value="{{ old('apertura') }}"
                                >
                                @error('apertura')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                             {{--cierre--}}
                            <div class="form-group">
                                <label for="cierre">Close:</label>
                                <input 
                                    type="time" 
                                    class="form-control @error('cierre')  is-invalid  @enderror" 
                                    id="cierre" 
                                    name="cierre"
                                    value="{{ old('cierre') }}"
                                >
                                @error('cierre')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                    </fieldset>

                    <fieldset class="border p-4">
                        <legend class="text-primary">Images</legend>
                        <div class="form-group">
                            <label for="imagenes">Images</label>
                           <div id="dropzone" class="dropzone form-control"></div>
                        </div>
                    </fieldset>

                    <input type="hidden" name="uuid" id="uuid" value="{{Str::uuid()->toString()}}">
                    <input 
                        type="submit" 
                        class="btn btn-primary mt-3 d-block"
                        value="Sign Up Your Business"
                    >

                </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script> 

    <script src="https://unpkg.com/esri-leaflet" defer></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.js" defer integrity="sha256-fegGeSK7Ez4lvniVEiz1nKMx9pYtlLwPNRPf6uc8d+8=" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded',() => {
            Dropzone.autoDiscover = false;
            const dropzone = new Dropzone('div#dropzone',{
                url:'/imagenes/store',
                dictDefaultMessage:'Up to 10 Images',
                maxFiles:0,
                required:true,
                acceptedFiles:".png,.jpg,.gif,.jpeg",
                addRemoveLinks:true,
                headers:{
                    'X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content
                },
                success: function(file,respuesta){
                    console.log(respuesta);
                    file.nombreServidor = respuesta.archivo;
                },
                sending: function(file,xhr,formData){
                    formData.append('uuid',document.querySelector('#uuid').value);
                    
                },
                removedfile:function(file,respuesta){
                    const params = {
                        imagen: file.nombreServidor,
                        uuid: document.querySelector('#uuid').value
                    }
                    axios.post('/imagenes/destroy',params)
                        .then(respuesta => {
                            
                            //Eliminar del DOM
                            file.previewElement.parentNode.removeChild(file.previewElement);
                    });
                }
            });
        });
    </script>

@endsection