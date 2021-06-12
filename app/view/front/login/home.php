<div class="section">
  <div class="column">
    <div class="content">
      <h1 class="text-center">Login</h1>
      <form id="flogin" method="post" class="form-horizontal">
        <div class="form-group">
          <label for="iemail" class="control-label">Email *</label>
          <input id="iemail" type="text" class="form-control" name="email" placeholder="email" minlength="3" required />
        </div>
        <div class="form-group">
          <label for="ipassword" class="control-label">Password *</label>
          <input id="ipassword" type="password" class="form-control" name="password" placeholder="password" required />
        </div>
        <div class="form-group form-action">
          <button type="submit" class="btn btn-primary btn-submit">Login <i class="icon-submit fa fa-sign-in"></i></button>
          <a href="<?=base_url("lupa")?>" class="btn btn-danger">Lupa Password <i class="icon-submit fa fa-question-circle"></i></a>
          <a href="<?=base_url("daftar")?>" class="btn btn-default">Daftar <i class="icon-submit fa fa-yelp"></i></a>
        </div>
      </form>
    </div>
  </div>
</div>
