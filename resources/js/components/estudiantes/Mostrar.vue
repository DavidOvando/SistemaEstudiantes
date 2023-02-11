<template>
    <div>
        <div
            class="d-flex justify-content-center mt-5 pt-5"
            v-if="cargaCompleta"
        >
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="card col-lg-6 offset-lg-3 mt-5 row col-12" v-if="!cargaCompleta">
            <div class="card-body col-12">
                <h5 class="card-title">Lista de Estudiantes</h5>
                <form @submit.prevent="mostrarestudiantes">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-1 col-12 mt-4">
                            <div class="form-group">
                                <label>Seleccionar un Grupo</label>
                                <select
                                    class="form-select"
                                    v-model="grupoBusqueda"
                                >
                                    <option
                                        v-for="grupos in grupos"
                                        v-bind:value="grupos.id"
                                    >
                                        {{ grupos.nombre_grupo }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-12 mt-5">
                            <button
                                type="submit"
                                class="btn btn-primary"
                                style="width: 100%"
                            >
                                Buscar
                            </button>
                        </div>
                    </div>
                </form>
                <div class="col-12">
                    <div
                        class="d-flex justify-content-center mt-5 pt-5"
                        v-if="cargaCompletaEstudiantes"
                    >
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5" v-if="cargaCompletaResutados">
                    <div class="alert alert-danger" role="alert">
                        El grupo seleccionado no tiene estudiantes asignados.
                    </div>
                </div>
                <div class="row" v-if="verTabla">
                    <div class="col-12">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Grupo</th>
                                    <th scope="col">Materias</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="estudiantes in estudiantes"
                                    :key="estudiantes.id"
                                >
                                    <td>{{ estudiantes.id }}</td>
                                    <td>{{ estudiantes.nombre_completo }}</td>
                                    <td>{{ estudiantes.grupo }}</td>
                                    <td>
                                        <router-link
                                            style="color: white"
                                            :to="{
                                                name: 'mostrarnotas',
                                                params: { id: estudiantes.id },
                                            }"
                                            class="btn btn-primary"
                                            ><i class="bi bi-eye-fill"></i
                                        ></router-link>
                                    </td>
                                    <td>
                                        <router-link
                                            style="color: white"
                                            :to="{
                                                name: 'editarestudiantes',
                                                params: { id: estudiantes.id },
                                            }"
                                            class="btn btn-primary"
                                            ><i class="bi bi-pencil-fill"></i
                                        ></router-link>
                                        <a
                                            style="color: white"
                                            type="buttom"
                                            @click="
                                                borrarestudiantes(
                                                    estudiantes.id
                                                )
                                            "
                                            class="btn btn-danger"
                                            ><i class="bi bi-trash-fill"></i
                                        ></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "mostrar-estudiantes",
    data() {
        return {
            estudiantes: [],
            estudiantesTemp: [],
            grupos: [],
            grupoBusqueda: "",
            verTabla: false,
            cargaCompleta: true,
            cargaCompletaEstudiantes: false,
            cargaCompletaResutados: false,
        };
    },
    mounted() {
        this.consultarGrupos();
    },
    methods: {
        async mostrarestudiantes() {
            this.verTabla = false;
            this.cargaCompletaEstudiantes = true;
            this.cargaCompletaResutados = false;
            await this.axios
                .get(`/api/estudiantes/${String(this.grupoBusqueda)}`)
                .then((response) => {
                    this.estudiantesTemp = response.data;
                    this.cargaCompletaEstudiantes = false;
                    if (this.estudiantesTemp.length > 0) {
                        for (let i = 0; i < this.estudiantesTemp.length; i++) {
                            if (this.grupos.length > 0) {
                                for (let j = 0; j < this.grupos.length; j++) {
                                    if (
                                        this.estudiantesTemp[i].grupo ==
                                        this.grupos[j].id
                                    ) {
                                        this.estudiantesTemp[i].grupo =
                                            this.grupos[j].nombre_grupo;
                                    }
                                }
                            }
                        }
                        this.estudiantes = this.estudiantesTemp;
                        this.verTabla = true;
                    } else {
                        this.cargaCompletaResutados = true;
                    }
                })
                .catch((error) => {
                    this.verTabla = false;
                    this.estudiantes = [];
                });
        },
        borrarestudiantes(id) {
            if (confirm("¿Confirma eliminar registro?")) {
                this.axios
                    .delete(`/api/estudiantes/${id}`)
                    .then((response) => {
                        this.mostrarestudiantes();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        async consultarGrupos() {
            await this.axios
                .get("/api/grupos")
                .then((response) => {
                    this.grupos = response.data;
                    this.cargaCompleta = false;
                })
                .cath((error) => {
                    this.grupos = [];
                });
        },
    },
};
</script>
