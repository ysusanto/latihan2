<script>
    // 
    $(document).ready(function () {
        $('#detail').hide();
    });
    function tampildetail() {
        $('#detail').show();


    }
    function do_register() {
        var telp = $('#telp').val();
        var username = $('#user').val();
        var password = $('#passwd').val();
        var email = $('#email').val();
        var alamat = $('#alamat').val();
        var status = $('#status').val();
        var kota = $('#kota').val();
        var nama = $('#nama').val();
//                                         alert(username);
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>registerlogin/register',
            data: "nama=" + nama + "&no_tlp=" + telp + "&username=" + username + "&email=" + email + "&password=" + password + "&alamat=" + alamat + "&status=" + status + "&kota=" + kota,
//                                            datatype : "JSON",
            success: function (msg) {
//                alert(msg);
                obj = JSON.parse(msg);
//                alert(obj.status);
                if (obj.status = '1') {
                    location.replace("<?php echo base_url(); ?>registerlogin/afterlogin");
                } else {
                    alert(obj.pesan);
                }
//                window.location.replace("http://www.google.com");
//                window.location.host()
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
    <div id='head' style='margin-bottom: 20px'><h1>REGISTER</h1></div>
    <div id='data-form'
         <!--<form>-->
         <div class="form-group">
            <!--<label for="exampleInputEmail1">Email address</label>-->
            <input type="text" class="form-control" id="user" placeholder="username" >
        </div>

        <div class="form-group">
            <!--<label for="exampleInputPassword1">Password</label>-->
            <input type="password" class="form-control" id="passwd" placeholder="Password" >
        </div>
        <div class="form-group">
            <!--<label for="exampleInputPassword1">Password</label>-->
            <input type="password" class="form-control" id="conf-passwd" placeholder="Password" >
        </div>
        <div class="form-group">
            <!--<label for="exampleInputPassword1">Password</label>-->
            <!--                                                    <label for="name">Select list</label>-->
            <select class="form-control" onchange="tampildetail()" id='status'>
                <option value='' selected >Pilih Status</option>
                <option value='1'>Tempat Kursus</option>
                <option value='2'>Perusahaan</option>
                <option value='3'>Pencari Kerja</option>
            </select>
        </div>
        <div id='detail'>
            <div class="form-group">
                <!--<label for="exampleInputEmail1">Email address</label>-->
                <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
                <!--<label for="exampleInputEmail1">Email address</label>-->
                <textarea class="form-control" rows="3" id='alamat' placeholder='Alamat'></textarea>
            </div>
            <!--                                                <div class="form-group">
                                                                <label for="exampleInputPassword1">Password</label>
                                                                                                                    <label for="name">Select list</label>
                                                                <select class="form-control" id='status'>
                                                                    <option value='' selected >Pilih Status</option>
                                                                    <option value='1'>Tempat Kursus</option>
                                                                    <option value='2'>Perusahaan</option>
                                                                    <option value='3'>Pencari Kerja</option>
                                                                </select>
                                                            </div>-->
            <div class="form-group">
                <!--<label for="exampleInputPassword1">Password</label>-->
                <!--                                                    <label for="name">Select list</label>-->
                <select class="form-control" id='status'>
                    <option value='' selected >Pilih Kota</option>
                    <?php
                    if (isset($kota)) {
                        foreach ($kota as $k) {
                            echo "<option value='$k[0]'>$k[1]</option>
";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <!--<label for="exampleInputEmail1">Email address</label>-->
                <input type="telp" class="form-control" id="telp" placeholder="Telpon">
            </div>
            <div class="form-group">
                <!--<label for="exampleInputEmail1">Email address</label>-->
                <input type="email" class="form-control" id="email" placeholder="Alamat Email">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-default" onclick='do_register()'>Submit</button>
    <!--</form>-->
</div>

