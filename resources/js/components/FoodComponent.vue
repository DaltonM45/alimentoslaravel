<template>

<div>
    <div class="container">
        <div class="opciones">
            <div class="botones">
                
              <i class="fas btn-al fa-utensils" v-on:click="abrilModal('registrar')"></i>
               
            </div>
            <div class="botones">
                <!-- <button class="estadistica"> -->
                    <router-link to="/estadisticas">
                            <i class="fas btn-est fa-tachometer-alt"></i>
                    </router-link>    

                   
                <!-- </button> -->
            </div>
        </div>
       
    </div>

        <div class="busqueda">
            <div>
                 <input type="text" class="form-control ip-buscar" placeholder="buscar">
            </div>
        </div>

        <table class="table">
           <thead class="thead-dark">
                <tr>
                    <th>Desayuno</th>
                    <th>Comida</th>
                    <th>Cena</th>
                    <th>Extra</th>  
                    <th>Opciones </th>    
                    <th>Fecha </th>     
                </tr>
            </thead>
            <tbody>
                <tr v-for="food in arrayFood" :key="food.id">
                    <td v-text="food.desayuno"></td>
                    <td  v-text="food.comida"></td>
                    <td  v-text="food.cena"></td>
                    <td  v-text="food.extra"></td>
                    <td>
                        <button class="btn btn-primary" @click="eliminarFood(food.id)" >
                             <i class="far fa-trash-alt"></i>
                        </button>
                         <button class="btn btn-warning" @click="abrilModal('actualizar', food)">
                               <i class="far fa-edit"></i>
                         </button>
                    </td>
                    <td> {{ food.created_at | formatlocale }}</td>
                </tr>
                
            </tbody>


            
        </table>


       

        <!-- Modal -->
        <div class="modal fade"   tabindex="-1" role="dialog"  aria-hidden="true" :class="{'mostrar' : modal}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" v-text="tituloModal"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" @click="cerrarModal()">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group">
                            <input type="text" placeholder="Desayuno" class="form-control" autofocus v-model="desayuno">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Comida" class="form-control" v-model="comida">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Cena" class="form-control" v-model="cena">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Extra" class="form-control" v-model="extra">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>
                    <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="guardarFood()">Guardar</button>
                    <button type="button" class="btn btn-success" v-if="tipoAccion==2" @click="actualizarFood()">Actualizar</button>
                </div>
                </div>
            </div>
        </div>


        
</div>
       
   
</template>




<script>
// const moment = require('moment')
// require('moment/locale/es')

    export default {

        data(){
            return {
                comida_id:0,
                desayuno:'',
                comida:'',
                cena:'',
                extra:'',
                arrayFood: [],
                modal: 0,
                tituloModal:'',
                tipoAccion:0
            }
        },
        methods : {
            mostrarAlimentos(){
                let me = this;
                var url = '/alimentos';

                axios.get(url).then(function (response)  {
                      var respuesta = response.data;
                      me.arrayFood = respuesta.alimentos;

                }).catch(function(error) {
                   console.log(error + 'error en el metodo mostraraliemntos');
            });

            },
            guardarFood(){
                 let me = this;
                
                axios.post('/alimentos/guardar', {
                    'desayuno' : this.desayuno,
                    'comida' : this.comida,
                    'cena': this.cena,
                    'extra':this.extra
                }).then(function (response) {
                    me.cerrarModal();
                    me.mostrarAlimentos();
                }).catch(function (error) {
                  console.log(error + 'error en el metodo guardar');
             })

            },
            actualizarFood(){
                
                 let me = this;
                 
                 axios.put('/alimentos/actualizar' , {
                     'desayuno': this.desayuno,
                     'comida'  : this.comida,
                     'cena'    : this.cena,
                     'extra'   : this.extra,
                     'id'      : this.comida_id
                     
                 }).then( function (response) {
                       me.cerrarModal();
                       me.mostrarAlimentos(); 
                 }).catch( function (error) {
                    console.log(error + 'el metodo actualizar no se pudo ser completada');
                 })


            },
            eliminarFood(id){
                swal({
                    title: "Estas seguro de eliminar este registro?",
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                      let url = '/alimentos/'+id;
                      let me = this;

                     axios.post(url).then( function (response) {
                       console.log('eliminado')
                       me.mostrarAlimentos();

                        swal("El registro ha sido eliminado", {
                         icon: "success",
                        })
                        
                      })
 
                    }
                });
                
               


                

            },
            abrilModal(accion, data = []){

                switch(accion){
                    case 'registrar':
                    {
                        this.modal=1;
                        this.tituloModal='Registrar';
                        this.desayuno='';
                        this.comida='';
                        this.cena='';
                        this.extra='';
                        this.tipoAccion=1;
                        break;
                    }
                    case 'actualizar':
                    {   
                        this.modal=1;
                        console.log(data);
                        this.tituloModal='Actualizar';
                        this.tipoAccion=2;
                        this.comida_id = data['id'];
                        this.desayuno = data['desayuno'];
                        this.comida = data['comida'];
                        this.cena = data['cena'];
                        this.extra = data['extra'];
                        break;
                        
                    }

                }
            },
            cerrarModal(){
                this.tituloModal='';
                this.desayuno='';
                this.comida='';
                this.cena='';
                this.extra='';    
                this.modal=0;
            }
        },
        mounted(){
         this.mostrarAlimentos();
     },
    //  created() {
    //      moment.locale('es'); 
    //  }
       
    }
</script>

<style>

/* scoped para poner privado las clases */

.opciones{
    display: flex;
    justify-content: space-around;
    margin-bottom: 38px;
    margin-top: 24px;
}
.opciones .botones .btn-al{
    font-size: 250px; 
    color: #fd5d00;
    cursor: pointer;
}
.opciones .botones .btn-al:hover{
     /* font-size: 256px;  */
}

.opciones .botones .btn-est{
     font-size: 250px;
    color: #00da62;
     cursor: pointer;
}

.busqueda{
    padding-left: 48px;
    padding-right: 48px;
    display: flex;
    justify-content: space-around;
    margin-bottom: 12px;

}
.busqueda .ip-buscar{
    width: 500px;
}


.tema{
    margin-top: 20px;
    display: flex;
    justify-content: center;
}
.formulario{
    width: 60%;
    margin: auto;
}
.formulario .form-group .env{
    width: 100%;
}

.mostrar{
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: #3c29297a;
}

.modal-content{
    width: 100% !important;
    position: absolute !important;
}

</style>

