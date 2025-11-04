<template lang="">
<form @submit.prevent="ajouterCategorie">
<div class="form-group">
 <input type="text" class="form-control" placeholder="Nom" v-model="nomcategorie">


</div>
<div class="form-group">
<FilePond max-files="1" @change="onFileChange"/>
</div>


<button type="submit" class="btn btn-block btn-primary">Ajouter
Catégorie</button>
</form>
</template>
<script>
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

//import 'filepond-plugin-image-preview/dist/filepond-plugin-imagepreview.min.css';
export default {
    components: {
FilePond: vueFilePond(FilePondPluginImagePreview)
},
data() {
return {
nomcategorie: "",
imagecategorie: "",
}
},
methods: {
ajouterCategorie(){
const categ = {
nomcategorie:this.nomcategorie,
imagecategorie:this.imagecategorie
}
this.axios.post("http://localhost:8000/api/categories",categ)
.then(() => {
this.$router.push('/categories')})
.catch(error => {
this.errorMessage = error.message;
console.error("There was an error!", error);})
},
onFileChange(e) {
this.imagecategorie = "storage/images/"+e.target.files[0].name;
}
}
}
</script>

<style lang="">
</style>