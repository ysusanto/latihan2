<?php $this->load->view('admin/header'); ?>
<script>
//   var $j = jQuery.noConflict() ;
    $(document).ready(function () {
//        alert('1234');

        viewperusahaan();

    });
    function viewperusahaan() {
//        alert('1234');
        $('#dtprusahaan').dataTable({
            "sPaginationType": "full_numbers",
//            "bJQueryUI": true,
            "iDisplayLength": 30,
            "bDestroy": true,
            "bLengthChange": false,
            "aaSorting": [],
            "bAutoWidth": true,
            "bSortable": false,
            "bSortClasses": false,
            "sAjaxSource": '<?php echo base_url(); ?>perusahaan'



        });
    }
    function addlowker(id) {
        $('#addlowkerModal').modal("show");
        $('#txtcompany_id').val(id);

    }
    function dodeleted() {
        var id=$('#delete_id').val();
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>perusahaan/deleteperusahaan',
            data: "company_id=" + id,
//                                            datatype : "JSON",
            success: function (msg) {
//                alert(msg);
//                                                alert(msg);
                if (msg == "ok") {
//                                    location.reload();
                    $("#deletedModal").modal("hide");
                   
                    viewperusahaan();
                } else {
//                    alert(msg);
                    $('#gagal').show();
                    $('#gagal').text(msg);
                }
//                                                $('#s_periode1,#s_periode2,#fmonth').html(msg);
//                                                $('#s_periode1,#fmonth,#s_periode2').val(month);
//                                                viewReport(0);
            }

        });
    }
    function deleted(id) {
$('#deleteTitleLabel').text("Hapus Perusahaan");
$('#deletelabel').text("Apakah Anda Yakin akan menghapus data perusahaan ini ?");
$('#delete_id').val(id);
$('#deletedModal').modal('show')

    }
</script>
<!--<div id="row">-->
<div id="dialog-delete" style="display:none;max-height:43px !important;" title="Share 'Not Shared' file(s)?">
    <div style="">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
            You have 'Not Shared' Upload file, share now?</p>
    </div>
</div>
<div class="alert alert-success" role="alert" id="ok" style="width: 40%;margin-top: 20px;" hidden >...</div>

<div class="alert alert-danger" role="alert" id="gagal" style="width: 40%;margin-top: 20px;" hidden>...</div>
<h3>Perusahaan</h3>
<a href="<?php echo base_url(); ?>perusahaan/getexportpdf" class="btn btn-primary btn-sm" target="_blank">Print PDF</a>
<button  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addperusahaanModal">Tambah Perusahaan</button>
<!--    <a href="page/print-employer.php" class="btn">Print PDF</a>
    <a href="?menu=add-company" class="btn">Tambah Perusahaan</a>-->
<div class="dataTable_wrapper">
    <table id="dtprusahaan" class="display" style="font-size:small;">
        <thead>
            <tr>
                <th >Nama Perusahaan</th>
                <!--<th>Alamat</th>-->
                <th>Lokasi</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
                <th>Tambah Lowongan</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<!--</div>-->
<?php $this->load->view('admin/addperusahaanmodal'); ?>
<?php $this->load->view('admin/addlowkermodal'); ?>
<?php $this->load->view('admin/footer'); ?>