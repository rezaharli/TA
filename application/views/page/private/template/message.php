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
                <b><?php echo $profil->nama ?></b>
              </td>
            </tr>
            <tr>
              <th>Pesan</th>
              <td>
                <pre><?php echo $pesan->pesan ?></pre>
              </td>
            </tr>
          </table>

        </div>
      </div>
      <div class="modal-footer">
          <a href="<?php echo base_url('proposal_himpunan/detail_proposal?id_proposal='.$pesan->id_proposal); ?>" class="btn btn-info pull-right" style="margin-left: 5px;"><i class="fa fa-book"></i> Lihat Proposal</a>
      </div>
    </div>
  </div>
</div> <!-- /modal -->

<script type="text/javascript">
    function cekstatus() {
          var id_pesan = '<?php echo $pesan->id ?>';
          window.location.href = "<?php base_url(); ?>pesan/cek_status?id_pesan=" + id_pesan;
    }
</script> 