<?php foreach($data as $d){ ?>
<div class="section" style="background-color: #fafafa; margin-bottom: 0.5em;">
  <div class="content">
    <div class="notifikasi-list">
      <p class="<?=!empty($d->is_read) ? 'is-read' : ''?>"><a href="<?=base_url('notifikasi/baca/'.$d->id)?>"><?=$d->isi?></a></p>
    </div>
  </div>
</div>
<?php } ?>
<br>
<br>
<br>
