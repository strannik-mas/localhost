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
    }

    componentDidMount(){
        // console.log("--", "компонент смонтирован");
    }

    handleClick(e){
        e.preventDefault();
        this.setState({selected:!this.state.selected});
    }

    render(){
        const price = this.props.price ? <strong>{this.props.price}</strong> : <del>&nbsp;</del>;

        return <div className={"book" + (this.state.selected ? " book_selected" : " book_default")}>
            <h3>{this.props["title"]}</h3>
            <img src={'http://placehold.it/100x120?text='+this.props["title"]} alt=""/>
            <p>Автор: {this.props["author"]}</p>
            <p>Цена: {price} руб.</p>
            <a href="#" onClick={this.handleClick}>Сравнить</a>&nbsp;
            <a href="#">В корзину</a>
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
            id:0,
            title: '',
            author: '',
            price: null
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
            dataBook.push(this.state);
            this.setState({
                id:0,
                title: '',
                author: '',
                price: null
            });
            console.log(dataBook);
        }else alert("Заполните поля");
    }

    render(){
        return <form action="" onSubmit={this.handleSubmit}>
            <div>id<input type="text" name="id" onChange={this.handleChange}/></div>
            <div>Название<input type="text" name="title" onChange={this.handleChange}/></div>
            <div>Авторы<input type="text" name="author" onChange={this.handleChange}/></div>
            <div>Цена<input type="text" name="price" onChange={this.handleChange}/></div>
            <div><input type="submit" value="Добавить"/></div>
        </form>
    }
}

class App extends React.Component{
    constructor(props){
        super(props);
    }
    render(){
        return <div className="books">
            {/*<Form />*/}
            <AddBookForm />
            {
                dataBook.map(item => {
                    return item.price ?
                    <Book title={item.title} author={item.author} price={item.price} key={item.id}/>
                        : <BookWithoutPrice title={item.title} author={item.author} price={item.price} key={item.id}/>
                })
            }
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