<template>
  <section>
  <Header v-on:searchChanged = "updateSearch"></Header>
    <main class="container">
    <div>
      <h1>
        Главные хиты 2021
      </h1>
    </div>
    <section class="products">
      <div  class="v-for" v-for="product in products">
        <Product :product="product"></Product>
      </div>
    </section>
    </main>
  <Footer></Footer>
  </section>
</template>

<script>
import Product from "./Product";
import Header from "./Header";
import Footer from "./Footer";
import {forEach} from "core-js/internals/array-iteration";

export default {
  name: "MainPage",
  components: {
    Footer,
    Header,
    Product
  },
  beforeCreate: function() {
    document.body.className = 'main';
  },
  data(){
    return{
      products: [],
      searched: "",
      allProducts: []
    }
  },
    created() {
        this.$http.get('/products')
            .then(response => this.searchFilter(response.data))
    },
    methods: {
      searchFilter(data){
              this.allProducts = data
              this.products = []
              data.forEach((element) => {
                  if (element.title.includes(this.searched)) {
                      this.products.push(element)
                  }
              })
      },

      updateSearch(e){
          this.searched = e
          this.searchFilter(this.allProducts)
      }
    }
}
</script>

<style scoped src="../assets/styles/main_style.css">

</style>
