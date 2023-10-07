<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wisata</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
<style>
    .id {
        display: none;
    }

    .card {
        transition: all 0.3s;
    }

    .card:hover {
        transform: scale(1.07);
    }
</style>

<body">
    <div class="container mt-5 px-5">
        <div class="text-center">
            <h1><img src="image/Logo_Pati.png" class="rounded" width="200" alt="..."> DAFTAR WISATA KABUPATEN PATI</h1>
        </div>
        <form action="" method="post">
            <div class="input-group mt-5 mb-5">
                <select class="form-select" name="keyword1">
                    <option selected>Jenis Wisata</option>
                    <option value="Wisata Alam">Wisata Alam</option>
                    <option value="Wisata Budaya">Wisata Budaya</option>
                    <option value="Wisata Kerajinan">Wisata Kerajinan</option>
                    <option value="Wisata Kuliner">Wisata Kuliner</option>
                    <option value="Wisata Religi">Wisata Religi</option>
                    <option value="Wisata Sejarah">Wisata Sejarah</option>
                </select>
                <input type="text" name="keyword2" nam class="form-control" placeholder="Cari Wisata">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>
        <?php
        $no = 1;
        $noo = 1;
        $nooo = 1;
        $noooo = 1;
        $nooooo = 1;
        require_once("sparqllib.php");
        $test = "";
        $test2 = "";
        if (isset($_POST['keyword1'])) {
            $test = $_POST['keyword1'];
            $test2 = $_POST['keyword2'];
            $data = sparql_get(
                "http://localhost:3030/semantik",
                "
                PREFIX schema: <http://schema.org/>
                PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
                PREFIX data: <http://www.semanticweb.org/asus/ontologies/2021/1/wisata#> 
                SELECT ?ObyekWisata ?JenisWisata ?JenisWisata2 ?JenisWisata3 ?JenisWisata4 ?Deskripsi ?Deskripsi2 ?Deskripsi3 ?Deskripsi4 ?Desa ?Desa2 ?Desa3 ?Desa4 ?Kecamatan ?Kecamatan2 ?Kecamatan3 ?Kecamatan4 ?Telpon ?Telpon2 ?Telpon3 ?Telpon4 ?Broader ?Narrower ?Related ?Gambar ?Gambar2 ?Gambar3 ?Gambar4 ?Toilet ?Toilet2 ?Toilet3 ?Toilet4 ?Wifi ?Wifi2 ?Wifi3 ?Wifi4 ?Mushola ?Mushola2 ?Mushola3 ?Mushola4
                WHERE { 
                ?wisata data:beradaDi ?Tempat;
                        data:namaObyek ?ObyekWisata;
                        data:deskripsiWisata ?Deskripsi;
                        data:telpon ?Telpon;
                        schema:image ?Gambar.
                ?Tempat data:dimiliki ?wisata;
                        data:jenisWisata ?JenisWisata;
                        data:desa ?Desa;
                        data:kecamatan ?Kecamatan.
                
                OPTIONAL {?wisata skos:broader ?broader.
                    ?broader data:beradaDi ?Tempat1;
                            data:namaObyek ?Broader;
                            data:deskripsiWisata ?Deskripsi2;
                            data:telpon ?Telpon2;
                            schema:image ?Gambar2.
                    ?Tempat1 data:dimiliki ?broader;
                            data:jenisWisata ?JenisWisata2;
                            data:desa ?Desa2;
                            data:kecamatan ?Kecamatan2.
                    
                    OPTIONAL{?broader data:memiliki ?fasilitas2.
                        ?fasilitas2 data:toilet ?Toilet2.}
                    OPTIONAL {?broader data:memiliki ?fasilitas2.
                        ?fasilitas2 data:wifi ?Wifi2.}
                    OPTIONAL {?broader data:memiliki ?fasilitas2.
                        ?fasilitas2 data:mushola ?Mushola2.}}
                
                OPTIONAL {?wisata skos:narrower ?narrower.
                    ?narrower data:beradaDi ?Tempat2;
                            data:namaObyek ?Narrower;
                            data:deskripsiWisata ?Deskripsi3;
                            data:telpon ?Telpon3;
                            schema:image ?Gambar3.
                    ?Tempat2 data:dimiliki ?narrower;
                            data:jenisWisata ?JenisWisata3;
                            data:desa ?Desa3;
                            data:kecamatan ?Kecamatan3.
                    
                    OPTIONAL{?narrower data:memiliki ?fasilitas3.
                    ?fasilitas3 data:toilet ?Toilet3.}
                    OPTIONAL {?narrower data:memiliki ?fasilitas3.
                    ?fasilitas3 data:wifi ?Wifi3.}
                    OPTIONAL {?narrower data:memiliki ?fasilitas3.
                    ?fasilitas3 data:mushola ?Mushola3.}}
                
                OPTIONAL {?wisata skos:related ?related.
                    ?related data:beradaDi ?Tempat3;
                            data:namaObyek ?Related;
                            data:deskripsiWisata ?Deskripsi4;
                            data:telpon ?Telpon4;
                            schema:image ?Gambar4.
                    ?Tempat3 data:dimiliki ?related;
                            data:jenisWisata ?JenisWisata4;
                            data:desa ?Desa4;
                            data:kecamatan ?Kecamatan4.
                    
                    OPTIONAL{?related data:memiliki ?fasilitas4.
                    ?fasilitas4 data:toilet ?Toilet4.}
                    OPTIONAL {?related data:memiliki ?fasilitas4.
                    ?fasilitas4 data:wifi ?Wifi4.}
                    OPTIONAL {?related data:memiliki ?fasilitas4.
                    ?fasilitas4 data:mushola ?Mushola4.}}
                
                OPTIONAL{?wisata data:memiliki ?fasilitas.
                    ?fasilitas data:toilet ?Toilet.}
                OPTIONAL {?wisata data:memiliki ?fasilitas.
                    ?fasilitas data:wifi ?Wifi.}
                OPTIONAL {?wisata data:memiliki ?fasilitas.
                    ?fasilitas data:mushola ?Mushola.}
                    FILTER (regex(?JenisWisata,'$test') && regex(?ObyekWisata,'$test2'))
                } "
            );
            echo '<div class="row row-cols-1 row-cols-md-5 g-4 mb-5">';
            foreach ((array) $data as $dat) { ?>
                <div class="col">
                    <div class="card h-100">
                        <img width="200" src="<?= $dat["Gambar"] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $noo++ ?>. <?= $dat["ObyekWisata"] ?></h5>
                            <p class="card-text"><?= $dat["Desa"] ?>, <?= $dat["Kecamatan"] ?></p>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#detail_<?= $noo ?>">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="detail_<?= $noo ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Wisata</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <img src="<?= $dat["Gambar"] ?>" class="rounded" width="500">
                                </div>
                                <table class="table table-borderless mt-3">
                                    <tbody>
                                        <tr>
                                            <th>Nama Wisata</th>
                                            <td><?= $dat["ObyekWisata"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kategori</th>
                                            <td><?= $dat["JenisWisata"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi</th>
                                            <td><?= $dat["Deskripsi"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td><?= $dat["Desa"] ?> , <?= $dat["Kecamatan"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Narahubung</th>
                                            <td><?= $dat["Telpon"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Fasilitas</th>
                                            <td><?= $dat["Toilet"] ?> , <?= $dat["Mushola"] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5>Disarankan</h5>
                                <div>
                                    <h6 class="id"><?= $no++ ?></h6><button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModalToggle_<?= $no ?>"><?= $dat["Broader"] ?></button>
                                </div>
                                <div>
                                    <h6 class="id"><?= $nooo++ ?></h6><button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModalToggle2_<?= $nooo ?>"><?= $dat["Narrower"] ?></button>
                                </div>
                                <div>
                                    <h6 class="id"><?= $noooo++ ?></h6><button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModalToggle3_<?= $noooo ?>"><?= $dat["Related"] ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModalToggle_<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Wisata</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <img src="<?= $dat["Gambar2"] ?>" class="rounded" width="500">
                                </div>
                                <table class="table table-borderless mt-3">
                                    <tbody>
                                        <tr>
                                            <th>Nama Wisata</th>
                                            <td><?= $dat["Broader"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kategori</th>
                                            <td><?= $dat["JenisWisata2"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi</th>
                                            <td><?= $dat["Deskripsi2"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td><?= $dat["Desa2"] ?> , <?= $dat["Kecamatan2"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Narahubung</th>
                                            <td><?= $dat["Telpon2"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Fasilitas</th>
                                            <td><?= $dat["Toilet2"] ?> , <?= $dat["Mushola2"] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#detail_<?= $noo ?>">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModalToggle2_<?= $nooo ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Wisata</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <img src="<?= $dat["Gambar3"] ?>" class="rounded" width="500">
                                </div>
                                <table class="table table-borderless mt-3">
                                    <tbody>
                                        <tr>
                                            <th>Nama Wisata</th>
                                            <td><?= $dat["Narrower"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kategori</th>
                                            <td><?= $dat["JenisWisata3"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi</th>
                                            <td><?= $dat["Deskripsi3"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td><?= $dat["Desa3"] ?> , <?= $dat["Kecamatan3"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Narahubung</th>
                                            <td><?= $dat["Telpon3"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Fasilitas</th>
                                            <td><?= $dat["Toilet3"] ?> , <?= $dat["Mushola3"] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#detail_<?= $noo ?>">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModalToggle3_<?= $noooo ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Wisata</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <img src="<?= $dat["Gambar4"] ?>" class="rounded" width="500">
                                </div>
                                <table class="table table-borderless mt-3">
                                    <tbody>
                                        <tr>
                                            <th>Nama Wisata</th>
                                            <td><?= $dat["Related"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kategori</th>
                                            <td><?= $dat["JenisWisata4"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi</th>
                                            <td><?= $dat["Deskripsi4"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td><?= $dat["Desa4"] ?> , <?= $dat["Kecamatan4"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Narahubung</th>
                                            <td><?= $dat["Telpon4"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Fasilitas</th>
                                            <td><?= $dat["Toilet4"] ?> , <?= $dat["Mushola4"] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#detail_<?= $noo ?>">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            echo '</div>';
        } else {
            $data = sparql_get(
                "http://localhost:3030/Web_Semantik",
                "
                PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
                PREFIX schema: <http://schema.org/>
                PREFIX data: <http://www.semanticweb.org/asus/ontologies/2021/1/wisata#> 
                SELECT ?Judul ?Tanggal ?Isi ?Gambar
                WHERE { ?berita data:judulBerita ?Judul;
                                data:tanggalBerita ?Tanggal;
                                data:isiBerita ?Isi;
                                schema:image ?Gambar.
                } "
            );
            echo '<div id="carouselExampleDark" class="carousel carousel-dark slide">';
            echo '<div class="carousel-inner">';
            foreach ((array) $data as $dat) { ?>
                <div class="carousel-item active">
                    <div class="card mb-5">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <img src="<?= $dat["Gambar"] ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h6 class="id"><?= $nooooo++ ?></h6>
                                    <h5 class="card-title"><?= $dat["Judul"] ?></h5>
                                    <footer class="blockquote-footer mt-3">Admin, <?= $dat["Tanggal"] ?></footer>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#Berita_<?= $nooooo ?>">
                                        Baca Selengkapnya
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="Berita_<?= $nooooo ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Berita</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img src="<?= $dat["Gambar"] ?>" class="rounded" width="500">
                                    </div>
                                    <div class="modal-body">
                                        <?= $dat["Isi"] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

        <?php }
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    </body>

</html>