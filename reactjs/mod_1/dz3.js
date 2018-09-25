var cities = ['Москва', "Ленинград", "Куйбышев", "Сталинград", "Ворошиловград", "Харьков"];

function InputOption(props) {
    return <option value={props.val}>{props.opt}</option>
}

function InputSelect(props) {
    return <label>{props.label}
        <select name={props.name}>
            {
                cities.map((city, i) =>
                    <InputOption val={city} opt={city} key={i}/>
                )
            }
        </select>
    </label>
}

function InputSubmit(props) {
    return <input type="submit"/>
}

function App(props) {
    return <form method="get" action="http://google.ru/search" target="_blank" name="search">
        <InputSelect name = "q" label="Город: "/>
        <InputSubmit />
    </form>
}

ReactDOM.render(
    <App></App>
    ,
    document.getElementById('wrapper')
);