<?php $this->load->view('admin/header'); ?>
<script>
//   var $j = jQuery.noConflict() ;
    $(document).ready(function () {
//        alert('1234');

        viewlowongan();

    });
    function viewlowongan() {
//        alert('1234');
        $('#dtlowongan').dataTable({
            "sPaginationType": "full_numbers",
//            "bJQueryUI": true,
            "iDisplayLength": 30,
            "bDestroy": true,
            "bLengthChange": false,
            "aaSorting": [],
            "bAutoWidth": true,
            "bSortable": false,
            "bSortClasses": false,
            "sAjaxSource": '<?php echo base_url(); ?>lowongan'



        });
    }
    function addlowker(id) {
        $('#addlowkerModal').modal("show");
        $('#txtcompany_id').val(id);

    }
</script>
<!--<div id="row">-->
<div class="alert alert-success" role="alert" id="ok" style="width: 40%;margin-top: 20px;" hidden >...</div>

<div class="alert alert-danger" role="alert" id="gagal" style="width: 40%;margin-top: 20px;" hidden>...</div>
<h3>Lowongan Pekerjaan</h3>
<a href="<?php echo base_url() ; ?>lowongan/getexportpdf" class="btn btn-primary btn-sm" target="_blank">Print PDF</a>
<!--<button  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addperusahaanModal">Tambah Perusahaan</button>-->
<!--    <a href="page/print-employer.php" class="btn">Print PDF</a>
    <a href="?menu=add-company" class="btn">Tambah Perusahaan</a>-->
<div class="dataTable_wrapper">
    <table id="dtlowongan" class="display" style="font-size:small;">
        <thead>
            <tr>
                <th>Lowongan Kerja</th>
				<th>Perusahaan</th>
				<th>Lokasi</th>
				<th>Gaji</th>
				<th>Tanggal Posting</th>
				<th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<!--</div>-->

<?php $this->load->view('admin/footer'); ?>