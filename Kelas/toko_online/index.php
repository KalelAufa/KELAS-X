<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .banner {
            height: 300px;
            background: url('https://via.placeholder.com/1200x300') no-repeat center center;
            background-size: cover;
        }

        .carousel-item img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .footer-link {
            color: #ffffff;
            text-decoration: none;
        }

        .footer-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header class="bg-light py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#">TokoOnline</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="d-flex align-items-center">
                <div class="input-group me-3">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-outline-secondary" type="button">Search</button>
                </div>
                <a href="register.php" class="btn btn-primary me-2">Register</a>
                <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
                <a href="cart.php">
                    <button class="btn btn-outline-success position-relative">
                        <i class="bi bi-cart"></i> Cart
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            0
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                </a>
            </div>
        </div>
    </header>

    <div class="container my-4">
        <div id="productCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://down-id.img.susercontent.com/file/sg-11134201-7rblx-lo6voeidra2847.webp" class="d-block" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="https://down-id.img.susercontent.com/file/sg-11134201-7rdy5-m0k3zkv8v2ha8d@resize_w450_nl.webp" class="d-block" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="https://down-id.img.susercontent.com/file/sg-11134201-7rbm6-lo7vv9v0dtf773.webp" class="d-block" alt="Slide 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card product-card h-100">
                    <img src="https://down-id.img.susercontent.com/file/sg-11134201-7rbm6-lo7vv9v0dtf773.webp" class="card-img-top img-fluid" alt="Product Image">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product Name 1</h5>
                        <p class="card-text">$10.00</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card h-100">
                    <img src="https://down-id.img.susercontent.com/file/sg-11134201-7rdy5-m0k3zkv8v2ha8d@resize_w450_nl.webp" class="card-img-top img-fluid" alt="Product Image">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product Name 2</h5>
                        <p class="card-text">$15.00</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card h-100">
                    <img src="https://down-id.img.susercontent.com/file/sg-11134201-7rbm6-lo7vv9v0dtf773.webp" class="card-img-top img-fluid" alt="Product Image">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product Name 3</h5>
                        <p class="card-text">$20.00</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>Menu</h5>
                    <nav class="nav flex-column">
                        <a class="nav-link footer-link" href="index.php">Home</a>
                        <a class="nav-link footer-link" href="about.php">About</a>
                        <a class="nav-link footer-link" href="shop.php">Shop</a>
                        <a class="nav-link footer-link" href="contact.php">Contact</a>
                    </nav>
                </div>
                <div class="col-md-3">
                    <h5>Payment</h5>
                    <img src="https://via.placeholder.com/100x50" alt="Payment Methods" class="img-fluid">
                    <p class="mt-2">We accept Visa, MasterCard, and PayPal.</p>
                </div>
                <div class="col-md-3">
                    <h5>Follow Us</h5>
                    <div>
                        <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i> Facebook</a>
                        <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i> Instagram</a>
                        <a href="#" class="text-white"><i class="bi bi-twitter"></i> Twitter</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <p><a href="mailto:contact@tokoonline.com" class="text-white">contact@tokoonline.com</a></p>
                    <p>Phone: +123-456-7890</p>
                    <p>Address: 123 Online St, Web City</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
