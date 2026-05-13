<div class="mb-3">
    <label class="form-label">Tên</label>
    <input id="name" name="name" value="{{ old('name', $category->name ?? '') }}" class="form-control @error('name') is-invalid @enderror">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Slug (Đường dẫn tĩnh)</label>
    <input id="slug" name="slug" value="{{ old('slug', $category->slug ?? '') }}" class="form-control @error('slug') is-invalid @enderror">
    <small class="text-muted">Slug sẽ được tự động tạo từ tên nếu để trống.</small>
    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Mô tả</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $category->description ?? '') }}</textarea>
    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<script>
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    if (nameInput && slugInput) {
        nameInput.addEventListener('input', function() {
            let slug = nameInput.value
                .toLowerCase()
                .trim()
                .normalize('NFD') // Chuẩn hóa Unicode
                .replace(/[\u0300-\u036f]/g, '') // Xóa dấu tiếng Việt
                .replace(/[đĐ]/g, 'd')
                .replace(/([^0-9a-z-\s])/g, '') // Xóa ký tự đặc biệt
                .replace(/(\s+)/g, '-') // Thay khoảng trắng bằng gạch ngang
                .replace(/-+/g, '-') // Xóa nhiều gạch ngang liên tiếp
                .replace(/^-+|-+$/g, ''); // Xóa gạch ngang ở đầu/cuối
            
            slugInput.value = slug;
        });
    }
</script>
