<!-- modal column -->
<!-- Tampilkan Pesan Modal -->
<div class="modal fade" id="tampilkanPesanModal<?php echo $pesan->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog center" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Pesan</h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive">

          <table class="table" id="tabel-pesan">
            <tr>
              <th style="width:25%">Dari</th>
              <td>
                <b><?php //echo $kepada; ?></b>
              </td>
            </tr>
            <tr>
              <th>Pesan</th>
              <td>
                <pre><?php echo $pesan->pesan ?></pre>>
              </td>
            </tr>
          </table>

        </div>
      </div>
    </div>
  </div>
</div> <!-- /modal -->