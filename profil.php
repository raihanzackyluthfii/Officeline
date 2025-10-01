<?php
    // Mulai sesi dan sambungkan ke database
    session_start();
    require "koneksi.php";

    $role_id = $_SESSION['role_id']; // Ambil role_id dari sesi
include 'koneksi.php';
require "startbootstrap-sb-admin-gh-pages/function.php";

    $user_id = $_SESSION['user_id'];

// Ambil data pengguna dari database
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Pesan notifikasi
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);




?>
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Logo -->
    <link rel="icon" href="img/officeline_logo.png" type="image/x-icon">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap-5.3.3/css/bootstrap.min.css">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <style>
        .kategori-lainnya {
    transition: transform 0.3s ease; /* Animasi transisi */
}
 
.kategori-lainnya:hover {
    transform: translateY(-5px); /* Menaikkan tombol sedikit ke atas */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Menambahkan bayangan */
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

        /* Menjamin card mengisi seluruh layar */
.card {
    min-height:; /* Memastikan card memiliki tinggi minimal 100% dari layar */
    display: flex;
    flex-direction: column; /* Agar konten dalam card berada dalam kolom */
    justify-content: center; /* Agar konten card diposisikan di tengah */
    padding: 30px;
}

/* Menambahkan padding pada bagian card-body */
.card-body {
    flex-grow: 1; /* Mengambil ruang yang tersisa di card */
}

/* Styling tambahan agar card terlihat lebih menarik */
.card {
    background-color: #ffffff; /* Menetapkan warna latar belakang putih */
    border-radius: 10px; /* Menambahkan sudut melengkung pada card */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan untuk efek depth */
}

    </style>

    <title>OFFICELINE</title>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar bg-light sticky-top shadow">
        <div class="container-lg">
            <a class="navbar-brand logotoko" href="#">
                <img src="img/officeline_logo_fit_nobg.png" alt="officeline" style="width: 60px;" loading="lazy">
            </a>

            

            
            <span class="navbar-text">
                <!-- Keranjang -->
                <div class="d-flex align-items-center">
                
                
                <!-- Tombol Pembuka Sidebar -->
                <a href="javascript:void(0)" class="btn rounded-circle btn-outline-warniing" onclick="openSidebar()">
                    <i class="bi bi-person fs-2"></i>
                </a>
                <!-- Sidebar Profil -->
                <div id="profileSidebar" class="sidebar">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()">×</a>
                    <div class="text-center mb-3">
                    <div class="rounded-circle container d-flex justify-content-center align-items-center" 
     style="width: 150px; height: 150px; background-color: #f0f0f0; position: relative; overflow: hidden;">
    <?php if (!empty($user['profile_picture'])): ?>
        <img id="" src="uploads/<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
    <?php else: ?>
        <i class="fas fa-user-circle" style="font-size: 100px; color: #ccc;"></i> <!-- Icon user-circle Font Awesome -->
    <?php endif; ?>
    <input type="file" name="profile_picture" 
           style="position: absolute; inset: 0; opacity: 0; cursor: pointer;" 
           accept="image/*" onchange="previewImage(event)">
</div>
                    
                        <h4><?= htmlspecialchars($user['username']); ?></h4>
                    </div>
                    <!-- Profile Options -->
    <ul class="list-unstyled">
        <li class="mb-2">
            <?php if (isset($role_id) && $role_id == 1): ?>
                <a href="startbootstrap-sb-admin-gh-pages\index.php" class="text-dark text-decoration-none">
                    <i class="bi bi-grid fs-5 me-2"></i> Administrator
                </a>
            <?php endif; ?>
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
                            <a href="chat.php" class="text-dark text-decoration-none">
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

    </span>
    <span class="navbar-text">

    </span>
    </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Profil Saya</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                <div class="card-body text-center">
               <!-- Foto Profil -->
               <form id="imageUploadForm" action="simpan_gambar.php" method="post" enctype="multipart/form-data">
               <div class="rounded-circle container d-flex justify-content-center align-items-center" 
     style="width: 150px; height: 150px; background-color: #f0f0f0; position: relative; overflow: hidden;">
    <?php if (!empty($user['profile_picture'])): ?>
        <img id="profilePreview" src="uploads/<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
    <?php else: ?>
        <i class="fas fa-user-circle" style="font-size: 100px; color: #ccc;"></i> <!-- Icon user-circle Font Awesome -->
    <?php endif; ?>
    <input type="file" name="profile_picture" 
           style="position: absolute; inset: 0; opacity: 0; cursor: pointer;" 
           accept="image/*" onchange="previewImage(event)">
</div>

</form>



                        <script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('profilePreview');
            output.src = reader.result; // Set the image source to the uploaded image
        };
        reader.readAsDataURL(event.target.files[0]); // Read the file as Data URL
    }

    // Fungsi untuk mengirim form secara manual
function submitImageForm() {
    var form = document.getElementById('imageUploadForm');
    form.submit(); // Mengirimkan form secara manual
}
</script>



<!-- Tambahkan Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


</div>

<!-- Tambahkan Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

                        <table class="table">
                            <tr>
                                <th>Username</th>
                                <td><?= htmlspecialchars($user['username']); ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= htmlspecialchars($user['email']); ?></td>
                            </tr>
                            
                        </table>
                        
                       
    <div class="d-flex justify-content-center gap-3">
        
    <a href="edit_profile.php" class="btn btn-primary">Edit Profil</a>
                        <button type="button" class="btn btn-primary" onclick="submitImageForm()">Simpan Gambar</button>
                        </div>
        
</div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Script -->
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
