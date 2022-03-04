<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url(); ?>">
          <div class="row">
              <div class="col-md"><img src="<?=base_url();?>assets/img/logo-bpom.png" alt="<?= SEO ; ?>" width="40px"></div>
              <div class="col-md"> <h5> BADAN PENGAWAS OBAT DAN MAKANAN <br> <span style="font-size:15px">Lorem ipsum dolor sit amet.</span></h5> </div>
          </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item sorot">
          <a class="nav-link" href="<?= base_url(); ?>">Home</a>
        </li>
        <li class="nav-item sorot">
          <a class="nav-link" href="<?= base_url(); ?>auth">Login</a>
        </li>
        <li class="nav-item sorot">
          <a class="nav-link" href="<?= base_url(); ?>auth/register">Registrasi Akun</a>
        </li>
        <li class="nav-item sorot">
          <a class="nav-link" href="<?= base_url(); ?>#informasi">Informasi</a>
        </li>
        <li class="nav-item sorot">
          <a class="nav-link" href="<?= base_url(); ?>#faq">FAQ</a>
        </li>
        <li class="nav-item sorot">
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">Lot Release</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="#">Impor</a></li>
              <li><a class="dropdown-item" href="#">Domestik</a></li>
            </ul>
          </div>
        </li>
        

        <li class="nav-item">
          <?php if($this->session->userdata('key')) : ?>
            <a class="nav-link" href="<?=base_url();?>dashboard" data-toogle='tooltip' title='Dashboard'>
              Dashboard
            </a>
          <?php elseif($this->session->userdata('eksId')) : ?>
            <a class="nav-link" href="<?=base_url();?>dsb" data-toogle='tooltip' title='Dashboard'>
              Dashboard
            </a>
          <?php endif ; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>