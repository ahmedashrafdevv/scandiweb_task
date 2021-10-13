export default interface ValidationInterface {
    required: (key: string) => string
    number: (key: string) => string
    int: (key: string) => string
    str: (key: string) => string

}
