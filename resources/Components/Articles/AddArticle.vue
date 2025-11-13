<template>
  <form @submit.prevent="ajouterproduit">
    <div class="form-group">
      <input type="text" class="form-control" placeholder="reference" v-model="reference">
    </div>

    <div class="form-group">
      <input type="text" class="form-control" placeholder="designation" v-model="designation">
    </div>

    <div class="form-group">
      <input type="text" class="form-control" placeholder="marque" v-model="marque">
    </div>

    <div class="form-group">
      <input type="text" class="form-control" placeholder="caracteristiques" v-model="caracteristiques">
    </div>

    <div class="form-group">
      <input type="number" class="form-control" placeholder="prixAchat" v-model="prixAchat">
    </div>

    <div class="form-group">
      <input type="number" class="form-control" placeholder="prixVente" v-model="prixVente">
    </div>

    <div class="form-group">
      <input type="number" class="form-control" placeholder="prixSolde" v-model="prixSolde">
    </div>

    <div class="form-group">
      <input type="number" class="form-control" placeholder="qtestock" v-model="qtestock">
    </div>

    <div class="form-group">
      Catégories
      <select class="form-control" v-model="categorie" @change="getscategories($event)">
        <option v-for="c in Categories" :key="c.id" :value="c.id">{{ c.nomcategorie }}</option>
      </select>
    </div>

    <div class="form-group">
      Sous Catégories
      <select class="form-control" v-model="scategorie">
        <option v-for="sc in Scategories" :key="sc.id" :value="sc.id">{{ sc.nomscategorie }}</option>
      </select>
    </div>

    <div class="form-group">
     <FilePond
name="file"
max-files="1"
accepted-file-types="image/*"
label-idle="Déposez l’image principale ou cliquez pour sélectionner"
:server="{
process: {
url: 'http://localhost:8000/api/upload',
method: 'POST',
withCredentials: false,
onload: handleUploadedFile,
onerror: (response) => console.error('Erreur upload:', response)
}
}"
/>
    </div>

    

    <div class="form-group">
     <FilePond
name="file"
max-files="10"
allowMultiple="true"
accepted-file-types="image/*"
label-idle="Déposez d’autres images"
:server="{
process: {
url: 'http://localhost:8000/api/upload',
method: 'POST',
withCredentials: false,
onload: handleUploadedFiles
},
revert: null
}"
/>
    </div>

    <button type="submit" class="btn btn-block btn-primary">
      Ajouter Produit
    </button>
  </form>
</template>

<script>
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

// ✅ Correction des noms des plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';

// Création du composant FilePond avec les plugins
const FilePond = vueFilePond(
  FilePondPluginImagePreview,
  FilePondPluginFileValidateType,
  FilePondPluginFileValidateSize
);

export default {
  name: 'AddArticle',
  components: { FilePond },
  data() {
    return {
      tab: [],
      reference: "",
      designation: "",
      marque: "",
      caracteristiques: "",
      prixAchat: "",
      prixVente: "",
      prixSolde: "",
      qtestock: "",
      imageartpetitf: "",
      imageartgrandf: [],
      categorie: "",
      scategorie: "",
      Categories: [],
      Scategories: [],
    };
  },
  methods: {

    handleUploadedFile(response) {
 const res = JSON.parse(response);
 this.imageartpetitf = res.url;
 },
 handleUploadedFiles(response) {
 const res = JSON.parse(response);
 this.tab.push(res.url);
 this.imageartgrandf = JSON.stringify(this.tab);
 },

    ajouterproduit() {

      const pr = {
        reference: this.reference,
        designation: this.designation,
        marque: this.marque,
        caracteristiques: this.caracteristiques,
        prixAchat: this.prixAchat,
        prixVente: this.prixVente,
        prixSolde: this.prixSolde,
        qtestock: this.qtestock,
        categorieID: this.categorie,
        scategorieID: this.scategorie,
        imageartpetitf: this.imageartpetitf,
        imageartgrandf: this.imageartgrandf
      };
   

      this.axios.post("http://localhost:8000/api/articles", pr)
        .then(() => { this.$router.push('/articles'); })
        .catch(error => { console.error("Erreur:", error); });
    },
    onFileChange(e) {
      this.imageartpetitf = 'storage/images/' + e.target.files[0].name;
    },
    onFileChangeM(e) {
      this.tab.push('storage/images/' + e.target.files[0].name);
      this.imageartgrandf = JSON.stringify(this.tab);
    },
    onRemoveFileClick(...e) {
      let imag = 'storage/images/' + e[1].filename;
      const index = this.tab.indexOf(imag);
      if (index !== -1) this.tab.splice(index, 1);
      this.imageartgrandf = JSON.stringify(this.tab);
    },
    getscategories(event) {
      const categ = event.target.value;
      this.axios.get('http://localhost:8000/api/scat/' + categ)
        .then(res => { this.Scategories = res.data; })
        .catch(error => { console.log(error); });
    }
  },
  created() {
    this.axios.get('http://localhost:8000/api/categories')
      .then(res => { this.Categories = res.data; })
      .catch(error => { console.log(error); });
  }
};
</script>

<style>
</style>
