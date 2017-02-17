<?php $this->load->view('admin/header'); ?>
<script>
    $(document).ready(function () {
        viewuser();
    });
    function viewuser() {
        
        $('#dtuser').dataTable({
            "sPaginationType": "full_numbers",
//            "bJQueryUI": true,
            "iDisplayLength": 30,
            "bDestroy": true,
            "bLengthChange": false,
            "aaSorting": [],
            "bAutoWidth": true,
            "bSortable": false,
            "bSortClasses": true,
            "sAjaxSource": '<?php echo base_url(); ?>useraccess'



        });
    }
    function deleteuser(id){
    
    $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>useraccess/deleteuser',
            data: "user_id=" + id ,
//                                            datatype : "JSON",
           
            success: function (msg) {
//                alert(msg);
//                                                alert(msg);
                if (msg == "ok") {
                    location.reload();
                } else {
                    alert(msg);
                }
//                                                $('#s_periode1,#s_periode2,#fmonth').html(msg);
//                                                $('#s_periode1,#fmonth,#s_periode2').val(month);
//                                                viewReport(0);
            }

        });
    
    }

</script>
<div class="container" style="margin-top:70px;">
    <p><h3>User Access</h3></p>
<div id="data">
    <div id="additem"><button class="btn btn-md btn-primary" data-toggle="modal" data-target="#addModal" style="margin-right: 20px;margin-bottom: 10px;">Add User</button>
        <table class="display" cellspacing="0"  id="dtuser">
            <thead>
                <tr>
                    <!--<th width="15%">Unit</th>-->
                    <th >No.</th> 
                    <th >Username</th>        
                    <th >Nama</th>
                    <th >Alamat</th>
                    <th >Telp</th>
                    <th>#</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table></div>
</div>

<!--<div class="container" id="areabukatoko">
    
</div>-->


<?php $this->load->view('admin/addusercms'); ?>
<?php $this->load->view('admin/footer'); ?>
