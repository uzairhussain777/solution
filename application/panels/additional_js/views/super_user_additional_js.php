<!-- Mainly scripts -->
    <script src="<?php echo $this->config->base_url();?>r/js/jquery-2.1.1.js"></script>
    <script src="<?php echo $this->config->base_url();?>r/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/flot/curvedLines.js"></script>
	
	<!-- Bootstrap Growl -->
	<script src="<?php echo $this->config->base_url();?>r/js/jquery.bootstrap-growl.js" type="text/javascript"></script>
   
    <!-- Peity -->
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo $this->config->base_url();?>r/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo $this->config->base_url();?>r/js/inspinia.js"></script>
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo $this->config->base_url();?>r/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?php echo $this->config->base_url();?>r/js/plugins/chartJs/Chart.min.js"></script>
    

<script type="text/javascript">
        $(document).ready(function() {


            var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
            var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

            var data1 = [
                { label: "Data 1", data: d1, color: '#17a084'},
                { label: "Data 2", data: d2, color: '#127e68' }
            ];
            $.plot($("#flot-chart1"), data1, {
                xaxis: {
                    tickDecimals: 0
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }]
                        },
                    },
                    points: {
                        width: 0.1,
                        show: false
                    },
                },
                grid: {
                    show: false,
                    borderWidth: 0
                },
                legend: {
                    show: false,
                }
            });

            var lineData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Example dataset",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 40, 51, 36, 25, 40]
                    },
                    {
                        label: "Example dataset",
                        fillColor: "rgba(26,179,148,0.5)",
                        strokeColor: "rgba(26,179,148,0.7)",
                        pointColor: "rgba(26,179,148,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: [48, 48, 60, 39, 56, 37, 30]
                    }
                ]
            };

            var lineOptions = {
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                responsive: true,
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            var myNewChart = new Chart(ctx).Line(lineData, lineOptions);

        });
    </script>
    
