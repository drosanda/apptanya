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
