<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EMS > Expense</title>
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
            <p class="mt-auto mb-auto" style="font-size: 20px">Expenses</p>
            <p class="mt-auto mb-auto">Expense Management > Expenses</p>    
        </div>
        
    <div class="table-btn">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>Expense Category</th>
                    <th>Amount</th>
                    <th>Entry Date</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($displays as $display)
                    <tr ondblclick="openEditRoleModal('{{ $display->id }}', '{{ $display->category }}', '{{ $display->amount }}', '{{ $display->date }}')">
                        <td>{{ $display->category }}</td>
                        <td>{{ $display->amount }}</td>
                        <td>{{ $display->date }}</td>
                        <td>{{ $display->created_at->format('Y-m-d') }}</td>
                    </tr>

                    <div class="modal fade" id="editRoleModal{{ $display->id }}" tabindex="-1" aria-labelledby="editRoleModalLabel{{ $display->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editRoleModalLabel{{ $display->id }}">Update Expense</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="d-flex flex-column px-4" id="updateForm{{ $display->id }}" action="{{ route('updateExpense', $display->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3 d-flex justify-content-between">
                                            <label for="category{{ $display->id }}" class="form-label  mt-auto mb-auto">Expense Category</label>
                                            <select style="width:100%;max-width:300px" class="form-control" id="category{{ $display->id }}" name="category" required>
                                                <option value="" disabled selected>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-between">
                                            <label for="amount{{ $display->id }}" class="form-label  mt-auto mb-auto">Amount</label>
                                            <input style="width:100%;max-width:300px" type="number" class="form-control" name="amount" id="amount{{ $display->id }}" required>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-between">
                                            <label for="date{{ $display->id }}" class="form-label  mt-auto mb-auto">Entry Date</label>
                                            <input style="width:100%;max-width:300px" type="date" class="form-control" name="date" id="date{{ $display->id }}" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <div>
                                        <form action="{{ route('deleteExpense', $display->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" form="updateForm{{ $display->id }}" class="btn btn-primary btn-sm">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No Expenses Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    <div class="d-flex justify-content-end w-100 mt-5">
        <button type="button" class="btn-addRole" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
            Add Expense
        </button>
    </div>

        <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addExpenseModalLabel">Add Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="d-flex flex-column px-4" action="{{ route('addExpense') }}" method="POST">
                            @csrf
                            <div class="mb-3 d-flex justify-content-between">
                                <label for="category" class="form-label  mt-auto mb-auto">Expense Category</label>
                                <select  style="width:100%;max-width:300px" class="form-control" id="category" name="category" required>
                                    <option value="" disabled selected>Select Category</option> 
                                    @foreach($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <label for="amount" class="form-label  mt-auto mb-auto">Amount</label>
                                <input  style="width:100%;max-width:300px" type="number" class="form-control" name="amount" placeholder="Enter amount" required>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <label for="date" class="form-label  mt-auto mb-auto">Entry Date</label>
                                <input  style="width:100%;max-width:300px" type="date" class="form-control" name="date" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
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
        function openEditRoleModal(id, category, amount, date) {
            // Set the values for the modal
            document.getElementById('category' + id).value = category;
            document.getElementById('amount' + id).value = amount;
            document.getElementById('date' + id).value = date;
            // Show the modal
            var modal = new bootstrap.Modal(document.getElementById('editRoleModal' + id));
            modal.show();
        }
    </script>
</body>
</html>
