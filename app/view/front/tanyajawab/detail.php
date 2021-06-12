<div class="section">
  <div class="column">
    <div class="content">
      <h4 class="text-center"><?=$data->tanya?></h4>
      <?php if(strlen($data->jawab)>0){ ?>
      <p><?=$data->jawab?></p>
      <div class="form-group form-action">
        <a href="<?=base_url()?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali </a>
      </div>

      <?php }else{ ?>
      <p><em>Belum dijawab</em></p>
      <?php if($this->user_login){ ?>
      <form id="fjawab" method="post" class="form-horizontal">
        <div class="form-group">
          <input id="ijawab" type="text" class="form-control" name="jawab" placeholder="Tulis Jawaban" minlength="2" required />
        </div>
        <div class="form-group form-action">
          <button type="submit" class="btn btn-success btn-submit">Simpan Jawaban <i class="icon-submit fa fa-check"></i></button>
        </div>
      </form>
      <?php } ?>
      <div class="form-group form-action">
        <a href="<?=base_url()?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali </a>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
