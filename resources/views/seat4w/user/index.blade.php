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

  @if (Session::has('message'))
    <div class="alert alert-success" role="alert">
      {{Session::get('message')}}
    </div>
  @endif
    <!-- Page Heading -->
    <div class="row">
      <div class="col">
        <h1 class="h3 mb-4 text-gray-800">Data User</h1>
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
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Level</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $no = 1;
                      @endphp
                      @foreach ($users as $data)
                        <tr>
                          <td>{{$no}}</td>
                          <td>{{$data->nama}}</td>
                          <td>{{$data->username}}</td>
                          <td>{{$data->password}}</td>
                          <td>{{$data->level}}</td>
                          <td>
                            <button data-toggle="modal" data-target="#edit_modal{{$data->id}}" class="btn btn-primary btn-sm" name="button">Edit</button>
                            <a href="{{route('seat4w-user_management.delete', $data->id)}}" onclick="return confirm('Yakin ingin menghapus user ini ?');" class="btn btn-danger btn-sm" name="button">Hapus</a>
                          </td>
                        </tr>
                        @php
                          $no++;
                        @endphp

                        <div class="modal fade" id="edit_modal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="{{route('seat4w-user_management.update', $data->id)}}" method="get">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit User {{$data->nama}}</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  @csrf
                                  <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{$data->nama}}">
                                  </div>
                                  <div class="row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" value="{{$data->username}}">
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control" value="{{$data->password_text}}">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label>E-Mail</label>
                                    <input type="text" name="email" class="form-control" value="{{$data->email}}">
                                  </div>
                                  <div class="form-group">
                                    <label>Level</label>
                                    <select class="form-control" name="level">
                                      <option>-- pilih level --</option>
                                      @foreach ($levels as $level)
                                        <option value="{{$level->id}}" {{$level->level == $data->level ? 'selected' : ''}}>{{$level->level}}</option>
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
          <form action="{{route('seat4w-user_management.store')}}" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              @csrf
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-control">
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>E-Mail</label>
                <input type="text" name="email" class="form-control">
              </div>
              <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level">
                  <option>-- pilih level --</option>
                  @foreach ($levels as $level)
                    <option value="{{$level->id}}">{{$level->level}}</option>
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
