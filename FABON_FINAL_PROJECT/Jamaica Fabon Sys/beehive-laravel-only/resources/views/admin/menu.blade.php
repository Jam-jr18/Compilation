@extends('layout')
@section('title', 'manage menu')
@section('content')
<section class="section">
    <div class="section-title"><div><h2>Menu Management</h2><p class="muted">Add, edit, delete categories and menu items.</p></div></div>
    @include('admin.partials-nav')

    <div class="grid two">
        <div class="card">
            <h2>Add category</h2>
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="field"><label>Name</label><input class="input" name="name" required></div>
                <div class="field"><label>Sort order</label><input class="input" type="number" name="sort_order" value="0"></div>
                <button class="btn primary">Add Category</button>
            </form>
        </div>
        <div class="card">
            <h2>Add item</h2>
            <form method="POST" action="{{ route('admin.items.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="field"><label>Category</label><select class="select" name="menu_category_id" required>@foreach($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach</select></div>
                <div class="field"><label>Name</label><input class="input" name="name" required></div>
                <div class="field"><label>Description</label><textarea class="textarea" name="description"></textarea></div>
                <div class="field"><label>Price</label><input class="input" type="number" step="0.01" min="1" name="price" required></div>
                <div class="field"><label>Image upload</label><input class="input" type="file" name="image_file" accept="image/*"></div>
                <label><input type="checkbox" name="is_available" value="1" checked> Available</label><br><br>
                <button class="btn primary">Add Item</button>
            </form>
        </div>
    </div>
</section>

<section class="section">
    <div class="card">
        <h2>Categories</h2>
        <table class="table">
            <thead><tr><th>Name</th><th>Sort</th><th>Actions</th></tr></thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td colspan="3">
                        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="actions">
                            @csrf @method('PATCH')
                            <input class="input" style="max-width:240px" name="name" value="{{ $category->name }}">
                            <input class="input" style="max-width:100px" type="number" name="sort_order" value="{{ $category->sort_order }}">
                            <button class="btn blue mini">Save</button>
                        </form>
                        <form method="POST" action="{{ route('admin.categories.delete', $category) }}" onsubmit="return confirm('Delete this category? Items under it will also be deleted.')" style="margin-top:8px">
                            @csrf @method('DELETE')<button class="btn red mini">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>

<section class="section">
    <div class="section-title"><h2>Menu items</h2></div>
    <div class="grid two">
        @foreach($items as $item)
            <div class="card">
                <form method="POST" action="{{ route('admin.items.update', $item) }}" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="grid two">
                        <div>
                            @if($item->image_base64)<img src="{{ $item->image_base64 }}" style="height:150px;width:100%;object-fit:cover;border-radius:20px">@endif
                            <div class="field"><label>Replace image</label><input class="input" type="file" name="image_file" accept="image/*"></div>
                        </div>
                        <div>
                            <div class="field"><label>Category</label><select class="select" name="menu_category_id">@foreach($categories as $category)<option value="{{ $category->id }}" @selected($item->menu_category_id === $category->id)>{{ $category->name }}</option>@endforeach</select></div>
                            <div class="field"><label>Name</label><input class="input" name="name" value="{{ $item->name }}"></div>
                            <div class="field"><label>Price</label><input class="input" type="number" step="0.01" name="price" value="{{ $item->price }}"></div>
                        </div>
                    </div>
                    <div class="field"><label>Description</label><textarea class="textarea" name="description">{{ $item->description }}</textarea></div>
                    <label><input type="checkbox" name="is_available" value="1" @checked($item->is_available)> Available</label>
                    <div class="actions" style="margin-top:14px"><button class="btn blue">Save Item</button></div>
                </form>
                <form method="POST" action="{{ route('admin.items.delete', $item) }}" onsubmit="return confirm('Delete this item?')" style="margin-top:10px">
                    @csrf @method('DELETE')<button class="btn red">Delete Item</button>
                </form>
            </div>
        @endforeach
    </div>
</section>
@endsection
