<?php
// Koneksi ke database
include '../koneksi.php'; // Pastikan file ini memiliki kode koneksi ke database



if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil informasi kategori untuk menghapus gambar
    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE idkategori = $id");
    $kategori = mysqli_fetch_assoc($queryKategori);
    $gambarKategori = $kategori['gambarkategori'];

    if ($kategori) {
        // Lokasi file gambar
        $target_dir = "../img/";
        $target_file = $target_dir . $kategori['gambarkategori']; // Nama file gambar
        $kategoriSlug = $kategori['slug']; // Ambil slug kategori
        $htmlFile = "../kategori/{$kategoriSlug}.php"; // File HTML kategori

        // Hapus file gambar jika ditemukan
        if (file_exists($target_file)) {
            unlink($target_file); // Hapus file gambar
        }

        // Hapus file HTML kategori jika ditemukan
        if (file_exists($htmlFile)) {
            unlink($htmlFile); // Hapus file HTML kategori
        }


    // Hapus gambar dari folder jika ada
    if (file_exists($gambarKategori)) {
        unlink($gambarKategori); // Fungsi untuk menghapus file
    }

    // Hapus produk terkait (jika ada tabel produk dengan idkategori sebagai foreign key)
    $deleteProdukQuery = "DELETE FROM produk WHERE idkategori = $id";
    mysqli_query($conn, $deleteProdukQuery);

    // Hapus kategori dari database
    $deleteQuery = "DELETE FROM kategori WHERE idkategori = $id";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Kategori dan data terkait berhasil dihapus!');</script>";
    } else {
        echo "<script>alert('Gagal menghapus kategori: " . mysqli_error($conn) . "');</script>";
    }

    // Redirect kembali ke halaman kategori
    echo "<script>window.location = 'kategori.php';</script>";
} else {
    echo "<script>alert('ID kategori tidak ditemukan!');</script>";
    echo "<script>window.location = 'index.php';</script>";
}
}

?>

<?php
// Koneksi ke database
include '../koneksi.php'; // Pastikan file koneksi sudah ada dan sesuai

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil informasi foto dari database
    $query = "SELECT foto FROM produk WHERE idproduk = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $foto_path = $row['foto']; // Path foto diambil dari database

        // Hapus file foto dari direktori
        if (file_exists($foto_path)) {
            unlink($foto_path); // Menghapus file
        }

        // Hapus data produk dari database
        $delete_query = "DELETE FROM produk WHERE idproduk = '$id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            echo "<script>alert('Produk berhasil dihapus!');</script>";
            echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus produk!');</script>";
        }
    } else {
        echo "<script>alert('Produk tidak ditemukan!');</script>";
    }
} else {
    echo "<script>alert('ID produk tidak ditemukan!');</script>";
    echo "<script>window.location.href='index.php';</script>";
}
?>


<?php
if (isset($_GET['pesan']) && $_GET['pesan'] == 'sukses') {
    echo "<div class='alert alert-success'>Data berhasil dihapus!</div>";
}

?>
