import Form from "./Form";
import Validation from "./Validation";
import { ref, watch, reactive } from 'vue'
import {ProductFormModel} from '@/models/ProductFormModel'
import BaseForm from '@/classes/BaseForm'
export default class ProductForm  extends BaseForm implements Form {
    pForm:ProductFormModel = {
        name : "",
        price : 0,
        type_id : 0,
        prop_content : ""
    }
    form = ref(this.pForm)
    rules = {
        name: 'required,str',
        price: 'required,number',
        type_id: 'required,int',
        prop_name: 'required,str',
        prop_unit: 'required,str',
        prop_content: 'required,str',
    }
    loading = false
    submitted = false
    valid = false

    validation = new Validation()
    // directly watching a ref


    // constructor(response : any) {

    //     this.product = {
    //       sku : response.sku,
    //       name : response.name,
    //       price : response.price,
    //       prop_name : response.prop_name,
    //       prop_content : response.prop_content,
    //       prop_unit : response.prop_unit,
    //       checked : false
    //     }
    //   }

    submit = async () => {
        this.loading = true
       
            const rawResponse = await fetch('http://127.0.0.1:8001/addnew', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(this.form)
            });
            const content = await rawResponse.json();

            console.log(content);
       
        this.loading = false
    } // arrow function
   
    reset = () => {
        const form = this.form.value
        Object.keys(form).map((key: string) => {
            // form[key] = null
        })
        console.log(typeof 1.2)
        console.log(form)
    }

}