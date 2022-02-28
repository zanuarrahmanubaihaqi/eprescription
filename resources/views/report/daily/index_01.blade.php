@extends('layouts.admin')

@section('css')
  <style media="screen">
  #table_daily {
    /* overflow-x: auto;
    overflow-y: visible; */
  }
  </style>
@endsection

@section('main-content')
    <!-- Page Heading -->
    <div class="row">
      <div class="col">
        <h1 class="h3 mb-4 text-gray-800">Daily Report</h1>
      </div>
    </div>

    <div class="row justify-content-center">

        <div class="col-lg-12">

            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="table-responsive">
                  <table border="0" cellspacing="5" cellpadding="5"  style="margin-left: -4px; margin-bottom: 10px;">
                    <tbody>
                      <tr>
                        <td>Mesin :</td>
                        <td>
                          <!-- <input type="text" id="tgl_pencarian" name="tgl_pencarian"> -->
                          <select name="select_mesin" id="select_mesin" onchange="showModalMesin();">
                            <option value="">-</option>
                            @php foreach ($line_form as $key => $value): @endphp
                              <option value="@php echo $value->mesin; @endphp">
                                @php
                                  echo "MC ASSY SEAT 2W LINE " . $value->mesin;
                                @endphp
                              </option>
                            @php endforeach @endphp
                          </select>
                        </td>
                        <td>Bulan :</td>
                        <td>
                          <select name="select_mesin" id="select_mesin" onchange="showModalMesin();">
                            <option value="">-</option>
                            @php foreach ($line_form as $key => $value): @endphp
                              <option value="@php echo $value->mesin; @endphp">
                                @php
                                  echo "MC ASSY SEAT 2W LINE " . $value->mesin;
                                @endphp
                              </option>
                            @php endforeach @endphp
                          </select>
                        </td>
                        <td>
                          <button class="btn btn-primary btn-sm" id="refresh">Show</button>
                        </td>
                        <td>
                          <button class="btn btn-secondary btn-sm" id="refresh">Refresh</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table" id="table_daily">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Mesin</th>
                        <th scope="col">Tanggal</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="body_table_daily">
                      @php
                        $no = 1;
                        $month_name = ['','Januari', 'Fabruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                      @endphp
                      @foreach ($reports as $data)
                        <tr>
                          <td>{{$no}}</td>
                          <td>MC SEEAT ASSY 2W LINE {{$data->mesin}}</td>
                          <td>{{ $data->hari }} {{$month_name[$data->bulan]}} {{$data->tahun}}</td>
                          <td>
                            <a href="{{url('report/daily/detail/'.$data->id)}}" class="btn btn-primary btn-sm" name="button">Detail</a>
                          </td>
                        </tr>
                        @php
                          $no++;
                        @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>

    <div id="mesinModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <p id="temp_text"></p>
            <div id="mesin_form_table">
              
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

@endsection

@section('js')
  <script type="text/javascript">
  $(document).ready( function () {
    $('#table_daily').DataTable({
      responsive: true,
      searching : false,
      sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>',
    });
    
    var versionNo = $.fn.dataTable.version;
    alert(versionNo);
  });

  $('#refresh').on('click', function(){
    location.reload();
  });

  function showModalMesin() {
      var mesin_form = $('#select_mesin').val();
      if (mesin_form == "") {
        location.reload();
      }
      var mesin = mesin_form.substr(0, 1);
      var month_name = ['','Januari', 'Fabruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      const root_url = "{{ URL::to('/') }}";
      const daily_url = root_url.concat('/report/daily/datadaily/'+ mesin);
      var temptgl = "";
      var tgl = "";
      var no = 0;
      var exturl = "";
      $('#table_daily').DataTable().destroy();
      // $('#table_daily .tbody').empty();
      $("#body_table_daily").html("");

      // $('#body_table_daily').html();

      // table.search(mesin_form).draw();

      // $('#mesinModal').modal('show');
      // $('#temp_text').html();
      // $('#temp_text').html("MC ASSY MIRROR 4W LINE " + mesin + " STATION " + form);

      $.ajax({
        url: daily_url,
        type: 'GET',
        dataType: 'JSON',
        cache : false,
        success: function(response){
          var konten = "";
          // console.log(response);
          // return false;
          for (var i = 0; i < response.length; i++) {
            no = no + 1;
            const exturl = root_url.concat('/report/daily/detail/'+ response[i].id);
            konten += "<tr>"+
                        "<td>"+
                          no+
                        "</td>"+
                        "<td>"+
                          "MC ASSY SEET 2W LINE " + response[i].mesin +
                        "</td>"+
                        "<td>";
                          tgl = response[i].tanggal;
                          temptgl = tgl.substr(8, 9) + " " + month_name[parseInt(tgl.substr(5, 6))] + " " + tgl.substr(0, 4);
                        konten +=
                        temptgl+
                        "</td>"+
                        "<td>"+
                          "<a href='" + exturl +"' class='btn btn-primary btn-sm' name='button'>Detail</a>"
                        "</td>"+
                      "</tr>";
          }
          $("#body_table_daily").html();
          $("#body_table_daily").html(konten);
          $('[name=table_daily_length]').attr('hidden', true);
        }
      });

      $('#table_daily').DataTable({
        // "responsive" : true,
        // "processing": true,
        "sDom" : 'r<"H"lf><"datatable-scroll"t><"F"ip>',
        "searching" : false,
        "responsive": true,
      });
      
    }

  // function showModalMesin() {
  //     var mesin_form = $('#select_mesin').val();
  //     var mesin = mesin_form;
  //     var month_name = ['','Januari', 'Fabruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
  //     const root_url = "{{ URL::to('/') }}";
  //     const daily_url = root_url.concat('/report/daily/datadaily/'+ mesin);
  //     var temptgl = "";
  //     var tgl = "";
  //     var no = 0;

  //     $('#mesinModal').modal('show');
  //     $('#temp_text').html();
  //     $('#temp_text').html("MC ASSY SEAT 2W LINE " + mesin);

  //     $.ajax({
  //       url: daily_url,
  //       type: 'GET',
  //       dataType: 'JSON',
  //       cache : false,
  //       success: function(response){
  //         var konten = "";
  //         // console.log(response[5].mesin);
  //         // return false;
  //         konten += "<table border=1 style='overflow-x: auto; overflow-y: auto; width: 100%'>"+
  //                       "<thead style='text-align: center; font-weight: bold;'>"+
  //                         "<tr>"+
  //                           "<th>No</th>"+
  //                           "<th>Tanggal</th>"+
  //                         "</tr>"+
  //                       "</thead>"+
  //                       "<tbody style='text-align: center;'>";
  //                       for (var i = 0; i < response.length; i++) {
  //                       no = no + 1;
  //                       konten += 
  //                         "<tr>"+
  //                           "<td>"+
  //                             no +
  //                           "</td>"+
  //                           "<td>";
  //                             tgl = response[i].tanggal;
  //                             temptgl = tgl.substr(8, 9) + " " + month_name[parseInt(tgl.substr(5, 6))] + " " + tgl.substr(0, 4);
  //                           konten +=
  //                           temptgl+
  //                           "</td>"+
  //                         "</tr>";
  //                       }
  //                       konten += "</tbody>";
  //                   "</table>";
  //         $("#mesin_form_table").html();          
  //         $("#mesin_form_table").html(konten);
  //         // console.log(response);
  //         return false;
  //       }
  //     });
  // }

  </script>
@endsection
