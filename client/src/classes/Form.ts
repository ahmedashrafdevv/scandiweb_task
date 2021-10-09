export default interface Form {
    form:Object
    rules:Object
    loading:boolean
    submitted:boolean
    valid:boolean
    submit: () => void; // arrow function
    validate:() => boolean; 
    reset:() => void
}