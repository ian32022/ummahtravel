<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Pemesanan | Nasrotul Ummah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Scheherazade&display=swap">
    <style>
        /* Gaya Kustom untuk halaman form_pemesanan (Menyesuaikan dengan gambar) */
        
        /* Warna Navbar dan Footer */
        .navbar, footer {
            background-color: #1A061F !important;
        }

        /* Jarak Konten Utama dari Navbar Fixed */
        .form-section {
            padding-top: 100px;
            padding-bottom: 50px;
        }

        /* Box untuk setiap section (mirip card) */
        .section-box {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Sedikit shadow */
        }

        .section-box h5 {
            color: #1A061F;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 1.1rem;
        }

        /* Penyesuaian Ringkasan Harga (Kolom Kiri Bawah) */
        .summary-box {
            background-color: #f8f9fa; /* Latar belakang abu muda */
            border: 1px solid #dee2e6;
        }
        .summary-box p {
            margin-bottom: 8px;
        }
        .summary-box .highlight {
            background-color: #ffc107; /* Warna kuning */
            padding: 10px;
            border-radius: 5px;
            font-size: small;
            margin-top: 15px;
            color: #1A061F;
            font-weight: bold;
        }
        
        /* Input Tipe Kamar (Tombol Radio Custom) */
        .room-type-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .room-type-label:hover {
            background-color: #f1f1f1;
        }
        /* Style saat radio button dipilih */
        input[type="radio"]:checked + .room-type-label {
            border-color: #1A061F;
            background-color: #f0f0ff; 
        }
        .room-price {
            background-color: #1A061F;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        /* Logo di Navbar */
        .navbar-brand.arabic-logo {
            font-family: 'Scheherazade', serif;
            font-size: 1.5rem;
            color: white;
        }

        /* Tombol Aksi */
        .btn-kembali {
            background-color: #1A061F;
            color: white;
            border: none;
            padding: 10px 30px;
        }
        .btn-lanjutkan {
            background-color: #00ff8c; /* Warna hijau muda sebagai aksi utama */
            color: #1A061F;
            border: none;
            padding: 10px 30px;
            font-weight: bold;
        }
        
        /* Penyesuaian Footer */
        footer h5 {
            color: #00ff8c !important; /* Mengembalikan warna hijau untuk judul footer */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand arabic-logo" href="#">Nasrotul Ummah</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.html">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="tentangkami.html">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link active" href="daftarumroh.html">Daftar Umroh</a></li>
                    <li class="nav-item"><a class="nav-link" href="umrohsaya.html">Umroh Saya</a></li>
                    <li class="nav-item"><a class="nav-link" href="hubungi-kami.html">Hubungi Kami</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="form-section bg-light">
        <div class="container">
            <div class="row">

                <div class="col-lg-4">

                    <div class="section-box">
                        <h5 class="mb-3">Paket Yang Dipilih *</h5>

                        <div class="mb-3">
                            <select id="paket_dipilih" class="form-select">
                                <option selected>Paket Ekonomi - 12 Hari</option>
                            </select>
                        </div>

                        <h5 class="mb-3">Tanggal Keberangkatan *</h5>
                        
                        <div class="mb-3">
                            <input type="date" class="form-control" id="tanggal_keberangkatan" value="2025-01-22" required>
                        </div>
                        
                        <h5 class="mt-4 mb-3">Tipe Kamar *</h5>
                        
                        <div>
                            <input type="radio" id="double" name="tipe_kamar" class="d-none" checked>
                            <label for="double" class="room-type-label">
                                <div>
                                    <p class="mb-0 fw-bold">Double <small class="text-muted">(2 orang per kamar)</small></p>
                                </div>
                                <span class="room-price">Rp 30.000.000</span>
                            </label>
                            
                            <input type="radio" id="triple" name="tipe_kamar" class="d-none">
                            <label for="triple" class="room-type-label">
                                <div>
                                    <p class="mb-0 fw-bold">Triple <small class="text-muted">(3 orang per kamar)</small></p>
                                </div>
                                <span class="room-price">Rp 25.000.000</span>
                            </label>

                            <input type="radio" id="quad" name="tipe_kamar" class="d-none">
                            <label for="quad" class="room-type-label">
                                <div>
                                    <p class="mb-0 fw-bold">Quad <small class="text-muted">(4 orang per kamar)</small></p>
                                </div>
                                <span class="room-price">Rp 22.000.000</span>
                            </label>
                        </div>
                    </div>

                    <div class="section-box summary-box">
                        <h5 class="mb-3">Ringkasan Harga</h5>
                        <p>Paket: <span class="float-end fw-bold">Paket Ekonomi</span></p>
                        <p>Tanggal Berangkat: <span class="float-end fw-bold">22 Januari 2025</span></p>
                        <p>Tipe Kamar: <span class="float-end fw-bold">Quad</span></p>
                        <hr>
                        <p class="fw-bold fs-5">Total Per Orang <span class="float-end text-success">Rp 22.000.000</span></p>
                        <div class="highlight text-center">
                            *Hemat lebih banyak dengan memilih kamar Triple atau Quad!
                        </div>
                    </div>

                </div>

                <div class="col-lg-8">
                    <form>
                        <div class="section-box">
                            <h5 class="mb-4">Data Diri Jamaah</h5>
                            
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label small mb-0">Nama Lengkap *</label>
                                <input type="text" class="form-control" id="nama_lengkap" placeholder="Sesuai KTP/Paspor" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="email" class="form-label small mb-0">Email *</label>
                                    <input type="email" class="form-control" id="email" placeholder="email@example.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nomor_telepon" class="form-label small mb-0">Nomor Telepon *</label>
                                    <input type="text" class="form-control" id="nomor_telepon" placeholder="08xxxxxxxxxxx" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="alamat_lengkap" class="form-label small mb-0">Alamat Lengkap *</label>
                                <input type="text" class="form-control" id="alamat_lengkap" placeholder="Jalan, No. Rumah, RT/RW" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="kota_kabupaten" class="form-label small mb-0">Kota/Kabupaten *</label>
                                    <input type="text" class="form-control" id="kota_kabupaten" placeholder="Nama kota" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="provinsi" class="form-label small mb-0">Provinsi *</label>
                                    <input type="text" class="form-control" id="provinsi" placeholder="Nama provinsi" required>
                                </div>
                            </div>
                            
                            <div class="mb-3 col-md-4 px-0">
                                <label for="kode_pos" class="form-label small mb-0 ps-3">Kode Pos *</label>
                                <input type="text" class="form-control" id="kode_pos" placeholder="12345" required>
                            </div>
                        </div>

                        <div class="section-box">
                            <h5 class="mb-4">Kontak Darurat</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_darurat" class="form-label small mb-0">Nama Kontak Darurat *</label>
                                    <input type="text" class="form-control" id="nama_darurat" placeholder="Nama keluarga/teman" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nomor_darurat" class="form-label small mb-0">Nomor Telepon Darurat *</label>
                                    <input type="text" class="form-control" id="nomor_darurat" placeholder="08xxxxxxxxxxx" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-4">
                            <a href="detail_dubai.html" class="btn btn-kembali me-3 text-decoration-none">Kembali</a>
                            <a href="konfirmasi_pemesanan.html" class="btn btn-lanjutkan text-decoration-none">Lanjutkan</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5 class="text-warning">Sosial Media</h5>
                    <p class="small">Jangan lewatkan informasi lainnya di sosial media rabbanihtour</p>
                    <ul class="list-unstyled small">
                        <li>@ummahTravel</li>
                        <li>@ummahTravel.pdg</li>
                        <li>@ummahTravel.bdg</li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="text-warning">Kantor Jakarta</h5>
                    <p class="small">Jl. RS. Fatmawati Raya No.215, RT.5/RW.3, Cilandak Barat,<br>Kec. Cilandak, Kota Jakarta Selatan</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="text-warning">Kantor Padang</h5>
                    <p class="small">Jl. Koto Tuo No.4, Balai Gadang,<br>Kec. Koto Tangah, Kota Padang</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="text-warning">Kantor Bandung</h5>
                    <p class="small">Jl. Jurang No.84, Pasteur, Kec. Sukajadi,<br>Kota Bandung</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>