@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Manage Issues</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	color: #566787;
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
	font-size: 13px;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	min-width: 1000px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {        
	padding-bottom: 15px;
	background: #435d7d;
	color: #fff;
	padding: 16px 30px;
	min-width: 100%;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}
.table-title h2 {
	margin: 5px 0 0;
	font-size: 24px;
}
.table-title .btn-group {
	float: right;
}
.table-title .btn {
	color: #fff;
	float: right;
	font-size: 13px;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
}
.table-title .btn i {
	float: left;
	font-size: 21px;
	margin-right: 5px;
}
.table-title .btn span {
	float: left;
	margin-top: 2px;
}
table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 12px 15px;
	vertical-align: middle;
}
table.table tr th:first-child {
	width: 60px;
}
table.table tr th:last-child {
	width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}
table.table th i {
	font-size: 13px;
	margin: 0 5px;
	cursor: pointer;
}	
table.table td a {
	font-weight: bold;
	color: #566787;
	text-decoration: none;
	outline: none !important;
}
table.table td a:hover {
	color: #2196F3;
}
table.table td a.edit {
	color: #FFC107;
}
table.table td a.delete {
	color: #F44336;
}
.pagination {
	float: right;
	margin: 0 0 5px;
}
.pagination li a {
	border: none;
	font-size: 13px;
	min-width: 30px;
	min-height: 30px;
	color: #999;
	margin: 0 2px;
	line-height: 30px;
	border-radius: 2px !important;
	text-align: center;
	padding: 0 6px;
}
.pagination li a:hover {
	color: #666;
}	
.pagination li.active a, .pagination li.active a.page-link {
	background: #03A9F4;
	color: #fff;
}
.pagination li.active a:hover {        
	background: #0397d6;
}
.hint-text {
	float: left;
	margin-top: 10px;
	font-size: 13px;
}    

.modal .modal-dialog {
	max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 3px;
	font-size: 14px;
}
.modal .modal-footer {
	background: #ecf0f1;
	border-radius: 0 0 3px 3px;
}
.modal form label {
	font-weight: normal;
}	
</style>
</head>
<body>
<div class="container-xl">
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Issues</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addIssueModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Issue</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
                        <th>ID</th>
                        <th>Computer Name</th>
                        <th>Model</th>
                        <th>Reported By</th>
                        <th>Reported Date</th>
                        <th>Urgency</th>
                        <th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				    @foreach($issues as $issue)
					<tr>
                        <td>{{ $issue->id }}</td>
                        <td>{{ $issue->computer->computer_name ?? '' }}</td>
                        <td>{{ $issue->computer->model ?? '' }}</td>
                        <td>{{ $issue->reported_by }}</td>
                        <td>{{ $issue->reported_date }}</td>
                        <td>{{ $issue->urgency }}</td>
                        <td>{{ $issue->status }}</td>
						<td>
							<a href="#editIssueModal" class="edit" data-toggle="modal"
							   data-id="{{ $issue->id }}"
							   data-computer_id="{{ $issue->computer_id }}"
							   data-reported_by="{{ $issue->reported_by }}"
							   data-reported_date="{{ $issue->reported_date }}"
							   data-description="{{ $issue->description }}"
							   data-urgency="{{ $issue->urgency }}"
							   data-status="{{ $issue->status }}"
							><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>

							<a href="#deleteIssueModal" class="delete" data-toggle="modal"
							   data-id="{{ $issue->id }}"
							><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			
            <div class="clearfix">
                <div class="hint-text">
                    Showing <b>{{ $issues->firstItem() }}</b> to <b>{{ $issues->lastItem() }}</b> of <b>{{ $issues->total() }}</b> entries
                </div>
                {{ $issues->links('vendor.pagination.custom') }}
            </div>


		</div>
	</div>        
</div>

<div id="addIssueModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ route('issues.store') }}" method="post">
			    @csrf
				<div class="modal-header">						
					<h4 class="modal-title">Add Issue</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Computer</label>
						<select class="form-control" name="computer_id" required>
						    @foreach($computers as $comp)
						        <option value="{{ $comp->id }}">{{ $comp->computer_name }} - {{ $comp->model }}</option>
						    @endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Reported By</label>
						<input type="text" class="form-control" name="reported_by" required>
					</div>
					<div class="form-group">
						<label>Reported Date</label>
						<input type="datetime-local" class="form-control" name="reported_date" required>
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="description" required></textarea>
					</div>
					<div class="form-group">
						<label>Urgency</label>
						<select class="form-control" name="urgency" required>
						    <option value="Low">Low</option>
						    <option value="Medium">Medium</option>
						    <option value="High">High</option>
						</select>
					</div>
					<div class="form-group">
						<label>Status</label>
						<select class="form-control" name="status" required>
						    <option value="Open">Open</option>
						    <option value="In Progress">In Progress</option>
						    <option value="Resolved">Resolved</option>
						</select>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>



<div id="editIssueModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="editForm" method="post">
			    @csrf
			    @method('PUT')
				<div class="modal-header">						
					<h4 class="modal-title">Edit Issue</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Computer</label>
						<select class="form-control" name="computer_id" id="edit_computer_id" required>
						    @foreach($computers as $comp)
						        <option value="{{ $comp->id }}">{{ $comp->computer_name }} - {{ $comp->model }}</option>
						    @endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Reported By</label>
						<input type="text" class="form-control" name="reported_by" id="edit_reported_by" required>
					</div>
					<div class="form-group">
						<label>Reported Date</label>
						<input type="datetime-local" class="form-control" name="reported_date" id="edit_reported_date" required>
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="description" id="edit_description" required></textarea>
					</div>
					<div class="form-group">
						<label>Urgency</label>
						<select class="form-control" name="urgency" id="edit_urgency" required>
						    <option value="Low">Low</option>
						    <option value="Medium">Medium</option>
						    <option value="High">High</option>
						</select>
					</div>
					<div class="form-group">
						<label>Status</label>
						<select class="form-control" name="status" id="edit_status" required>
						    <option value="Open">Open</option>
						    <option value="In Progress">In Progress</option>
						    <option value="Resolved">Resolved</option>
						</select>
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>

<div id="deleteIssueModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="deleteForm" method="post">
			    @csrf
			    @method('DELETE')
				<div class="modal-header">						
					<h4 class="modal-title">Delete Issue</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete this Issue?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$('a.edit').on('click', function(){
		var id = $(this).data('id');
		var computer_id = $(this).data('computer_id');
		var reported_by = $(this).data('reported_by');
		var reported_date = $(this).data('reported_date');
		var description = $(this).data('description');
		var urgency = $(this).data('urgency');
		var status = $(this).data('status');

		$('#edit_computer_id').val(computer_id);
		$('#edit_reported_by').val(reported_by);
		let rd = new Date(reported_date);
		let formattedDate = rd.getFullYear()+'-' + ("0"+(rd.getMonth()+1)).slice(-2) + '-'+ ("0" + rd.getDate()).slice(-2)+'T'+("0"+rd.getHours()).slice(-2)+':'+("0"+rd.getMinutes()).slice(-2);
		$('#edit_reported_date').val(formattedDate);

		$('#edit_description').val(description);
		$('#edit_urgency').val(urgency);
		$('#edit_status').val(status);

		$('#editForm').attr('action', '/issues/' + id);
	});

	$('a.delete').on('click', function(){
		var id = $(this).data('id');
		$('#deleteForm').attr('action', '/issues/' + id);
	});
});
</script>
</body>
</html>
@endsection
