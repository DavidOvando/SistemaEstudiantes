<template>
    <div class="row">
        <div class="col-12">
            <div
                class="d-flex justify-content-center mt-5 pt-5"
                v-if="cargaCompleta"
            >
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div class="card col-6 offset-3 mt-5" v-if="!cargaCompleta">
            <div class="card-body">
                <h5 class="card-title mb-3">Nostas del Estudiante</h5>
                <div class="row">
                    <div class="col-lg-3 offset-lg-1 col-12 border-right">
                        <div
                            class="d-flex flex-column align-items-center text-center"
                        >
                            <img
                                class="rounded-circle"
                                width="150px"
                                src="https://png.pngitem.com/pimgs/s/508-5087146_circle-hd-png-download.png"
                            /><span class="font-weight-bold">{{
                                estudiantes.nombre_completo
                            }}</span
                            ><span> </span>
                        </div>
                    </div>
                    <div
                        class="row col-7 offset-1 pt-5"
                        v-if="cargaCompletaResutados"
                    >
                        <div class="col-8 mb-1">
                            <router-link
                                :to="{
                                    name: 'crearnotas',
                                    params: { id: $route.params.id },
                                }"
                                class="btn btn-success"
                                ><i class="bi bi-file-earmark-plus-fill"></i>
                                Agregar Materia</router-link
                            >
                        </div>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                El Estudiante seleccionado no tiene materias
                                asignadas.
                            </div>
                        </div>
                    </div>
                    <div
                        class="row col-7 offset-1"
                        v-if="!cargaCompletaResutados"
                    >
                        <div class="col-8 mb-1">
                            <router-link
                                :to="{
                                    name: 'crearnotas',
                                    params: { id: $route.params.id },
                                }"
                                class="btn btn-success"
                                ><i class="bi bi-file-earmark-plus-fill"></i>
                                Agregar Materia</router-link
                            >
                        </div>
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Materia</th>
                                        <th scope="col">Nota</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="notas in notas" :key="notas.id">
                                        <td>{{ notas.id }}</td>
                                        <td>{{ notas.materia }}</td>
                                        <td>{{ notas.nota }}</td>
                                        <td>
                                            <router-link
                                                style="color: white"
                                                :to="{
                                                    name: 'editarnotas',
                                                    params: { id: notas.id },
                                                }"
                                                class="btn btn-primary"
                                                ><i
                                                    class="bi bi-pencil-fill"
                                                ></i
                                            ></router-link>
                                            <a
                                                style="color: white"
                                                type="buttom"
                                                @click="borrarNotas(notas.id)"
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
    </div>
</template>
<script>
export default {
    name: "editarEstudiantes",
    data() {
        return {
            estudiantes: {
                nombre_completo: "",
                grupo: "",
            },
            notas: [],
            materias: [],
            cargaCompleta: true,
            cargaCompletaResutados: true,
        };
    },
    mounted() {
        this.consultarMaterias();
    },
    methods: {
        async mostrarEstudiantes() {
            this.axios
                .get(`/api/estudiantes/${this.$route.params.id}/edit`)
                .then((response) => {
                    const { nombre_completo, grupo } = response.data;
                    this.estudiantes.nombre_completo = nombre_completo;
                    this.estudiantes.grupo = grupo;
                    this.consultarNotas();
                })
                .catch((error) => {
                    this.$router.push({ name: "mostrarestudiantes" });
                });
        },
        async consultarMaterias() {
            await this.axios
                .get("/api/materias")
                .then((response) => {
                    this.materias = response.data;
                    this.mostrarEstudiantes();
                })
                .cath((error) => {
                    this.materias = [];
                });
        },
        async consultarNotas() {
            await this.axios
                .get(`/api/notas/${String(this.$route.params.id)}`)
                .then((response) => {
                    this.notas = response.data;
                    if (this.notas.length > 0) {
                        for (let i = 0; i < this.notas.length; i++) {
                            if (this.materias.length > 0) {
                                for (let j = 0; j < this.materias.length; j++) {
                                    if (
                                        this.notas[i].materia ==
                                        this.materias[j].id
                                    ) {
                                        this.notas[i].materia =
                                            this.materias[j].nombre_materia;
                                    }
                                }
                            }
                        }
                        this.cargaCompletaResutados = false;
                    } else {
                        this.cargaCompletaResutados = true;
                    }
                    this.cargaCompleta = false;
                })
                .cath((error) => {
                    this.notas = [];
                });
        },
        borrarNotas(id) {
            this.cargaCompleta = true;
            if (confirm("¿Confirma eliminar registro?")) {
                this.axios
                    .delete(`/api/notas/${id}`)
                    .then((response) => {
                        this.consultarNotas();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
    },
};
</script>
