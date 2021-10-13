export default interface Form {
    form:Object
    rules:Object
    loading:boolean
    submitted:boolean
    valid:boolean
    errors:Array<string>
    submit: () => void; // arrow function
    validate:(key:any) => void; 
    reset:() => void
}