function ActionLink() {
    function handleClick(e) {
        e.preventDefault();
        console.log('The link was clicked.');
    }

    return React.createElement(
        'a',
        { href: '#', onClick: handleClick },
        'Click me'
    );
}

ReactDOM.render(React.createElement(ActionLink, null), document.getElementById('root'));
//# sourceMappingURL=mod_2-2.js.map