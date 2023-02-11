<template>
    <div class="card col-lg-6 offset-lg-3 col-12 mt-5">
        <div class="card-header">
            <h5 class="card-title">Edición de Grupos</h5>
            <div class="card-body">
                <form @submit.prevent="editar">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label>Nombre del Grupo</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="grupos.nombre_grupo"
                                />
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
    name: "editar-grupos",
    data() {
        return {
            grupos: {
                nombre_grupo: "",
            },
        };
    },
    mounted() {
        this.mostrarGrupo();
    },
    methods: {
        async mostrarGrupo() {
            this.axios
                .get(`/api/grupos/${this.$route.params.id}`)
                .then((response) => {
                    const { nombre_grupo } = response.data;
                    this.grupos.nombre_grupo = nombre_grupo;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        async editar() {
            this.axios
                .put(`/api/grupos/${this.$route.params.id}`, this.grupos)
                .then((response) => {
                    this.$router.push({
                        name: "mostrargrupo",
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
