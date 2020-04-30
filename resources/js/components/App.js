import React from 'react'
import ReactDom from 'react-dom'
import { BrowserRouter as Router, Link, Route } from 'react-router-dom'
import Movies from './Movies'

const App = () => (
    <Router>
        <Movies path="/" />
    </Router>

);



ReactDom.render(<App />, document.getElementById('app'));
