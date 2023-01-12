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


      mapSimpul()

      // Tampil data simpul
      t_simpul()

      function t_simpul(){
        $.ajax({
          url: "<?php echo base_url('astar/f_simpul') ?>",
          type: 'post',
          dataType: 'json',
          success: function(data){
          var i = '1';
            $('#i_simpul').DataTable({
              "data": data.posts,              
              "columns":[
                {"render": function(){
                  return a = i++;
                }},     
                {"data": "nama_simpul"}, 
                {"render": function(data,type,row,meta){
                  var a = `
                        <a href="#" value="${row.id_simpul}" id="del_simpul" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                        
                  `;
                  return a;
                }}
              ]
            });
          }
        });
       }

       $('#simpan_simpul').on('click', function(){

        var nama_simpul = $('#nama_simpul').val();
        var sLatitude = $('#sLatitude').val();
        var sLongitude = $('#sLongitude').val();

        $.ajax({
          url: "<?php echo base_url('astar/t_simpul') ?>",
          type: 'post',
          data: {
            nama_simpul: nama_simpul,
            sLatitude: sLatitude,
            sLongitude: sLongitude
          },
          dataType: 'json',
          success: function(data){
            if(data==''){

              console.log('gagal')

            }else{

              console.log(data)
              Swal.fire(
                  'Berhasil!',
                  'Data Berhasil Ditambahkan!',
                  'success'
                )            
                $('#i_simpul').DataTable().destroy();
                t_simpul();
                $('#mapcontainer').html('').append('<div id="mapidi" style="width: 100%; height: 400px;"></div>');              
                mapSimpul();
                

            }           
          
          }
        });

       });

      //del simpul 
      $(document).on("click", "#del_simpul", function(e){
        e.preventDefault();
        var del_id = $(this).attr("value");
       

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
          })

          swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {

            $.ajax({
              type: 'POST',
              data: {del_id: del_id},
              url: '<?php echo base_url()."astar/del_simpul" ?>',            
              success: function(data){
                swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              );
               $('#i_simpul').DataTable().destroy();
                t_simpul();
                $('#mapcontainer').html('').append('<div id="mapidi" style="width: 100%; height: 400px;"></div>');              
                mapSimpul();
                
              }
            }) 

              
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
              )
              $('#i_simpul').DataTable().destroy();
              t_simpul();;
            }
          })             
      });
  
      function mapSimpul(){
        // map.off();
        // map.remove(); 

      var map = L.map('mapidi').setView([5.216585, 97.061562], 14);

       L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
          }).addTo(map);
          

         $.ajax({
          url: "<?php echo base_url('astar/f_simpul') ?>",
          type: 'post',
          dataType: 'json',
          success: function(data){
           var data = data.posts;
           for (var i = 0; i < data.length; i++) {
             console.log(data[i].sLatitude);

              L.marker([data[i].sLatitude, data[i].sLongitude]).bindPopup(data[i].nama_simpul).addTo(map);
           }
          }
        });
         
      } // end mapSimpul

      

        function mapGrap(){
          var mapg = L.map('mapku').setView([5.216585, 97.061562], 14);

           L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
              }).addTo(mapg);

            $.ajax({
              url: "<?php echo base_url('astar/f_graph') ?>",
              type: 'post',
              dataType: 'json',
              success: function(data){
               var data = data.posts;
               for (var i = 0; i < data.length; i++) {
                 console.log("halo");

                  L.marker([data[i].sLatitude, data[i].sLongitude]).bindPopup(data[i].nama_simpul).addTo(mapg);
               }

              }
            });

          
        }
      
      

   

    }); // end document

</script>



</body>

</html>