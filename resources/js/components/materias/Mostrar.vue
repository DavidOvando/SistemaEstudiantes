<template>
    <div class="card col-lg-6 offset-lg-3 col-12 mt-5 row">
        <div class="card-body col-12">
            <h5 class="card-title">Lista de Materias</h5>
            <form>
                <div class="row">
                    <div class="col-12">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre Materia</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="materias in materias" :key="materias.id">
                                    <td>{{ materias.id }}</td>
                                    <td>{{ materias.nombre_materia }}</td>
                                    <td>{{ materias.descripcion }}</td>
                                    <td>
                                        <router-link style="color: white"
                                            :to='{ name: "editarmaterias", params: { id: materias.id } }'
                                            class="btn btn-primary"><i class="bi bi-pencil-fill"></i></router-link>
                                        <a type="buttom" @click="eliminarMateria(materias.id)" class="btn btn-danger"><i
                                                class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

export default {

    name: "mostrar-materias",
    data() {
        return {
            materias: []
        }

    },
    mounted() {
        this.consultarMaterias()
    },
    methods: {
        async consultarMaterias() {
            await this.axios.get('/api/materias')
                .then(response => {
                    this.materias = response.data;
                })
                .cath(error => {
                    this.materias = []
                })
        },
        eliminarMateria(id) {
            if (confirm("¿Confirma eliminar registro?")) {
                this.axios.delete(`/api/materias/${id}`)
                    .then(response => {
                        this.consultarMaterias()
                    })
                    .cath(error => {
                        console.log(error)
                    })
            }
        }
    }
}
</script>