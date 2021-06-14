<div class="section">
  <div class="column">
    <div class="content">
      <h1 class="text-center">Ganti Nama</h1>
      <form id="flogin" method="post" class="form-horizontal">
        <div class="form-group">
          <label for="iemail" class="control-label">Email *</label>
          <input id="iemal" type="text" class="form-control" name="email" placeholder="email" minlength="3" required />
        </div>
        <div class="form-group">
          <label for="ijenis_kelamin" class="control-label">Jenis Kelamin *</label>
          <input id="ijenis_kelamin" type="jenis_kelamin" class="form-control" name="jenis_kelamin" placeholder="jenis kelamin" required />
        </div>
        <div class="form-group">
          <label for="ialamat" class="control-label">Alamat *</label>
          <input id="ialamat" type="alamat" class="form-control" name="alamat" placeholder="almaat" required />
        </div>
        <div class="form-group form-action">
          <button type="submit" class="btn btn-primary btn-submit">Konfirmasi <i class="icon-submit fa fa-sign-in"></i></button>
          <a href="<?=base_url("lupa")?>" class="btn btn-danger">Batal <i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
      </form>
    </div>
  </div>
</div>
