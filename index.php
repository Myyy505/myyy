<?php
include "koneksi.php"; 
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Web Sederhana - Home, Artikel, Galeri</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>

    <style>
        #home {
        background-image: url(img/nav.jpg);
        background-size: cover;
        background-position: center;
        color: white;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg" style="background-color: var(--bs-body-bg);">
      <div class="container">
        <a class="navbar-brand" href="#">Kabar_Bola</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#artikel">Artikel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#galeri">Galeri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#schedule">Schedule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#About Me">About Me</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          </ul>
          <button id="dark-mode" class="btn btn-outline ms-2" style="background-color: var(--bs-body-bg);">
            <i class="fas fa-moon"></i> Dark
          </button>
          <button id="light-mode" class="btn btn-outline ms-2" style="background-color: var(--bs-body-bg);">
            <i class="fas fa-sun"></i> Light
          </button>
        </div>
      </div>
    </nav>

    <section id="home" class="bg-light py-5">
      <div class="container text-center">
        <h1>Selamat datang di Website Kabar Bola!</h1>
        <p class="lead">
            Selamat datang di portal berita sepak bola terbaik, tempat Anda dapat menemukan informasi terbaru dan terlengkap tentang dunia sepak bola, baik itu di kancah internasional maupun domestik! Kami berkomitmen untuk menyajikan berita terkini, analisis mendalam, dan laporan pertandingan dari berbagai liga top dunia, seperti Liga Champions, Liga Inggris, Serie A, La Liga, Bundesliga, dan tentunya juga kompetisi-kompetisi dalam negeri. Dapatkan ulasan pemain, update transfer, statistik tim, hingga perkembangan taktik terbaru yang sedang tren. Kami hadir untuk memenuhi kebutuhan para pecinta sepak bola yang haus akan berita akurat dan up-to-date. Mari bergabung dengan komunitas kami dan jadilah yang pertama mengetahui setiap momen penting yang terjadi di lapangan hijau!
        </p>
        <a href="#artikel" class="btn" style="background-color: var(--bs-body-bg);">Lihat Artikel</a>
      </div>
    </section>

    <!-- article begin -->
    <section id="article" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">article</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
            <?php
            $sql = "SELECT * FROM article ORDER BY tanggal DESC";
            $hasil = $conn->query($sql); 

            while($row = $hasil->fetch_assoc()){
            ?>
                <div class="col">
                <div class="card h-100">
                    <div class="ratio ratio-4x3"> <!-- Tambahkan rasio -->
                    <img src="img/<?= $row["gambar"]?>" class="card-img-top img-fluid" alt="..." />
                    </div>
                    <div class="card-body">
                    <h5 class="card-title"><?= $row["judul"]?></h5>
                    <p class="card-text">
                        <?= $row["isi"]?>
                    </p>
                    </div>
                    <div class="card-footer">
                    <small class="text-body-secondary">
                        <?= $row["tanggal"]?>
                    </small>
                    </div>
                </div>
                </div>
                <?php
            }
            ?> 
            </div>
        </div>
    </section>
    <!-- article end -->
      
    <section id="gallery" class="container my-5">
        <h2 class="text-center mb-4"><b>Gallery</b></h2>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php
                    $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
                    $hasil = $conn->query($sql); 
                    $total_images = $hasil->num_rows;
                    $counter = 0;
                    while($row = $hasil->fetch_assoc()){
                        $active_class = ($counter == 0) ? 'active' : '';
                        echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $counter . '" class="' . $active_class . '" aria-current="true" aria-label="Slide ' . ($counter + 1) . '"></button>';
                        $counter++;
                    }
                    ?>
                </div>
                
                <div class="carousel-inner">
                    <?php
                    $hasil->data_seek(0); // Reset pointer
                    $counter = 0;
                    while($row = $hasil->fetch_assoc()){
                        $active_class = ($counter == 0) ? 'active' : '';
                        echo '<div class="carousel-item ' . $active_class . '">';
                        echo '<div class="ratio ratio-16x9">'; // Rasio aspek tetap untuk gambar
                        echo '<img src="img/' . $row["gambar"] . '" class="d-block w-100 img-fluid" alt="' . $row["judul"] . '">';
                        echo '</div>';
                        echo '<div class="carousel-caption d-none d-md-block">';
                        echo '<h5>' . $row["judul"] . '</h5>';
                        echo '</div>';
                        echo '</div>';
                        $counter++;
                    }
                    ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
    </section>

        <section id="schedule" class="text-start p-5 bg-body-light">
        <div class="container-schedule table-responsive">
            <div class="container-h2">
                <h2 class="fw-bold text-center mb-4">Schedule</h2>

                <!-- Tabel versi HP -->
                <div class="d-block d-md-none">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <div class="card mb-3 text-center" style="filter: invert(1);">SENIN</div>
                                    <li class="list-group-item">Technopreurrship 12.30-14.10 | Kulino.</li>
                                    <li class="list-group-item">Pendidikan Pancasila 14.10-15.40 | Aula.H.7</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <div class="card mb-3 text-center" style="filter: invert(1);">SELASA</div>
                                    <li class="list-group-item">Basis Data 08.40-10.20 | H.4.1</li>
                                    <li class="list-group-item">Logika Informatika 12.30-15.00 | H.4.9</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <div class="card mb-3 text-center" style="filter: invert(1);">RABU</div>
                                    <li class="list-group-item">Sistem Operasi 08.40-10.20 | H.4.8</li>
                                    <li class="list-group-item">Kalkulus 11.00-13.30</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <div class="card mb-3 text-center" style="filter: invert(1);">KAMIS</div>
                                    <li class="list-group-item">Probalitas Data Statistik 08.40-10.20 | H.4.9</li>
                                    <li class="list-group-item">Basis Data 13.20-15.30 | D.2.J</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <div class="card mb-3 text-center" style="filter: invert(1);">JUMAT</div>
                                    <li class="list-group-item">Rekayasa Perangkat Lunak 07.20-09.30 | H.5.3</li>
                                    <li class="list-group-item">Fisika 09.30-11.30 | H.5.6</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <div class="card mb-3 text-center" style="filter: invert(1);">SABTU</div>
                                    <li class="list-group-item">Dasar Komputasi 09.30-11.20 | D.3.M</li>
                                    <li class="list-group-item">Keamanan Data 12.30-15.20 | D.3.M</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel versi komputer -->
                <div class="d-none d-md-block">
                    <div class="d-flex justify-content-center pt-3 gap-5">
                        <div class="card" style="width: 18rem;">
                            <ul class="list-group list-group-flush">
                                <div class="card mb-3 text-center" style="filter: invert(1);">SENIN</div>
                                <li class="list-group-item">Technopreurrship 12.30-14.10 | Kulino.</li>
                                <li class="list-group-item">Pendidikan Pancasila 14.10-15.40 | Aula.H.7</li>
                            </ul>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <ul class="list-group list-group-flush">
                                <div class="card mb-3 text-center" style="filter: invert(1);">SELASA</div>
                                <li class="list-group-item">Basis Data 08.40-10.20 | H.4.1</li>
                                <li class="list-group-item">Logika Informatika 12.30-15.00 | H.4.9</li>
                            </ul>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <ul class="list-group list-group-flush">
                                <div class="card mb-3 text-center" style="filter: invert(1);">RABU</div>
                                <li class="list-group-item">Sistem Operasi 08.40-10.20 | H.4.8</li>
                                <li class="list-group-item">Kalkulus 11.00-13.30</li>
                            </ul>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <ul class="list-group list-group-flush">
                                <div class="card mb-3 text-center" style="filter: invert(1);">KAMIS</div>
                                <li class="list-group-item">Probalitas Data Statistik 08.40-10.20 | H.4.9</li>
                                <li class="list-group-item">Basis Data 13.20-15.30 | D.2.J</li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start pt-3 gap-5">
                        <div class="card" style="width: 18rem;">
                            <ul class="list-group list-group-flush">
                                <div class="card mb-3 text-center" style="filter: invert(1);">JUMAT</div>
                                <li class="list-group-item">Rekayasa Perangkat Lunak 07.20-09.30 | H.5.3</li>
                                <li class="list-group-item">Fisika 09.30-11.30 | H.5.6</li>
                            </ul>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <ul class="list-group list-group-flush">
                                <div class="card mb-3 text-center" style="filter: invert(1);">SABTU</div>
                                <li class="list-group-item">Dasar Komputasi 09.30-11.20 | D.3.M</li>
                                <li class="list-group-item">Keamanan Data 12.30-15.20 | D.3.M</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section id="About Me" class="py-5 border-top border-bottom" style="background-color: var(--bs-body-bg);">
      <div class="container">
        <h2 class="text-center">About Me</h2>
        <div class="row align-items-center justify-content-center">
          <div class="col-md-3 text-center text-md-start">
            <img src="img/saya.jpg" alt="Myyy" class="rounded-circle img-fluid" style="width: 150px; height: 150px; margin-top:20%;">
          </div>
          <div class="col-md-6 text-center text-md-start">
            <p>A11.2023.15046</p>
            <h2>Ahmad Helmi Afandi</h2>
            <p>Program Studi Teknik Informatika</p>
            <a href="https://dinus.ac.id/" class="nav-link active" text="fw-bold">Universitas Dian Nuswantoro</a>
          </div>
        </div>
      </div>
    </section>
        
    <footer class="text-center py-3" style="background-color: var(--bs-body-bg);">
      <div class="d-flex justify-content-center mb-2">
        <a href="https://www.instagram.com/helmiafandi_/profilecard/?igsh=bXVvbXB4bWdldXJ0" class="h2 p-2">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="https://twitter.com" class="h2 p-2">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="https://whatsapp.com" class="h2 p-2">
          <i class="fab fa-whatsapp"></i>
        </a>
      </div>
      <div class="footer">
        <p>&copy; Myyy2024. All Rights Reserved.</p>
      </div>
    </footer>
    
    <style>
        /* Atur warna bg-info menjadi bg-danger jika dark mode aktif */
        [data-bs-theme="dark"] .bg-info {
            background-color: #808080 !important; /* Bootstrap bg-danger */
        }
    </style>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        (() => {
            'use strict'

            const getStoredTheme = () => localStorage.getItem('theme')
            const setStoredTheme = theme => localStorage.setItem('theme', theme)

            const getPreferredTheme = () => {
            const storedTheme = getStoredTheme()
            if (storedTheme) {
                return storedTheme
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
            }

            const setTheme = theme => {
            if (theme === 'auto') {
                document.documentElement.setAttribute('data-bs-theme', (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'))
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
            }

            setTheme(getPreferredTheme())

            const showActiveTheme = (theme) => {
            const darkModeButton = document.querySelector('#dark-mode')
            const lightModeButton = document.querySelector('#light-mode')
            
            if (theme === 'dark') {
                darkModeButton.classList.add('active')
                lightModeButton.classList.remove('active')
            } else {
                lightModeButton.classList.add('active')
                darkModeButton.classList.remove('active')
            }
            }

            document.querySelector('#dark-mode').addEventListener('click', () => {
            setStoredTheme('dark')
            setTheme('dark')
            showActiveTheme('dark')
            })

            document.querySelector('#light-mode').addEventListener('click', () => {
            setStoredTheme('light')
            setTheme('light')
            showActiveTheme('light')
            })

            window.addEventListener('DOMContentLoaded', () => {
            showActiveTheme(getPreferredTheme())
            })
        })()
    </script>
    </script>
  </body>
</html>