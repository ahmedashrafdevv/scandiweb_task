<template>
  <div class="product">
    {{product}}
    <input type="checkbox" id="checkbox" v-model="checked">
    <div class="sku">50da2f4d-1cb4-11ec-bd00-f0921c5e77b0</div>
    <div class="name">ACME DISC</div>
    <div class="price">10$</div>
    <div class="property">
      <span class="propperty__name">Size: </span>
      <span class="propperty__content">200Mb</span>
    </div>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component';
import Product from '../classes/Product'

@Options({
  props: {
    product: {} as Product
  }
})
export default class ProductPartial extends Vue {
  product!: Product
}
</script>

<style src="@/assets/scss/product.css"  rel="stylesheet" type="text/css" scoped/>