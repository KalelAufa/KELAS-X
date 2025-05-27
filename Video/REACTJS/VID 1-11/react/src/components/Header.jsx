import React from "react";
import { Navbar, Container, Nav, NavDropdown } from "react-bootstrap";
import { Link, useLocation } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import { FaHome, FaInfoCircle, FaEnvelope, FaBars } from "react-icons/fa";

// Enhanced Header component with icons and dropdown menu
const Header = () => {
  const location = useLocation();
  return (
    <Navbar
      bg="primary"
      variant="dark"
      expand="lg"
      className="shadow-sm rounded-bottom">
      <Container>
        <Navbar.Brand as={Link} to="/">
          <span style={{ fontWeight: 700, letterSpacing: 1 }}>
            <FaBars style={{ marginRight: 8, marginBottom: 3 }} /> SMK Revit
            React App
          </span>
        </Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="me-auto">
            <Nav.Link as={Link} to="/" active={location.pathname === "/"}>
              <FaHome style={{ marginBottom: 2, marginRight: 4 }} /> Beranda
            </Nav.Link>
            <Nav.Link
              as={Link}
              to="/menu"
              active={location.pathname === "/menu"}>
              <FaBars style={{ marginBottom: 2, marginRight: 4 }} /> Menu
            </Nav.Link>
            <Nav.Link
              as={Link}
              to="/tentang"
              active={location.pathname === "/tentang"}>
              <FaInfoCircle style={{ marginBottom: 2, marginRight: 4 }} />{" "}
              Tentang
            </Nav.Link>
            <Nav.Link
              as={Link}
              to="/kontak"
              active={location.pathname === "/kontak"}>
              <FaEnvelope style={{ marginBottom: 2, marginRight: 4 }} /> Kontak
            </Nav.Link>
            {/* Removed NavDropdown 'Menu Lainnya' */}
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
};

export default Header;
