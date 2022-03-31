
                    <div id="coba"></div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


        <!-- <script src="<?//= base_url(); ?>assets/bootstrap/js/bootstrap.js" ></script> -->
        <script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.bundle.js" ></script>
        <script src="<?= base_url(); ?>assets/js/script.js" ></script>


        <!-- Initialize Quill editor -->
        <script>
            tinymce.init({
                selector: '#mytextarea'
            });
        </script>





        <script>
            $(document).ready(function() {
                $('#jenisSample').dataTable();

                $('#libur').dataTable();

                $('#tabel_form_gi').dataTable();

                $('#internal-user').dataTable();

                $('#eksternal-user').dataTable();

                $('#tabel-surat').dataTable();

                $('#tabel-sampel').dataTable();

                $('#tabel-pengujian').dataTable();

                $('#tabel-bukti-bayar').dataTable();

                $('#cobaTable').dataTable();

                $('#sampel-evaluasi').dataTable();

                $('#jenisPengujian').dataTable();

                $('#tabelManufactureXjenisSample').dataTable();

                $('#tabel_tambah_pengujian').dataTable();

                $('#tabel-tugas').dataTable();

            } );
        </script>

    </body>
</html>