<div class="container-fluid bg-primary container-fluid">
  <div class="row">
    <div class="col-md-4 col-sm-2 col-xs-1 hidden-xs">&nbsp;</div>
    <div class="col-md-4 col-sm-8 col-xs-12 kartu">
      <h1 class="text-center">Daftar</h1>
      <form id="fdaftar" method="post">
        <div class="form-group">
          <div class="col-md-12">
            <label for="ifnama" class="control-label">Nama Lengkap *</label>
            <input id="ifnama" type="text" class="form-control" name="fnama" placeholder="Nama" required />
          </div>
          <div class="col-md-12">
            <label for="iemail" class="control-label">Email *</label>
            <input id="iemail" type="email" class="form-control" name="email" placeholder="Email" required />
          </div>
          <div class="col-md-12">
            <label for="inomor_Hp" class="control-label">Nomor HP *</label>
            <input id="inomor_Hp" type="number" class="form-control" name="telp" placeholder="Nomor Hp" required />
          </div>
          <div class="col-md-12">
            <label class="control-label">NIM </label>
            <input id="inim" class="form-control" type="text" placeholder="Nomor Induk Mahasiswa" name="nim" value="<?php if(isset($user->nim)){ echo $user->nim; } ?>" />
          </div>
          <div class="col-md-12">
            <label class="control-label">Nama Universitas/Instansi *</label>
            <input id="iinstansi" class="form-control" type="text" placeholder="Nama Universitas/Instansi" name="instansi" value="<?php if(isset($user->instansi)){ echo $user->instansi; } ?>" required/>
          </div>
          <div class="col-md-12">
            <label for="iokupansi">Jenjang *</label>
            <select name="a_kategori_id_ocp" id="iokupansi" class="form-control">
            <?php foreach($ocp as $o){?>
              <option value="<?=$o->id?>" data-kode="<?=$o->kode?>"><?=$o->nama?></option>
            <?php } ?>
            </select>
          </div>
          <div id="panel_jurusan" class="col-md-12">
          </div>
          <div class="col-md-12">
            <label for="ipassword" class="control-label">Password</label>
            <input id="ipassword" type="password" class="form-control" name="password" placeholder="Min. 6 Karakter, mengandung huruf dan angka" required />
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12" style="margin-top:16px">
            <button type="submit" href="#" class="btn btn-primary btn-block btn-submit">Daftar <i class="icon-submit fa"></i></button>
          </div>
        </div>
      </form>
      <hr />
      <p class="text-center"><a href="<?=base_url("login")?>">Sudah punya akun? Login</a></p>
    </div>
    <div class="col-md-4 col-xs-1">&nbsp;</div>
  </div>
</div>
