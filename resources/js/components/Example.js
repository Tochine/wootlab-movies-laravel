import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import Navbar from "react-bootstrap/Navbar";
import Container from "react-bootstrap/Container";
import Card from "react-bootstrap/Card";
import Nav from "react-bootstrap/Nav";
import Row from "react-bootstrap/Row";

const Example = () => {
    const [movies, setMovies] = useState([]);

    useEffect(() => {
        fetch("http://127.0.0.1:2000/api/all")
            .then(response => response.json())
            .then(movies => setMovies(movies));
        console.log(movies);
    }, []);


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
                    {/* {movies.map((movie, movieId) => (
                        <Card style={{ width: "18rem" }} key={movieId}>
                            <Card.Img variant="top" src={movie.backdropPath} />
                            <Card.Body>
                                <Card.Title>{movie.title}</Card.Title>
                                <Card.Text>{movie.voteAverage}</Card.Text>
                            </Card.Body>
                        </Card>
                    ))} */}
                </Row>
            </Container>
        </>
    );
};

export default Example;

// if (document.getElementById("example")) {
//     ReactDOM.render(<Example />, document.getElementById("example"));
// }
