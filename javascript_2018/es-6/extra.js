//lesson-13
// export let name = 'sasha';
// export let age = 20;
let name = 'sasha';
let age = 20;

export {
    age,
    name
}

export function func() {
    console.log('i am func');
}

// export default func;
export default class Car {
    constructor() {
        console.log('Car constructor');
    }
}