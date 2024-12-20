@extends('layout')

@section('content')
    <h1>Thêm vấn đề mới</h1>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('issues.store') }}" method="POST">
        @csrf
        <label for="computer_id">Máy tính:</label>
        <select name="computer_id" id="computer_id">
            @foreach($computers as $comp)
                <option value="{{ $comp->id }}">{{ $comp->computer_name }} - {{ $comp->model }}</option>
            @endforeach
        </select><br><br>

        <label for="reported_by">Người báo cáo:</label>
        <input type="text" name="reported_by" id="reported_by"><br><br>

        <label for="reported_date">Thời gian báo cáo:</label>
        <input type="datetime-local" name="reported_date" id="reported_date"><br><br>

        <label for="description">Mô tả:</label>
        <textarea name="description" id="description"></textarea><br><br>

        <label>Mức độ:</label>
        <select name="urgency">
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select><br><br>

        <label>Trạng thái:</label>
        <select name="status">
            <option value="Open">Open</option>
            <option value="In Progress">In Progress</option>
            <option value="Resolved">Resolved</option>
        </select><br><br>

        <button type="submit">Lưu</button>
    </form>
@endsection

