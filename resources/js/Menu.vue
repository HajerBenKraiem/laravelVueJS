<template>
<!-- Nav bar -->
<nav class="navbar navbar-dark bg-dark justify-content-between flex-nowrap
flex-row">
<div class="container">
<a class="navbar-brand float-left">Projet</a>
<ul class="nav navbar-nav flex-row float-right">
<li class="nav-item">
<router-link class="nav-link navbar-brand
pr-3" to="/"> Home </router-link>
</li>
<li class="nav-item">
<router-link class="nav-link pr-3" to="/categories"> Catégories |</router-link>
</li>
<li class="nav-item">
<router-link class="nav-link pr-3" to="/addCategorie"> | Ajout
Catégorie |</router-link>
</li>
</ul>
</div>
</nav>
</template>
<script>
export default {}
</script>