<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">

    <!-- Logo -->
    <link rel="icon" href="img/officeline_logo.png" type="image/x-icon">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap-5.3.3/css/bootstrap.min.css">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <title>OFFICELINE</title>

    <style>
        .custom-checkbox {
            display: inline-block;
            width: 24px;
            height: 24px;
            margin-right: 10px;
            /* Beri jarak antara checkbox dan tombol hapus */
        }

        .col-lg-2 .btn-outline {
            padding: 0;
            display: flex;
            align-items: center;
        }

        /* Hide default checkbox */
        .form-check-input {
            display: none;
            /* Hides the original checkbox */
        }

        /* Custom checkbox styling */
        .custom-checkbox {
            position: relative;
            display: inline-block;
            width: 24px;
            /* Width of the custom checkbox */
            height: 24px;
            /* Height of the custom checkbox */
            border: 2px solid #EC633D;
            /* Border color */
            border-radius: 4px;
            /* Optional: round the corners */
            cursor: pointer;
            /* Pointer cursor on hover */
            background-color: white;
            /* Background color when unchecked */
            transition: background-color 0.3s, border-color 0.3s;
            /* Smooth transition */
        }

        /* Checkbox checked state */
        .form-check-input:checked+.custom-checkbox {
            background-color: #EC633D;
            /* Background color when checked */
            border-color: #EC633D;
            /* Border color when checked */
        }

        /* Checkbox checkmark */
        .custom-checkbox:after {
            content: '';
            position: absolute;
            left: 6px;
            /* Adjust position */
            top: 1px;
            /* Adjust position */
            width: 8px;
            /* Width of the checkmark */
            height: 14px;
            /* Height of the checkmark */
            border: solid white;
            /* Color of the checkmark */
            border-width: 0 3px 3px 0;
            /* Adjust thickness */
            transform: rotate(45deg);
            /* Rotate to create a checkmark */
            opacity: 0;
            /* Hide by default */
            transition: opacity 0.2s;
            /* Smooth transition */
        }

        /* Show the checkmark when checked */
        .form-check-input:checked+.custom-checkbox:after {
            opacity: 1;
            /* Show checkmark */
        }

        /* Sidebar Styling */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: #f8f9fa;
            overflow-x: hidden;
            transition: 0.3s;
            padding-top: 60px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 20px;
            color: #000;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #EC633D;
            /* Warna latar belakang saat hover */
            color: #ffffff;
            /* Warna teks saat hover */
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 15px;
            font-size: 36px;
        }

        @media (max-width: 768px) {
            .harga {
                font-size: 1rem;
                /* Ukuran font lebih kecil di perangkat mobile */
            }

            .form-label {
                font-size: 0.9rem;
                /* Ukuran label lebih kecil */
            }

            .btn-warning,
            .btn-danger {
                font-size: 0.9rem;
                /* Ukuran tombol lebih kecil */
            }
        }

        img {
            max-width: 150px;
            /* Ukuran maksimum gambar */
            width: 100%;
            /* Agar gambar responsif */
            height: auto;
            /* Menjaga rasio aspek */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logotoko {
            border: 1px;
            border-radius: 5px;
        }

        .card {
            padding: 10px;
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .harga {
            font-weight: bold;
            color: #EC633D;
            font-size: 1.25rem;
        }

        .btn-warning,
        .btn-danger {
            width: 100%;
            margin-top: 10px;
            font-size: 1rem;
        }

        .subtotal-section {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 35px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
        }

        .form-label {
            font-weight: 0;
            color: #333;
        }

        .form-control {
            border: 1px solid #EC633D;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: #EC633D;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar bg-light sticky-top shadow">
        <div class="container-lg">
            <a class="navbar-brand logotoko" href="#">
                <img src="img/officeline_logo_fit_nobg.png" alt="officeline" style="width: 60px;" loading="lazy">
            </a>

            <span class="navbar-text ">
                <form class="d-flex form-inputs" role="search">
                    <input class="form-control pencarian border-2 rounded-3" type="text" id="filter"
                        placeholder="Cari produk . . . " aria-label="Search">
                    <i class="bi bi-search"></i>
                </form>
            </span>
            <span class="navbar-text">


                <!-- Tombol Pembuka Sidebar -->
                <a href="javascript:void(0)" class="btn rounded-circle btn-outline-warniing" onclick="openSidebar()">
                    <i class="bi bi-person fs-2"></i>
                </a>
                <!-- Sidebar Profil -->
                <div id="profileSidebar" class="sidebar">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()">×</a>
                    <div class="text-center mb-3">
                        <i class="bi bi-person-circle fs-1 text-secondary"></i>
                        <h4 class="mt-2">USERNAME</h4>
                    </div>
                    <!-- Profile Options -->
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="dashboard.html" class="text-dark text-decoration-none">
                                <i class="bi bi-grid fs-5 me-2"></i> Adminstrator
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="toko.php" class="text-dark text-decoration-none">
                                <i class="bi bi-house  fs-5 me-2"></i> Toko
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="profil.php" class="text-dark text-decoration-none">
                                <i class="bi bi-person  fs-5 me-2"></i> Profil Saya
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="wishlist.html" class="text-dark text-decoration-none">
                                <i class="bi bi-chat-dots text-dark fs-5 me-2"></i> Chat
                            </a>
                        </li>
                    </ul>
                    <div class="mt-4 text-center">
                        <a href="keluar.php" onclick="return confirm('Apakah anda yakin ingin keluar?')"
                            class="btn btn-warning w-100">
                            <i class="bi bi-box-arrow-right"></i> Keluar
                        </a>
                    </div>
                </div>
    </nav>
    <!-- BARANG -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 produk-container">
                    <div class="card border-0 pt-2">
                        <div id="atasan" class="card mb-3">
                            <div class="row g-0 justify-content-center">
                                <div class="col-lg-3 col-md-3">
                                    <p class="card-text text-center fw-normal">PRODUK</p>
                                </div>
                                <div class="col-lg-7 col-md-7 ps-3">
                                    <p class="card-text fw-normal">HARGA</p>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <p class="card-text fw-normal text-center pe-3">AKSI</p>
                                </div>
                            </div>
                        </div>
                        <!-- PRODUK -->
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-lg-3 col-md-3">
                                    <img src="img/pulpen_kenko.png"
                                        class="img-fluid rounded-start py-3 position-relative top-50 start-50 translate-middle"
                                        alt="produk" style="max-width: 150px; min-width: 100;" loading="lazy">
                                </div>
                                <div class="col-lg-7 col-md-7">
                                    <div class="card-body">
                                        <h5 class="card-text harga">Rp. 28.000</h5>
                                        <p class="card-text">KENKO PULPEN EASY GEL 0.5MM HITAM SATU LUSIN ISI 12PCS</p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 d-flex align-items-center justify-content-center gap-2">
                                    <div class="card-body">
                                        <input type="checkbox" class="form-check-input" id="check-item-1">
                                        <label class="custom-checkbox" for="check-item-1"></label>
                                        <a href="#" class="btn btn-outline" onclick="hapusItem(this)">
                                            <i class="bi bi-trash fs-4"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-lg-3 col-md-3">
                                    <img src="img/pulpen.png"
                                        class="img-fluid rounded-start py-3 position-relative top-50 start-50 translate-middle"
                                        alt="produk" style="max-width: 150px; min-width: 100;" loading="lazy">
                                </div>
                                <div class="col-lg-7 col-md-7">
                                    <div class="card-body">
                                        <h5 class="card-text harga">Rp. 10.000</h5>
                                        <p class="card-text">Pena</p>
                                    </div>
                                </div>
                                <!-- HTML Checkbox -->
                                <div class="col-lg-2 col-md-2 d-flex align-items-center justify-content-center gap-2">
                                    <div class="card-body">
                                        <input type="checkbox" class="form-check-input" id="check-item-2">
                                        <label class="custom-checkbox" for="check-item-2"></label>
                                        <a href="#" class="btn btn-outline" onclick="hapusItem(this)">
                                            <i class="bi bi-trash fs-4"></i>
                                        </a>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subtotal dan Alamat -->
                <div class="col-lg-5 col-md-12 subtotal-section">
                    <h5>Subtotal: <span id="subtotal">Rp. 0</span></h5>
                    <form>
                        <div class="mb-10">
                            <label for="alamat" class="form-label">Alamat Pengiriman</label>
                            <input type="text" class="form-control" id="alamat"
                                placeholder="Masukkan alamat pengiriman">
                        </div>
                        <div class="mb-3">
                            <label for="ongkir" class="form-label">Ongkir</label>
                            <input type="number" class="form-control" id="ongkir" placeholder="Masukkan ongkos kirim"
                                min="0">
                        </div>

                        <button type="submit" class="btn btn-outline-warning" onclick="prosesCheckout()">Check
                            Out</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
    function updateSubtotal() {
        const prices = Array.from(document.querySelectorAll('.harga')).map(price => {
            const checkbox = price.closest('.card').querySelector('.form-check-input');
            return checkbox.checked ? parseInt(price.innerText.replace(/[^0-9]/g, '')) : 0;
        });
        const subtotal = prices.reduce((total, price) => total + price, 0);
        document.getElementById('subtotal').innerText = 'Rp. ' + subtotal.toLocaleString();
    }

    // Fungsi untuk menambah produk ke keranjang
    function addToCart(button) {
        const card = button.closest('.card');
        const harga = card.querySelector('.harga').innerText;
        const produk = card.querySelector('.card-text:last-child').innerText;

        // Cek apakah produk sudah ada di keranjang
        const cartItems = Array.from(document.querySelectorAll('.cart-item'));
        const existingItem = cartItems.find(item => item.querySelector('.cart-product').innerText === produk);

        if (!existingItem) {
            const cart = document.getElementById('cart');
            const newCartItem = document.createElement('div');
            newCartItem.classList.add('cart-item', 'd-flex', 'justify-content-between', 'mb-2');
            newCartItem.innerHTML = `
                <span class="cart-product">${produk}</span>
                <span class="cart-price">${harga}</span>
            `;
            cart.appendChild(newCartItem);
        }

        updateSubtotal();  // Update subtotal setiap kali item ditambahkan
    }

    // Fungsi untuk menghapus item dari keranjang
    function hapusItem(button) {
        if (confirm("Apakah anda yakin ingin menghapus item ini?")) {
            const card = button.closest('.card');
            card.remove();
            updateSubtotal();
        }
    }

    // Event listener untuk mengupdate subtotal ketika checkbox diubah
    document.querySelectorAll('.form-check-input').forEach(input => {
        input.addEventListener('change', updateSubtotal);
    });

    // Fungsi untuk proses checkout
    function prosesCheckout() {
        const selectedItems = Array.from(document.querySelectorAll('.form-check-input:checked'));
        const selectedProducts = selectedItems.map(item => {
            const card = item.closest('.card');
            const harga = card.querySelector('.harga').innerText;
            const produk = card.querySelector('.card-text:last-child').innerText;
            return { produk, harga };
        });

        if (selectedProducts.length > 0) {
            alert('Produk yang dipilih:\n' + selectedProducts.map(item => `${item.produk}: ${item.harga}`).join('\n'));
        } else {
            alert('Tidak ada produk yang dipilih.');
        }
    }

    // Sidebar profile functions
    function openSidebar() {
        document.getElementById("profileSidebar").style.width = "250px";
    }

    function closeSidebar() {
        document.getElementById("profileSidebar").style.width = "0";
    }
</script>


        <scrip src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>

        <script>
        function openSidebar() {
            document.getElementById("profileSidebar").style.width = "250px";
        }

        function closeSidebar() {
            document.getElementById("profileSidebar").style.width = "0";
        }
        </script>
    
</body>

</html>