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
        <div class="card col-jg-6 offset-lg-3 col-12 mt-5" v-if="!cargaCompleta">
            <div class="card-body">
                <h5 class="card-title mb-3">Edición de Materias</h5>
                <form @submit.prevent="editar">
                    <div class="row">
                        <div class="row col-10 offset-1">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="materias.nombre_materia"
                                    />
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea
                                        type="text"
                                        class="form-control"
                                        v-model="materias.descripcion"
                                    ></textarea>
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
    name: "editarmaterias",
    data() {
        return {
            materias: {
                nombre_materia: "",
                descripcion: "",
            },
            cargaCompleta: true,
        };
    },
    mounted() {
        this.mostrarMaterias();
    },
    methods: {
        async mostrarMaterias() {
            this.axios
                .get(`/api/materias/${this.$route.params.id}`)
                .then((response) => {
                    const { nombre_materia, descripcion } = response.data;
                    this.materias.nombre_materia = nombre_materia;
                    this.materias.descripcion = descripcion;
                    this.cargaCompleta = false;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        async editar() {
            this.cargaCompleta = true;
            this.axios
                .put(`/api/materias/${this.$route.params.id}`, this.materias)
                .then((response) => {
                    this.$router.push({
                        name: "mostrarmaterias",
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
