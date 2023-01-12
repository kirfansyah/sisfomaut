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

      t_data_rekap()
      t_pembobotan_k()
      t_bobot()  

      

      $('.custom-file-input').on('change', function(){
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
      });

      $('.form-check-input').on('click', function(){ 

      const menuId = $(this).data('menu');
      const roleId = $(this).data('role');

      $.ajax({
          url: "<?= base_url('admin/changeaccess'); ?>",
          type: 'post',
          data: {
            menuId: menuId,
            roleId: roleId
          },
          success: function() {
            document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
          }
        });
      });

      // Tampil data rekap

      function t_data_rekap(){
        $.ajax({
          url: "<?php echo base_url('maut/f_rekap_data') ?>",
          type: 'post',
          dataType: 'json',
          success: function(data){
          var i = '1';
            $('#i_rekap_data').DataTable({
              "data": data.posts,              
              "columns":[
                {"render": function(){
                  return a = i++;
                }},     
                {"data": "nama_kost"},          
                {"data": "jenis_kost"},
                {"data": "alamat_lengkap"},
                {"data": "harga_kost"},
                {"render": function(data,type,row,meta){
                  var a = `
                        <a href="#" value="${row.id_rekap_data_kost}" id="del_data_rekap" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                        <a href="#" value="${row.id_rekap_data_kost}" id="edit_data_rekap" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                        <a href="<?php echo base_url('maut/detail_data_rekap/${row.id_rekap_data_kost}') ?>" value="${row.id_rekap_data_kost}" id="detail_data_rekap" class="btn btn-sm btn-outline-warning"><i class="fas fa-search-plus"></i></a>
                        
                  `;
                  return a;
                }}
              ]
            });
          }
        });
       }

       // Tambah data rekap

       $('#tambah_data_rekap').on('submit', function(e){
          e.preventDefault();

          $.ajax({
            url: '<?php echo base_url()."maut/t_data_rekap" ?>',
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
              $("#tambah_data").modal('hide');
              $('#i_rekap_data').DataTable().destroy();
              t_data_rekap();
              console.log(data)
            }
          })
       });

      // Edit data rekap

      $(document).on("click", "#edit_data_rekap", function(e){
        e.preventDefault();

        var id = $(this).attr("value");
        
        $.ajax({
          url: '<?php echo base_url()."maut/edit_data_rekap" ?>',
          type: 'POST',
          dataType: 'json',
          data: {
            id: id
          },
          success: function(data){
            $('#ubah_data_rekap').modal('show');
            var data = data.posts[0][0];
            console.log(data);
           
            $("[name='nama_kost2']").val(data.nama_kost);
            $("[name='id_rekap_data_kost']").val(data.id_rekap_data_kost);
            $("[name='jenis_kost2']").val(data.jenis_kost);
            $("[name='alamat_lengkap2']").val(data.alamat_lengkap);
            $("[name='harga_kost2']").val(data.harga_kost);
            $("[name='rute_ke_kampus2']").val(data.rute_ke_kampus);
            $("[name='kondisi_air2']").val(data.kondisi_air);
            $("[name='luas_kamar2']").val(data.luas_kamar);
            $("[name='letak_kamar_mandi2']").val(data.letak_kamar_mandi);
            $("[name='dapur2']").val(data.dapur);
            $("[name='wifi2']").val(data.wifi);
            $("[name='garasi2']").val(data.garasi);
            $("[name='latitude2']").val(data.latitude);
            $("[name='longitude2']").val(data.longitude);
            $("[name='narahubung2']").val(data.narahubung);
            $('#gambar_rumah').html('<img src="<?php echo base_url('assets/img/kostpict/default.jpg') ?>" class="img-thumbnail">');
            // $("[name='image2']").val('<?php echo base_url("assets/img/kostpict/") ?>'+ data.narahubung);
            // $('#id_gejala').val(data.id_gejala);
            // $('#gejala').val(data.nm_gejala);
            // $('#bobot').val(data.mb_bobot);
          }
        })
      }); 

       // Update data rekap

       $('#update_data_rekap').on('submit', function(e){
          e.preventDefault();

          $.ajax({
            url: '<?php echo base_url()."maut/u_data_rekap" ?>',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
              $('#file').val('');
              // alert(data);
              Swal.fire(
                'Berhasil!',
                'Data Berhasil Diubah!',
                'success'
              )
              $("#ubah_data_rekap").modal('hide');
              $('#i_rekap_data').DataTable().destroy();
              t_data_rekap();
              console.log(data)
            }
          })
       });

      //del rekap data
      $(document).on("click", "#del_data_rekap", function(e){
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
              url: '<?php echo base_url()."maut/del_data_rekap" ?>',            
              success: function(data){
                swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              );
               $('#i_rekap_data').DataTable().destroy();
                t_data_rekap();
                
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
              $('#i_rekap_data').DataTable().destroy();
              t_data_rekap();;
            }
          })             
      });

      // Tampil data pembobotan

      function t_pembobotan_k(){
        $.ajax({
          url: "<?php echo base_url('maut/f_pembobotan_k') ?>",
          type: 'post',
          dataType: 'json',
          success: function(data){
          var i = '1';
            $('#i_pembobotan_k').DataTable({
              "data": data.posts,              
              "columns":[
                {"render": function(){
                  return a = i++;
                }},     
                {"data": "nama_kost"},          
                {"data": "jenis_kost"},
                {"data": "harga_kost"},
                {"data": "rute_ke_kampus"},
                {"data": "kondisi_air"},
                {"data": "luas_kamar"},
                {"data": "letak_kamar_mandi"},
                {"data": "dapur"},
                {"data": "wifi"},
                {"data": "garasi"},
                {"render": function(data,type,row,meta){
                  var a = `
                        <a href="#" value="${row.id_pembobotan}" id="del_pembobotan_k" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                        <a href="#" value="${row.id_pembobotan}" id="edit_pembobotan_k" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                  `;
                  return a;
                }}
              ]
            });
          }
        });
       }

       // Tambah pembobotan kriteria

       $('#tambah_pembobotan_k').on('submit', function(e){
          e.preventDefault();

          $.ajax({
            url: '<?php echo base_url()."maut/t_pembobotan_k" ?>',
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
              $("#tambah_data_pembobotan").modal('hide');
              $('#i_pembobotan_k').DataTable().destroy();
              t_pembobotan_k()
              console.log(data)
            }
          })
       });

      // Edit pembobotan kriteria

      $(document).on("click", "#edit_pembobotan_k", function(e){
        e.preventDefault();

        var id = $(this).attr("value");
        
        $.ajax({
          url: '<?php echo base_url()."maut/edit_pembobotan_k" ?>',
          type: 'POST',
          dataType: 'json',
          data: {
            id: id
          },
          success: function(data){
            $('#ubah_data_pembobotan').modal('show');
            var data = data.posts[0][0];
            console.log(data);

            $("[name='id_rekap_data_kost5']").val(data.nama_kost);
            $("[name='id_pembobotan5']").val(data.id_pembobotan);
            $("[name='nama_kost5']").val(data.nama_kost);
            $("[name='jenis_kost5']").val(data.jenis_kost);
            $("[name='harga_kost5']").val(data.harga_kost);
            $("[name='rute_ke_kampus5']").val(data.rute_ke_kampus);
            $("[name='kondisi_air5']").val(data.kondisi_air);
            $("[name='luas_kamar5']").val(data.luas_kamar);
            $("[name='letak_kamar_mandi5']").val(data.letak_kamar_mandi);
            $("[name='dapur5']").val(data.dapur);
            $("[name='wifi5']").val(data.wifi);
            $("[name='garasi5']").val(data.garasi);
          }
        })
      });

      // Update pembobotan kriteria

       $('#update_pembobotan_k').on('submit', function(e){
          e.preventDefault();

          $.ajax({
            url: '<?php echo base_url()."maut/u_pembobotan_k" ?>',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
              $('#file').val('');
              // alert(data);
              Swal.fire(
                'Berhasil!',
                'Data Berhasil Diubah!',
                'success'
              )
              $("#ubah_data_pembobotan").modal('hide');
              $('#i_pembobotan_k').DataTable().destroy();
              t_pembobotan_k();
              console.log(data)
            }
          })
       }); 

       //del pembobotan kriteria
      $(document).on("click", "#del_pembobotan_k", function(e){
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
              url: '<?php echo base_url()."maut/del_pembobotan_k" ?>',            
              success: function(data){
                swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              );
               $('#i_pembobotan_k').DataTable().destroy();
                t_pembobotan_k();
                
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
              $('#i_pembobotan_k').DataTable().destroy();
              t_pembobotan_k();;
            }
          })             
      });

      // Tampil data bobot

      function t_bobot(){
        $.ajax({
          url: "<?php echo base_url('maut/f_bobot') ?>",
          type: 'post',
          dataType: 'json',
          success: function(data){
          var i = '1';
            $('#i_bobot').DataTable({
              "data": data.posts,              
              "columns":[
                {"render": function(){
                  return a = i++;
                }},     
                {"data": "kriteria_kost"},          
                {"data": "bobot"},
                {"render": function(data,type,row,meta){
                  // <a href="#" value="${row.id_bobot_k}" id="del_bobot" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                  var a = `
                        
                        <a href="#" value="${row.id_bobot_k}" id="edit_bobot" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                        
                  `;
                  return a;
                }}
              ]
            });
          }
        });
       }

       // Tambah bobot kriteria

       $('#tambah_bobot').on('submit', function(e){
          e.preventDefault();

          $.ajax({
            url: '<?php echo base_url()."maut/t_bobot" ?>',
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
              $("#tambah_data_bobot").modal('hide');
              $('#i_bobot').DataTable().destroy();
              t_bobot()
              console.log(data)
            }
          })
       });

       // Edit Bobot kriteria

      $(document).on("click", "#edit_bobot", function(e){
        e.preventDefault();

        var id = $(this).attr("value");
        
        $.ajax({
          url: '<?php echo base_url()."maut/edit_bobot" ?>',
          type: 'POST',
          dataType: 'json',
          data: {
            id: id
          },
          success: function(data){
            $('#ubah_data_bobot').modal('show');
            var data = data.posts[0][0];
            console.log(data);

            $("[name='id_bobot_k']").val(data.id_bobot_k);
            $("[name='kriteria_kost2']").val(data.kriteria_kost);
            $("[name='bobot2']").val(data.bobot);
          }
        })
      });

      // Update bobot kriteria

       $('#update_bobot').on('submit', function(e){
          e.preventDefault();

          $.ajax({
            url: '<?php echo base_url()."maut/u_bobot" ?>',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
              $('#file').val('');
              // alert(data);
              Swal.fire(
                'Berhasil!',
                'Data Berhasil Diubah!',
                'success'
              )
              $("#ubah_data_bobot").modal('hide');
              $('#i_bobot').DataTable().destroy();
              t_bobot();
              console.log(data)
            }
          })
       }); 


     

       $('#import_form').on('submit', function(e){
          e.preventDefault();

          $.ajax({
            url: '<?php echo base_url()."data/excel_import" ?>',
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
                'Data Berhasil Diimport!',
                'success'
              )
              $('#records2').DataTable().destroy();
              load_data();
            }
          })
       });

       $('#import_data').on('submit', function(e){
          e.preventDefault();

          $.ajax({
            url: '<?php echo base_url()."data/data_import" ?>',
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
                'Data Berhasil Diimport!',
                'success'
              )
              $('#records').DataTable().destroy();
              document.location.href = "<?= base_url('data/index'); ?>";
              fetch();
            } 
          })
       });

       $('#mulai').on('click', function(){
         
          $.ajax({
            url: '<?php echo base_url("maut/perhitungan_m") ?>',
            type: 'post',
            dataType: 'json',
            success: function(data){             
              $('#disini').html(data);
              console.log(data) 
              
              $('html,body').animate({scrollTop:$(document).height()},1000);
            }
          })

       });

       $('#kosong').click(function(){ 

        Swal.fire({
          title: 'Kosongkan seluruh data?',
          text: "",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {

            $.ajax({
            url: '<?php echo base_url("data/truncate") ?>',
            type: 'post',
            dataType: 'json',
            success: function(data){ 
            document.location.href = "<?= base_url('data/index'); ?>";
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )


              
            }
          })
            
          }
        })

       });

      $('#nama_kost3').change(function(){
        var id_rekap_data_kost = $(this).val();
        $.ajax({
          type: 'post',
          data: {id_rekap_data_kost : id_rekap_data_kost},
          url: '<?php echo base_url("maut/f_solusi") ?>',
          dataType: 'json',
          success: function(data){
            $('#id_rekap_data_kost').val(data.posts[0]);
            $('#nama_kost4').val(data.posts[1]);
            $('#jenis_kost4').val(data.posts[2]);
          }
        });        
      });

  

  

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
                map.off();
                map.remove();
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
  

   

    }); // end document

</script>



</body>

</html>