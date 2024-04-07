<script>
    $(document).ready(function() {
        $('.btn-toggle').click(function() {
            var button = $(this);
            var id = button.data('id');
            var status = button.data('status');
            if (status === 'disable') {
                status = 'enable';
                button.text('Enable');
            } else {
                status = 'disable';
                button.text('Disable');
            }
            button.data('status', status);
            $.ajax({
                type: "POST",
                url: "{{ route('server.toggle') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    action: status,
                    secret_ids: [id]
                },
                success: function(response) {
                    var button = $('.btn-toggle[data-id="' + id + '"]');
                    var status = button.data('status');
                    var newStatus = (status === 'enable') ? 'enable' : 'enable';
                    button.text((newStatus === 'enable') ? 'Enable' : 'Disable');
                    button.data('status', newStatus);
                    $('#status' + id).text((newStatus === 'enable') ? 'Enable' : 'Disable');
                    Swal.fire(
                        'Berhasil!',
                        'PPPoE Secret berhasil ' + newStatus + 'd.',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },

                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
