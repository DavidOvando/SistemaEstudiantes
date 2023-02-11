<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"
                    ><img
                        src="https://static.vecteezy.com/system/resources/thumbnails/009/583/906/small/3d-illustration-toga-hat-and-books-for-education-png.png"
                        alt=""
                        width="30"
                        height="24"
                    />
                    AppEstudiantes</a
                >
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                ><router-link
                                    exact-active-class="active"
                                    class="text-decoration-none"
                                    style="color: white"
                                    to="/home"
                                    >Inicio</router-link
                                ></a
                            >
                        </li>
                        <li class="nav-item dropdown">
                            <a
                                style="color: white"
                                class="nav-link dropdown-toggle"
                                id="navbarDropdownMenuLinkEstudiante"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                Estudiantes
                            </a>
                            <ul
                                class="dropdown-menu"
                                aria-labelledby="navbarDropdownMenuLinkEstudiante"
                            >
                                <li>
                                    <a class="dropdown-item"
                                        ><router-link
                                            exact-active-class="active"
                                            class="text-decoration-none"
                                            style="color: black"
                                            to="/estudiantesc"
                                            >Crear Estudiante</router-link
                                        ></a
                                    >
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        ><router-link
                                            exact-active-class="active"
                                            class="text-decoration-none"
                                            style="color: black"
                                            to="/estudiantesm"
                                            >Listar Estudiantes</router-link
                                        ></a
                                    >
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a
                                style="color: white"
                                class="nav-link dropdown-toggle"
                                id="navbarDropdownMenuLinkGrupos"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                Grupos
                            </a>
                            <ul
                                class="dropdown-menu"
                                aria-labelledby="navbarDropdownMenuLinkGrupos"
                            >
                                <li>
                                    <a class="dropdown-item"
                                        ><router-link
                                            exact-active-class="active"
                                            class="text-decoration-none"
                                            style="color: black"
                                            to="/grupoc"
                                            >Crear Grupos</router-link
                                        ></a
                                    >
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        ><router-link
                                            exact-active-class="active"
                                            class="text-decoration-none"
                                            style="color: black"
                                            to="/grupom"
                                            >Listar Grupos</router-link
                                        ></a
                                    >
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a
                                style="color: white"
                                class="nav-link dropdown-toggle"
                                id="navbarDropdownMenuLinkMaterias"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                Materias
                            </a>
                            <ul
                                class="dropdown-menu"
                                aria-labelledby="navbarDropdownMenuLinkMaterias"
                            >
                                <li>
                                    <a class="dropdown-item"
                                        ><router-link
                                            exact-active-class="active"
                                            class="text-decoration-none"
                                            style="color: black"
                                            to="/materiasc"
                                            >Crear Materias</router-link
                                        ></a
                                    >
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        ><router-link
                                            exact-active-class="active"
                                            class="text-decoration-none"
                                            style="color: black"
                                            to="/materiasm"
                                            >Listar Materias</router-link
                                        ></a
                                    >
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div>
            <router-view> </router-view>
        </div>
    </main>
</template>
