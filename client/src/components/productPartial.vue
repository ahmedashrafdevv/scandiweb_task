<template>
<div>
  <div v-if="loading">
    loading
  </div>
  <div class="product" v-else>
    <input type="checkbox" id="checkbox" v-model="product.checked">
    <div class="sku">{{product.sku}}</div>
    <div class="name">{{product.name}}</div>
    <div class="price">{{product.price}}$</div>
    <div class="property">
      <span class="propperty__name">{{product.prop_name}}: </span>
      <span class="propperty__content">{{product.prop_content}}{{product.prop_unit}}</span>
    </div>
  </div>
</div>
</template>

<script lang="ts">
import ProductModel from '@/models/ProductModel';
import {Product} from '@/models/Product';
import { Options, Vue } from 'vue-class-component';
// import Product from '../classes/Product'

@Options({
  methods:{
    check():void{
      this.product.setChecked(!(this.product.getChecked()))
      console.log(this.product)
    }
  },
  props: {
    product: {} as Product,
    loading:Boolean
  }
})
export default class ProductPartial extends Vue {
  // product!: Product
  
}
</script>

<style src="@/assets/scss/product.css"  rel="stylesheet" type="text/css" scoped/>