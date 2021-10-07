<template>
  <div class="home">
    <div class="page-header">
      <h1>Product List</h1>
      <div class="btns">
        <button class="btn success" @click="$router.push({name: 'Create'})">add</button>
        <button class="btn danger" @click="massDelete()">mass delete</button>
      </div>
    </div>
    <div class="product_wrapper">
      <product-partial v-for="pr in products" :loading="loading" :key="pr.sku" :product="pr" />
    </div>
    <button @click.prevent="test">click</button>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component';
import ProductPartial from '../components/productPartial.vue';
import {Product} from '../models/Product';

@Options({
  components:{
    ProductPartial,
  },
  data()  {
    // prod
    return {
      mode :" 12",
      products:[] as Array<Product>,
      loading:true,
      checked:false,
    }
  },
  methods:{
    test(){
      // let product = new Product("1234" , "ahmed" , 120)
      // console.log(product.getName())
      // console.log(product.setName("another"))
      // console.log(product.getName())
      this.getAllProducts()
    },
    massDelete(){
      const prs :Array<Product>= this.products
      const products = prs.filter((pr: Product) => {
        return pr.checked ? pr : ''
      })
      console.log(products);
    },
    getAllProducts(){
      fetch("http://127.0.0.1:8001")
      .then(response => response.json())
      .then(data =>{
        let products :Array<Product> = []
        for (let index = 0; index < data.length; index++) {
          const current  = data[index]
          const product :Product = {
            sku :current.sku,
            name :current.name,
            price :current.price,
            prop_name :current.prop_name,
            prop_content :current.prop_content,
            prop_unit :current.prop_unit,
            checked :current.checked,
          }
          products.push(product)
          
        }
        this.products = products
        this.loading = false
      } );
    },
  },
  
  mounted():void{
    this.getAllProducts()
  }
})
export default class Home extends Vue {


}
</script>
<style scoped src="@/assets/scss/list.css"/>


