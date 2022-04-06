<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <link rel="stylesheet" href="<?=base_url(); ?>assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/fontAwesome/css/all.css">
        <link rel="stylesheet" href="<?=base_url(); ?>assets/css/temp_style.css">
        <link rel="stylesheet" href="<?=base_url(); ?>assets/css/mystyle.css">
        <!-- <link rel="stylesheet" href="<?= base_url();?>assets/css/dataTables.css"> -->
        <link rel="stylesheet" href="<?= base_url();?>assets/css/dataTables.bootstrap4.min.css">



        <!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->



        <title><?= $judul ; ?></title>
        <link rel="icon" href="<?= base_url();?>assets/img/logo-bpom.png">
        
        <script src="<?= base_url(); ?>assets/js/jquery.js" ></script>
        
        <script src="<?= base_url(); ?>assets/js/dataTables.js" ></script>
        <script src="<?= base_url(); ?>assets/js/dataTables.bootstrap4.min.js" ></script>


        <script src="<?= base_url(); ?>assets/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

        
    </head> 
    <body >
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?= base_url() ; ?>dashboard">BPPB - PPPOMN</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav d-none d-md-inline-block form-inline ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url(); ?>auth/logout">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">
                                <?= $this->session->userdata('nama'); ?> <br>
                                <?= $this->session->userdata('nip'); ?>
                            </div>
<?php $lvl = $this->session->userdata('idLevel'); ?>
<?php if($lvl == 1) : ?> <!-- admin --> 
                            <!-- master data -->
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Master Data
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?= base_url(); ?>jenisSample">
                                            <div class="sb-nav-link-icon"><i class="fas fa-virus"></i></div>
                                            Jenis Vaksin
                                        </a>
                                        <a class="nav-link" href="<?= base_url(); ?>jenisSample/jenisPengujian">
                                            <div class="sb-nav-link-icon"><i class="fas fa-vial"></i></div>
                                            Jenis Pengujian
                                        </a>
                                        <a class="nav-link" href="<?= base_url(); ?>jenisSample/jenisKemasan">
                                            <div class="sb-nav-link-icon"><i class="fa fa-prescription-bottle"></i></div>
                                            Jenis Kemasan
                                        </a>
                                        <a class="nav-link" href="<?= base_url(); ?>jenisSample/jenisSample">
                                            <div class="sb-nav-link-icon"><i class="fas fa-vials"></i></div>
                                            Jenis Sample
                                        </a>
                                        <a class="nav-link" href="<?= base_url(); ?>jenisSample/dokumen">
                                            <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                            Jenis Dokumen
                                        </a>
                                        <a class="nav-link" href="<?= base_url(); ?>jenisSample/tugas">
                                            <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                                            Jenis Tugas
                                        </a>
                                        <a class="nav-link" href="<?= base_url(); ?>libur">
                                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-day"></i></div> Libur Nasional
                                        </a>
                                        <a class="nav-link" href="<?= base_url(); ?>form_gi">
                                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                            General Information
                                        </a>
                                    </nav>
                                </div>
                            <!-- master data -->

                            <!-- user -->
                                <a class="nav-link collapsed" href="#a" data-toggle="collapse" data-target="#user" aria-expanded="false" aria-controls="user">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    User
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="user" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?= base_url(); ?>user">
                                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                            Internal User
                                        </a>
                                        <a class="nav-link" href="<?= base_url(); ?>user/eksternal">
                                            <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                                            Eksternal User
                                        </a>
                                    </nav>
                                </div>
                            <!-- user -->

                            <!-- sample -->
                            <!-- <a class="nav-link collapsed" href="#a" data-toggle="collapse" data-target="#sample" aria-expanded="false" aria-controls="sample">
                                <div class="sb-nav-link-icon"><i class="fas fa-vials"></i></div>
                                Sampel
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a> -->
                            <!-- <div class="collapse" id="sample" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"> -->
                                    <a class="nav-link" href="<?= base_url(); ?>sample">
                                        <div class="sb-nav-link-icon">
                                            <!-- <i class="fa fa-envelope-open-text"></i> -->
                                            <i class="fa fa-vials"></i>
                                        </div>
                                        Sampel
                                    </a>
                                    <!-- <a class="nav-link" href="<?//= base_url(); ?>petugas">
                                        <div class="sb-nav-link-icon"><i class="fas fa-syringe"></i></div>
                                        Sampel
                                    </a> -->
                                    <!-- <a class="nav-link" href="<?//= base_url(); ?>pengujian">
                                        <div class="sb-nav-link-icon"><i class="fas fa-vial"></i></div>
                                        Pengujian
                                    </a> -->
                                    <!-- <a class="nav-link" href="<?//= base_url(); ?>sample/buktiBayar">
                                        <div class="sb-nav-link-icon"><i class="fas fa-money-check-alt"></i></i></div>
                                        Bukti Bayar
                                    </a>
                                </nav>
                            </div> -->
                            <!-- sample -->

                            <!-- sertifikat -->
                                <!-- <a class="nav-link collapsed" href="#a" data-toggle="collapse" data-target="#sertifikat" aria-expanded="false" aria-controls="sertifikat">
                                    <div class="sb-nav-link-icon"><i class="fa fa-file-signature"></i></div>
                                    Sertifikat
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="sertifikat" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?//= base_url(); ?>sertifikat/pelulusan">
                                            <div class="sb-nav-link-icon"><i class="fas fa-file-medical-alt"></i></div>
                                            Pelulusan
                                        </a>
                                        <a class="nav-link" href="<?//= base_url(); ?>pengujian">
                                            <div class="sb-nav-link-icon"><i class="fas fa-file-contract"></i></div>
                                            Pengujian
                                        </a>
                                    </nav>
                                </div> -->
                            <!-- sertifikat -->

                            <!-- untuk pengawas -->

<?php elseif($lvl == 2) : ?> <!-- pengawas --> 
                            <a class="nav-link" href="<?= base_url(); ?>dashboard?ok=mantap">
                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                                Evaluasi Sample
                            </a>
<?php elseif($lvl == 4) : ?> <!-- evaluator --> 
                            <a class="nav-link" href="<?= base_url(); ?>evaluasi">
                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                                Evaluasi Sample
                            </a>
<?php elseif($lvl == 3) : ?> <!-- Verifikator dan Evaluator -->

                            <!-- konfirmasi petugas -->
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false">
                                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-check"></i></div>
                                    Konfirmasi Petugas
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?= base_url(); ?>v_konfirmasi/pelulusan">
                                            <div class="sb-nav-link-icon"><i class="fas fa-file-signature"></i></div>
                                            Pelulusan
                                        </a>
                                        <a class="nav-link" href="<?= base_url(); ?>v_konfirmasi/pengujian">
                                            <div class="sb-nav-link-icon"><i class="fas fa-vial"></i></div>
                                            Pengujian
                                        </a>
                                    </nav>
                                </div>
                            <!-- Konfirmasi petugas -->
                            <a class="nav-link" href="<?= base_url(); ?>evaluasi">
                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                                Evaluasi Sample
                            </a> 
                            <a class="nav-link" href="<?= base_url(); ?>verifikasi_">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-signature"></i></div>
                                Verifikasi Sample
                            </a>

<?php else : ?>

<?php endif ; ?>
                            
                            
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                Pengaturan Akun
                            </a>

                            <a class="nav-link" href="<?= base_url(); ?>auth/logout">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?= $this->session->userdata('namaLevel'); ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><?= $header; ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"> <?= $bread; ?> </li>
                        </ol>


                        
