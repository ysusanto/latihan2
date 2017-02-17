<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="modal fade" id="deletedModal" tabindex="-1" role="dialog" aria-labelledby="addperusahaanModal" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#fff">&times;</span></button>
                <h4 class="modal-title" id="deleteTitleLabel" style="color:#fff">Tambah Perusahaan</h4>
            </div>
            <div class="modal-body" >

                <input class="form-control" type="hidden" id="delete_id" name="delete_id" value=""/>
                <div class="form-group">
                    <label id="deletelabel" class="control-label formtext w160" for="txtName"></label>

                </div>



            </div>
            <div class="modal-footer" style="border-top: none;">
                <button  onclick="dodeleted()" class="btn btn-lg btn-primary btn-sm" name="sbtSave" type="submit" id="submitAdd">Ya</button><button  data-dismiss="modal" aria-label="Close"" class="btn btn-lg btn-primary btn-sm" >No</button>

            </div>
        </div>
    </div>
</div>
