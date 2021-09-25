export abstract class BaseModel {
    private createdAt: Date;
    private sku: string;
    private deletedAt: Date;
    constructor(sku:string) {
      this.sku = sku;
      this.createdAt = new Date();
      this.deletedAt = new Date();
    }
    


    //getter
    getSku(): string{
      return this.sku
    }
    getCreatedAt(): Date{
      return this.createdAt
    }
    getDeletedAt(): Date{
      return this.deletedAt
    }


    //setters
    setSku(sku:string): void{
       this.sku = sku
    }
    setCreatedAt(createdAt:Date): void{
       this.createdAt = createdAt
    }
    setDeletedAt(deletedAt:Date): void{
       this.deletedAt = deletedAt
    }


    // // get all prodcuts
    // getAll(){

    // }

  }
  
  export default BaseModel;