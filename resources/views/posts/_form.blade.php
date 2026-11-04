@php $editing = isset($post); @endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
        </ul>
    </div>
@endif

<form action="{{ $editing ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
    @csrf
    @if ($editing) @method('PUT') @endif

    <div>
        <label for="title" class="label">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title', $post->title ?? '') }}" class="input">
    </div>
    <div>
        <label for="description" class="label">Description</label>
        <textarea id="description" name="description" rows="5" class="input">{{ old('description', $post->description ?? '') }}</textarea>
    </div>
    <div>
        <label for="status" class="label">Status</label>
        @php $current = old('status', $post->status ?? 'draft'); @endphp
        <select id="status" name="status" class="input">
            <option value="draft" @selected($current === 'draft')>Draft</option>
            <option value="published" @selected($current === 'published')>Published</option>
        </select>
    </div>

    <div>
        <label for="thumbnail" class="label">Thumbnail</label>
        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="input">
        @error('thumbnail')
            <p class="text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-3">
        <button type="submit" class="btn btn-primary">{{ $editing ? 'Update' : 'Submit' }}</button>
        <a href="{{ route('posts.index') }}" class="link text-sm">Back to List</a>
    </div>
</form>