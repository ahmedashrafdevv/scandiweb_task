export default interface ValidationInterface {
    static  required:(key:string , form:Object)=> string
    static number:(key:string , form:Object)=> string
    static  int:(key:string , form:Object)=> string
    static  str:(key:string , form:Object)=> string
   
}
