
import { BaseModel } from "./BaseModel";

export class Product extends BaseModel {
  private name: string;
  private price: number;

  constructor(sku: string , name: string , price: number) {
    super(sku);
    this.name = name;
    this.price = price;
  }


  // getters
  getName(): string{
    return this.name
  }

  getPrice(): number{
    return this.price
  }

  // setters
  setName(name:string): void{
    this.name = name
  }
  setPrice(price:number): void{
    this.price = price
  }
}

export default Product;