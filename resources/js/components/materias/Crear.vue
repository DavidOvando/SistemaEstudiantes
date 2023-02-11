<template>
    <div class="card col-lg-6 offset-lg-3 col-12 mt-5">
        <div class="card-body">
            <h5 class="card-title">Creación de Materias</h5>
            <form @submit.prevent="crearMateria">
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label>Nombre de Materia</label>
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
            </form>
        </div>
    </div>
</template>
<script>
export default {
    name: "crear-materia",
    data() {
        return {
            materias: {
                nombre_materia: "",
                descripcion: "",
            },
        };
    },
    methods: {
        async crearMateria() {
            await this.axios
                .post("/api/materias", this.materias)
                .then((_response) => {
                    this.$router.push({ name: "mostrarmaterias" });
                })
                .cath((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
