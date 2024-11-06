<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EMS > User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    
    <style>
         .container {
            position: absolute;
            top: 80px;
            right: 1rem;
            left: 15rem;
            max-width: calc(100vw - 16rem) !important;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .header-desc{
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 0 0 3rem;
            font-weight: 500 ;

        }
        td{
            cursor: pointer;
        }
        th{
            font-weight: 500 !important;
            background-color: #ccc !important;
            padding: 0 !important
        }
        .table-btn{ 
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: flex-start;
            width: 100%;
            max-width: 75%;
            padding: 0 2rem 0;
        }
        .btn-addRole{
            font-size: 14px;
            padding: 0 8px;
            border: 2px solid #3a3a3a;
            background-color: #fff;
        }
        table{
            border: 2px solid #3a3a3a !important;
        }
        table td, table th{
            border-right: 2px solid #3a3a3a !important;
            border-bottom: none !important;
            padding-left: 2px !important
        }
        
        .table td:last-child, .table th:last-child {
            border-right: none;
        }

        </style>
</head>
<body>
    @if(session('successKey'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            iziToast.success({
                title: 'Success',
                message: "{{ session('successKey') }}", 
            });
        });
    </script>
@endif
@if(session('updateKey'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            iziToast.success({
                title: 'Success',
                message: "{{ session('updateKey') }}", 
            });
        });
    </script>
@endif
@if(session('deleteKey'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            iziToast.success({
                title: 'Success',
                message: "{{ session('deleteKey') }}", 
            });
        });
    </script>
@endif
    <x-Navigation/>
    <div class="container">
        <div class="header-desc">
            <p class="mt-auto mb-auto" style="font-size: 20px">Users</p>
            <p class="mt-auto mb-auto">User Management > Users</p>    
        </div>
        

    <div class="table-btn">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($displays as $display)
                    <tr>
                        <td ondblclick="openEditRoleModal('{{ $display->id }}')">{{ $display->name }}</td>
                        <td ondblclick="openEditRoleModal('{{ $display->id }}')">{{ $display->email }}</td>
                    @if ($display->role == 1)
                        <td ondblclick="openEditRoleModal('{{ $display->id }}')">Administrator</td>
                    @else
                        <td ondblclick="openEditRoleModal('{{ $display->id }}')">User</td>
                    @endif
                        <td ondblclick="openEditRoleModal('{{ $display->id }}')">{{ $display->created_at->format('Y-d-m') }}</td>
                    </tr>

                    <div class="modal fade" id="editRoleModal{{ $display->id }}" tabindex="-1" aria-labelledby="editRoleModalLabel{{ $display->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editRoleModalLabel{{ $display->id }}">Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Update Form -->
                                    <form class="d-flex flex-column px-4" id="updateForm{{ $display->id }}" action="{{ route('updateUser', $display->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3 d-flex gap-2 justify-content-between">
                                            <label class="mt-auto mb-auto" for="name{{ $display->id }}" class="form-label">Name</label>
                                            <input style="width:100%;max-width:300px" type="text" class="form-control" name="name" id="name{{ $display->id }}" value="{{ $display->name }}" required>
                                        </div>
                                        <div class="mb-3 d-flex gap-2 justify-content-between">
                                            <label class="mt-auto mb-auto" for="email{{ $display->id }}" class="form-label">Email</label>
                                            <input style="width:100%;max-width:300px" type="email" class="form-control" name="email" id="email{{ $display->id }}" value="{{ $display->email }}" required>
                                        </div>
                                        <div class="mb-3 d-flex gap-2 justify-content-between">
                                            <label class="mt-auto mb-auto" for="role{{ $display->id }}" class="form-label">Role</label>
                                            <select style="width:100%;max-width:300px" name="role" id="role{{ $display->id }}" class="form-select" required>
                                                <option value="{{$display->role}}" selected disabled>Select Role</option>
                                                <option value="0">User</option>
                                                <option value="1">Admin</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <!-- Delete Form  -->
                                    <div>
                                        @if ($display->role == 0)
                                            <form action="{{ route('deleteUser', $display->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                    @if ($display->role == 0)
                                        <button type="submit" form="updateForm{{ $display->id }}" class="btn btn-primary btn-sm">Update</button>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="4">No user found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    <div class="d-flex justify-content-end w-100 mt-5">
        <button type="button" class="btn-addRole" data-bs-toggle="modal" data-bs-target="#addRoleModal">
            Add User
        </button>
    </div>

        <!-- Modal  -->
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoleModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Inside Modal -->
                        <form class="d-flex flex-column px-4" action="{{ route('addUser') }}" method="POST">
                            @csrf
                            <div class="mb-3 d-flex justify-content-between">
                                <label for="name" class="form-label mt-auto mb-auto">Name</label>
                                <input  style="width:100%;max-width:300px" type="text" class="form-control" name="name" placeholder="Enter name" required>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <label for="email" class="form-label mt-auto mb-auto">Email</label>
                                <input  style="width:100%;max-width:300px" type="email" class="form-control" name="email" placeholder="Enter email" required>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <label for="role" class="form-label mt-auto mb-auto">Role</label>
                                <select  style="width:100%;max-width:300px" name="role" class="form-select" required>
                                    <option value="" selected disabled>Select Role</option>
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        function openEditRoleModal(roleId) {
            const modal = new bootstrap.Modal(document.getElementById('editRoleModal' + roleId));
            modal.show();
        }
    </script>
</body>
</html>
