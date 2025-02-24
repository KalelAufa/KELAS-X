<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-4">
            <a href="../index.php">
                <img src="assets/images/logo.png" alt="Logo Toko Online" class="h-12"> <!-- Sesuaikan ukuran logo -->
            </a>
            <h1 class="text-2xl font-bold text-blue-600">Toko Online</h1>
        </div>

        <!-- Pencarian -->
        <div class="flex-grow mx-56 flex justify-center">
            <form action="../produk/cari_produk.php" method="GET" class="relative w-full"> <!-- Mengarahkan ke cari_produk.php -->
                <input type="text" name="query" placeholder="Cari produk..." class="border rounded px-4 py-2 pl-10 w-full focus:outline-none focus:ring focus:ring-blue-300">
                <span class="absolute left-3 top-2.5 text-gray-500"><i class="fas fa-search"></i></span>
            </form>
        </div>

        <!-- Navigasi -->
        <nav class="flex items-center space-x-6">
            <ul class="flex space-x-4">
                <li><a href="../index.php" class="text-gray-700 hover:text-blue-600">Beranda</a></li>
                <li><a href="#" class="text-gray-700 hover:text-blue-600">Kategori</a></li>
                <!-- Ikon Wishlist -->
                <li>
                    <a href="../produk/wishlist.php" class="relative inline-block">
                        <i class="fas fa-heart text-xl"></i>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <?php
                            // Menghitung jumlah item dalam wishlist
                            $user_id = $_SESSION['user_id'];
                            $query = "SELECT COUNT(*) as count FROM wishlist WHERE user_id = ?";
                            $result = executeSelect($koneksi, $query, [$user_id], 'i');
                            $count = $result->fetch_assoc()['count'];
                            ?>
                            <?php if ($count > 0): ?>
                                <span class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-1"><?php echo $count; ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </a>
                </li>
                <!-- Ikon Keranjang Belanja -->
                <li class="relative">
                    <a href="../keranjang/keranjang.php" class="text-gray-700 hover:text-blue-600">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <?php
                            // Menghitung jumlah item dalam keranjang
                            $query = "SELECT SUM(kuantitas) as total FROM item_keranjang ik JOIN keranjang k ON ik.cart_id = k.cart_id WHERE k.user_id = ?";
                            $result = executeSelect($koneksi, $query, [$user_id], 'i');
                            $total_items = $result->fetch_assoc()['total'] ?? 0; // Default ke 0 jika tidak ada
                            ?>
                            <?php if ($total_items > 0): ?>
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full px-1"><?php echo $total_items; ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="../akun/profile.php" class="hover:underline">Profile</a></li>
                    <li><a href="../akun/logout.php" class="hover:underline">Logout</a></li>
                <?php else: ?>
                    <li><a href="../akun/login.php" class="hover:underline">Login</a></li>
                    <li><a href="../akun/register.php" class="hover:underline">Daftar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
