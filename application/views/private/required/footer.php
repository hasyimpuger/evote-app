    <script src="<?php echo base_url('assets/js/jquery-1.11.0.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/select2.full.min.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#checkAllUser").click(function() {
                var checked = $(this).attr("checked");
                $("#userTable tbody tr td input:checkbox").attr("checked", checked);
            });

            $("#createUser").submit(function(){
                event.preventDefault();
                $("#error_container").css("display", "none");
                var $form = $("#createUser");
                var $inputs = $form.find("input, select, button, textarea");
                var data = $("#createUser").serialize();
                $.ajax({
                    type: "POST",
                    data: data,
                    dataType: 'json',
                    url: "<?php echo site_url('private/user/create')?>",
                    success: function(response){
                        if(response.error){
                            $("#error_container").css("display", "");
                            $("#error_container").html('');
                            $.each(response.message, function (key, value) {
                                var html = '<li>' + value + '</li>';
                                $("#error_container").append(html);
                            });
                        } else {
                            location.href = '<?php echo site_url('private/user')?>';
                        }
                        $inputs.prop("disabled", false);
                    },
                    error: function() { alert("Error."); },
                    beforeSend:function() { $inputs.prop("disabled", true); }
                });
                return false;
            });

            $('#inputKelas').select2();
        });
    </script>
</body>
</html>