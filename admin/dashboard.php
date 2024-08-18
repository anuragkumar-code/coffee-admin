<?php include ('partials/header.php'); ?>
<?php include ('partials/sidebar.php'); ?>
<?php echo "<script>if ( window.history.replaceState ) {  window.history.replaceState( null, null, window.location.href ); }</script>"; ?>

<div class="main-content app-content">
	<div class="main-container container-fluid">
		<div class="breadcrumb-header justify-content-between">
			<div>
				<h4 class="content-title mb-2" style="text-transform: uppercase;">Dashboard</h4>
			</div>
			<div class="d-flex my-auto">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					</ol>
				</nav>
			</div>
		</div>

		<div class="main-content-body">
			<!-- row for mini cards -->
			<div class="row row-cards">
				<div class=" col-lg-12">
					<div class="row" id="miniCards">
					</div>
				</div>
			</div>

			<!-- row for flot graph -->
			<div class="row row-sm">
				<div class="col-md-6">
					<div class="card mg-b-20">
						<div class="card-header bg-head pd-b-0 pd-t-20 bd-b-0">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mg-b-10">Types Of Customers Ordering</h4>
							</div>
							<p class="mg-b-20 text-muted tx-13">Trend for types of customers ordering monthly</p>
						</div>
						<div class="card-body">
							<div class="ht-200 ht-sm-300" id="flotArea1"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card mg-b-20">
						<div class="card-header bg-head pd-b-0 pd-t-20 bd-b-0">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mg-b-10">Types Of Coffee Ordered</h4>
							</div>
							<p class="mg-b-20 text-muted tx-13">Trend for type of being ordered monthly</p>
						</div>
						<div class="card-body">
							<div class="ht-200 ht-sm-300" id="flotArea2"></div>
						</div>
					</div>
				</div>
			</div>

			<!-- row for orders table and percentage div -->
			<div class="row row-sm ">
				<div class="col-xl-8 col-md-12 col-lg-12">
					<div class="card overflow-hidden">
						<div class="card-header bg-head pd-b-0 pd-t-20 bd-b-0">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mg-b-10">Latest Orders</h4>
							</div>
						</div>

						<div class="card-body" style="overflow-y: auto;max-height: 360px; height: 360px;">
							<div class="table-responsive" id="ordersTable">
								
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-4 col-md-6 col-lg-6">
					<div class="card overflow-hidden">
						<div class="card-header bg-head pd-b-0 pd-t-20 bd-b-0">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mg-b-10">Orders</h4>
							</div>
						</div>
						<div class="card-body p-4" style="overflow-y: auto;max-height: 360px; height: 360px;">
							<div id="chart-pie" class="chartsh"></div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<script src="assets/js/index.js"></script>

<!-- plugins for pie chart -->
<script src="assets/plugins/charts-c3/d3.v5.min.js"></script>
<script src="assets/plugins/charts-c3/c3-chart.js"></script>

<!-- plugins for flot chart -->
<script src="assets/plugins/jquery.flot/jquery.flot.js"></script>
<script src="assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
<script src="assets/plugins/jquery.flot/jquery.flot.resize.js"></script>

