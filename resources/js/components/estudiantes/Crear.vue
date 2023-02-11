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
                <h5 class="card-title">Creación de Estudiantes</h5>
                <form @submit.prevent="crear">
                    <div class="row">
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
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "crear-estudiante",
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
        async crear() {
            this.cargaCompleta = true;
            await this.axios
                .post("/api/estudiantes", this.estudiantes)
                .then((_response) => {
                    this.$router.push({ name: "mostrarestudiantes" });
                })
                .cath((error) => {
                    console.log(error);
                });
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
