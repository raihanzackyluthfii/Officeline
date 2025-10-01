<?php
session_start();
require "koneksi.php";

// Cek apakah ada file gambar yang diupload
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    // Nama file dan lokasi penyimpanan
    $fileTmpName = $_FILES['profile_picture']['tmp_name'];
    $fileName = $_FILES['profile_picture']['name'];
    $fileSize = $_FILES['profile_picture']['size'];
    $fileType = $_FILES['profile_picture']['type'];

    // Tentukan folder tempat menyimpan gambar
    $uploadDir = 'uploads/';

    // Membuat nama file unik untuk mencegah nama yang sama
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = uniqid('profile_', true) . '.' . $fileExtension;

    // Tentukan lokasi file setelah diupload
    $uploadPath = $uploadDir . $newFileName;

    // Pastikan file adalah gambar (opsional)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($fileType, $allowedTypes)) {
        // Pindahkan file ke folder upload
        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            // Update nama gambar di database
            $user_id = $_SESSION['user_id'];
            $query = "UPDATE users SET profile_picture = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $newFileName, $user_id);
            $stmt->execute();

            // Set pesan notifikasi
            $_SESSION['message'] = 'Gambar profil berhasil diperbarui!';
            header('Location: profil.php');
            exit();
        } else {
            $_SESSION['message'] = 'Gagal mengupload gambar.';
            header('Location: profil.php');
            exit();
        }
    } else {
        $_SESSION['message'] = 'Tipe file tidak valid. Harap upload gambar.';
        header('Location: profil.php');
        exit();
    }
} else {
    $_SESSION['message'] = 'Tidak ada file yang diupload.';
    header('Location: profil.php');
    exit();
}
?>
