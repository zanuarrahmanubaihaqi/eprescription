<style>
  body
  {
    margin: none;
  }

  .scrollable {
    overflow: auto;
  }

  .rotated-header th {
    height: 100px;
    vertical-align: bottom;
    text-align: left;
    line-height: 1;
  }

  .rotated-header-container {
    width: 21px;
  }

  .rotated-header-content {
    width: 300px;
    transform-origin: bottom left;
    transform: translateX(16px) rotate(-90deg);
    font-size: 12px;
  }

  .rotated-header td:not(:first-child) {
    text-align: left;
    font-size: 12px;
  }

  table {
    border-collapse: collapse;
  }

  table, td, th {
    border: 1px solid black;
  }
/*
  td {
    width: 20px;
  } */

  td .ok-ng {
    font-size: 10px;
  }

  td .text-center {
    text-align: right;
  }
</style>
<table class="table table-bordered rotated-header table-sm" border="1" width="20%">
  <thead>
    <tr>
      <td colspan="2" rowspan="3">
        <img src="{{asset('img/logo.jpeg')}}" height="80" alt="">
      </td>
      <td colspan="25" rowspan="3" class="text-center text-lg" style="font-size:20px; text-align:center">Engineering Preventive Maintenance Program & Checklist (Daily Check)</td>
      <td colspan="4">No Document</td>
      <td colspan="4">FR-MNTC.01-035</td>
    </tr>
    <tr>
      <td colspan="4" style="font-size:12px;">Revision</td>
      <td colspan="4" style="font-size:12px;">04</td>
    </tr>
    <tr>
      <td colspan="4" style="font-size:12px;">Effective Start</td>
      <td colspan="4" style="font-size:12px;">01 Juni 2016</td>
    </tr>
    <tr>
      <td colspan="3" rowspan="5" class="text-center text-md" style="font-size:20px; text-align:center">Plan Maintenance</td>
      <td colspan="16">Nama Mesin : Injection Molding</td>
      <td colspan="8" style="text-align:center;">Diketahui</td>
      <td colspan="4" style="text-align:center;">Diperiksa</td>
      <td colspan="4" style="text-align:center;">Dibuat Oleh</td>
    </tr>
    <tr>
      <td colspan="16" style="font-size:12px;">Proses : </td>
      <td colspan="4" style="text-align:center;" rowspan="3">nama</td>
      <td colspan="4" style="text-align:center;" rowspan="3">nama</td>
      <td colspan="4" style="text-align:center;" rowspan="3">nama</td>
      <td colspan="4" style="text-align:center;" rowspan="3">nama</td>
    </tr>
    <tr>
      <td colspan="16" style="font-size:12px;">Nomor : </td>
    </tr>
    <tr>
      <td colspan="16" style="font-size:12px;">Serial : </td>
    </tr>
    <tr>
      <td colspan="16" style="font-size:12px;">Area : </td>
      <td colspan="4" style="text-align:center;">Dept Head prod</td>
      <td colspan="4" style="text-align:center;">Dept Head Eng</td>
      <td colspan="4" style="text-align:center;">Supervisor Engineering</td>
      <td colspan="4" style="text-align:center;">Foreman Engineering</td>
    </tr>
    <tr>
      <td rowspan="2" width="10%" style="text-align:center;"><b>No</b></td>
      <td rowspan="2" style="text-align:center;"><b>Aktivitas Pemeliharaan</b></td>
      <td rowspan="2" style="text-align:center;"><b>Standar</b></td>
      <td style="text-align:center;"><b>Time est</b></td>
      <td colspan="32" style="text-align:center;"><b>Pengecekan Kondisi</b></td>
    </tr>
    <tr>
      <td style="text-align:center;">Tgl</td>
      @for ($i=1; $i <= 31; $i++)
        <td style="text-align:center;"><b>{{$i}}</b></td>
      @endfor
    </tr>
  </thead>
  <tbody>
    <tr>
      <td></td>
      <td style="text-align:center;">Operator Produksi</td>
      <td></td>
      <td></td>
      @for ($i=1; $i <= 31; $i++)
        @foreach ($data['namaMP'] as $key => $val)
          @php
            if ($key == $i) {
              $namaMP = $val;
              break;
            } else {
              $namaMP = '';
            }
          @endphp
        @endforeach
        <th>
          <div class="rotated-header-container">
            <div class="rotated-header-content">{{$namaMP}}</div>
          </div>
        </th>
      @endfor
    </tr>
    @php
      $no = 1;
    @endphp
    @foreach ($master_data as $master)
      @php
        $arr_form = explode(', ', $master->form);
        $kode = $master->kode;
      @endphp
      <tr>
        <td>{{$no}}</td>
        <td>{{$master->service}}</td>
        <td>{{$master->standard}}</td>
        <td class="text-center">{{$master->estimasiWaktu}}</td>
        @for ($i=1; $i <= 31; $i++)
          @php 
            $arr_kode = ["m1", "m2", "m3", "m4", "m5"];
            // dd($kode, $arr_kode, in_array($kode, $arr_kode), $form, $arr_form, in_array($form, $arr_form));
            $namaMP = '';
            if (in_array($kode, $arr_kode)) {
          @endphp
            @foreach ($data[$kode] as $key => $val)
              @php
                if ($key == $i) {
                  if (in_array($form, $arr_form)) {
                    $namaMP = $val;
                  } else {
                    $namaMP = '';
                  }
                }
              @endphp
            @endforeach
          @php
            }
          @endphp
          <td class="ok-ng">{{$namaMP}}</td>
        @endfor
      </tr>
      @php
        $no++;
      @endphp
    @endforeach
  </tbody>
</table>
