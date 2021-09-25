
import { BaseModel } from "./BaseModel";

export class Product extends BaseModel {
  private propertyName: string;
  private propertyContent: string;
  private propertyUnit: string;

  constructor(sku:string,propertyName: string , propertyContent: string , propertyUnit: string) {
    super(sku);
    this.propertyName = propertyName;
    this.propertyContent = propertyContent;
    this.propertyUnit = propertyUnit;
  }


  // getters
  getPropertyName(): string{
    return this.propertyName
  }

  getPropertyContent(): string{
    return this.propertyContent
  }

  getPropertyUnit(): string{
    return this.propertyUnit
  }

  // setters
  setPropertyName(propertyName:string): void{
    this.propertyName = propertyName
  }
  setPropertyContent(propertyContent:string): void{
    this.propertyContent = propertyContent
  }
  setPropertyUnit(propertyUnit:string): void{
    this.propertyUnit = propertyUnit
  }
}

export default Product;