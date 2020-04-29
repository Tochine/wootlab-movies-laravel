import React from 'react'
import ReactDom from 'react-dom'
import Example from './Example'

const App = ()=> (
    <Example />
);



ReactDom.render(<App />, document.getElementById('app'));
