
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


        <script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.js" ></script>
        <script src="<?= base_url(); ?>assets/js/script.js" ></script>

        <script>
            $(document).ready(function(){
                $("#ok").click(function(){
                    $.ajax({
                        url: '<?= base_url(); ?>coba',
                        type: 'get',
                        data: $(this).serialize(),             
                        success: function(data) {               
                            $('#coba').html(data) ;      
                        }
                    });
                });
            });
        </script>

    <script src="<?= base_url(); ?>assets/js/dataTables.js" ></script>
    <script>
        $(document).ready(function() {
            $('#cobaTable').dataTable();
        } );
    </script>
    </body>
</html>