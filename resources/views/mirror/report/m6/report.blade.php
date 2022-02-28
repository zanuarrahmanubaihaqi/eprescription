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
        <td colspan="7" class="text-center align-middle" style="vertical-align: middle;"> <h4><b>Engineering Preventive Maintenance Program & Checklist</b></h4> </td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="5">Machine Name : Plastic Injection</td>
        <td rowspan="3" class="text-center align-middle m1-text"><h1><b>HIGH</b></h1></td>
        <td colspan="3">No Dokumen : FR.MNTC.01-144</td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="5">Proses : Molding</td>
        <td colspan="3">Revisi</td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="5">Serial : </td>
        <td colspan="3">Efective Start</td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="6" rowspan="3" width="55%" class="align-middle text-center" style="vertical-align: middle;"><h1><b>Plant Maintenance</b></h1></td>
        <td colspan="2" width="15%" class="text-center">approved by</td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="2" height="80px;" class="align-bottom text-center" style="vertical-align: bottom;">{{ $approval_name }}</td>
      </tr>
      <tr style="font-size:10px;">
        <td colspan="2" class="text-center">Supervisor PE</td>
      </tr>
      <tr style="font-size:10px;">
        <th scope="col">No</th>
        <th scope="col">Item Check</th>
        <th scope="col">Service</th>
        <th scope="col">Standard</th>
        <th scope="col">Time</th>
        <th scope="col">OK/NG</th>
        <th scope="col">Remark</th>
      </tr>
    </thead>
    <tbody>
      @php
        $no = 1; $total_est_time = 0;
        $itemcheck = '';
      @endphp
      @for ($i=0; $i < count($master_data); $i++)
        @php
          $code = $master_data[$i]->kode;
        @endphp
        <tr style="font-size: 10px;">
          <td>{{$no}}</td>
          {{-- 
          @if ($master_data[$i]->itemCheck != $itemcheck)
            <td rowspan="{{array_count_values($itemchecks)[$master_data[$i]->itemCheck]}}">{{$master_data[$i]->itemCheck}}</td>
          @endif
          --}}
          @if ($master_data[$i]->itemCheck != $itemcheck)
            <td>{{$master_data[$i]->itemCheck}}</td>
          @else
            <td></td>
          @endif
          <td>{{$master_data[$i]->service}}</td>
          <td>{{$master_data[$i]->standard}}</td>
          <td>{{$master_data[$i]->estimasiWaktu}} min</td>
          <td>{{$reports[$code]}}</td>
          <td></td>
        </tr>
        @php
          $no++;
          $total_est_time += $master_data[$i]->estimasiWaktu;
          $itemcheck = $master_data[$i]->itemCheck;
        @endphp
      @endfor
    </tbody>
    <tr>
      <td colspan="12" class="bg-secondary"></td>
    </tr>
    <tr style="font-size:10px;">
      <td colspan="6" class="text-center">Total Estimation Time (min)</td>
      <td>{{$total_est_time}}</td>
    </tr>
    <tr style="font-size:10px;">
      <td colspan="4" rowspan="3" class="align-middle text-center"></td>
      <td colspan="6" width="15%" class="text-center">approved by</td>
    </tr>
    <tr style="font-size:10px;">
      <td colspan="6" height="80px;" class="align-bottom text-center" style="vertical-align: bottom;">{{ $approval_name }}</td>
    </tr>
    <tr style="font-size:10px;">
      <td colspan="6" class="text-center">Supervisor</td>
    </tr>
  </table>
