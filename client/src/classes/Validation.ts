import ValidationInterface from "./ValidationInterface";

export default class Validation implements ValidationInterface {
    required = (key:string): string => {
        if (key == null || typeof key == 'undefined')
            return `${key} is required`;
        

        return "";
    }
    number = (key:any): string => {
        if (isNaN(key))
            return `${key} is required`;


        return "";
    }
    int = (key:string): string => {
        if (Number.isInteger(key))
            return `${key} is required`;


        return "";
    }
    str = (key:string): string => {
        if (typeof key != 'string')
            return `${key} is required`;


        return "";
    }



}