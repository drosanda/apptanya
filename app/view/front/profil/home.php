<?php
$fnama = trim($sess->user->fnama);
if(strlen($fnama)>30){
  $fnama = substr($fnama,0,30).'...';
}
$okupansi = trim($sess->user->okupansi->nama);
if(strlen($okupansi)>34){
  $okupansi = substr($okupansi,0,34).'...';
}
$instansi = trim($sess->user->instansi);
if(strlen($instansi)>34){
  $instansi = substr($instansi,0,34).'...';
}

$jurusan = trim($sess->user->jurusan->nama);
if(strlen($jurusan)>34){
  $jurusan = substr($jurusan,0,34).'...';
}
?>
<style>
.button-tambah{
  background-color: #C7141A;
  color:white;
  padding:8px;
}
.mb16{
  margin-bottom: 16px;
}
.mt16{
  margin-top: 16px;
}
.lbl p{
  color:white;
  font-size: 400;
}
.bg-profil-img {
  height: 23vh;
  background-repeat: no-repeat;
  background-size: cover;
  background-image: url('<?=$this->cdn_url("media/home/img-header.png");?>');
}
.bg-profil-teks {
  position: relative;
  top: -13vh;
  background-color: white;
  border-radius: 20px;
  z-index: 2;
  padding: 1.5em;
  left: 5%;
  width: 90%;
  -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.25);
  -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.25);
  box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.25);
}
.bg-profil-teks * {
  color: #5a5a5a;
}
.bg-profil-teks h1 {
  margin: 0;
  line-height: 1;
  font-size: 2.4em;
  font-weight: bold;
  margin-top: 3px;
  color: #000000;
}
.bg-profil-teks p {
  margin: 0;
  line-height: 1;
  margin-bottom: 0.5em;
  color: #3d3d3d;
}

#panel-pertanyaan a:hover, #panel-pertanyaan a:focus {
  outline: 0;
  text-decoration: none;
}
@media screen and (max-width: 768px) {
  .table.table-condensed.table-striped.table-extra-info {
    margin-top: 1em;
  }
}
</style>
<div class="bg-profil-img" style=""></div>
<div class="bg-profil-teks">
  <div class="row">
    <div class="col-md-5">
      <h1><?=$fnama?> <?=!empty($sess->user->is_mentor) ? '<label class="label label-warning">Pembimbing</label>' : ''?></h1>
      <p style="margin-top: 0.5em; color: #6c6c6c;"><?=$sess->user->email?></p>
    </div>
    <div class="col-md-5 col-xs-12">
      <table class="table table-condensed table-striped table-extra-info">
        <tr>
          <td class="hidden-xs"><i class="fa fa-briefcase"></i> Jenjang</td>
          <td class="hidden-xs" style="padding-left: 0.25em;">:</td>
          <th style="padding-left: 0.25em;"><?=$okupansi?></th>
        </tr>
        <tr>
          <td class="hidden-xs"><i class="fa fa-graduation-cap"></i> Fakultas / Jurusan</td>
          <td class="hidden-xs" style="padding-left: 0.25em;">:</td>
          <th style="padding-left: 0.25em;"><?=$jurusan?></th>
        </tr>
        <tr>
          <td class="hidden-xs"><i class="fa fa-building"></i> Instansi / Universitas</td>
          <td class="hidden-xs" style="padding-left: 0.25em;">:</td>
          <th style="padding-left: 0.25em;"><?=$instansi?></th>
        </tr>
      </table>
    </div>
    <div class="col-md-2 col-xs-12">
      <hr class="visible-xs" />
      <div class="pull-right">
        <button id="bedit" type="button" class="btn btn-default btn-block"><i class="fa fa-pencil"></i> Edit Profil</button>
        <button id="bgp" type="button" class="btn btn-default btn-block"><i class="fa fa-key"></i> Ganti Password</button>
      </div>
    </div>
  </div>
</div>

<div class="container bg-primary">
  <div class="row">
    <div class="col-md-2 menu-sidebar-halodoctor" style="border-radius:16px;margin-top:16px">
      <div class="row">
        <div class="col-md-12 col-xs-6 mb16">
          <div class="lbl label-open">
            <h3 id="vopen">0</h3>
            <p>Menunggu Balasan</p>
          </div>
        </div>
        <div class="col-md-12 col-xs-6 mb16">
          <div class="lbl label-solved">
            <h3 id="vsolved">0</h3>
            <p>Selesai</p>
          </div>
        </div>
        <div class="col-md-12 col-xs-6 mb16">
          <div class="lbl label-pending">
            <h3 id="vpending">0</h3>
            <p>Belum disetujui</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-10" style="min-height: 80vh;">
      <form id="fcari" method="post" action="" class="form-horizontal">
        <div class="input-group mt16 mb16">
          <input id="ikeyword" type="text" class="form-control" placeholder="Cari pertanyaan..." required>
          <span class="input-group-btn">
            <button id="bkeyword" class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
          </span>
        </div><!-- /input-group -->
      </form>
      <div id="panel-pertanyaan">

      </div>
    </div>
  </div>
