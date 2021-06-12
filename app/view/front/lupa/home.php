<div class="section">
  <div class="column">
    <div class="content">
      <h4 class="text-center">Lupa Password</h4>
      <form id="form-lupa" method="post" action="<?=base_url()?>" class="form-horizontal form-bordered form-control-borderless">
        <div class="form-group">
          <div class="col-md-12">
            <label for="iemail" class="control-label">Email*</label>
            <input id="iemail" type="text" name="email" placeholder="email" class="form-control" required />
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12" style="margin-top:16px">
            <button type="submit" class="btn btn-primary btn-block btn-submit">Reset Password <i id="icon-submit" class="fa fa-chevron-right"></i></button>
          </div>
        </div>
      </form>
      <p class="text-center">Sudah ingat password ?<a href="<?=base_url("login")?>">Login</a></p>
      <hr />
      <p class="text-center">Belum pernah bikin akun? <a href="<?=base_url("daftar")?>">Daftar</a></p>
    </div>
  </div>
</div>
