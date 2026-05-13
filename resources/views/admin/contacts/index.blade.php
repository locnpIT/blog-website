@extends('layouts.admin')
@section('content')
<div class="panel">
    <div class="panel-header">Hộp thư liên hệ</div>
    <div class="panel-body">
        <div class="row g-3">
            @forelse($contacts as $contact)
                <div class="col-xl-6">
                    <div class="card p-3 h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <strong>{{ $contact->subject }}</strong>
                            <span class="badge {{ $contact->is_read ? 'text-bg-secondary':'text-bg-danger' }}">{{ $contact->is_read ? 'Đã đọc':'Mới' }}</span>
                        </div>
                        <div class="meta mt-1">{{ $contact->name }} • {{ $contact->email }}</div>
                        <p class="mt-2 mb-2">{{ $contact->message }}</p>
                        <small class="meta">IP: {{ $contact->ip_address }} • {{ $contact->created_at->format('d/m/Y H:i') }}</small>
                        <div class="mt-3 d-flex gap-2">
                            @if(!$contact->is_read)
                                <form method="post" action="{{ route('admin.contacts.read',$contact) }}">@csrf @method('patch')<button class="btn btn-sm btn-outline-primary">Đánh dấu đã đọc</button></form>
                            @endif
                            <form method="post" action="{{ route('admin.contacts.destroy',$contact) }}">@csrf @method('delete')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa liên hệ?')">Xóa</button></form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12"><div class="card p-4 text-center text-muted">Không có liên hệ</div></div>
            @endforelse
        </div>
    </div>
</div>
<div class="mt-3">{{ $contacts->links() }}</div>
@endsection
