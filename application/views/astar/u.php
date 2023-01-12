$.ajax({
          url: "<?php echo base_url('astar/f_simpul') ?>",
          type: 'post',
          dataType: 'json',
          success: function(data){
           // console.log(data.posts)

           var data = data.posts;

           console.log(data.length)

           for (var i = 0; i < data.length; i++) {
             console.log(data[i].sLatitude);

              L.marker([data[i].sLatitude, data[i].sLongitude]).bindPopup(data[i].nama_simpul).addTo(map);
           }


          }
        });


        // get coordinate location
   var latInput = document.querySelector("name=sLatitude]");
   var lngInput = document.querySelector("name=sLongitude]");

   // var curLocation = [5.216585, 97.061562];

   // map.attributionControl.setPrefix(false);

   // var marker = new L.marker(curLocation,{
   //    draggable: 'true',
   // });

   <script type="text/javascript">
  var mapg = L.map('mapku').setView([5.216585, 97.061562], 14);

   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(mapg);

   <?php foreach ($posts as $post) { ?>
     L.marker([<?php echo $post->sLatitude ?>, <?php echo $post->sLongitude ?>]).bindPopup("<?php echo $post->nama_simpul ?>").addTo(mapg);

     
   <?php } ?>

   L.polyline([
     <?php foreach ($posts as $post) { ?>

    [<?php echo $post->sLatitude ?>, <?php echo $post->sLongitude ?>],

    
  <?php } ?>
  ]).addTo(mapg);


   mapSimpul()
  
      function mapSimpul(){

      var map = L.map('mapidi').setView([5.216585, 97.061562], 14);

       L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
          }).addTo(map);
          

         <?php foreach ($posts as $post) { ?>
           L.marker([<?php echo $post->sLatitude ?>, <?php echo $post->sLongitude ?>]).bindPopup("<?php echo $post->nama_simpul ?>").addTo(map);
         <?php } ?>
         
      } // end mapSimpul

</script>