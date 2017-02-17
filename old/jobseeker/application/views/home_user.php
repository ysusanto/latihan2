<script>
    // 
     $( document ).ready(function() {
         $('#detail').hide();
     });
    function tampildetail(){
        $('#detail').show();
        
        
    }
    function do_register() {
        var telp = $('#telp').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var email = $('#email').val();
        var alamat = $('#alamat').val();
        var status = $('#status').val();
        var kota = $('#kota').val();
        var nama = $('#nama').val();
//                                         alert(telp);
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>registerlogin/register',
            data: "nama="+nama+"&no_tlp=" + telp + "&username=" + username + "&email=" + email + "&password=" + password + "&alamat=" + alamat + "&status=" + status + "&kota=" + kota,
//                                            datatype : "JSON",
            success: function(msg) {
                alert(msg);
//                                                if (detectmob() == true) {
//                                                    window.open(msg, '_blank');
//                                                }
//                                                $('#callback').show();
//                                                $('#inputan').hide();
////                                                $('#s_periode1,#s_periode2,#fmonth').html(msg);
//                                                $('#s_periode1,#fmonth,#s_periode2').val(month);
//                                                viewReport(0);
            }

        });
//                                        $('#registerform').trigger('submit');
    }

</script>
<div class="container">

</div>

