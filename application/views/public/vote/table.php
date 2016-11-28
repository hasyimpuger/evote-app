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