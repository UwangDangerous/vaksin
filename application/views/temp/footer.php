    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- <script src="<?//= base_url(); ?>assets/bootstrap/js/bootstrap.bundle.js" ></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script> -->
    <script src="<?= base_url(); ?>assets/js/jquery-chained.min.js"></script>

    <script>
      // $(document).ready(function() {
        $("#prop").click(function(){
          $("#kota").chained("#prop");
        });
        $("#kota").click(function(){
          $("#kecamatan").chained("#kota");
        });
      // });
    </script>
  </body>
</html>