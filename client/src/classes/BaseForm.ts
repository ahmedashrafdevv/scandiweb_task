import Validation from "./Validation"

export default class BaseForm extends Validation {
    form = {}
    rules = {}
    loading = false
    submitted = false
    valid = false
    errors = [""]
    
    validate = (key: any):void => {
       const input = document.querySelector('#name')
       const span = document.createElement('span')
       span.classList.add('error')
       const msg:string = this.number(key)
       span.innerHTML = this.number(msg)
       input?.appendChild(span)
       this.errors.push(msg)
      }
}