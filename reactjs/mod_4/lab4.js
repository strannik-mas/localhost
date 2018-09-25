const dataBook = [
    {id: 1, title: "Book 1", author: "Author 1", price: 500},
    {id: 5, title: "Book 2", author: "Author 2", price: 1200},
    {id: 6, title: "Book 3", author: "Author 3", price: null},
];

class Book extends React.Component{
    constructor(props){
        super(props);
        this.state = {selected: false};
        this.handleClick = this.handleClick.bind(this);
        this.addBasketBook = this.addBasketBook.bind(this);
    }

    componentDidMount(){
        // console.log("--", "компонент смонтирован");
    }

    handleClick(e){
        e.preventDefault();
        this.setState({selected:!this.state.selected});
    }

    addBasketBook(e){
        e.preventDefault();
        this.props.handleAddBasket(this.props.id);
    }

    render(){
        const price = this.props.price ? <strong>{this.props.price}</strong> : <del>&nbsp;</del>;

        return <div className={"book" + (this.state.selected ? " book_selected" : " book_default")}>
            <h3>{this.props["title"]}</h3>
            <img src={'http://placehold.it/100x120?text='+this.props["title"]} alt=""/>
            <p>Автор: {this.props["author"]}</p>
            <p>Цена: {price} руб.</p>
            <a href="#" onClick={this.handleClick}>Сравнить</a>&nbsp;
            <a href="#" onClick={this.addBasketBook}>В корзину</a>
            <div className="likes"></div>
        </div>;
    }
}

class BookWithoutPrice extends React.Component{
    constructor(props){
        super(props);
    }

    render(){
        const price = this.props.price ? <strong>{this.props.price}</strong> : <del>&nbsp;</del>;

        return <div className="book book_default">
            <h3>{this.props["title"]}</h3>
            <img src={'http://placehold.it/100x120?text='+this.props["title"]} alt=""/>
            <p>Автор: {this.props["author"]}</p>
            <p>Цена: {price} руб.</p>
        </div>;
    }
}

class Form extends React.Component {
    constructor(props){
        super(props);
        this.state = {title: ""};
        this.handleChange = this.handleChange.bind(this);
    }
    handleChange(e){
        this.setState({title: e.target.value});

    }
    render(){
        return <label><input type="text" onChange={this.handleChange} value={this.state.title}/>{this.state.title}</label>
    }
}

class AddBookForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            id:'',
            title: '',
            author: '',
            price: ''
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    isValidBook(book){
        return book.id && book.title && book.author && true;
    }

    handleChange(e){
        // console.log(e.target.value);
        this.setState({
            [e.target.name]:e.target.value
        });
        // console.log(this.state);
    }

    handleSubmit(e){
        e.preventDefault();
        if(this.isValidBook(this.state)){
            // dataBook.push(this.state);
            this.props.onChange(this.state);
            this.setState({
                id:'',
                title: '',
                author: '',
                price: ''
            });
            // console.log(dataBook);
            // this.props.onChange();
        }else alert("Заполните поля");
    }

    render(){
        return <form action="" onSubmit={this.handleSubmit}>
            <div>id<input type="text" name="id" onChange={this.handleChange} value={this.state.id}/></div>
            <div>Название<input type="text" name="title" onChange={this.handleChange} value={this.state.title}/></div>
            <div>Авторы<input type="text" name="author" onChange={this.handleChange} value={this.state.author}/></div>
            <div>Цена<input type="text" name="price" onChange={this.handleChange} value={this.state.price}/></div>
            <div><input type="submit" value="Добавить"/></div>
        </form>
    }
}

class App extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            // counter: 0,
            dataBook: dataBook,
            items: []
        };
        this.addBasket = this.addBasket.bind(this);
        this.removeBasket = this.removeBasket.bind(this);
        this.handleNewBook = this.handleNewBook.bind(this);
    }

    handleNewBook(newBook){
        this.setState(prevState => ({
            dataBook: prevState.dataBook.push(newBook)
        }));
        /*this.setState(prevState => ({
            counter: prevState.counter+1
        }))*/
    }

    addBasket(id) {
        let items = this.state.items.slice(0);  //для копирования
        console.dir(items);
        items[id] = id in items ? ++items[id] : 1;
        this.setState({items: items});
        console.dir(items);
    }

    removeBasket(id){
        /*
        let items = this.state.items.slice(0);  //для копирования
        items[id] = items[id]>1 ? --items[id] : delete items[id];
        this.setState({items: items});

*/
        let items = this.state.items.slice(0), result=[];
        items[id] = items[id]-1;
        this.setState({items:items});

        console.dir(items);
    }

    render(){
        return <div className="books">
            {/*<Form />*/}
            <Basket
                items={this.state.items}
                dataBook={this.state.dataBook}
                handleRemoveBasket={this.removeBasket}
            />
            <AddBookForm onChange={this.handleNewBook}/>
            {
                dataBook.map(item => {
                    return item.price ?
                    <Book title={item.title} author={item.author} price={item.price} key={item.id} id={item.id} handleAddBasket={this.addBasket}/>
                        : <BookWithoutPrice title={item.title} author={item.author} price={item.price} key={item.id}/>
                })
            }
        </div>
    }
}

class Basket extends React.Component {
    constructor(props){
        super(props);
        this.deleteBasketItem = this.deleteBasketItem.bind(this);
    }

    deleteBasketItem(e){
        e.preventDefault();
        this.props.handleRemoveBasket(e.target.id);
    }

    getIndexById(id){
        for(let p in this.props.dataBook){
            if(this.props.dataBook[p]['id'] == id)
                return p;
        }
        return false;
    }

    render(){
        let items = [], j,sum = 0;

        for(let i in this.props.items){
            if(!this.props.items[i]) continue;
            // console.log(this.props.items[i], i);
            j = this.getIndexById(i);
            sum += this.props.items[i]*this.props.dataBook[j]['price'];
            items.push(
                <div className="basket-item">
                    <a href="#">{this.props.dataBook[j]['title']}</a>
                    <span>{this.props.items[i]}шт.</span>
                    <span>{this.props.dataBook[j]['price']}руб.</span>
                    <a href="#" onClick={this.deleteBasketItem} id={i}>Удалить</a>
                </div>
            );
        }

        return <div className="basket">
            <h3>Корзина</h3>
            {items}
            <div className="basket-item">
                <span>Всего: <b>{sum}</b> руб.</span>
            </div>
        </div>
    }
}

ReactDOM.render(
    <App/>,
    document.getElementById('root')
);















/*for likes*/
class Like extends React.Component{
    constructor(props) {
        super(props);
        this.state = {counter: 0};

        // Это связывание необходимо делать работой `this` в функции обратного вызова
        this.handleClick = this.handleClick.bind(this);
    }

    handleClick(e) {
        e.preventDefault();
        this.setState(prevState => ({
            counter: prevState.counter+1
        }));
    }

    render(){
        return (
            <div>
                <a href="#22" onClick={this.handleClick}>
                    likes me
                </a>
                <mark>  {this.state.counter}</mark>
            </div>
        );
    }

}

var collection = document.getElementsByClassName('likes');
// console.log(collection);
for(let i=0; i<collection.length; i++){
    ReactDOM.render(
        <Like />
        ,
        collection[i]
    );
}