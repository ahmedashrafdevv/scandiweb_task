<template>
  <div class="home">
    
    <product-partial :product="{name :'asd'}" />
    <button @click.prevent="test">click</button>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component';
import ProductPartial from '../components/productPartial.vue';
import Product from '../models/ProductModel';

@Options({
  components:{
    ProductPartial,
  },
  data()  {
    return {
      mode :" 12",
      checked:false,
    }
  },
  methods:{
    test(){
      let product = new Product("1234" , "ahmed" , 120)
      console.log(product.getName())
      console.log(product.setName("another"))
      console.log(product.getName())
      this.getAllProducts()
    },
    getAllProducts(){
      fetch("http://127.0.0.1:8001")
      .then(response => {
        console.log(response.json())

      })
    },
  },
  
  mounted():void{
    this.getAllProducts()
  }
})
export default class Home extends Vue {


}
</script>


