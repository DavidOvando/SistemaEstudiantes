<template>
    <div class="card col-lg-6 offset-lg-3 col-12 mt-5 row">
        <div class="card-body col-12">
            <h5 class="card-title">Lista de Grupos</h5>
            <form>
                <div class="row">
                    <div class="col-12">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre Grupo</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="grupos in grupos" :key="grupos.id">
                                    <td>{{ grupos.id }}</td>
                                    <td>{{ grupos.nombre_grupo }}</td>
                                    <td>
                                        <router-link
                                            style="color: white"
                                            :to="{
                                                name: 'editargrupo',
                                                params: { id: grupos.id },
                                            }"
                                            class="btn btn-primary"
                                            ><i class="bi bi-pencil-fill"></i
                                        ></router-link>
                                        <a
                                            type="buttom"
                                            @click="eliminarGrupo(grupos.id)"
                                            class="btn btn-danger"
                                            ><i class="bi bi-trash-fill"></i
                                        ></a>
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
    name: "mostrar-grupos",
    data() {
        return {
            grupos: [],
        };
    },
    mounted() {
        this.consultarGrupos();
    },
    methods: {
        async consultarGrupos() {
            await this.axios
                .get("/api/grupos")
                .then((response) => {
                    this.grupos = response.data;
                })
                .cath((error) => {
                    this.grupos = [];
                });
        },
        eliminarGrupo(id) {
            if (confirm("¿Confirma eliminar registro?")) {
                this.axios
                    .delete(`/api/grupos/${id}`)
                    .then((response) => {
                        this.consultarGrupos();
                    })
                    .cath((error) => {
                        console.log(error);
                    });
            }
        },
    },
};
</script>
