import ValidationInterface from "./ValidationInterface";

export default class Validation implements ValidationInterface {
    required = (key:any): string => {
        if (key == null || typeof key == 'undefined')
            return `${key} is required`;
        

        return "";
    }
    number = (key:any): string => {
        if (isNaN(key))
            return `${key} Must be a number`;


        return "";
    }
    int = (key:any): string => {
        if (Number.isInteger(key))
            return `${key} Must be a integer`;


        return "";
    }
    str = (key:any): string => {
        if (typeof key != 'string')
            return `${key} is required Must be a string`;


        return "";
    }



}