class Typescript {
    version: string

    constructor(version: string) {
        this.version = version
    }
    info(name: string):string {
        return `[${name}]: Typescript version is ${this.version}`
    }
}

/*
class Car {
    readonly model: string
    readonly numberOfWheels: number = 4

    constructor(theModel: string) {
        this.model = theModel
    }
}
*/
class Car {
    readonly numberOfWheels: number = 4
    constructor(readonly model: string) {}
}
//===============================================

class Animal {
    protected voice:string = ""
    public color:string = 'black'

    constructor() {
        this.go()
    }

    private go() {
        console.log('go')
    }
}

class Cat extends Animal {
    public setVoice(voice: string) :void {
        this.voice = voice
        // this.go()
    }

}

const cat = new Cat()
cat.setVoice('test')
cat.color = 'blue'
console.log(cat.color)
// cat.voice = 'asdf'
//=============================
abstract class Component {
    abstract render():void
    abstract info():string
}

class AppComponent extends Component{
    info(): string {
        return "info";
    }

    render(): void {
        console.log('asdfkl;jasdfk')
    }

}
