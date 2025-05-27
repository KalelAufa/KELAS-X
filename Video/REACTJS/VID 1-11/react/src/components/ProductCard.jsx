import React from "react";
import { Card, Button } from "react-bootstrap";
import PropTypes from "prop-types";
import "./ProductCard.css";

// ProductCard component menerima props: name, price, image
const ProductCard = ({ name, price, image }) => {
  return (
    <Card
      className="product-card"
      style={{ width: "18rem", margin: "1rem auto" }}>
      <Card.Img variant="top" src={image} alt={name} />
      <Card.Body>
        <Card.Title>{name}</Card.Title>
        <Card.Text>Harga: Rp {price}</Card.Text>
        <Button variant="primary">Beli</Button>
      </Card.Body>
    </Card>
  );
};

ProductCard.propTypes = {
  name: PropTypes.string.isRequired,
  price: PropTypes.number.isRequired,
  image: PropTypes.string.isRequired,
};

export default ProductCard;
