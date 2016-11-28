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