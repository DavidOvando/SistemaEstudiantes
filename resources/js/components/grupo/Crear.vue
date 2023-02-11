<template>
    <div class="card col-lg-6 offset-lg-3 col-12 mt-5">
        <div class="card-body">
            <h5 class="card-title">Creación de Grupos</h5>
            <form @submit.prevent="crearGrupo">
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
</template>
<script>
export default {
    name: "crear-grupo",
    data() {
        return {
            grupos: {
                nombre_grupo: "",
            },
        };
    },
    methods: {
        async crearGrupo() {
            await this.axios
                .post("/api/grupos", this.grupos)
                .then((_response) => {
                    this.$router.push({ name: "mostrargrupo" });
                })
                .cath((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
