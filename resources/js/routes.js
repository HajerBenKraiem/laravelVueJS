import { createRouter,createWebHashHistory } from 'vue-router'
import Home from "./Home.vue";
//import AllCategories from "./Components/Categories/AllCategories.vue";
import AllCategories from "../Components/Categories/AllCategories.vue"
//import AddCategorie from "./Components/Categories/AddCategorie.vue";
import AddCategorie from "../Components/Categories/AddCategorie.vue";
import EditCategorie from "../Components/Categories/EditCategorie.vue";
//import AllScategories from "./components/SousCategories/AllSousCategories";
import AllScategories from"../Components/SousCategories/AllSousCategories.vue";
//import AddScategorie from "./components/SousCategories/AddSousCategorie";
import AddScategorie from"../Components/SousCategories/AddSousCategorie.vue";
import EditSousCategorie from "../Components/SousCategories/EditSousCategorie.vue";

//import AllArticles from "./Components/Articles/AllArticles.vue";
import AllArticles from "./../Components/Articles/AllArticles.vue";

//import AddArticles from "./Components/Articles/AddArticle.vue";
//import AddArticles from "../Components/Articles/AddArticle.vue";
import AddArticles from "../Components/Articles/AddArticle.vue";

//import EditArticle from "./components/Articles/EditArticle.vue";
import EditArticle from "../Components/Articles/EditArticle.vue";
const routes = [
{
path: '/',
name: 'home',
component: Home
},
{
path: '/articles',
name: 'articles',
component: AllArticles
},

{
path: '/addArticle',
name: 'addArticle',
component: AddArticles
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
},
{
path: '/scategories',
name: 'scategories',
component: AllScategories
},
{
path: '/addScategories',
name: 'addScategories',
component: AddScategorie
},
{
path: '/editScategorie',
name: 'editScategorie',
component: EditSousCategorie
},
{
path: '/editArticle',
name: 'editArticle',
component: EditArticle
},


];
const router = createRouter({
history: createWebHashHistory(),
routes
})
export default router