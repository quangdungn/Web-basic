@extends('layout')

@section('content')
    <h1>Sửa vấn đề #{{ $issue->id }}</h1>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('issues.update', $issue->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="computer_id">Máy tính:</label>
        <select name="computer_id" id="computer_id">
            @foreach($computers as $comp)
                <option value="{{ $comp->id }}" {{ $comp->id == $issue->computer_id ? 'selected' : '' }}>{{ $comp->computer_name }} - {{ $comp->model }}</option>
            @endforeach
        </select><br><br>

        <label for="reported_by">Người báo cáo:</label>
        <input type="text" name="reported_by" id="reported_by" value="{{ $issue->reported_by }}"><br><br>

        <label for="reported_date">Thời gian báo cáo:</label>
        <input type="datetime-local" name="reported_date" id="reported_date" value="{{ date('Y-m-d\TH:i', strtotime($issue->reported_date)) }}"><br><br>

        <label for="description">Mô tả:</label>
        <textarea name="description" id="description">{{ $issue->description }}</textarea><br><br>

        <label>Mức độ:</label>
        <select name="urgency">
            <option value="Low" {{ $issue->urgency == 'Low' ? 'selected' : '' }}>Low</option>
            <option value="Medium" {{ $issue->urgency == 'Medium' ? 'selected' : '' }}>Medium</option>
            <option value="High" {{ $issue->urgency == 'High' ? 'selected' : '' }}>High</option>
        </select><br><br>

        <label>Trạng thái:</label>
        <select name="status">
            <option value="Open" {{ $issue->status == 'Open' ? 'selected' : '' }}>Open</option>
            <option value="In Progress" {{ $issue->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Resolved" {{ $issue->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
        </select><br><br>

        <button type="submit">Cập nhật</button>
    </form>
@endsection

