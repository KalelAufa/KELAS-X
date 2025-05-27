import React from "react";
import { Card, Row, Col } from "react-bootstrap";
import "./Menu.css";

// Menu component menampilkan daftar menu makanan/minuman dengan card
const menuItems = [
  {
    name: "Nasi Goreng",
    price: "Rp 15.000",
    image:
      "https://cdn.pixabay.com/photo/2017/01/22/19/20/indonesian-2009594_1280.jpg",
  },
  {
    name: "Mie Ayam",
    price: "Rp 12.000",
    image:
      "https://cdn.pixabay.com/photo/2016/03/05/19/02/hot-1239300_1280.jpg",
  },
  {
    name: "Sate Ayam",
    price: "Rp 20.000",
    image:
      "https://cdn.pixabay.com/photo/2017/06/02/18/24/food-2367020_1280.jpg",
  },
  {
    name: "Es Teh Manis",
    price: "Rp 5.000",
    image:
      "https://cdn.pixabay.com/photo/2017/07/28/14/28/tea-2545751_1280.jpg",
  },
  {
    name: "Jus Alpukat",
    price: "Rp 10.000",
    image:
      "https://cdn.pixabay.com/photo/2017/01/20/15/06/smoothie-1998400_1280.jpg",
  },
];

const Menu = () => {
  return (
    <div className="menu-page">
      <h2>Daftar Menu</h2>
      <Row>
        {menuItems.map((item, idx) => (
          <Col md={4} sm={6} xs={12} key={idx} className="mb-4">
            <Card className="menu-card">
              <Card.Img
                variant="top"
                src={item.image}
                alt={item.name}
                className="menu-card-img"
              />
              <Card.Body>
                <Card.Title>{item.name}</Card.Title>
                <Card.Text className="menu-price">{item.price}</Card.Text>
              </Card.Body>
            </Card>
          </Col>
        ))}
      </Row>
    </div>
  );
};

export default Menu;
