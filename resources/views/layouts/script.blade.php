<script src="{{ asset('assets') }}/vendor/global/global.min.js"></script>
<script src="{{ asset('assets') }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset('assets') }}/js/dashboard/dashboard-1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.2/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/vendor/owl-carousel/owl.carousel.js"></script>
<script src="{{ asset('assets') }}/js/custom.min.js"></script>
<script src="{{ asset('assets') }}/js/deznav-init.js"></script>
<script src="{{ asset('assets') }}/js/demo.js"></script>
<script src="{{ asset('assets') }}/js/apexcharts.js"></script>
<script>
    function convertToReadableFormat(bytes) {
        var sizes = ['Bytes', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
        if (!bytes) return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
    }

    $(document).ready(function() {

        var options = {
            series: [{
                name: 'Mikman Traffic TX',
                data: []
            }, {
                name: 'Mikman Traffic RX',
                data: []
            }],
            chart: {
                height: 350,
                type: 'area',
                animations: {
                    enabled: true, 
                    easing: 'linear', 
                    speed: 200, 
                    animateGradually: {
                        enabled: true,
                        delay: 150 
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 200 
                    }
                },
                events: {
                    mounted: function(chartContext, config) {
                        setInterval(function() {
                            requestData();
                        }, 3000);
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(value) {
                    return convertToReadableFormat(value);
                }
            },
            stroke: {
                curve: 'smooth'
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return convertToReadableFormat(value);
                    }
                }
            },
            xaxis: {
                type: 'datetime',
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#graph"), options);
        chart.render();

        $(document).ready(function() {
            $('#interface').on('change', function() {
                requestData();
            });
        });

        function requestData() {
            var selectedInterface = $("#interface").val();
            var rx = parseInt(document.getElementById('nilaiRX').value);
            var tx = parseInt(document.getElementById('nilaiTX').value);

            $.ajax({
                url: "{{ url('graf') }}/" + selectedInterface,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        var TX = parseInt(data[0].data[0]);
                        var RX = parseInt(data[1].data[0]);
                        var x = new Date().getTime();
                        if (chart.w.config.series[0].data.length > 10) {
                            chart.w.config.series.forEach(series => {
                                series.data
                                    .shift(); 
                            });
                        }
                        chart.appendData([{
                            data: [{
                                x: x,
                                y: TX
                            }]
                        }, {
                            data: [{
                                x: x,
                                y: RX
                            }]
                        }]);

                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.error("Status: " + textStatus + " request: " + XMLHttpRequest);
                    console.error("Error: " + errorThrown);
                }
            });
        }

    });
</script>
