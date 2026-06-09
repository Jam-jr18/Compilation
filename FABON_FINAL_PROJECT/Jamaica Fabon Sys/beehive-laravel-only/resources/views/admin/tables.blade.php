@extends('layout')
@section('title', 'manage tables')
@section('content')
<section class="section">
    <div class="section-title"><div><h2>Table Management</h2><p class="muted">Create tables and manage occupancy.</p></div></div>
    @include('admin.partials-nav')

    <div class="card">
        <h2>Add table</h2>
        <form method="POST" action="{{ route('admin.tables.store') }}" class="actions">
            @csrf
            <input class="input" style="max-width:260px" name="name" placeholder="Table name" required>
            <input class="input" style="max-width:140px" type="number" name="capacity" value="4" min="1" max="30" required>
            <button class="btn primary">Add Table</button>
        </form>
    </div>
</section>

<section class="section">
    <div class="card">
        <h2>Tables</h2>
        <table class="table">
            <thead><tr><th>Name</th><th>Capacity</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($tables as $table)
                    <tr>
                        <td colspan="4">
                            <form method="POST" action="{{ route('admin.tables.update', $table) }}" class="actions">
                                @csrf @method('PATCH')
                                <input class="input" style="max-width:240px" name="name" value="{{ $table->name }}">
                                <input class="input" style="max-width:100px" type="number" name="capacity" value="{{ $table->capacity }}" min="1" max="30">
                                <select class="select" style="max-width:170px" name="status">
                                    @foreach(['available','occupied','reserved'] as $status)
                                        <option value="{{ $status }}" @selected($table->status === $status)>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                <span class="badge {{ $table->status }}">{{ $table->status }}</span>
                                <button class="btn blue mini">Save</button>
                            </form>
                            <form method="POST" action="{{ route('admin.tables.delete', $table) }}" onsubmit="return confirm('Delete this table?')" style="margin-top:8px">
                                @csrf @method('DELETE')<button class="btn red mini">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">No tables yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
