@extends('layouts.admin-seat4w')

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
    <h1 class="h3 mb-4 text-gray-800">Struktur User</h1>
  </div>
  <div class="col">
    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#add_modal" name="button">Tambah</button>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table" id="table_daily">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Teknisi</th>
                <th scope="col">Leader</th>
                <th scope="col">Foreman</th>
                <th scope="col">Supervisor</th>
                <th scope="col">Manager</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
              @endphp
              @foreach ($struktur as $data)
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$data->teknisi != null ? $data->teknisi->nama : ''}}</td>
                  <td>{{$data->leader != null ? $data->leader->nama : ''}}</td>
                  <td>{{$data->foreman != null ? $data->foreman->nama : ''}}</td>
                  <td>{{$data->supervisor != null ? $data->supervisor->nama : ''}}</td>
                  <td>{{$data->manager != null ? $data->manager->nama : ''}}</td>
                  <td>
                    <button data-toggle="modal" data-target="#edit_modal{{$data->id}}" class="btn btn-primary btn-sm" name="button">Edit</button>
                  </td>
                </tr>
                @php
                  $no++;
                @endphp

                <div class="modal fade" id="edit_modal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form action="{{route('seat4w-user_management.update_struktur', $data->id)}}" method="post">
                        <div class="modal-header">
                          <h5 class="modal-title">Edit Struktur User</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          @csrf
                          <div class="form-group">
                            <label>Teknisi</label>
                            <select class="form-control" name="teknisi">
                              <option value=""> -- pilih teknisi --</option>
                              @foreach ($users as $user)
                                @if ($user->level == 1)
                                  @php
                                    if ($user->id == $data->teknisi->id) {
                                      $isselect = "selected";
                                    } else {
                                      $isselect = "";
                                    }
                                  @endphp
                                  <option value="{{$user->id}}" {{ $isselect }}>{{$user->nama}}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Leader</label>
                            <select class="form-control" name="leader">
                              <option value=""> -- pilih leader --</option>
                              @foreach ($users as $user)
                                @if ($user->level == 2)
                                  @php
                                    if ($user->id == $data->leader->id) {
                                      $isselect = "selected";
                                    } else {
                                      $isselect = "";
                                    }
                                  @endphp
                                  <option value="{{$user->id}}" {{ $isselect }}>{{$user->nama}}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Foreman</label>
                            <select class="form-control" name="foreman">
                              <option value=""> -- pilih foreman --</option>
                              @foreach ($users as $user)
                                @if ($user->level == 3)
                                  @php
                                    if ($user->id == $data->foreman->id) {
                                      $isselect = "selected";
                                    } else {
                                      $isselect = "";
                                    }
                                  @endphp
                                  <option value="{{$user->id}}" {{ $isselect }}>{{$user->nama}}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Supervisor</label>
                            <select class="form-control" name="supervisor">
                              <option value=""> -- pilih supervisor --</option>
                              @foreach ($users as $user)
                                @if ($user->level == 4)
                                  @php
                                    if ($user->id == $data->supervisor->id) {
                                      $isselect = "selected";
                                    } else {
                                      $isselect = "";
                                    }
                                  @endphp
                                  <option value="{{$user->id}}" {{ $isselect }}>{{$user->nama}}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Manager</label>
                            <select class="form-control" name="manager">
                              <option value=""> -- pilih manager --</option>
                              @foreach ($users as $user)
                                @if ($user->level == 5)
                                  @php
                                    if ($user->id == $data->manager->id) {
                                      $isselect = "selected";
                                    } else {
                                      $isselect = "";
                                    }
                                  @endphp
                                  <option value="{{$user->id}}" {{ $isselect }}>{{$user->nama}}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{route('seat4w-user_management.store_struktur')}}" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Struktur User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Teknisi</label>
            <select class="form-control" name="teknisi">
              <option value=""> -- pilih teknisi --</option>
              @foreach ($users as $user)
                @if ($user->level == 1)
                  <option value="{{$user->id}}">{{$user->nama}}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Leader</label>
            <select class="form-control" name="leader">
              <option value=""> -- pilih leader --</option>
              @foreach ($users as $user)
                @if ($user->level == 2)
                  <option value="{{$user->id}}">{{$user->nama}}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Foreman</label>
            <select class="form-control" name="foreman">
              <option value=""> -- pilih foreman --</option>
              @foreach ($users as $user)
                @if ($user->level == 3)
                  <option value="{{$user->id}}">{{$user->nama}}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Supervisor</label>
            <select class="form-control" name="supervisor">
              <option value=""> -- pilih supervisor --</option>
              @foreach ($users as $user)
                @if ($user->level == 4)
                  <option value="{{$user->id}}">{{$user->nama}}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Manager</label>
            <select class="form-control" name="manager">
              <option value=""> -- pilih manager --</option>
              @foreach ($users as $user)
                @if ($user->level == 5)
                  <option value="{{$user->id}}">{{$user->nama}}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
  <script type="text/javascript">
  $(document).ready( function () {
    $('#table_daily').DataTable({
      responsive: true,
      sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>',
    });
  });
  </script>
@endsection
