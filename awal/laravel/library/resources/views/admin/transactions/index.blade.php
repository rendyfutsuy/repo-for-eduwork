@extends('layouts.admin')

@section('title', 'Transaction')
@section('page-heading', 'Data Transaction')

@section('css')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('create-button')
    <a href="{{ route('transactions.create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Transaction</a>
    <select data-column="7" class="filter-select-status">
        <option value="">Choose Status</option>
        <option value="Borrowed">Borrowed</option>
        <option value="Returned">Returned</option>
    </select>
    <select data-column="1" class="filter-select-date">
        <option value="">Choose Borrowed Date</option>
        @foreach ($listOfBorrowedDate as $date)
            <option value="{{ $date->date_start->format('d F Y') }}">{{ $date->date_start->format('d F Y') }}</option>
        @endforeach
    </select>
@endsection

@section('content')
    <table class="table w-100" id="transactions-table">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Borrow Date</th>
                <th scope="col">Return Date</th>
                <th scope="col">Borrower Name</th>
                <th scope="col">Duration</th>
                <th scope="col">Total Books</th>
                <th scope="col">Total Cost</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection

@section('js')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function() {
    var table = $('#transactions-table').DataTable({
        "scrollX": true,
        processing: true,
        serverSide: true,
        ajax: "{{ url('/api/transactions') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'borrow_date', name: 'borrow_date'},
            {data: 'return_date', name: 'return_date'},
            {data: 'member.name', name: 'member.name'},
            {data: 'duration', name: 'duration'},
            {data: 'total_books', name: 'total_books'},
            {data: 'total_cost_rupiah', name: 'total_cost_rupiah'},
            {data: 'transaction_status', name: 'transaction_status'},
            {render: function (index, row, data, meta) {
                return `
                <div class="d-sm-flex align-items-center justify-content-between">
                    <a href="/transactions/${data.id}" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mr-2"><i class="fas fa-eye fa-sm text-white-50"></i></a>
                    <a href="/transactions/${data.id}/edit" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2"><i class="fas fa-edit fa-sm text-white-50"></i></a>
                    <form action="/transactions/${data.id}" method="post">
                    @csrf
                    @method('delete')
                        <button onclick="return confirm('Are you sure?');" type="submit" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-sm text-white-50"></i></button>
                    </form>
                <div>
                `
            }, orderable: false, searchable: false},
        ]
    });

   $('.filter-select-date').change(function() {
        table.column($(this).data('column'))
            .search($(this).val())
            .draw()
   })

   $('.filter-select-status').change(function() {
        table.column($(this).data('column'))
            .search($(this).val())
            .draw()
   })
});
</script>
@endsection