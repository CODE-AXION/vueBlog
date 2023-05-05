
//router basics
/**
 * import router
 *
 * import your components/pages
 *
 * add your routes/paths
 *
 * initialize the route
 *
 * export the router
 */


// always use this below statement dont use import router from vue-router it will throw error
import {createRouter, createWebHistory  } from "vue-router";

//import the necessary pages required for routing
//without lazy loading
// import Navbar from '../components/pages/Navbar.vue'
// import Footer from '../components/pages/Footer.vue'
// import Hooks from '../components/pages/basics/Hooks.vue'

//with lazy loading
const Navbar = () => import('../components/pages/Navbar.vue')
const Footer = () => import('../components/pages/Footer.vue')
const Hooks = () => import('../components/pages/basics/Hooks.vue')

const CreatePost = () => import('../components/pages/admin/posts/CreatePost.vue')
const ListsPosts = () => import('../components/pages/admin/posts/ListPosts.vue')

//mention your routes below
/**
 * 1). mention path property which consists paths and it should first start with '/'
 * 2). mention name property use for route names like in laravel
 * 3). mentioned component property it should only be singular and mention your component name you mentioned above
 *
 */


const routes = [

    {
        path: '/',
        name: 'root'
    },

    {
        path: '/filter', 
        name: 'Navbar',
        component: Navbar
    },

    {
        path: '/admin-create-post',
        name: 'CreatePost',
        component: () => import('../components/pages/admin/posts/CreatePost.vue')
    },

    {
        path: '/admin-list-posts',
        name: 'ListsPosts',
        component: ListsPosts
    },




    {
        path: '/footer',
        name: 'Footer',
        component: Footer
    },

    {
        path: '/hooks',
        name: 'Hooks',
        component: Hooks
    }
]

//initialize the router and add history property which will remove hash from the url and add the routes to 2nd parameter
const router = createRouter({
    history: createWebHistory(),
    routes,
})


//export the above router
export default router
