import { createRouter,createWebHashHistory } from 'vue-router'
import Home from "./Home.vue";
//import AllCategories from "./Components/Categories/AllCategories.vue";
import AllCategories from "../Components/Categories/AllCategories.vue"
//import AddCategorie from "./Components/Categories/AddCategorie.vue";
import AddCategorie from "../Components/Categories/AddCategorie.vue";
import EditCategorie from "../Components/Categories/EditCategorie.vue";
const routes = [
{
path: '/',
name: 'home',
component: Home
},
{
path: '/categories',
name: 'categories',
component: AllCategories
},
{
path: '/addCategorie',
name: 'addCategorie',
component: AddCategorie
},
 {
path: '/editCategorie',
name: 'editCategorie',
component: EditCategorie
}
];
const router = createRouter({
history: createWebHashHistory(),
routes
})
export default router