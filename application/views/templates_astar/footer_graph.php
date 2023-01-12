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

      t_graph()

      function t_graph()
      {
        $.ajax({
          url: "<?php echo base_url('astar/f_graph') ?>",
          type: 'post',
          dataType: 'json',
          success: function(data){
            // console.log(data)
          var i = '1';
            $('#i_graph').DataTable({
              "data": data.posts,              
              "columns":[
                {"render": function(){
                  return a = i++;
                }},     
                {"data": "graphAwal"}, 
                {"data": "graphAkhir"}, 
                {"data": "graphJarak"}, 
                {"render": function(data,type,row,meta){
                  var a = `
                        <a href="#" value="${row.id_graph}" id="del_graph" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                        
                  `;
                  return a;
                }}
              ]
            });
          }
        });
      }

      // Tambah data graph

       $('#tambah_data_graph').on('submit', function(e){
          e.preventDefault();

          $.ajax({
            url: '<?php echo base_url()."astar/t_graph" ?>',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
              $('#file1').val('');
              // alert(data);
              Swal.fire(
                'Berhasil!',
                'Data Berhasil Ditambahkan!',
                'success'
              )
              console.log(data)
              $("#tambah_graph").modal('hide');
              $('#i_graph').DataTable().destroy();
              t_graph();
               $('#mapcontainer2').html('').append('<div id="mapku" style="width: 100%; height: 400px;"></div>');
               mapGrap();

            }
          })
       }); 

      //del graph 
      $(document).on("click", "#del_graph", function(e){
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
              url: '<?php echo base_url()."astar/del_graph" ?>',            
              success: function(data){
                swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              );
               $('#i_graph').DataTable().destroy();
                t_graph();
                $('#mapcontainer2').html('').append('<div id="mapku" style="width: 100%; height: 400px;"></div>');
               mapGrap();
                
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
              $('#i_graph').DataTable().destroy();
              t_graph();;
            }
          })             
      });     

      mapGrap()      

        function mapGrap(){
          var mapg = L.map('mapku').setView([5.216585, 97.061562], 14);

           L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
              }).addTo(mapg);

            $.ajax({
              url: "<?php echo base_url('astar/f_graph2') ?>",
              type: 'post',
              dataType: 'json',
              success: function(data){
               var line = data.posts[0];
               var markerku = data.posts[1];
               console.log(markerku)
               for (var i = 0; i < markerku.length; i++) {

                  L.marker([markerku[i].sLatitude, markerku[i].sLongitude]).bindPopup(markerku[i].nama_simpul).addTo(mapg);
               }

               if(line){
                var isi = []              
              
                line.forEach(function(e){
                  isi.push([[e.latitude, e.longitude],
                          [e.latitude2, e.longitude2],],);
                }); 

                L.polyline(isi).addTo(mapg);
               }
               
                // L.polyline([[5.2024481892155, 97.063822563588],   
                //           [5.2021116230005, 97.063642]]).addTo(mapg); 
              }
            });

        }

    }); // end document

</script>



</body>

</html>