<?php
    include 'includes/db.php';
    include 'includes/header.php';
?>
<div class="container mt-5 pt-5">
    <h2 class="text-center mb-4">Contact Us</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" id="contactForm">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Message</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        const nama = document.getElementById('nama').value;
        const email = document.getElementById('email').value;
        const pesan = document.getElementById('pesan').value;

        if (!nama || !email || !pesan) {
            e.preventDefault();
            alert('Please fill in all fields.');
        }
    });
</script>
