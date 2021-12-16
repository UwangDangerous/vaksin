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
        
        <title><?= $judul ; ?></title>
        <link rel="icon" href="<?= base_url();?>assets/img/logo-bpom.png">

        <script src="<?= base_url(); ?>assets/js/jquery.js" ></script>

        
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

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Master Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url(); ?>user">
                                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                        User
                                    </a>
                                    <a class="nav-link" href="<?= base_url(); ?>sample">
                                        <div class="sb-nav-link-icon"><i class="fas fa-vial"></i></div> Sample
                                    </a>
                                </nav>
                            </div>

                            <a class="nav-link" href="<?= base_url(); ?>sertifikat">
                                <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
                                Buat sertifikat
                            </a>
<!-- untuk pengawas -->
                            <a class="nav-link" href="<?= base_url(); ?>petugas">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                                Pilih Petugas
                            </a>

<?php elseif($lvl == 2) : ?> <!-- pengawas --> 
<?php elseif($lvl == 3) : ?> <!-- evaluator --> 
                            <a class="nav-link" href="<?= base_url(); ?>evaluasi">
                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                                Evaluasi Sample
                            </a>
<?php elseif($lvl == 4) : ?> <!-- Verifikator --> 
                            <a class="nav-link" href="<?= base_url(); ?>verifikasi">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-signature"></i></div>
                                Verifikasi Sample
                            </a>

<?php else : ?>

<?php endif ; ?>
                            
                            
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                Pengaturan Akun
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


                        
