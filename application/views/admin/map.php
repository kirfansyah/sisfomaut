<div class="container-fluid">
	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h 3class="m-0 font-weight-bold">View Map</h3>
	    </div>
	    <div class="row"> 
	     	<div class="col-6">
	     		
	     			<div class="input-group mb-3">
					  <form action="<?php echo base_url(); ?>data/cetak" target="_blank" method="POST" class="input-group-prepend" id="button-addon3">
					    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-print"></i> Print</button>	
					  </form>
					  <form action="<?php echo base_url(); ?>data/pdf" target="_blank" method="POST" class="input-group-prepend" id="button-addon3">
					    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-download"></i> PDF</button>
					  </form>
					  <form action="<?php echo base_url(); ?>data/excel" target="_blank" method="POST" class="input-group-prepend" id="button-addon3">
					    <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-file"></i> Excel</button>	
					  </form>
					  
					</div>
	     		    		
	     	</div>
	     </div>
		<div id="mapid" style="width: 100%; height: 300px;">
		
	    </div>
	    
	</div>
</div>					


<script>
	var map = L.map('mapid').setView([5.154999353388613, 97.19732716435323], 10);

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

	const config = {
	  type: 'line',
	  data: data,
	  options: {
	    responsive: true,
	    plugins: {
	      legend: {
	        position: 'top',
	      },
	      title: {
	        display: true,
	        text: 'Chart.js Line Chart'
	      }
	    }
	  },
	};

	const DATA_COUNT = 7;
	const NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

	const labels = Utils.months({count: 7});
	const data = {
	  labels: labels,
	  datasets: [
	    {
	      label: 'Dataset 1',
	      data: Utils.numbers(NUMBER_CFG),
	      borderColor: Utils.CHART_COLORS.red,
	      backgroundColor: Utils.transparentize(Utils.CHART_COLORS.red, 0.5),
	    },
	    {
	      label: 'Dataset 2',
	      data: Utils.numbers(NUMBER_CFG),
	      borderColor: Utils.CHART_COLORS.blue,
	      backgroundColor: Utils.transparentize(Utils.CHART_COLORS.blue, 0.5),
	    }
	  ]
	};
</script>