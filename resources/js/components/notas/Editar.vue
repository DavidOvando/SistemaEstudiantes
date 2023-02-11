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
        <div class="card col-lg-6 offset-lg-3 col-12 mt-5" v-if="!cargaCompleta">
            <div class="card-body">
                <h5 class="card-title mb-3">Nostas del Estudiante</h5>
                <div class="row">
                    <div class="col-3 offset-1 border-right">
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
                    <div class="row col-7 offset-1">
                        <div class="col-12">
                            <form @submit.prevent="asignarMateria">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Seleccionar Materia</label>
                                            <select
                                                class="form-select"
                                                v-model="notas.materia"
                                            >
                                                <option
                                                    v-for="materias in materias"
                                                    v-bind:value="materias.id"
                                                >
                                                    {{
                                                        materias.nombre_materia
                                                    }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Asignar Nota</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="notas.nota"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "crear-notas",
    data() {
        return {
            notas: {
                estudiante: "",
                materia: "",
                nota: "",
            },
            estudiantes: {
                nombre_completo: "",
                grupo: "",
            },
            idEstudiante: "",
            materias: [],
            cargaCompleta: true,
        };
    },
    mounted() {
        this.consultarMaterias();
    },
    methods: {
        async mostrarEstudiantes() {
            this.axios
                .get(`/api/estudiantes/${this.notas.estudiante}/edit`)
                .then((response) => {
                    const { nombre_completo, grupo } = response.data;
                    this.estudiantes.nombre_completo = nombre_completo;
                    this.estudiantes.grupo = grupo;
                    this.cargaCompleta = false;
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
                    this.mostrarNotas();
                })
                .cath((error) => {
                    this.materias = [];
                });
        },
        async asignarMateria() {
            this.cargaCompleta = true;
            await this.axios
                .put(`/api/notas/${this.$route.params.id}`, this.notas)
                .then((_response) => {
                    this.$router.push({
                        name: "mostrarnotas",
                        params: { id: this.notas.estudiante },
                    });
                })
                .cath((error) => {
                    console.log(error);
                });
        },
        async mostrarNotas() {
            this.axios
                .get(`/api/notas/${this.$route.params.id}/edit`)
                .then((response) => {
                    const { estudiante, materia, nota } = response.data;
                    this.notas.estudiante = estudiante;
                    this.notas.materia = materia;
                    this.notas.nota = nota;
                    this.mostrarEstudiantes();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
