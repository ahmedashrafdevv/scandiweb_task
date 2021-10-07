

import {Product}  from "./Product";
export class ProductModel{
  product:Product

  
  constructor(response : any) {
   
    this.product = {
      sku : response.sku,
      name : response.name,
      price : response.price,
      prop_name : response.prop_name,
      prop_content : response.prop_content,
      prop_unit : response.prop_unit,
      checked : false
    }
  }


  // getters
  getSku(): string{
    return this.product.sku
  }
  getName(): string{
    return this.product.name
  }
  getPrice(): number{
    return this.product.price
  }
  getPropName(): string{
    return this.product.prop_name
  }
  getPropContent(): string{
    return this.product.prop_content
  }
  getPropUnit(): string{
    return this.product.prop_unit
  }
  getChecked(): boolean{
    return this.product.checked
  }

  
  

  // setters
  setSku(sku:string):void{
     this.product.sku = sku
  }
  setName(name:string):void{
     this.product.name = name
  }
  setPrice(price:number):void{
     this.product.price = price
  }
  setPropName(prop_name:string):void{
     this.product.prop_name = prop_name
  }
  setPropContent(prop_content:string):void{
     this.product.prop_content = prop_content
  }
  setPropUnit(prop_unit:string):void{
     this.product.prop_unit = prop_unit
  }
  setChecked(checked:boolean):void{
     this.product.checked = checked
  }
}

export default Product;