<div class="section">
  <div class="column">
    <div class="content">
      <center>
        <amp-img layout="fixed" width="100px" height="100px" src="<?=base_url('media/user/default.png')?>"></amp-img>
      </center>
      <h1><?=$sess->user->nama?></h1>
      <p><?=$sess->user->email?></p>
      <br>
      <div class="form-group form-action">
        <a href="<?=base_url("logout")?>" class="btn btn-warning">Logout <i class="icon-submit fa fa-sign-out"></i></a>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<br>
