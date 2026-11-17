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
        <label for="short_description" class="label">Ringkasan</label>
        <input type="text" id="short_description" name="short_description" class="input"
            value="{{ old('short_description', $editing ? $post->short_description : '') }}">
        @error('short_description')
            <p class="text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category_id" class="label">Kategori</label>
        <select id="category_id" name="category_id" class="input">
            <option value="">Tanpa kategori</option>
            @foreach ($categories as $c)
                <option value="{{ $c->id }}"
                    @selected((string) old('category_id', $editing ? $post->category_id : '') === (string) $c->id)>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="post_date" class="label">Tanggal</label>
        <input type="date" id="post_date" name="post_date" class="input"
            value="{{ old('post_date', $editing ? $post->post_date : '') }}">
    </div>

    <div>
        <span class="label">Technologies</span>
        @php
            $dipilih = old('technologies', $editing ? $post->technologies->pluck('id')->all() : []);
        @endphp
        <div class="flex flex-wrap gap-4">
            @foreach ($technologies as $t)
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="technologies[]" value="{{ $t->id }}"
                        @checked(in_array($t->id, $dipilih))>
                    {{ $t->name }}
                </label>
            @endforeach
        </div>
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