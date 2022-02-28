@extends('layouts.admin-mirror')

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
                              <option value="@php echo $value->mesin .''. $value->form; @endphp">
                                @php
                                  echo "MC ASSY MIRROR 4W LINE " . $value->mesin . " STATION " . $value->form;
                                @endphp
                              </option>
                            @php endforeach @endphp
                          </select>
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
                          <td>MC ASSY MIRROR 4W LINE {{$data->mesin}} STATION {{ $data->form }}</td>
                          <td>{{ $data->hari }} {{$month_name[$data->bulan]}} {{$data->tahun}}</td>
                          <td>
                            <a href="{{url('mirror-report/daily/detail/'.$data->No)}}" class="btn btn-primary btn-sm" name="button">Detail</a>
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
    $(document).ready(function() {
        
    });

    $('#refresh').on('click', function(){
      location.reload();
    });

    var table = $('#table_daily').DataTable({
      // "responsive" : true,
      "sDom" : 'r<"H"lf><"datatable-scroll"t><"F"ip>',
      "searching" : false,
      "responsive": true,
      "iDisplayLength": 10,
    });
     

    function showModalMesin() {
      var mesin_form = $('#select_mesin').val();
      if (mesin_form == "") {
        location.reload();
      }
      var mesin = mesin_form.substr(0, 1);
      var form = mesin_form.substr(1);
      var month_name = ['','Januari', 'Fabruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      const root_url = "{{ URL::to('/') }}";
      const daily_url = root_url.concat('/mirror-report/daily/datadaily/'+ mesin + '/' + form);
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
            const exturl = root_url.concat('/mirror-report/daily/detail/'+ response[i].No);
            konten += "<tr>"+
                        "<td>"+
                          no+
                        "</td>"+
                        "<td>"+
                          "MC ASSY MIRROR 4W LINE " + response[i].mesin + " STATION " + response[i].form +
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
          // table.rows.add([{
          //   'mesin': '5',
          //   'form': 'aa',
          //   'tanggal': '8',
          //   'btn': 'null'
          //   }]).draw();
          // console.log(response);
          // return false;
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

  </script>

  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script> -->
  
  <!-- <script type="text/javascript">
    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date( data[4] );
     
            if (
                ( min === null && max === null ) ||
                ( min === null && date <= max ) ||
                ( min <= date   && max === null ) ||
                ( min <= date   && date <= max )
            ) {
                return true;
            }
            return false;
        }
    );

    $(document).ready( function () {
      // Create date inputs
      minDate = new DateTime($('#min'), {
          format: 'd MMMM YYYY'  
      });
      maxDate = new DateTime($('#max'), {
          format: 'd MMMM YYYY'
      });

      var table = $('#table_daily').DataTable({
        responsive: true,
        searching : false,
        sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>',
      });

      // Refilter the table
      $('#min, #max').on('change', function () {
        table.draw();
      });
    });
  </script> -->
@endsection
