<script>
    function convertToReadableFormat(bytes) {
        var sizes = ['Bytes', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
        if (!bytes) return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function pollData() {
        $.ajax({
            url: '/dashboard/sys', // Sesuaikan dengan endpoint di controller Laravel Anda
            method: 'GET',
            success: function(response) {
                var cpuLoad = parseFloat(response.cpu_load);
                var freeHdd = parseFloat(response.free_hdd);
                var freeMemory = parseFloat(response.free_memory);

                var freeHddFormatted = convertToReadableFormat(freeHdd);
                var freeMemoryFormatted = convertToReadableFormat(freeMemory);

                // Update nilai CPU Load
                // Maksimum CPU Load yang diinginkan
                var maxCpuLoad = 100;

                // Update nilai CPU Load
                $('#cpu-load-value').text(cpuLoad + '%');
                var cpuLoadWidth = Math.min(cpuLoad,
                maxCpuLoad); // Membatasi nilai CPU Load agar tidak melebihi maksimum
                $('#cpu-progress').css('width', cpuLoadWidth + '%').text(cpuLoad + '%');


                // Update nilai Free HDD
                $('#free-hdd-value').text(freeHddFormatted);
                $('#hdd-progress').css('width', freeHdd + '%').text(freeHddFormatted);

                // Update nilai Free Memory
                $('#free-memory-value').text(freeMemoryFormatted);
                $('#memory-progress').css('width', freeMemory + '%').text(freeMemoryFormatted);


            },
            error: function(xhr, status, error) {
                console.error('Error polling data:', error);
            },
            complete: function() {
                setTimeout(pollData, 1000); // Set timeout sesuai kebutuhan Anda
            }
        });
    }

    pollData();
</script>
