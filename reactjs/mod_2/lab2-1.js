const dataBook = [
    {id: 1, title: "Book 1", author: "Author 1", price: 500},
    {id: 5, title: "Book 2", author: "Author 2", price: 1200},
    {id: 6, title: "Book 3", author: "Author 3", price: null},
];

/*function Book(props) {
    const price = props.price ? <strong>{props.price}</strong> : <del>&nbsp;</del>;
    return <div className="book">
        <h3>{props["title"]}</h3>
        <img src={'http://placehold.it/100x120?text='+props["title"]} alt=""/>
        <p>Автор: {props["author"]}</p>
        <p>Цена: {price} руб.</p>

    </div>;
}*/

class Book extends React.Component{
    constructor(props){
        super(props);
        this.state = {selected: false}
    }

    componentDidMount(){
        console.log("--", "компонент смонтирован");
    }

    render(){
        const price = this.props.price ? <strong>{this.props.price}</strong> : <del>&nbsp;</del>;

        // console.log(this);
        // this.setState({selected: true});     //тут ошибка

        return <div className={"book" + (this.state.selected ? " book_selected" : " book_default")}>
            <h3>{this.props["title"]}</h3>
            <img src={'http://placehold.it/100x120?text='+this.props["title"]} alt=""/>
            <p>Автор: {this.props["author"]}</p>
            <p>Цена: {price} руб.</p>
            <a href="#">Сравнить</a>&nbsp;
            <a href="#">В корзину</a>
            <div className="likes"></div>
        </div>;
    }
}

function App(props) {
    return <div className="books">
        {
            dataBook.map(item => <Book title={item.title} author={item.author} price={item.price} key={item.id}/>)
        }
    </div>
}

ReactDOM.render(
    <App/>,
    document.getElementById('root')
);