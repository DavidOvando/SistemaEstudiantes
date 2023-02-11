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
        <div class="card col-lg-6 offset-lg-3 mt-5 col-12" v-if="!cargaCompleta">
            <div class="card-body">
                <h5 class="card-title mb-3">Edición de Estudiantes</h5>
                <form @submit.prevent="editar">
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
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="estudiantes.nombre_completo"
                                    />
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Seleccionar Grupo</label>
                                    <select
                                        class="form-select"
                                        v-model="estudiantes.grupo"
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
                            <div class="col-12 mb-2">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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
            grupos: [],
            cargaCompleta: true,
        };
    },
    mounted() {
        this.consultarGrupos();
    },
    methods: {
        async mostrarEstudiantes() {
            this.axios
                .get(`/api/estudiantes/${this.$route.params.id}/edit`)
                .then((response) => {
                    const { nombre_completo, grupo } = response.data;
                    this.estudiantes.nombre_completo = nombre_completo;
                    this.estudiantes.grupo = grupo;
                    this.cargaCompleta = false;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        async editar() {
            this.cargaCompleta = true;
            this.axios
                .put(
                    `/api/estudiantes/${this.$route.params.id}`,
                    this.estudiantes
                )
                .then((response) => {
                    this.$router.push({
                        name: "mostrarestudiantes",
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async consultarGrupos() {
            await this.axios
                .get("/api/grupos")
                .then((response) => {
                    this.grupos = response.data;
                    this.mostrarEstudiantes();
                })
                .cath((error) => {
                    this.grupos = [];
                });
        },
    },
};
</script>
