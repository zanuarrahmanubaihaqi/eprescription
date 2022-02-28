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
        <td colspan="11" class="text-center align-middle" style="vertical-align: middle;"> <h4><b>Engineering Preventive Maintenance Program & Checklist</b></h4> </td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="5">Machine Name : MIRROR ASSY 4W LINE {{ $reports['mesin'] }} STATION {{ $reports['form'] }}</td>
        <td rowspan="3" class="text-center align-middle m1-text"><h1><b>DAILY</b></h1></td>
        <td colspan="7">No Dokumen : FR.MNTC.01-144</td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="5">Proses : Assy Mirror</td>
        <td colspan="7">Revisi</td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="5">Serial : </td>
        <td colspan="7">Efective Start</td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="12" class="align-middle text-center" style="vertical-align: middle;"><h1><b>Plant Maintenance</b></h1></td>
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
      </tr>
    </thead>
    <tbody>
      @php
        $no = 1; $total_est_time = 0;
        $itemcheck = $master_data[0]->itemCheck;
      @endphp
      @for ($i=0; $i < count($master_data); $i++)
        @php
          $code = $master_data[$i]->kode;
          $arr_kode = ["m1", "m2", "m3", "m4", "m5"];
          $arr_form = explode(', ', $master_data[$i]->form);
          $form = $reports['form'];
          if (in_array($code, $arr_kode)) {
        @endphp
        <tr style="font-size: 10px;">
          @if (in_array($form, $arr_form))
            <td>{{$no}}</td>
            {{-- 
            @if ($master_data[$i]->itemCheck != $itemcheck)
              <td rowspan="{{array_count_values($itemchecks)[$master_data[$i]->itemCheck]}}">{{$master_data[$i]->itemCheck}}</td>
            @endif
            --}}
            @if ($no == 1)
              @if ($master_data[$i]->itemCheck == $itemcheck)
              <td rowspan="{{ count($master_data) }}">{{$master_data[$i]->itemCheck}}</td>
              @endif
            @endif
            <td>{{ $master_data[$i]->service }}</td>
            <td>{{ $master_data[$i]->standard }}</td>
            <td>{{ $master_data[$i]->estimasiWaktu }} min</td>
            <td>{{ $reports[$code] }}</td>
            <td>{{ $reports['notem1'] }}</td>
            <td>{{ $reports['notem2'] }}</td>
            <td>{{ $reports['notem3'] }}</td>
            <td>{{ $reports['notem4'] }}</td>
            <td>{{ $reports['notem5'] }}</td>
            @php
              $no = $no + 1;
              $total_est_time += $master_data[$i]->estimasiWaktu;
            @endphp
          @endif
        </tr>
        @php
          }
          $itemcheck = $master_data[$i]->itemCheck;
        @endphp
      @endfor
    </tbody>
    <tr>
      <td colspan="12" class="bg-secondary"></td>
    </tr>
    <tr style="font-size:10px;">
      <td colspan="6" class="text-center">Total Estimation Time (min)</td>
      <td colspan="5">{{$total_est_time}}</td>
    </tr>
    <tr style="font-size:10px;">
      <td colspan="4" rowspan="3" class="align-middle text-center"></td>
      <td colspan="10" width="15%" class="text-center">{{ $tanggal }} <br> {{ $reports['petugas'] }}</td>
    </tr>
  </table>
