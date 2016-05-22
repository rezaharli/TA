<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Sertifikat Lomba
      <small><?php echo $nama ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
      <li><a href="#">sertifikat</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
          <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Logbook Sertifikat Lomba</h3>
                    </div>
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="No">No</th>
                        <th class="sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Tema" aria-sort="descending">Tema</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Penyelenggara">Penyelenggara</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Tahun">Tahun</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Status">Status</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label=""></th>
                      </tr>
                    </thead>
                    <tbody role="" class="odd">
                      <tr>
                        <td>1</td>
                        <td>Animation and Video</td>
                        <td>Gemestest</td>
                        <td>2016</td>
                        <td></td>
                        <td align="center text"><a href=""><button type="button" class="btn btn-default"><span class=""></span> preview </button></a></td>
                      </tr>
                    </tbody>
                    </table>
                <div class="box-header">
                  <div class="col-sm-8">
                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite" >*Silahkan upload sertifikat untuk pengajuan beasiswa prestasi</div>
                  </div>
                <div class="col-sm-4">
                  <a href="<?php echo base_url('sertifikat/add') ?>"<button type="button" class="btn btn-default"><span class="fa fa-plus" ></span> Upload Sertifikat </button></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Preview Sertifikat</h3>
                </div>
              </div>
        </div>
  </section>
</div>
