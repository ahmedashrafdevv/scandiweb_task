<template>
  <div class="home">
    <div class="page-header">
      <h1>Create Product</h1>
      <div class="btns">
        <button class="btn success" @click.prevent="productForm.submit()">
          submit
        </button>
        <button class="btn danger" @click="productForm.reset()">reset</button>
      </div>
    </div>
    <div class="form_wrapper">
      <form ref="form">
        <div class="form-controller" id="name">
          <div class="input" >
            <label>name: </label>
            <input
              type="text"
              @input="validate('name')"
              v-model="state.form.name"
              placeholder="name"
            />
          </div>
        </div>
        <div class="form-controller" id="price">
          <div class="input" >
            <label>price: </label>
            <input
              type="number"
              v-model="state.form.price"
              placeholder="price"
            />
          </div>
        </div>
        <div class="form-controller" id="type">
          <div class="input" >
            <label>type: </label>
            <select
              placeholder="choose type"
              @change="typeSelected()"
              v-model="state.form.type_id"
            >
              <option disaled :value="0">choose option</option>
              <option
                v-for="type in state.types"
                :key="type.id"
                :value="type.id"
              >
                {{ type.name }}
              </option>
            </select>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
  <!--
<script lang="ts">
// import { Options, Vue } from 'vue-class-component'
// @Options({
//   data()  {
//     // prod
//     return {
//       form :{
//           name:"",
//           price : "",
//           type_id:0,
//       },
//       types:[
//           {
//               id: 1,
//               name : "DVD"
//           },
//           {
//               id: 2,
//               name : "BOOK"
//           }
//       ]
//     }
//   },
//   methods:{
//       getTypes(){
//           console.log("get types")
//       },
//       submit(){
//           console.log("submit")
//       },
//       reset(){
//           console.log("reset")
//       },
//       typeSelected(){
//         const form =this.$refs['form']
//         const input = `
//           <div class="input">
//             <label>size: </label>
//             <input type="text" v-model="form.prop_content" placeholder="size" >
//           </div>
//         `
//         form.innerHTML = form.innerHTML + input
//        // var node = document.createElement("LI");   
//         // var textnode = document.createTextNode("Water");         // Create a text node
//         // node.appendChild(textnode);    
//         // form.appendChild(node)
//         // console.log(form)
//         //   console.log("type selected")
//       }

//     },
  
  
//   mounted():void{
//     this.getTypes()
//   }
// })
// export default class Create extends Vue {


// }
// </script>
 -->
<script lang="ts">
import { defineComponent, reactive, watch } from "vue";
import ProductForm from "@/classes/ProductForm";
import { ProductFormModel } from "@/models/ProductFormModel";
import Validation from "@/classes/Validation";
export default defineComponent({
  setup() {
    const productForm = new ProductForm();
    const form = productForm.form;
    const types = [""];
    const state = reactive({ form, types });

    const validation = new Validation();
    const validate = (key: keyof typeof state.form): void => {
      productForm.validate(state.form[key]);
    };
    // watch(state.form , val => {
    //   console.log(val.name)
    // })
    return {
      productForm,
      validate,
      state,
    };
  },
});
</script>




