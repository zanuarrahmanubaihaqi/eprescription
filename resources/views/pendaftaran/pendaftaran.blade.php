@extends('layouts.admin')

@section('main-content')

<div class="row">
  <div class="col">
    <h1 class="h3 mb-4 text-gray-800">Pendaftaran</h1>
  </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary" data-collapsed="0">
						<div class="panel-body">
							<form method="POST" action="{{ 'pendaftaran.tambah' }}">
							@csrf
								<div class="form-group">
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Nama</label>
										<input type="text" name="name" id="name">
									</div>
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Jenis Kelamin</label>
										<select name="jenis_kelamin" id="gol_darah">
											<option value="">-</option>
											<option value="1">Laki-Laki</option>
											<option value="2">Perempuan</option>
											<option value="8">Lain-Lain</option>
										</select>
									</div>
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Golongan Darah</label>
										<select name="gol_darah" id="gol_darah">
											<option value="-">-</option>
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="AB">AB</option>
											<option value="O">O</option>
											<option value="Lain">Lain-Lain</option>
										</select>
									</div>
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Pekerjaan</label>
										<input type="text" name="pekerjaan" id="pekerjaan">
									</div>
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Nomor Telepon</label>
										<input type="text" name="telp" id="telp">
									</div>
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Alamat</label>
										<input type="text" name="alamat" id="alamat">
									</div>
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Kecamatan</label>
										<input type="text" name="kec" id="kec">
									</div>
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Kelurahan</label>
										<input type="text" name="kel" id="kel">
									</div>
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Kota</label>
										<input type="text" name="kota" id="kota">
									</div>
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Provinsi</label>
										<input type="text" name="prov" id="prov">
									</div>
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Agama</label>
										<input type="text" name="agama" id="agama">
									</div>
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Status Perkawinan</label>
										<input type="text" name="status_perkawinan" id="status_perkawinan">
									</div>
									<div class="col-sm-10">
										<label for="field-1" class="col-sm-3 control-label" style="text-align:left;">&emsp;&emsp;Tanggal Lahir</label>
										<input type="date" name="tgl_lahir" id="tgl_lahir">
									</div>
								</div>
								<div class="form-group center-block pull-left" style="margin-left: 20px;">
									<button type="submit" id="simpan" class="btn btn-green btn-icon icon-left col-left">
									Simpan
									<i class="entypo-check"></i>
									</button>
									<a href="{{ route('home') }}" class="btn btn-red btn-icon icon-left">
											Kembali
										<i class="entypo-cancel"></i>
									</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
          </div>
        </div>
    </div>
</div>

@endsection