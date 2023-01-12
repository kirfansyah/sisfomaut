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

 
  <!-- <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script> -->
  <script src="<?php echo base_url() ?>assets/dist/pagination.js"></script>

  <script>
    $(document).ready(function(){

      f_data()

      function duit(numb){        
        const format = numb.toString().split('').reverse().join('');
        const convert = format.match(/\d{1,3}/g);
        const rupiah = 'Rp ' + convert.join('.').split('').reverse().join('');

        return rupiah;
      }

      $('#mulai').on('click', function(){
       var sources = null; 

      $.ajax({
            url: '<?php echo base_url("guest/perhitungan_m") ?>',
            type: 'post',
            dataType: 'json',
            success: function(data){ 
            if(!data){
              return false;
            }

              sources = data 
              console.log(data);
              $('#konten').html('').append('<div id="wrapper"><section><div class="data-container"></div><div id="pagination-demo1"></div></section></div>');

              $(function() {
                  (function(name) {
                    var container = $('#pagination-' + name);
                    var options = {
                      dataSource: sources,
                      callback: function (response, pagination) {
                        window.console && console.log(response, pagination);
                        // console.log(response)

                        var dataHtml = '<div class="row">';

                        $.each(response, function (index, item) {
                          dataHtml += `<div class="col-md-4 mb-4">
                                         <div class="card">
                                              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-white text-decoration-none" href="#">${item.jenis_kost}</a></div>`;
                                              if (item.gambar) {
                                                dataHtml += `<img style="width: 100%; height: 200px;" src="<?php echo base_url('assets/img/kostpict/') ?>${item.gambar}" class="card-img-top" alt="">`;
                                              }else{
                                                 dataHtml += `<img style="width: 100%; height: 200px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">`;
                                              }
                                          
                                dataHtml += `<div class="card-body">
                                              <h5 class="card-title">${item.nama_kost} || Rank ${index+1}</h5>
                                              
                                              <p class="badge badge-success card-text">${duit(item.harga_kost)} / Tahun</p>
                                              <p class="badge badge-warning card-text">Jarak Ke Kampus ${(item.rute_ke_kampus)} Km</p>
                                              <br>
                                              <a href="<?php echo base_url('guest/detail/${(item.id_rekap_data_kost)}') ?>" class="btn btn-sm btn-primary">Lihat Yuk  !</a>
                                          </div>
                                        </div>
                                      </div>`;
                        }); 

                        dataHtml += `<div class="col-md-4 mb-4 ml-12" style="opacity:0%;">
                                         <div class="card" style="width:350px">
                                              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-white text-decoration-none" href="#">JENIS KOST</a></div><img style="width: 100%; height: 200px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">
                                              <div class="card-body">
                                              <h5 class="card-title">NAMA KOST</h5>
                                              
                                              <p class="badge badge-success card-text">HARGA / Tahun</p>
                                              <p class="badge badge-warning card-text">Jarak Ke Kampus Km</p>
                                              <br>
                                              <a href="#" class="btn btn-sm btn-primary">Lihat Yuk  !</a>
                                          </div>
                                        </div>
                                      </div>`;                

                        // var dataHtml += '</div>';

                        container.prev().html(dataHtml);
                      }
                    };

                    //$.pagination(container, options);

                    container.addHook('beforeInit', function () {
                      window.console && console.log('beforeInit...');
                    });
                    container.pagination(options);

                    container.addHook('beforePageOnClick', function () {
                      window.console && console.log('beforePageOnClick...');
                      //return false
                    });
                  })('demo1');
                
                })

                Swal.fire(
                  'Berhasil!',
                  'Data Berhasil Dirangkingkan!',
                  'success'
                )  
              
              
            }
          })

      });

       $('#filter1').on('change', function(){
        var jenis_kost = $(this).val();
        var sources = null;
        if (jenis_kost!='') {
          $.ajax({
              url: "<?= base_url('guest/f_filter1'); ?>",
              type: 'post',
              dataType: 'json', 
              data: {
                jenis_kost: jenis_kost
              },
              success: function(data) {
                sources = data;
                console.log(sources)
                $('#konten').html('').append('<div id="wrapper"><section><div class="data-container"></div><div id="pagination-demo1"></div></section></div>');

                $(function() {
                  (function(name) {
                    var container = $('#pagination-' + name);
                    var options = {
                      dataSource: sources,
                      callback: function (response, pagination) {
                        window.console && console.log(response, pagination);
                        // console.log(response)

                        var dataHtml = '<div class="row">';

                        $.each(response, function (index, item) {
                          dataHtml += `<div class="col-md-4 mb-4">
                                         <div class="card">
                                              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-white text-decoration-none" href="#">${item.jenis_kost}</a></div>`;
                                              if (item.gambar) {
                                                dataHtml += `<img style="width: 100%; height: 200px;" src="<?php echo base_url('assets/img/kostpict/') ?>${item.gambar}" class="card-img-top" alt="">`;
                                              }else{
                                                 dataHtml += `<img style="width: 100%; height: 200px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">`;
                                              }
                                          
                                dataHtml += `<div class="card-body">
                                              <h5 class="card-title">${item.nama_kost}</h5>
                                              
                                              <p class="badge badge-success card-text">${duit(item.harga_kost)} / Tahun</p>
                                              <p class="badge badge-warning card-text">Jarak Ke Kampus ${(item.rute_ke_kampus)} Km</p>
                                              <br>
                                              <a href="<?php echo base_url('guest/detail/${(item.id_rekap_data_kost)}') ?>" class="btn btn-sm btn-primary">Lihat Yuk  !</a>
                                          </div>
                                        </div>
                                      </div>`;
                        });     

                        dataHtml += `<div class="col-md-4 mb-4 ml-12" style="opacity:0%;">
                                         <div class="card" style="width:350px">
                                              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-white text-decoration-none" href="#">JENIS KOST</a></div><img style="width: 100%; height: 200px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">
                                              <div class="card-body">
                                              <h5 class="card-title">NAMA KOST</h5>
                                              
                                              <p class="badge badge-success card-text">HARGA / Tahun</p>
                                              <p class="badge badge-warning card-text">Jarak Ke Kampus Km</p>
                                              <br>
                                              <a href="#" class="btn btn-sm btn-primary">Lihat Yuk  !</a>
                                          </div>
                                        </div>
                                      </div>`;            

                        // var dataHtml += '</div>';

                        container.prev().html(dataHtml);
                      }
                    };

                    //$.pagination(container, options);

                    container.addHook('beforeInit', function () {
                      window.console && console.log('beforeInit...');
                    });
                    container.pagination(options);

                    container.addHook('beforePageOnClick', function () {
                      window.console && console.log('beforePageOnClick...');
                      //return false
                    });
                  })('demo1');
                
                })  
              }
            });
          }
        
        });

      $('#filter2').on('change', function(){
        var harga_kost = $(this).val();
        var sources = null;
        if (harga_kost!='') {
          $.ajax({
              url: "<?= base_url('guest/f_filter2'); ?>",
              type: 'post',
              dataType: 'json', 
              data: {
                harga_kost: harga_kost
              },
              success: function(data) {
                sources = data;
                console.log(sources)
                $('#konten').html('').append('<div id="wrapper"><section><div class="data-container"></div><div id="pagination-demo1"></div></section></div>');

                $(function() {
                  (function(name) {
                    var container = $('#pagination-' + name);
                    var options = {
                      dataSource: sources,
                      callback: function (response, pagination) {
                        window.console && console.log(response, pagination);
                        // console.log(response)

                        var dataHtml = '<div class="row">';

                        $.each(response, function (index, item) {
                          dataHtml += `<div class="col-md-4 mb-4" style="float:left;">
                                         <div class="card" style="width:350px">
                                              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-white text-decoration-none" href="#">${item.jenis_kost}</a></div>`;
                                              if (item.gambar) {
                                                dataHtml += `<img style="width: 100%; height: 200px;" src="<?php echo base_url('assets/img/kostpict/') ?>${item.gambar}" class="card-img-top" alt="">`;
                                              }else{
                                                 dataHtml += `<img style="width: 100%; height: 200px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">`;
                                              }
                                          
                                dataHtml += `<div class="card-body">
                                              <h5 class="card-title">${item.nama_kost}</h5>
                                              
                                              <p class="badge badge-success card-text">${duit(item.harga_kost)} / Tahun</p>
                                              <p class="badge badge-warning card-text">Jarak Ke Kampus ${(item.rute_ke_kampus)} Km</p>
                                              <br>
                                              <a href="<?php echo base_url('guest/detail/${(item.id_rekap_data_kost)}') ?>" class="btn btn-sm btn-primary">Lihat Yuk  !</a>
                                          </div>
                                        </div>
                                      </div>`;
                        });      

                        dataHtml += `<div class="col-md-4 mb-4 ml-12" style="opacity:0%;">
                                         <div class="card" style="width:350px">
                                              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-white text-decoration-none" href="#">JENIS KOST</a></div><img style="width: 100%; height: 200px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">
                                              <div class="card-body">
                                              <h5 class="card-title">NAMA KOST</h5>
                                              
                                              <p class="badge badge-success card-text">HARGA / Tahun</p>
                                              <p class="badge badge-warning card-text">Jarak Ke Kampus Km</p>
                                              <br>
                                              <a href="#" class="btn btn-sm btn-primary">Lihat Yuk  !</a>
                                          </div>
                                        </div>
                                      </div>`;           

                        // var dataHtml += '</div>';

                        container.prev().html(dataHtml);
                      }
                    };

                    //$.pagination(container, options);

                    container.addHook('beforeInit', function () {
                      window.console && console.log('beforeInit...');
                    });
                    container.pagination(options);

                    container.addHook('beforePageOnClick', function () {
                      window.console && console.log('beforePageOnClick...');
                      //return false
                    });
                  })('demo1');
                
                })  
              }
            });
          }
        
        });

      $('#filter3').on('change', function(){
        var rute_ke_kampus = $(this).val();
        var sources = null;
        if (rute_ke_kampus!='') {
          $.ajax({
              url: "<?= base_url('guest/f_filter3'); ?>",
              type: 'post',
              dataType: 'json', 
              data: {
                rute_ke_kampus: rute_ke_kampus
              },
              success: function(data) {
                sources = data;
                console.log(sources)
                $('#konten').html('').append('<div id="wrapper"><section><div class="data-container"></div><div id="pagination-demo1"></div></section></div>');

                $(function() {
                  (function(name) {
                    var container = $('#pagination-' + name);
                    var options = {
                      dataSource: sources,
                      callback: function (response, pagination) {
                        window.console && console.log(response, pagination);
                        // console.log(response)

                        var dataHtml = '<div class="row">';

                        $.each(response, function (index, item) {
                          dataHtml += `<div class="col-md-4 mb-4 ml-12">
                                         <div class="card" style="width:350px">
                                              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-white text-decoration-none" href="#">${item.jenis_kost}</a></div>`;
                                              if (item.gambar) {
                                                dataHtml += `<img style="width: 100%; height: 200px;" src="<?php echo base_url('assets/img/kostpict/') ?>${item.gambar}" class="card-img-top" alt="">`;
                                              }else{
                                                 dataHtml += `<img style="width: 100%; height: 200px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">`;
                                              }
                                          
                                dataHtml += `<div class="card-body">
                                              <h5 class="card-title">${item.nama_kost}</h5>
                                              
                                              <p class="badge badge-success card-text">${duit(item.harga_kost)} / Tahun</p>
                                              <p class="badge badge-warning card-text">Jarak Ke Kampus ${(item.rute_ke_kampus)} Km</p>
                                              <br>
                                              <a href="<?php echo base_url('guest/detail/${(item.id_rekap_data_kost)}') ?>" class="btn btn-sm btn-primary">Lihat Yuk  !</a>
                                          </div>
                                        </div>
                                      </div>`;
                        });

                        dataHtml += `<div class="col-md-4 mb-4 ml-12" style="opacity:0%;">
                                         <div class="card" style="width:350px">
                                              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-white text-decoration-none" href="#">JENIS KOST</a></div><img style="width: 100%; height: 200px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">
                                              <div class="card-body">
                                              <h5 class="card-title">NAMA KOST</h5>
                                              
                                              <p class="badge badge-success card-text">HARGA / Tahun</p>
                                              <p class="badge badge-warning card-text">Jarak Ke Kampus Km</p>
                                              <br>
                                              <a href="#" class="btn btn-sm btn-primary">Lihat Yuk  !</a>
                                          </div>
                                        </div>
                                      </div>`;                

                         dataHtml += '</div>';

                        container.prev().html(dataHtml);
                      }
                    };

                    //$.pagination(container, options);

                    container.addHook('beforeInit', function () {
                      window.console && console.log('beforeInit...');
                    });
                    container.pagination(options);

                    container.addHook('beforePageOnClick', function () {
                      window.console && console.log('beforePageOnClick...');
                      //return false
                    });
                  })('demo1');
                
                })  
              }
            });
          }
        
        });
      

      function f_data()
      {
        var sources = null;

        $.ajax({
            url: "<?php echo base_url('guest/f_data') ?>",
            type: 'post',               
            dataType: 'json',                
            success: function(data){ 
               sources= data;
               // console.log(sources)   

               $(function() {
                  (function(name) {
                    var container = $('#pagination-' + name);
                    var options = {
                      dataSource: sources,
                      callback: function (response, pagination) {
                        window.console && console.log(response, pagination);
                        // console.log(response)

                        var dataHtml = '<div class="row">';

                        $.each(response, function (index, item) {
                          dataHtml += `<div class="col-md-4 mb-4">
                                         <div class="card">
                                              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-white text-decoration-none" href="#">${item.jenis_kost}</a></div>`;
                                              if (item.gambar) {
                                                dataHtml += `<img style="width: 100%; height: 200px;" src="<?php echo base_url('assets/img/kostpict/') ?>${item.gambar}" class="card-img-top" alt="">`;
                                              }else{
                                                 dataHtml += `<img style="width: 100%; height: 200px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">`;
                                              }
                                          
                                dataHtml += `<div class="card-body">
                                              <h5 class="card-title">${item.nama_kost}</h5>
                                              
                                              <p class="badge badge-success card-text">${duit(item.harga_kost)} / Tahun</p>
                                              <p class="badge badge-warning card-text">Jarak Ke Kampus ${(item.rute_ke_kampus)} Km</p>
                                              <br>
                                              <a href="<?php echo base_url('guest/detail/${(item.id_rekap_data_kost)}') ?>" class="btn btn-sm btn-primary">Lihat Yuk  !</a>
                                          </div>
                                        </div>
                                      </div>`;
                        }); 

                        dataHtml += `<div class="col-md-4 mb-4 ml-12" style="opacity:0%;">
                                         <div class="card" style="width:350px">
                                              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-white text-decoration-none" href="#">JENIS KOST</a></div><img style="width: 100%; height: 200px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">
                                              <div class="card-body">
                                              <h5 class="card-title">NAMA KOST</h5>
                                              
                                              <p class="badge badge-success card-text">HARGA / Tahun</p>
                                              <p class="badge badge-warning card-text">Jarak Ke Kampus Km</p>
                                              <br>
                                              <a href="#" class="btn btn-sm btn-primary">Lihat Yuk  !</a>
                                          </div>
                                        </div>
                                      </div>`;                

                        // var dataHtml += '</div>';

                        container.prev().html(dataHtml);
                      }
                    };

                    //$.pagination(container, options);

                    container.addHook('beforeInit', function () {
                      window.console && console.log('beforeInit...');
                    });
                    container.pagination(options);

                    container.addHook('beforePageOnClick', function () {
                      window.console && console.log('beforePageOnClick...');
                      //return false
                    });
                  })('demo1');
                
                })        
            }
        });
      }


      $("#search").keyup(function(){
        var keyword = $(this).val();
        // alert(keyword)

        var sources = null;

        $.ajax({
            url: "<?php echo base_url('guest/f_filter4') ?>",
            type: 'post',
            data: {
              keyword: keyword
            },               
            dataType: 'json',                
            success: function(data){ 
               sources= data;
               // console.log(sources)   

               $(function() {
                  (function(name) {
                    var container = $('#pagination-' + name);
                    var options = {
                      dataSource: sources,
                      callback: function (response, pagination) {
                        window.console && console.log(response, pagination);
                        // console.log(response)

                        var dataHtml = '<div class="row">';

                        $.each(response, function (index, item) {
                          dataHtml += `<div class="col-md-4 mb-4">
                                         <div class="card">
                                              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-white text-decoration-none" href="#">${item.jenis_kost}</a></div>`;
                                              if (item.gambar) {
                                                dataHtml += `<img style="width: 100%; height: 200px;" src="<?php echo base_url('assets/img/kostpict/') ?>${item.gambar}" class="card-img-top" alt="">`;
                                              }else{
                                                 dataHtml += `<img style="width: 100%; height: 200px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">`;
                                              }
                                          
                                dataHtml += `<div class="card-body">
                                              <h5 class="card-title">${item.nama_kost}</h5>
                                              
                                              <p class="badge badge-success card-text">${duit(item.harga_kost)} / Tahun</p>
                                              <p class="badge badge-warning card-text">Jarak Ke Kampus ${(item.rute_ke_kampus)} Km</p>
                                              <br>
                                              <a href="<?php echo base_url('guest/detail/${(item.id_rekap_data_kost)}') ?>" class="btn btn-sm btn-primary">Lihat Yuk  !</a>
                                          </div>
                                        </div>
                                      </div>`;
                        }); 

                        for (var i = 0; i < 2; i++) {
                          dataHtml += `<div class="col-md-4 mb-4 ml-12" style="opacity:0%;">
                                         <div class="card" style="width:350px">
                                              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a class="text-white text-decoration-none" href="#">JENIS KOST</a></div><img style="width: 100%; height: 200px;" src="https://source.unsplash.com/630x360?villa" class="card-img-top" alt="">
                                              <div class="card-body">
                                              <h5 class="card-title">NAMA KOST</h5>
                                              
                                              <p class="badge badge-success card-text">HARGA / Tahun</p>
                                              <p class="badge badge-warning card-text">Jarak Ke Kampus Km</p>
                                              <br>
                                              <a href="#" class="btn btn-sm btn-primary">Lihat Yuk  !</a>
                                          </div>
                                        </div>
                                      </div>`;
                        }
                                        

                        // var dataHtml += '</div>';

                        container.prev().html(dataHtml);
                      }
                    };

                    //$.pagination(container, options);

                    container.addHook('beforeInit', function () {
                      window.console && console.log('beforeInit...');
                    });
                    container.pagination(options);

                    container.addHook('beforePageOnClick', function () {
                      window.console && console.log('beforePageOnClick...');
                      //return false
                    });
                  })('demo1');
                
                })        
            }
        });
      });

      

        


       

    }); // end document

</script>
</body>

</html>