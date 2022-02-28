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

    /* td .text-center {
      text-align: right;
    } */

    .text-center {
      margin: auto;
      text-align:center;
    }
  </style>
  <table class="table table-bordered table-sm table-hover" border="1">
    <thead>
      <tr>
        <td colspan="2">
          <img src="{{asset('img/logo-small.jpg')}}" height="50px" alt="">
        </td>
        <td colspan="17" class="text-center align-middle" style="vertical-align: middle;"> <h4><b>Engineering Preventive Maintenance Program & Checklist</b></h4> </td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="5">Machine Name : {{ $reports['mesin'] }}</td>
        <td rowspan="3" class="text-center align-middle m1-text"><h1><b>DAILY</b></h1></td>
        <td colspan="13">No Dokumen : FR.MNTC.01-144</td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="5">Proses : Assy Mirror</td>
        <td colspan="13">Revisi</td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="5">Serial : </td>
        <td colspan="13">Efective Start</td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="19" class="align-middle text-center" style="vertical-align: middle;"><h1><b>Plant Maintenance</b></h1></td>
      </tr>
      <tr style="font-size:10px;">
        <th scope="col">No</th>
        <th scope="col">Item Check</th>
        <th scope="col">Service</th>
        <th scope="col">Standard</th>
        <th scope="col">Time</th>
        <th scope="col">OK/NG</th>
        <th scope="col">Note 1</th>
        <th scope="col">Note 2</th>
        <th scope="col">Note 3</th>
        <th scope="col">Note 4</th>
        <th scope="col">Note 5</th>
        <th scope="col">Note 6</th>
        <th scope="col">Note 7</th>
        <th scope="col">Note 8</th>
        <th scope="col">Note 9</th>
        <th scope="col">Note 10</th>
        <th scope="col">Note 11</th>
        <th scope="col">Note 12</th>
        <th scope="col">Note 13</th>
      </tr>
    </thead>
    <tbody>
      @php
        $no = 1; $total_est_time = 0;
        $itemcheck = $master_data[0]->item_check;
      @endphp
      @for ($i=0; $i < count($master_data); $i++)
        @php
          $code = $master_data[$i]->kode;
          $arr_kode = ["m1", "m2", "m3", "m4", "m5", "m6", "m7", "m8", "m9", "m10", "m11", "m12", "m13"];
          
          if (in_array($code, $arr_kode)) {
        @endphp
        <tr style="font-size: 10px;">
            <td>{{$no}}</td>
            {{-- 
            @if ($master_data[$i]->item_check != $itemcheck)
              <td rowspan="{{array_count_values($itemchecks)[$master_data[$i]->item_check]}}">{{$master_data[$i]->item_check}}</td>
            @endif
            --}}
            @if ($no == 1)
              @if ($master_data[$i]->item_check == $itemcheck)
              <td rowspan="{{ count($master_data) }}">{{$master_data[$i]->item_check}}</td>
              @endif
            @endif
            <td>{{ $master_data[$i]->service }}</td>
            <td>{{ $master_data[$i]->standard }}</td>
            <td>{{ $master_data[$i]->estimasi_waktu }} min</td>
            <td>{{ $reports[$code] }}</td>
            <td>{{ $reports['notem1'] }}</td>
            <td>{{ $reports['notem2'] }}</td>
            <td>{{ $reports['notem3'] }}</td>
            <td>{{ $reports['notem4'] }}</td>
            <td>{{ $reports['notem5'] }}</td>
            <td>{{ $reports['notem6'] }}</td>
            <td>{{ $reports['notem7'] }}</td>
            <td>{{ $reports['notem8'] }}</td>
            <td>{{ $reports['notem9'] }}</td>
            <td>{{ $reports['notem10'] }}</td>
            <td>{{ $reports['notem11'] }}</td>
            <td>{{ $reports['notem12'] }}</td>
            <td>{{ $reports['notem13'] }}</td>
            @php
              $no = $no + 1;
              $total_est_time += $master_data[$i]->estimasi_waktu;
            @endphp
        </tr>
        @php
          }
          $itemcheck = $master_data[$i]->item_check;
        @endphp
      @endfor
    </tbody>
    <tr>
      <td colspan="19" class="bg-secondary"></td>
    </tr>
    <tr style="font-size:10px;">
      <td colspan="6" class="text-center">Total Estimation Time (min)</td>
      <td colspan="13">{{$total_est_time}}</td>
    </tr>
    <tr style="font-size:10px;">
      <td colspan="4" rowspan="3" class="align-middle text-center"></td>
      <td colspan="15" width="15%" class="text-center">{{ $tanggal }} <br> {{ $reports['petugas'] }}</td>
    </tr>
  </table>
