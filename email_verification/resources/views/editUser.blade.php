<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap Table with Add and Delete Row Feature</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('css/editUser.css')}}">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="{{ asset('js/scripts.js')}}"></script>

</head>
<body>
<div class="container-lg">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="row mt-auto p-5">
                        <div class="col-sm-6"><h2>Hi <b>{{ $data->username}}</b></h2></div>
                        <input type="hidden" id="username" value="{{ $data->username}}">
                        <div class="col-sm-4">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Choose actions 
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="{{ url('edit-user')}}">Edit</a>
                                  <a class="dropdown-item" href="{{ url('logout')}}">Logout</a>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$data->first_name}}</td>
                        <td>{{$data->last_name}}</td>
                        <td>{{$data->email}}</td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                        </td>
                    </tr>     
                </tbody>
            </table>
            {{-- edit password --}}
            <button type="button" class="btn-secondary newPassword">New password</button>
            <div class="addNewPassword">
            </div>
            <button type="button" class="btn-success mt-4" id="submit">Submit</button>
        </div>
    </div>
</div>     
</body>
</html>