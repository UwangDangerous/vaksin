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
        
        <script src="<?= base_url(); ?>assets/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>


        
    </head> 
    <body >
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?= base_url() ; ?>dashboard">Nama Web</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav d-none d-md-inline-block form-inline ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url(); ?>auth/logoutEks">Logout</a>
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
                                <?= $this->session->userdata('eksNama'); ?> 
                            </div>
                            
                            
                            <a class="nav-link" href="<?= base_url(); ?>surat/kirim">
                                <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                                Surat Pengiriman Sample
                            </a>
                            <a class="nav-link" href="<?= base_url(); ?>surat">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Riwayat dan Keterangan
                            </a>
                            <a class="nav-link" href="<?= base_url(); ?>surat/penundaan">
                                <div class="sb-nav-link-icon"><i class="fa fa-clock"></i></div>
                                Penundaan
                            </a>
                            <a class="nav-link" href="<?= base_url(); ?>surat/pengaturan">
                                <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                Pengaturan
                            </a>
                            <a class="nav-link" href="<?= base_url(); ?>auth/logoutEks">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?= $this->session->userdata('eksNama'); ?>
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
                        
