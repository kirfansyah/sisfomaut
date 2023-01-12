 </div>
      <!-- End of Main Content -->
<!-- Footer -->
      <footer class="sticky-footer bg-white">  
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Aplikasiku <?php echo date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url('auth/logout') ;?>">Logout</a>
        </div>
      </div>
    </div>
  </div>
<!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url() ?>assets/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo base_url() ?>assets/js/demo/chart-pie-demo.js"></script>

 <!-- Page level plugins -->
  <script src="<?php echo base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url() ?>assets/js/demo/datatables-demo.js"></script>

  <script>
    $(document).ready(function(){

        mapRute()      

        function mapRute(){
          var map = L.map('maprute').setView([5.216585, 97.061562], 15);

           L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
              }).addTo(map);

            $.ajax({
            url: "<?php echo base_url('astar/f_simpul') ?>",
            type: 'post',
            dataType: 'json',
            success: function(data){
             var data = data.posts;
             console.log(data)
             for (var i = 0; i < data.length; i++) {
               // console.log(data[i].sLatitude);

                L.marker([data[i].sLatitude, data[i].sLongitude]).bindPopup(data[i].nama_simpul).addTo(map);
                console.log(data[i].sLatitude)
             }
            }
          });
        }

        $('#cari').on('click', function(){

          var titik_awal = $('#titik_awal').val();
          var titik_akhir = $('#titik_akhir').val();

          if(titik_awal != ''&&titik_akhir!= '')
          {
            
            $.ajax({
            url: "<?php echo base_url('astar/cari_rute') ?>",
            type: 'post',
            dataType: 'json',
            data: {
              titik_awal: titik_awal,
              titik_akhir: titik_akhir
            },
            success: function(data){
             console.log(data)
             $('#mapcontainer3').html('').append('<div id="maprute" style="width: 100%; height: 400px;"></div>');
             var map = L.map('maprute').setView([data.marker[0].mlatitude, data.marker[0].mlongitude], 15);

             L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
             console.log(data.marker)
              for (var i = 0; i < data.marker.length; i++) {
               // console.log(data[i].sLatitude);

                L.marker([data.marker[i].mlatitude, data.marker[i].mlongitude]).bindPopup('h').addTo(map);
                
             }

             var isi = []              
              
                data.kordinat.forEach(function(e){
                  isi.push([e.rlatitude, e.rlongitude],);
                }); 

                L.polyline(isi).addTo(map);
            },error: function(request, status, error){
              // alert(request.responseText)
              Swal.fire(
                'Perhatian!',
                'Data Graph Tidak Ditemukan!',
                'warning'
              )
            }
          });

          }else{
            alert('isi dulu')
          }

            

       });

    }); // end document

</script>
</body>

</html>