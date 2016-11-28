<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">Live Count <span class="label label-danger">HOT</span></div>
        <div class="panel-body" style="height: 550px">
          <div class="row">
            <div class="col-md-8">
              <canvas id="myChart" width="400" height="400"></canvas>
            </div>
            
            <div class="col-md-4">
            <div id="tableHolder">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Total Perolehan</th>
                  </tr>
                </thead>
                    <tfoot style="background-color: #eee">
    <tr>
      <td colspan="2">Total Suara Masuk: <?php echo $votes_count ?> dari <?php echo $siswa_count ?> Siswa</td>
    </tr>
    <tr>
      <td colspan="2">Total Siswa: <?php echo $siswa_count ?> Siswa</td>
    </tr>
  </tfoot>
                <tbody>
                <?php foreach ($candidates as $candidate):
                  $count = $this->db->where('nominee_id', $candidate->id)->get('votes')->num_rows();
                ?>
                  <tr>
                    <td><?php echo $candidate->name?></td>
                    <td><?php echo $count?> ( <?php echo ($votes_count > 0) ? round($count / 1192 * 100) : '0' ?> % )</td>
                  </tr>
                <?php endforeach?>
                  <tr>
      <td>Belum / Tidak Memilih</td>
      <td><?php echo $siswa_count - $votes_count?> ( <?php echo ($votes_count > 0) ? round( ($siswa_count - $votes_count ) / 1192 * 100) : '0' ?> % )</td>
    </tr>
                </tbody>
              </table>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Komentar</h3>
              </div>
              <div class="panel-body" id="">
              <div id="commentSection">
                <table class="table table-bordered table-hover">
                  <thead>
                  </thead>
                  <tbody>
                  <?php if($votes): ?>
                  <?php foreach ($votes as $vote):
                  $comment = $this->db->where('id', $vote->nominee_id)->get('candidates')->row();
                 ?>
                    <tr>
                      <td>Untuk <strong><?php echo $comment->name?></strong>: <?php echo $vote->saran?></td>
                    </tr>
                  <?php endforeach; else: ?>
                  <tr>
                  <td>Data not found</td>
                  </tr>
                <?php endif?>
                  </tbody>
                </table>
                </div>
              </div>
            </div>
            </div>
            </div>
          </div>
        </div>
        <div class="panel-footer">
          <p class="pull-right">&copy; <?php echo date('Y') ?> <strong><a href="http://github.com/katonsa">Katonsa</a></strong>.</p>
          <p>Halaman ini di render dalam waktu {elapsed_time} detik.</p>
        </div>
      </div>
    </div>
  </div>
</div>
