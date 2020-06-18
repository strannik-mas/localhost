/*const str: string = 'Hello'
console.log(str)*/
const isFetching: boolean = true
const isLoading: boolean = false

const int: number = 42
const float: number = 4.2
const num: number = 3e100

const message: string = "Hello type"

const numberArr: number[] = [1, 1, 2, 3, 5, 8, 13]
const numberArr2: Array<number> = [1, 1, 2, 3, 5, 8, 13]

const words: string[] = ["hello", 'typescr']

//Tuple
const contact: [string, number] = ['vlad', 12345]

//Any
let variable: any = 42
variable = 'new str'

//function
function sayMyName(name: string) :void {
    console.log(name)
}
// sayMyName('djdjdjdjdj')

//Never
function throwError(message: string) :never {
    throw  new Error(message)
}
function infinite(): never {
    while (true) {

    }
}

//Type
type Login = string;
const login: Login = 'admin'
// const login2: Login = 2

type ID = string|number
const id1: ID = 12
const id2: ID = "12"

type SomeType = string|null|undefined
