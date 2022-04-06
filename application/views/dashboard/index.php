<?php if($this->session->userdata('idLevel') == 3) : ?>
    <div id="verifikator"></div>
<?php endif ; ?>


<script>
    $("#verifikator").load("<?= base_url();?>dashboard/verifikator") ;
</script>