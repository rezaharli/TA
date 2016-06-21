<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/documentation/style.css">
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Proposal 
            <small> Himpunan </small>
        </h1>
        <?php echo $breadcrumb ?>
    </section>

<!-- Main content -->
    <section class="content">
        <div class="row">
        <!-- left column -->
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 
                        class="box-title"><?php echo $event ?> 
                        <small>
                            <?php if ($status == null || $status == '-') { ?>
                                <span class="label label-warning">Pending</span>
                            <?php } else if ($status == 'y') { ?>
                                <span class="label label-success">Disetujui</span>
                            <?php } else if ($status == 'n') { ?>
                                <span class="label label-danger">Ditolak</span>
                            <?php } ?>
                        </small>
                      </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="box box-solid">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                              &nbsp;Tujuan Kompetisi
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $tujuan_kompetisi ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div class="box box-solid collapsed-box">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Sasaran Kompetisi
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $sasaran_kompetisi ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div class="box box-solid collapsed-box">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Tempat Kompetisi
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $tempat_kompetisi ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <div class="box box-solid collapsed-box">
                          <div class="box-header bg-light-blue-gradient">
                            <h4 class="box-title">
                              <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-plus"></i></button>
                              &nbsp;Total Anggaran
                            </h4>
                          </div>
                          <div class="box-body">
                            <pre class="prettyprint"><?php echo $biaya ?></pre>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                    <div class="box-footer">
                            <?php if ($status == NULL || $status == '-') { ?>
                                <button class="btn btn-success pull-left" data-toggle="modal" data-target="#setujuModal"><i class="fa fa-check"></i> &nbsp;Setuju</button>
                                &nbsp;
                                <button class="btn btn-danger" data-toggle="modal" data-target="#tolakModal"><i class="fa fa-close"></i> &nbsp;Tolak</button>
                            <?php }elseif ($status == 'n') { ?>
                                <button class="btn btn-info" data-toggle="modal" data-target="#pesanModal"><i class="fa fa-envelope"></i> &nbsp;Kirim Pesan</button>
                            <?php } ?>
                            
                            
                    </div><!-- /.box-footer -->
                </div>
            </div>

            <!-- modal column -->
            <!-- Setuju Modal -->
                    <div class="modal fade" id="setujuModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog center" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                            Apakah anda ingin <b>menyetujui</b> proposal ini?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> &nbsp;
                            <a href="<?php echo base_url('proposal_mahasiswa/do_edit_status/'.$id.'?s=t') ?>" class="btn btn-success pull-right"><i class="fa fa-check"></i> Setuju</a>
                          </div>
                        </div>
                      </div>
                    </div> <!-- /modal -->
            <!-- Tolak Modal -->
                    <div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog center" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                            Apakah anda ingin <b>menolak</b> proposal ini?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> &nbsp;
                            <a href="<?php echo base_url('proposal_mahasiswa/do_edit_status/'.$id.'?s=f') ?>" class="btn btn-danger pull-right" style="margin-left: 5px;"><i class="fa fa-close"></i> Tolak</a>
                          </div>
                        </div>
                      </div>
                    </div> <!-- /modal -->
            <!-- Private Message Modal -->
                    <div class="modal fade" id="pesanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog center" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Kirim Pesan</h4>
                          </div>
                          <form role="form" method="post" action="<?php echo base_url('pesan/do_kirim_pesan'); ?>" autocomplete="off">
                              <div class="modal-body">
                                <div class="table-responsive">
                                    
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Kepada</th>
                                            <td>
                                                <b><?php echo $kepada; ?></b>
                                                <input type="hidden" name="kepada" value="<?php echo $id_kepada; ?>"></input>
                                                <input type="hidden" name="id_pengajuan" value="<?php echo $id_pengajuan; ?>"></input>
                                                <input type="hidden" name="id_proposal" value="<?php echo $id; ?>"></input>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Penanggung Jawab</th>
                                            <td>
                                                <a href='<?php echo base_url('profil/'.$usernamepj); ?>'><?php echo $pj; ?> &horbar; <?php echo $namapj; ?> </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pesan</th>
                                            <td>
                                                <textarea class="form-control" id="pesan" placeholder="Pesan" name="isipesan" rows='5'></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="submit" value="Kirim" class="btn btn-primary" id="button-pesan-submit">
                              </div>
                          </form>
                        </div>
                      </div>
                    </div> <!-- /modal -->

                             
                
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->