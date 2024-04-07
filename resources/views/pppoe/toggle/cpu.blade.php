<script>

    function pollData() {
        $.ajax({
            url: '/dashboard/cpu', // Sesuaikan dengan endpoint di controller Laravel Anda
            method: 'GET',
            success: function(response) {
                // Ubah data yang diterima menjadi format yang lebih mudah dibaca
                var time = response.time;
                var uptime = response.uptime;
                var cpuload = response.cpu_load;
                
                // Tampilkan data yang diterima di dalam #data-container
                $('#data-cpu').html(`
                    <div>Time & Date: ${time}</div>
                    <div>Uptime: ${uptime}</div>
                    <div>Cpu Load: ${cpuload}</div>
                `);
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

