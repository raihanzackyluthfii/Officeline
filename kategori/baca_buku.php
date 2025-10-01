
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'officeline');?>
        <?php
        session_start();
    require '../koneksi.php';

    $role_id = $_SESSION['role_id']; // Ambil role_id dari sesi
include '..koneksi.php';
    require '../startbootstrap-sb-admin-gh-pages/function.php';

$user_id = $_SESSION['user_id'];

// Ambil data pengguna dari database
$query = 'SELECT * FROM users WHERE id = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Pesan notifikasi
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);


$upload_dir = '../imgproduk/';

// Ambil kategori dan search dari URL, jika ada
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query berdasarkan kategori dan nama produk (jika kategori dan search diberikan)
if (!empty($kategori) && !empty($search)) {
    $stmt = $conn->prepare('SELECT * FROM produk WHERE kategoriproduk = ? AND nama LIKE ?');
    $searchTerm = '%'. $search . '%'; // Menambahkan wildcard untuk pencarian
    $stmt->bind_param('ss', $kategori, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $dataProduk = $result->fetch_all(MYSQLI_ASSOC);
} elseif (!empty($kategori)) {
    // Jika hanya kategori diberikan
    $stmt = $conn->prepare('SELECT * FROM produk WHERE kategoriproduk = ?');
    $stmt->bind_param('s', $kategori);
    $stmt->execute();
    $result = $stmt->get_result();
    $dataProduk = $result->fetch_all(MYSQLI_ASSOC);
} elseif (!empty($search)) {
    // Jika hanya search diberikan
    $stmt = $conn->prepare('SELECT * FROM produk WHERE nama LIKE ?');
$searchTerm = '%' . $search . '%'; // Menambahkan wildcard untuk pencarian
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $dataProduk = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Jika tidak ada kategori atau search, ambil semua produk
    $result = mysqli_query($conn, 'SELECT * FROM produk');
    $dataProduk = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Cek apakah ada data produk yang ditemukan
if (!$dataProduk) {
    echo 'Tidak ada produk yang ditemukan.';
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- Custom CSS -->
    <link rel='stylesheet' href='../styles.css'>

    <!-- Google Font -->
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel='stylesheet'>

    <!-- Logo -->
    <link rel='icon' href='../img/officeline_logo.png' type='image/x-icon'>

    <!-- Bootstrap -->
    <link rel='stylesheet' href='../bootstrap-5.3.3/css/bootstrap.min.css'>

    <!-- Bootstrap Icon -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css'>

    <!-- Animate CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css' />

    <title>Kategori - {$namakategori}</title>

    <style>
        .button-container {
            display: flex;
            align-items: center;
        }

        .stok {
            font-weight: bold;
            color: #28a745;
            margin-left: 8px;
        }

        .navbar {
            z-index: 1;
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
            color: black;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #EC633D;
            color: #ffffff;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 15px;
            font-size: 36px;
        }

        .sidebar .profile-options {
            flex-grow: 1;
        }

        .sidebar .logout-btn {
            margin-top: auto;
            padding: 10px 0;
        }

        /* Custom CSS */
        body {
            font-family: 'Poppins', sans-serif;
        }

        .produk {
            margin-bottom: 20px;
        }

        .harga {
            color: #f26341;
            font-weight: bold;
        }

        .btn-warning {
            background-color: #f26341;
            border-color: #f26341;
        }

        .btn-small {
            padding: 0.25rem 0.5rem;
            font-size: 0.900rem;
        }

        .gap-1 {
            margin-right: 10px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        /* Animasi */
        @keyframes shake {
            0% {
                transform: translate(1px, 0);
            }

            25% {
                transform: translate(-1px, 0);
            }

            50% {
                transform: translate(1px, 0);
            }

            75% {
                transform: translate(-1px, 0);
            }

            100% {
                transform: translate(0, 0);
            }
        }

        .shake {
            animation: shake 0.5s ease;
        }

        /* Badge Styling */
        .badge {
            position: relative;
            top: -5px;
            right: -10px;
        }

        .icon-wishlist-active {
            color: rgb(15, 14, 14);
        }

        .bi-heart-fill {
            color: red;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class='navbar bg-light sticky-top shadow'>
        <div class='container-lg'>
            <a class='navbar-brand logotoko' href='#'>
                <img src='../img/officeline_logo_fit_nobg.png' alt='officeline' style='width: 60px;' loading='lazy'>
            </a>

            <form class='d-flex form-inputs' role='search'>
                <input class='form-control pencarian border-2 rounded-3' type='search' placeholder='Cari . . .' aria-label='Search'>
                <i class='bi bi-search'></i>
            </form>

            <div class='d-flex align-items-center'>
                
                <a href='javascript:void(0)' class='btn rounded-circle' onclick='openSidebar()'>
                    <i class='bi bi-person fs-2'></i>
                </a>
                <div id='profileSidebar' class='sidebar'>
                    <a href='javascript:void(0)' class='closebtn' onclick='closeSidebar()'>×</a>
                    <div class='text-center mb-3'>
                        <i class='bi bi-person-circle fs-1 text-secondary'></i>
                        <h4 class='mt-2'>USERNAME</h4>
                    </div>
                    <ul class='list-unstyled profile-options'>
                        <li class='mb-2'>
                        <?php if (isset($role_id) && $role_id == 1): ?>
                            <a href='../startbootstrap-sb-admin-gh-pages\index.php' class='text-dark text-decoration-none'>
                                <i class='bi bi-grid fs-5 me-2'></i> Administrator
                            </a>
                            <?php endif; ?>
                        </li>
                        <li class='mb-2'>
                            <a href='../toko.php' class='text-dark text-decoration-none'>
                                <i class='bi bi-house  fs-5 me-2'></i> Toko
                            </a>
                        </li>
                        <li class='mb-2'>
                            <a href='../profil.php' class='text-dark text-decoration-none'>
                                <i class='bi bi-person  fs-5 me-2'></i> Profil Saya
                            </a>
                        </li>
                        <li class='mb-2'>
                            <a href='../chat.php' class='text-dark text-decoration-none'>
                                <i class='bi bi-chat-dots  fs-5 me-2'></i> Chat
                            </a>
                        </li>
                    </ul>
                    <div class='logout-btn text-center'>
                        <a href='../keluar.php' onclick='return confirm('Apakah anda yakin ingin keluar?')' class='btn btn-warning w-100'>
                            <i class='bi bi-box-arrow-right'></i> Keluar
                        </a>
                    </div>
                </div>
    </nav>
    <!-- Produk -->
    <?php
$result = mysqli_query($conn, 'SELECT * FROM produk');
$dataProduk = mysqli_fetch_all($result, MYSQLI_ASSOC); // Ambil semua data sebagai array
?>
<section id='produk'>
    <div class='container mt-4'>
        <div class='row'>
            <?php foreach ($dataProduk as $row) : ?>
                <div class='col-6 col-md-4 mb-4'>
                    <div class='card shadow produk'>
                        <img src='<?= file_exists('../imgproduk/' . $row['foto']) ? '../imgproduk/' . $row['foto'] : 'https://via.placeholder.com/150' ?>' class='card-img-top p-2' alt='<?= $row['nama']; ?>' loading='lazy'>
                        <div class='card-body'>
                            <h5 class='card-text harga'>Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></h5>
                            <p class='card-text deskripsi'><?= $row['deskripsiproduk']; ?></p>
                            <a href='../pesan.html' class='btn btn-warning btn-small'>Beli</a>
                            
                            <span class='stok ms-2'>Stok: <?= $row['ketersediaanstok']; ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

    <script>
        function openSidebar() {
            document.getElementById('profileSidebar').style.width = '250px';
        }

        function closeSidebar() {
            document.getElementById('profileSidebar').style.width = '0';
        }

       
    </script>
</body>

</html>