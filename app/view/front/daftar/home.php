<div class="section">
  <div class="column">
    <div class="content">
      <h1 class="text-center">Daftar</h1>
      <form id="fdaftar" method="post">
        <div class="form-group">
          <label for="inama" class="control-label">Nama Lengkap *</label>
          <input id="inama" type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required />
        </div>
        <div class="form-group">
          <label for="iemail" class="control-label">Email *</label>
          <input id="iemail" type="email" class="form-control" name="email" placeholder="Email" required />
        </div>
        <div class="form-group">
          <label for="ipassword" class="control-label">Password</label>
          <input id="ipassword" type="password" class="form-control" name="password" placeholder="Min. 6 Karakter, mengandung huruf dan angka" required />
        </div>
        <div class="form-group">
          <label for="ialamat" class="control-label">Alamat *</label>
          <input id="ialamat" type="text" class="form-control" name="alamat" placeholder="Alamat" required />
        </div>
        <div class="form-group">
          <label class="control-label" for="ijk">Jenis Kelamin </label>
          <select id="ijk" name="jk" class="form-control">
            <option value="1">Laki-laki</option>
            <option value="0">Perempuan</option>
          </select>
        </div>
        <div class="form-group form-action">
          <button type="submit" href="#" class="btn btn-primary btn-block btn-submit">Daftar <i class="icon-submit fa fa-yelp"></i></button>
          <a href="<?=base_url("login")?>" class="btn btn-danger">Login <i class="icon-submit fa fa-sign-in"></i></a>

        </div>
      </form>
      <br>
      <br>
      <br>
    </div>
  </div>
</div>
