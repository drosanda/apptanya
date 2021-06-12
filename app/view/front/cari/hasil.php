<div class="section" style="">
  <div class="content">
    <form id="fcari" method="get" action="<?=base_url('cari')?>" class="form-horizontal">
      <div class="form-group">
        <input id="ikeyword" type="text" class="form-control" name="keyword" placeholder="cth: dimana beli lele" minlength="1" value="<?=$keyword?>" required />
      </div>
    </form>
  </div>
</div>

<?php foreach($data as $d){ ?>
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
<?php } ?>
<br>
<br>
<br>