</div>

<!-- modal edit status -->
<div id="modal_edit_profil" class="modal fade" role="dialog" aria-labelledby="">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header text-center">
        <h2 class="modal-title">Edit Profil</h2>
      </div>
      <!-- END Modal Header -->

      <!-- Modal Body -->
      <div class="modal-body">
        <form id="fedit" class="form-horizontal" method="post" action="<?=base_url()?>">

          <div class="form-group">
            <div class="col-md-8">
              <label for="ienama">Nama *</label>
              <input id="ienama" class="form-control" name="fnama" value="<?=$sess->user->fnama?>" minlength="1" required />
            </div>
            <div class="col-md-4">
              <label for="ietelp">Telp/Hp</label>
              <input id="ietelp" name="telp" class="form-control" value="<?=$sess->user->telp?>" minlength="6" required* />
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
              <label for="iokupansi">Jenjang *</label>
              <select id="iokupansi" name="a_kategori_id_ocp" class="form-control" required>
              <?php foreach($ocp as $o){?>
                <option value="<?=$o->id?>" data-kode="<?=$o->kode?>"><?=$o->nama?></option>
              <?php } ?>
              </select>
            </div>
            <div class="col-md-8">
              <label for="ieinstansi">Instansi/Universitas *</label>
              <input id="ieinstansi" name="instansi" class="form-control" value="<?=$sess->user->instansi?>" required />
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
              <label for="inim">NIM </label>
              <input name="nim" id="inim" type="text" class="form-control" />
            </div>
            <div class="col-md-8">
              <label for="ia_kategori_id_jur">Fakultas/Jurusan </label>
              <select id="ia_kategori_id_jur" name="a_kategori_id_jur" class="form-control">
              <?php foreach($jur as $o){?>
                <option value="<?=$o->id?>" data-kode="<?=$o->kode?>" <?=($o->id == $sess->user->a_kategori_id_jur) ? 'selected' : ''?>><?=$o->nama?></option>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group form-actions">
            <div class="col-xs-12">
              <div class="btn-group pull-right" style="">
                <button type="button" class="btn btn-default btn-submit" data-dismiss="modal"><i class="fa fa-times  icon-submit"></i> Tutup</button>
                <button type="submit" class="btn btn-success btn-submit " ><i class="fa fa-save icon-submit"></i> Simpan</button>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal edit status -->
<div id="modal_password_ganti" class="modal fade" role="dialog" aria-labelledby="">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header text-center">
        <h2 class="modal-title">Ganti Password</h2>
        <p>Silakan masukan password terakhir, password baru beserta konfirmasinya. Setelah berhasil anda akan diarahkan untuk <b>login kembali</b>.</p>
      </div>
      <!-- END Modal Header -->

      <!-- Modal Body -->
      <div class="modal-body">
        <form id="fpassword_ganti" class="form-horizontal" method="post" action="<?=base_url()?>">
          <div class="form-group">
            <div class="col-md-12">
              <label for="igp_password_lama">Password Lama *</label>
              <input id="igp_password_lama" name="password_lama" type="password" class="form-control" required />
            </div>
            <div class="col-md-12">
              <label for="igp_password_baru">Password Baru *</label>
              <input id="igp_password_baru" name="password_baru" type="password" class="form-control" minlength="6" required />
            </div>
            <div class="col-md-12">
              <label for="igp_password_baru_konfirmasi">Konfirmasi Password Baru *</label>
              <input id="igp_password_baru_konfirmasi" name="password_baru_konfirmasi" type="password" class="form-control" minlength="6" required />
            </div>
          </div>
          <div class="form-group form-actions">
            <div class="col-xs-12">
              <div class="btn-group pull-right" style="">
                <button type="button" class="btn btn-default btn-submit" data-dismiss="modal"><i class="fa fa-times  icon-submit"></i> Tutup</button>
                <button type="submit" class="btn btn-success btn-submit " ><i class="fa fa-save icon-submit"></i> Simpan Perubahan</button>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
