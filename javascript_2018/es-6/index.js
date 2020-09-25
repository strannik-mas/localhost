/*for(/!*var*!/let i = 0; i< 5; i++) {
    setTimeout(function () {
        console.log(i);
    });
}*/

/**
 * стрелочные функции
 */
// const original = function () {
//     return 100;
// };
//console.log(original());

// const arrow = (num) => {
//       return 150 + num;
// };
// const arrow2 = (num, num2) => 150 + num * num2;
// const arrow3 = num => 150 + num;
// console.log(arrow3(50));
// console.log(arrow3);

/*const obj = {
    name: 'sdf',
    logName: function () {
        /!*var self = this;
        setTimeout(function () {
            console.log('name' + self.name); //this - объект Window
            //console.log('name' + this.name); //this - объект Window
        }, 2000);*!/

        setTimeout(() => {
            console.log('name' + this.name);        }, 2000);
    }
};
obj.logName();*/

//lesson-4
/*const c = 90;
const c2 = () => 200;
const func = (a = 20, b = a + 50 + c2()) => {
    //a = a || 13;    //для значения по-умолчанию (старый вариант)
    return a + b;
};

console.log(func());
console.log(func(60));
console.log(func(60, 80));
console.log(func(null, 80));
console.log(func(undefined, 80));*/

//lesson-5
/*const name = "WFM";
const age = 30;

const obj = {name, age};

console.log(obj);

const createPerson = (name, surname, fieldName, fieldPostfix) => {
    const fullName = name + ' ' + surname;
    // const person = {
    //     fullName,
    //     name,
    //     surname,
    //     getJob: () => "FrontEnd1"
    // };
    // const finalFieldName = fieldName + fieldPostfix;
    // person[finalFieldName] = 50;
    // return person;
    return {
        fullName,
        name,
        surname,
        getJob: () => "FrontEnd1",
        [fieldName + fieldPostfix]: 100
    };
};

const person = createPerson("WFM", 'WFM2', 'age', '-name2');

console.log(person.getJob());
console.log(person);*/

