<!--
<div class="section" style="">
  <div class="content">
    <form id="fcari" method="get" action="<?=base_url('cari')?>" class="form-horizontal">
      <div class="form-group">
        <input id="ikeyword" type="text" class="form-control" name="keyword" placeholder="cth: dimana beli lele" minlength="1" value="<?=$keyword?>" required />
      </div>
    </form>
  </div>
</div>
-->
<?php if($count>0){ foreach($data as $d){ ?>
<div class="section" style="background-color: #fafafa; margin-bottom: 0.5em;">
  <div class="content">
    <p><strong><a href="<?=base_url('tanyajawab/detail/'.$d->id)?>"><?=$d->tanya?></a></strong></p>
    <?php if(strlen($d->jawab)>0){ ?>
    <p><?=$d->jawab?></p>
    <?php }else{ ?>
    <p><em>Belum dijawab</em></p>
    <?php } ?>
  </div>
</div>
<?php } }else{ ?>
  <?php if($this->user_login){ ?>
<div class="section">
  <div class="column">
    <div class="content">

      <form id="ftanya" method="post" class="form-horizontal">
        <div class="form-group">
          <p>Pencarian "<?=$keyword?>" tidak menemukan hasil. Apakah anda ingin mengajukan pertanyaan baru?</p>
        </div>
        <div class="form-group">
          <input id="itanya" type="text" class="form-control" name="tanya" placeholder="Tulis Pertanyaan" minlength="2" maxlength="254" required />
        </div>
        <div class="form-group form-action">
          <button type="submit" class="btn btn-primary btn-submit">Simpan Pertanyaan <i class="icon-submit fa fa-check"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>
    <?php } ?>
<?php } ?>
<div class="section">
  <div class="column">
    <div class="content">
      <p>Tidak menemukan jawaban yang anda cari?</p>

      <div class="form-group form-action">
        <a href="<?=base_url("tanyajawab")?>" class="btn btn-primary">Buat Pertanyaan Baru <i class="icon-submit fa fa-chevron-right"></i></a>
      </div>

    </div>
  </div>
</div>
<br>
<br>
<br>
