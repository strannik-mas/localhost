const arrayOfNumbers: Array<number> = [1, 1, 2, 5]
const arrayOfStrings: Array<string> = ['1', '1', '2', '5']

function reverse<T>(array: T[]): T[] {
    return array.reverse()
}

reverse(arrayOfNumbers)
reverse(arrayOfStrings)
