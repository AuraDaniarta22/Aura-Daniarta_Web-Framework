<!-- filepath: c:\xampp\htdocs\Aura-Daniarta_Web-Framework\app\Views\project.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Collection</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="51" onload="startCamera()">

<!-- Spinner -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top shadow py-lg-0 px-4 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
    <a href="index.html" class="navbar-brand d-block d-lg-none">
        <h1 class="text-primary fw-bold m-0">Portfolio</h1>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between py-4 py-lg-0" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="about" class="nav-item nav-link">About</a>
            <a href="service" class="nav-item nav-link">Services</a>
        </div>
        <a href="index.php" class="navbar-brand bg-secondary py-3 px-4 mx-3 d-none d-lg-block">
            <h1 class="text-primary fw-bold m-0">Portfolio</h1>
        </a>
        <div class="navbar-nav me-auto py-0">
            <a href="project" class="nav-item nav-link">Projects</a>
            <a href="contact" class="nav-item nav-link">Contact</a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Collection</h2>
        <a href="#" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Hasil</a>
    </div>

    <div class="row">
        <!-- Bagian Kiri: Kamera, Tombol, dan Galeri -->
        <div class="col-md-6">
            <div class="mt-3" id="cameraContainer">
                <video id="camera" width="320" height="240" autoplay playsinline></video>
                <!-- Tombol-tombol -->
                <div class="mt-3 btn-group" role="group" aria-label="Camera Controls">
                    <button type="button" class="btn btn-custom btn-sm" onclick="flipCamera()">
                        <i class="bi bi-arrow-repeat"></i> Flip
                    </button>
                    <button type="button" class="btn btn-custom btn-sm" onclick="toggleMirror()">
                        <i class="bi bi-aspect-ratio"></i> Mirror
                    </button>
                    <label for="fileInput" class="btn btn-custom btn-sm">
                        <i class="bi bi-upload"></i> Choose File
                    </label>
                    <input type="file" id="fileInput" class="d-none" accept="image/*" onchange="handleFileUpload(event)">
                    <button type="button" class="btn btn-custom btn-sm" onclick="takeSnapshot()">
                        <i class="bi bi-camera-fill"></i> Ambil
                    </button>
                </div>
                <!-- Galeri Gambar -->
                <div id="gallery" class="mt-4"></div>
                <!-- filepath: c:\xampp2\htdocs\Aura-Daniarta_Web-Framework\app\Views\project.php -->
            <div id="photoDetails" class="mt-3">
                <form action="/images/upload" method="POST" enctype="multipart/form-data">
                    <label for="image">Upload Gambar:</label>
                    <input type="file" name="image" id="image" required class="form-control mb-2">
                    
                    <label for="description">Deskripsi:</label>
                    <textarea name="description" id="description" required class="form-control mb-2"></textarea>
                    
                    <label for="category">Kategori:</label>
                    <input type="text" name="category" id="category" required class="form-control mb-2">
                    
                    <button type="submit" class="btn btn-primary btn-sm mt-2">Kirim</button>
                </form>
            </div>
            </div>
        </div>

        <!-- Bagian Kanan: Konten Tambahan -->
        <div class="col-md-6">
            <div class="content">
                <h3>Konten Tambahan</h3>
                <p>Berikut adalah file yang telah diunggah:</p>

                <?php
                // Koneksi ke database
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'mycoll'; // Ganti dengan nama database Anda

                $conn = new mysqli($host, $username, $password, $database);

                // Periksa koneksi
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Ambil data dari tabel images
                $query = "SELECT id, image, description, category FROM images ORDER BY created_at DESC";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    echo '<div class="uploaded-files">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="uploaded-item">';
                        echo '<img src="data:image/png;base64,' . base64_encode($row['image']) . '" alt="Uploaded Image" class="img-thumbnail mb-2" style="width: 100%; max-width: 200px;">';
                        echo '<p><strong>Deskripsi:</strong> ' . htmlspecialchars($row['description']) . '</p>';
                        echo '<p><strong>Kategori:</strong> ' . htmlspecialchars($row['category']) . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>Tidak ada file yang diunggah.</p>';
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/typed/typed.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/isotope/isotope.pkgd.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>

<script src="js/camera.js"></script>
<script src="js/main.js"></script>

</body>
</html>