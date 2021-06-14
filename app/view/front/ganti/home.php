<div class="section">
  <div class="column">
    <div class="content">
      <h1 class="text-center">Reset Passwrod</h1>
      <form id="flogin" method="post" class="form-horizontal">
        <div class="form-group">
          <label for="ipassword_lama" class="control-label">Password Lama *</label>
          <input id="ipassword_lama" type="text" class="form-control" name="passwoed_lama" placeholder="password lama" minlength="3" required />
        </div>
        <div class="form-group">
          <label for="ipassword_baru" class="control-label">Password Baru *</label>
          <input id="ipassword_baru" type="password_baru" class="form-control" name="password_baru" placeholder="password baru" required />
        </div>
        <div class="form-group">
          <label for="iverifikasi_password_baru" class="control-label">Verifikasi Password Baru*</label>
          <input id="iverifikasi_password_baru" type="verifikasi_password_baru" class="form-control" name="verifikasi_password_baru" placeholder="verifikasi password baru" required />
        </div>
        <div class="form-group form-action">
          <button type="submit" class="btn btn-primary btn-submit">Konfirmasi <i class="icon-submit fa fa-sign-in"></i></button>
          <a href="<?=base_url("lupa")?>" class="btn btn-danger">Batal <i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
      </form>
    </div>
  </div>
</div>
