import React, { Component } from 'react'
import Axios from 'axios';
import Navbar from "react-bootstrap/Navbar";
import Container from "react-bootstrap/Container";
import Card from "react-bootstrap/Card";
import Nav from "react-bootstrap/Nav";
import Row from "react-bootstrap/Row";

export default class Movie extends Component {

    constructor() {
        super();
        this.state = {
            movies: []
        }
    }

    componentDidMount() {
        axios.get('http://127.0.0.1:2000/api/all')
            .then(response => {
                this.setState({ movies: response.data.data })
            })

    }

    render() {
        const { movies } = this.state;

        return (
            <>
                <Navbar expand="lg" variant="dark" bg="dark">
                    <Container>
                        <Navbar.Brand href="#">WootLab Movies</Navbar.Brand>
                        <Navbar.Toggle aria-controls="responsive-navbar-nav" />

                        <Nav className="mr-auto">
                            <Nav.Link href="#features">Favorite</Nav.Link>
                        </Nav>
                    </Container>
                </Navbar>
                <Container>
                    <Row>
                        {
                            movies && movies.length > 1 && movies.map(movie => {
                                return (
                                    <Card style={{ width: "18rem" }} key={movie.id}>
                                        <Card.Img variant="top" src={movie.backdropPath} />
                                        <Card.Body>
                                            <Card.Title>{movie.title}</Card.Title>
                                            <Card.Text>{movie.voteAverage}</Card.Text>
                                        </Card.Body>
                                    </Card>
                                )
                            })
                        }
                    </Row>
                </Container>
            </>
        );
    }
}