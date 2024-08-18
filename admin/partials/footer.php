		<div class="main-footer ht-45">
			<div class="container-fluid pd-t-0 ht-100p">
				<span> Copyright © <?php echo date("Y") ?> <a href="javascript:void(0)" class="text-primary">Big Apple Roaster</a>. Designed with <span class="fa fa-heart text-danger"></span> All rights reserved.</span>
			</div>
		</div>
	</div>
		<a href="javascript:void(0)top" id="back-to-top"><i class="fas fa-angle-double-up"></i></a>

		<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    	<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
    	<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			if (!$.fn.DataTable.isDataTable('#responsive-datatable')) {
				$('#responsive-datatable').DataTable({
					
					language: {
						searchPlaceholder: 'Search...',
						scrollX: "100%",
						sSearch: '',
						
					},
					dom: 'Blfrtip', 
						buttons: [
							'excel' 
						],
				});
			}
		});
		
		</script>
		<script src="assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>
		<script src="assets/plugins/bootstrap/popper.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<script src="assets/plugins/ionicons/ionicons.js"></script>

		<script src="assets/plugins/chart.js/Chart.bundle.min.js"></script>

		<script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

		<script src="assets/js/chart.flot.sampledata.js"></script>

		<script src="assets/js/eva-icons.min.js"></script>

		<script src="assets/plugins/moment/moment.js"></script>

		<script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="assets/plugins/perfect-scrollbar/p-scroll.js"></script>

		<script src="assets/plugins/side-menu/sidemenu.js"></script>

		<script src="assets/js/sticky.js"></script>

		<script src="assets/js/script.js"></script>

		<script src="assets/js/apexcharts.min.js"></script>

		<script src="assets/js/index1.js"></script>

		<script src="assets/js/themecolor.js"></script>

		<script src="assets/js/swither-styles.js"></script>

		<script src="assets/js/custom.js"></script>
	</body>
</html>