//lesson-6
/*let obj = {
    name: 'WFM',
    age: 40
};
// let name = obj.name;
// let age = obj.age;

// let {name} = obj;
// let {age} = obj;
// let {name, age} = obj;
// let {name: n, age: a} = obj;
//
// console.log(name, age);
// console.log(n, a);

let array = ['WFM', 30];
// let array = ['WFM', 30, 'red'];

// let name = array[0];
// let age = array[1];
// let color = array[2];

let [name, , color ='magenta'] = array;

console.log(name, color);

//lesson-7
// function logStrings(num, str, str2, str3) {
function logStrings(num, ...args) {
    //var args = Array.prototype.slice.call(arguments);
    // console.log(num,str,str2,str3);
    console.log(num, args);
}
let spreadArray = ["WFM", "WFM2", "WFM3", "WFM4"];
// logStrings(20, "WFM", "WFM2", "WFM3", "WFM4");
logStrings(20, ...spreadArray);

//lesson-8

//конкатенация
const name = 'alex';
let str = `Hello, ${name} aaa bbb "ccc"! ${5+'10'}`;
console.log(str);

//lesson-9
const array = [1, 2, 3, 4];
for (let i = 0; i < array.length; i++){
    //console.log(array[i]);
}

array.forEach(function (item) {
    //console.log(item);
});

for(let item of array) {
    //console.log("Item", item);
}

for(let item of 'abcdefg') {
    console.log("Letter: ", item);
}


//lesson-10
class Car {
    constructor(name) {
        console.log('Car constructor');
        this.name = name;
    }

    logName() {
        console.log('Car name is ', this.name);
    }

    static staticFunc() {
        console.log('adfljsd;lasj');
    }
}

//let car = new Car("BMW");
//car.logName();
//console.log(car.logName() === Car.prototype.logName());
//Car.staticFunc();

class BMW extends Car{
    constructor(name) {
        console.log('BMW constructor');
        super(name);
    }

    logName() {
        console.log('BMW name is ', this.name);
        super.logName();
    }
}

let bmw = new BMW('X6');
bmw.logName();


//lesson-11
//SET - только уникальные значения
let set = new Set();
set.add(10);
set.add(10);        //не добавится
set.add('hello');
set.add({});
// console.log(set);
// console.log(set.size);

// let set2 = new Set([1, 2 ,3, 4 ,5 ,3, 1,5])
// console.log(set2.size)
let set3 = new Set().add(2).add(3);

// console.log(set3.size)
// console.log(set3.has(3));
// // console.log(set3.delete(3));
// console.log(set3.clear());
// console.log(set3);

let set4 = new Set();
let key = {};
set4.add(key);
console.log(set4.size);
key = null;
console.log(set4);
//for delete from set
let set5 = new WeakSet();
let key2 = {};
set5.add(key2);
console.log(set5.size);
key2 = null;
console.log(set5);


//lesson-12
let map = new Map();

map.set('name', 'WWFM');
map.set('age', 20);
map.set('name', 'WWFM2');
console.log(map);
console.log(map.get('age'));

let obj1 = {};
let obj2 = {};
map.set(obj1, 10);
map.set(obj2, 50);
console.log(map);
console.log("size: ", map.size);
console.log("has: ", map.has(obj2));
console.log("has: ", map.has(20));
map.delete(obj1);
console.log(map);

let map2 = new Map([
    ['mane', 'aaa'],
    ['mane2', 'b'],
    ['mane333', 'ccc'],
]);

for (let val of map2.values()) {
    console.log("Values: ", val);
}

for (let key of map2.keys()) {
    console.log("Keys: ", key);
}

for (let entr of map2.entries()) {
    console.log(`${entr[0]} - ${entr[1]}`);
}

let map3 = new Map();
let key = {};
map3.set('key', key);
console.log(map3.size);
key = null;
console.log(map3.size);

let map4 = new WeakMap();
let key2 = {};
map4.set(key2, 'key');
console.log(map4.size);
key = null;
console.log(map4.size);


//lesson-13
// import * as extra from './extra';
//import {age as a} from './extra';
// import {age, name} from './extra';
// console.log(age, name);

//import {func} from './extra';
//import func from './extra';     //если export default - не нужно делать деструктуризацию
//func();
import Car from './extra';
let car = new Car();


//lesson-14
// let sym = Symbol('WFM');
// let s2 = Symbol('1');
// let s3 = Symbol('1');
// console.log(s2 === s3);

let s = Symbol('field');
let s1 = Symbol('field');

let obj = {
    age: 20,
    [s]: 'WFM'      //уникальные поля
};
console.log(obj[s]);
console.log(Object.getOwnPropertyNames(obj));
console.log(Object.getOwnPropertySymbols(obj));

//цикл for - of работает для тех сущностей, для которых определен символ итератор
let num = 1;
let str = '2';
let arr = [1, 2];
let obj2 = {name: 'WFM'};
console.log('Number: ', typeof num[Symbol.iterator]);
console.log('String: ', typeof str[Symbol.iterator]);
console.log('Array: ', typeof arr[Symbol.iterator]);
console.log('Object: ', typeof obj2[Symbol.iterator]);

//как работает цикл for-of примерно
function createIterator(arr) {
    let count = 0;
    return {
        next() {
            return count < arr.length ? {value: arr[count++], done: false} : {value: undefined, done: true}
        }
    }
}
let iter = createIterator([1, 2, 3, 4]);
console.log(iter.next());
console.log(iter.next());
console.log(iter.next());
console.log(iter.next());
console.log(iter.next());
console.log(iter.next());

//последовательность Фибоначчи
let fib = {
    [Symbol.iterator]() {
        let pre = 0, cur = 1;
        return {
            next() {
                [pre, cur] = [cur, pre+cur];
                return {value: cur, done: false};
            }
        }
    }
};
for (let n of fib) {
    if (n > 1500) break;
    console.log(n);
}

//lesson-15 generators
// function* gen() {
//     yield 11;
//     yield 22;
//     yield 33;
// }
// let iter = gen();
// console.log(iter.next());
// console.log(iter.next());
// console.log(iter.next());
// console.log(iter.next());
//
// function* g1() {
//     yield 1;
//     yield* g2();
//     yield 4;
// }
//
// function* g2() {
//     yield 2;
//     yield 3;
// }
//
// let iter2 = g1();
// console.log(iter2.next());
// console.log(iter2.next());
// console.log(iter2.next());
// console.log(iter2.next());
// console.log(iter2.next());

// function* g() {
//     //yield [1, 2, 3];
//     yield* [1, 2, 3];
// }
//
// let iter = g();
// console.log(iter.next());
// console.log(iter.next());
// console.log(iter.next());
// console.log(iter.next());

// function* getRange(start = 0, end = 100, step = 10) {
//     while (start < end) {
//         yield start;
//         start += step;
//     }
// }
//
// for (let n of getRange(10, 50)) {
//     console.log(n);
// }

//генерация ряда Фибоначчи
let fib = {
    *[Symbol.iterator](){
        let cur = 1, pre = 0;
        for (;;) {
            [cur, pre] = [cur + pre, cur];
            yield cur;
        }
    }
};
for (let n of fib) {
    if (n > 10000) break;
    console.log(n);
}


//lesson-16
let obj1 = {a: 1};
let obj2 = {b:2, c:3};
let obj3 = Object.assign({}, obj1, obj2);
let obj4 = Object.assign({d: 4}, obj1, obj2);

//Object.assign(obj1, obj2);
console.log(obj1);
console.log(obj2);
console.log(obj3);
console.log(obj4);

let findedItem = [1, 2, 3, 4].find(x => x > 2); //первый попавшийся
console.log(findedItem);

let str = "Hello!";
console.log("Repeat: ", str.repeat(3));
console.log("StartsWith: ", str.startsWith('el', 1));
console.log("Includes: ", str.includes('llo', 1));
*/

//lesson-17 Promise

// function oldDelay(ms, func) {
//     setTimeout(function () {
//         func();
//     }, ms);
// }
//
// oldDelay(3000, function () {
//     console.log('old delay passed!')
// });

// function delay(ms = 2500) {
//     return new Promise((resolve, reject) => {
//         setTimeout(()=>{
//             //resolve();
//             reject();
//         }, ms);
//     });
// }
//
// delay(4000).then(()=>{
//     console.log('new deleay passed');
// }).catch(()=>{
//     console.info('error');
// });

import $ from 'jquery';

let promise = new Promise((resolve, reject) => {
    $.ajax({
        url: 'http://ddate.jsontest.com/',
        dataType: 'json',
        success: function(response) {
            resolve(response);
        },
        error: function (error) {
            reject(error);
        }
    });
});

promise
    .then((data)=>{
        //console.log("Success: ", data);
        return data.date;
    })
    .then((date)=>{
        console.log(date);
    })
    .catch((data)=>{
        console.log("Error: ", data);
    });
