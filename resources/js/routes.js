
  const Home = ()=>  import('./components/Home.vue');
  const Contacto = ()=>  import('./components/Contacto.vue');

  //importamos los componentes para estudiantes

  const CrearE = ()=>  import('./components/estudiantes/Crear.vue');
  const MostrarE = ()=>  import('./components/estudiantes/Mostrar.vue');
  const EditarE = ()=>  import('./components/estudiantes/Editar.vue');
 //importamos los componentes para grupo
  const CrearG = ()=>  import('./components/grupo/Crear.vue');
  const MostrarG = ()=>  import('./components/grupo/Mostrar.vue');
  const EditarG = ()=>  import('./components/grupo/Editar.vue');
 //importamos los componentes para materias
  const CrearM = ()=>  import('./components/materias/Crear.vue');
  const MostrarM = ()=>  import('./components/materias/Mostrar.vue');
  const EditarM = ()=>  import('./components/materias/Editar.vue');
 //importamos los componentes para notas
  const CrearN = ()=>  import('./components/notas/Crear.vue');
  const MostrarN = ()=>  import('./components/notas/Mostrar.vue');
  const EditarN = ()=>  import('./components/notas/Editar.vue');

  export const routes =[{

    name:'home',
    path: '/home',
    component:Home

  }, 
  {

    name:'contacto',
    path: '/contacto',
    component:Contacto

  },
  {

    name:'mostrarestudiantes',
    path: '/estudiantesm',
    component:MostrarE

  },
  {

    name:'crearestudiantes',
    path: '/estudiantesc',
    component:CrearE

  },
  {

    name:'editarestudiantes',
    path: '/estudiantes/:id',
    component:EditarE

  },
  {

    name:'mostrargrupo',
    path: '/grupom',
    component:MostrarG

  },
  {

    name:'creargrupo',
    path: '/grupoc',
    component:CrearG

  },
  {

    name:'editargrupo',
    path: '/grupo/:id',
    component:EditarG

  },
  {

    name:'mostrarmaterias',
    path: '/materiasm',
    component:MostrarM

  },
  {

    name:'crearmaterias',
    path: '/materiasc',
    component:CrearM

  },
  {

    name:'editarmaterias',
    path: '/materias/:id',
    component:EditarM

  },

  {

    name:'mostrarnotas',
    path: '/notasm',
    component:MostrarN

  },
  {

    name:'crearnotas',
    path: '/notasc',
    component:CrearN

  },
  {

    name:'editarnotas',
    path: '/notas/:id',
    component:EditarN

  },

];