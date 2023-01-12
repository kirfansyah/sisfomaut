<!-- <?php var_dump($jenis_kost); ?> -->
<div class="container-fluid">
  <div class="row">
    <div class="col-6">
    <div class="input-group mb-3">
      <div class="input-group-append">
        <button class="btn btn-sm btn-outline-primary" type="button" name="mulai" id="mulai"><i class="fa fa-play"></i> Ranking it !</button>
      </div>
      <select class="form-control" id="filter1">
        <option selected="" value="">Filter</option>
        <?php foreach($jenis_kost as $tnm) : ?>            
        <option value="<?php echo $tnm->jenis_kost; ?>"><?php echo $tnm->jenis_kost; ?></option>
        <?php endforeach; ?>     
      </select>  
      <select class="form-control" id="filter2">
        <option selected="" value="">Filter</option>
        <option value="1">2 jt - 2.5 jt</option>
        <option value="2">2.6 jt - 3 jt</option>
        <option value="3">3.1 jt - 3.5 jt</option>
        <option value="4">3.6 jt - 4 jt</option>
        <option value="5">4.1 jt - 4.5 jt</option>
        <option value="6">4.6 jt - 5 jt</option>
        <option value="7">5.1 jt - 5.6 jt</option>
        <option value="8">Diatas 5.6 jt</option>            
      </select>
       <select class="form-control" id="filter3">
        <option selected="" value="">Filter</option>
        <option value="1">0.6 Km - 1 Km</option>
        <option value="2">1.1 Km - 1.5 Km</option>
        <option value="3">1.6 Km - 2 Km</option>
        <option value="4">2.1 Km - 2.5 Km</option>
        <option value="5">2.6 Km - 3 Km</option>
        <option value="6">Diatas 3 Km</option>          
      </select> 
            
            
      
    </div>          
    </div>
    <div class="col-6">
      <input style="align-content: right;" type="text" autocomplete="off" class="form-control" placeholder="Cari.." id="search">
    </div>  
   </div>
  <div class="row">
    <div id="konten">
        <div id="wrapper">
          <section>
              <div class="data-container"></div>
              <div id="pagination-demo1"></div>
          </section>
      </div> 
    </div>
     
     
  </div>
 
</div>






