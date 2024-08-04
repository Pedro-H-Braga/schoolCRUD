import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [

    /**
     * Students Route
     */
    {
      path: '/students',
      name: 'StudentsIndex',
      component: () => import('../views/students/StudentsIndex.vue')
    },
    {
      path: '/students/create',
      name: 'StudentsCreate',
      component: () => import('../views/students/StudentsCreate.vue')
    },
    {
      path: '/students/edit/:id',
      name: 'StudentsEdit',
      component: () => import('../views/students/StudentsEdit.vue')
    },

    /**
     * Classes Route
     */
    {
      path: '/',
      name: 'ClassesIndex',
      component: () => import('../views/classes/ClassesIndex.vue')
    },
    {
      path: '/classes/create',
      name: 'ClassesCreate',
      component: () => import('../views/classes/ClassesCreate.vue')
    },
    {
      path: '/classes/edit/:id',
      name: 'ClassesEdit',
      component: () => import('../views/classes/ClassesEdit.vue')
    },
    {
      path: '/classes/show/:id',
      name: 'ClassesShow',
      component: () => import('../views/classes/ClassesShow.vue')
    },
  ]
})

export default router
