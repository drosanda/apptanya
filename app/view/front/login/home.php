<div class="container-fluid bg-primary container-fluid">
  <div class="row">
    <div class="col-md-4 col-sm-2 hidden-xs">&nbsp;</div>
    <div class="col-md-4 col-sm-8 col-xs-12 kartu">
      <h1 class="text-center">Login</h1>
      <form id="flogin" method="post">
        <div class="form-group">
          <div class="col-md-12">
            <label for="iemail" class="control-label">Email *</label>
            <input id="iemail" type="text" class="form-control" name="email" placeholder="email" minlength="3" required />
          </div>
          <div class="col-md-12">
            <label for="ipassword" class="control-label">Password *</label>
            <input id="ipassword" type="password" class="form-control" name="password" placeholder="password" required />
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12" style="margin-top:16px">
            <button type="submit" class="btn btn-primary btn-block btn-submit">Masuk <i class="icon-submit fa"></i></button>
          </div>
        </div>
      </form>
      <p class="text-center"><a href="<?=base_url("lupa")?>">Lupa Password</a></p>
      <hr />
      <p class="text-center"> <a href="<?=base_url("daftar")?>">Belum pernah bikin akun? Daftar</a></p>
    </div>
    <div class="col-md-4 col-xs-1">&nbsp;</div>
  </div>
</div>
