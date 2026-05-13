<div class="row g-3">
    <div class="col-md-8"><label class="form-label">Tiêu đề</label><input name="title" value="{{ old('title', $post->title ?? '') }}" class="form-control @error('title') is-invalid @enderror">@error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-md-4"><label class="form-label">Danh mục</label><select name="category_id" class="form-select @error('category_id') is-invalid @enderror">@foreach($categories as $c)<option value="{{ $c->id }}" @selected((int)old('category_id', $post->category_id ?? 0)===$c->id)>{{ $c->name }}</option>@endforeach</select>@error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-12"><label class="form-label">Mô tả ngắn</label><textarea name="excerpt" rows="3" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>@error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-12"><label class="form-label">Nội dung</label><textarea id="content-editor" name="content" class="form-control @error('content') is-invalid @enderror" rows="12">{{ old('content', $post->content ?? '') }}</textarea>@error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-md-6"><label class="form-label">Thumbnail</label><input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">@error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-md-6"><label class="form-label">Trạng thái</label><select name="status" class="form-select"><option value="draft" @selected(old('status',$post->status ?? 'draft')==='draft')>draft</option><option value="published" @selected(old('status',$post->status ?? '')==='published')>published</option></select></div>
</div>
@if(!empty($post?->thumbnail))<div class="mt-3"><img src="{{ Storage::url($post->thumbnail) }}" width="140" alt="thumbnail"></div>@endif
@push('scripts')
<script>ClassicEditor.create(document.querySelector('#content-editor')).catch(error => console.error(error));</script>
@endpush
