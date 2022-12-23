<!-- NOTIFICATION -->
<?php if ($this->session->flashdata('message')) { ?>
	<script type="text/javascript">
		$(document).ready(function() {
			toastr.options.timeOut = 3500;
			toastr.options.progressBar = true;
			toastr.options.positionClass = "toast-top-right";
			toastr.success('<?= $this->session->flashdata('message') ?>');
		});
	</script>
<?php } ?>

<div class="row">
	<?php foreach($kategori as $row) { ?>
		<div class="col-lg-4">
			<div class="card card-body">
				<a href="<?= base_url() ?>dashboard/detail/<?= encrypt_url($row['id_powerbi_kategori']) ?> "><h4 class="card-title"><i class="uil-chart-bar text-primary me-2"></i><?= $row['nama_kategori'] ?></h4></a> 
				<p class="card-text"><?= $row['deskripsi'] ?></p>
			</div>
		</div>
	<?php } ?>
	<!-- <div class="col-md-3">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title mb-4">Terakhir Login</h4>
				<ol class="activity-feed mb-0 ps-2" data-simplebar style="max-height: 336px;">
					<?php foreach ($log_login as $row) { ?>
						<li class="feed-item">
							<p class="text-muted mb-1 font-size-13"><?= date('d F Y - h:i:s', strtotime($row['created'])) ?>
							</p>
							<p class="mt-0 mb-0"><?= $row['nama'] ?></p>
							<p class="mt-0 mb-0"><span class="text-primary"><?= $row['level'] ?></span></p>
						</li>
					<?php } ?>

				</ol>

			</div>
		</div>
	</div> -->
</div>
<!-- apexcharts -->
<script src="<?= base_url(); ?>assets/libs/apexcharts/apexcharts.min.js"></script>

<script>
	$(document).ready(function() {
		getVisitor();
	})

	function getVisitor() {
		$.ajax({
			url: base_url + 'dashboard/grafik_visitor',
			method: "POST",
			dataType: "json",
			success: function(data) {
				var kategori = $.map(data, function(n, i) {
					return [new Date(n.created).toLocaleDateString()];
				});
				var jumlah = $.map(data, function(n, i) {
					return [n.visitor];
				});
				var serie = $.map(data, function(n, i) {
					return [{
						x: new Date(n.created).getTime(),
						y: n.visitor
					}];
				});
				var options = {
					chart: {
						height: 350,
						type: "bar",
						stacked: true
					},
					dataLabels: {
						enabled: false
					},
					colors: ["#f1b44c"],
					series: [{
						name: "Pengunjung",
						data: jumlah
					}],
					stroke: {
						width: [2]
					},
					plotOptions: {
						bar: {
							columnWidth: "20%"
						}
					},
					xaxis: {
						categories: kategori
					},
					yaxis: [{
							axisTicks: {
								show: true
							},
							axisBorder: {
								show: true,
								color: "#FF1654"
							},
							labels: {
								style: {
									colors: "#FF1654"
								}
							},
							title: {
								text: "Pengunjung",
								style: {
									color: "#FF1654"
								}
							}
						},
						{
							opposite: true,
							axisTicks: {
								show: true
							},
							axisBorder: {
								show: true,
								color: "#247BA0"
							},
							labels: {
								style: {
									colors: "#247BA0"
								}
							}
						}
					],
					tooltip: {
						shared: false,
						intersect: true,
						x: {
							show: false
						}
					},
					legend: {
						horizontalAlign: "left",
						offsetX: 40
					}
				};
				(chart = new ApexCharts(document.querySelector("#chartVisitor"), options)).render();
			}
		});
	}
</script>