<script type="text/javascript">
	//load functions
	loadMiniCards();
	loadOrderTable();
	loadPieChart();
	loadCustomerFlotChart();
	loadCoffeeFlotChart();

	// function to create mini cards
	function loadMiniCards(){
		$.ajax({
			type: 'POST',
			url: 'functions/dashboard/load_mini_cards.php',
			data: {
				status:"a",
			},
			success: function(result){
				$('#miniCards').html(result);
			}
	  	});
	}

	// function to load order table
	function loadOrderTable(){
		$.ajax({
			type: 'POST',
			url: 'functions/dashboard/load_order_table.php',
			data: {
				status:"a",
			},
			success: function(result){
				$('#ordersTable').html(result);
			}
	  	});
	}


	function loadPieChart(){
		$.ajax({
			type: 'POST',
			url: 'functions/dashboard/load_pie_chart.php',
			data: {
				status:"a",
			},
			success: function(result){
				var data = JSON.parse(result);
				var chart = c3.generate({
        			bindto: '#chart-pie',
        			data: {
        				columns: data,
	            		type: 'pie', 
	            		colors: {
	            		    data1: '#721c94',
	            		    data2: '#fb8d34',
	            		    data3: '#24CBE5',
	            		    data4: '#7a74be'
	            		},
	            		names: {
	            		    'data1': 'A',
	            		    'data2': 'B',
	            		    'data3': 'C',
	            		    'data4': 'D'
	            		}
        			},
        			axis: {},
        			legend: {
        			    show: false,
        			},
        			padding: {
        			    bottom: 0,
        			    top: 0
        			},
    			});
			}
	  	});
	}

	function labelFormatter(label, series) {
		return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
	}

	function loadCustomerFlotChart(){
		$.ajax({
			type: 'POST',
			url: 'functions/dashboard/load_customer_flot_graph.php',
			data: {
				status:"a",
			},
			success: function(result){
				var data = JSON.parse(result);

	    		var plot = $.plot($('#flotArea1'), [{
	    		    data: data.individual,
	    		    label: 'Individual',
	    		    color: '#00cccc'
	    		}, {
	    		    data: data.business,
	    		    label: 'Business',
	    		    color: '#560bd0'
	    		}], {
	    		    series: {
	    		        lines: {
	    		            show: true,
	    		            lineWidth: 1,
	    		            fill: true,
	    		            fillColor: {
	    		                colors: [{
	    		                    opacity: 0
	    		                }, {
	    		                    opacity: 0.3
	    		                }]
	    		            }
	    		        },
	    		        shadowSize: 0
	    		    },
	    		    points: {
	    		        show: true,
	    		    },
	    		    legend: {
	    		        noColumns: 1,
	    		        position: 'nw'
	    		    },
	    		    grid: {
	    		        borderWidth: 1,
	    		        borderColor: 'rgba(171, 167, 167,0.2)',
	    		        hoverable: true
	    		    },
	    		    yaxis: {
	    		        min: 0,
	    		        max: 15,
	    		        color: '#eee',
	    		        tickColor: 'rgba(171, 167, 167,0.2)',
	    		        font: {
	    		            size: 10,
	    		            color: '#999'
	    		        }
	    		    },
	    		    xaxis: {
	    		        ticks: [
	    		            [1, 'Jan'], [2, 'Feb'], [3, 'Mar'], [4, 'Apr'], 
	    		            [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Aug'], 
	    		            [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dec']
	    		        ],
	    		        color: '#eee',
	    		        tickColor: 'rgba(171, 167, 167,0.2)',
	    		        font: {
	    		            size: 10,
	    		            color: '#999'
	    		        }
	    		    }
	    		});
			}
	  	});
	}


	function loadCoffeeFlotChart(){
		$.ajax({
			type: 'POST',
			url: 'functions/dashboard/load_coffee_flot_graph.php',
			data: {
				status:"a",
			},
			success: function(result){
				var data = JSON.parse(result);

				var plot = $.plot($('#flotArea2'), [{
			        data: data.highlyRoasted,
			        label: 'Highly Roasted',
			        color: '#00cccc'
			    }, {
			        data: data.mediumRoasted,
			        label: 'Medium Roasted',
			        color: '#560bd0'
			    }], {
			        series: {
			            lines: {
			                show: true,
			                lineWidth: 1,
			                fill: true,
			                fillColor: {
			                    colors: [{
			                        opacity: 0
			                    }, {
			                        opacity: 0.3
			                    }]
			                }
			            },
			            shadowSize: 0
			        },
			        points: {
			            show: true,
			        },
			        legend: {
			            noColumns: 1,
			            position: 'nw'
			        },
			        grid: {
			            borderWidth: 1,
			            borderColor: 'rgba(171, 167, 167,0.2)',
			            hoverable: true
			        },
			        yaxis: {
			            min: 0,
			            max: 15,
			            color: '#eee',
			            tickColor: 'rgba(171, 167, 167,0.2)',
			            font: {
			                size: 10,
			                color: '#999'
			            }
			        },
			        xaxis: {
			            ticks: [
			                [1, 'Jan'], [2, 'Feb'], [3, 'Mar'], [4, 'Apr'], 
			                [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Aug'], 
			                [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dec']
			            ],
			            color: '#eee',
			            tickColor: 'rgba(171, 167, 167,0.2)',
			            font: {
			                size: 10,
			                color: '#999'
			            }
			        }
			    });
			}
		});
	}

</script>

<?php include('partials/footer.php'); ?>