@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Thống kê lượt truy cập theo ngày</h4>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-4"><div class="stat-card"><div class="stat-label">Lượt truy cập hôm nay</div><div class="stat-value">{{ number_format($todayVisits) }}</div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-label">Tổng lượt trong danh sách</div><div class="stat-value">{{ number_format($totalVisits) }}</div></div></div>
</div>

<div class="panel mb-3">
    <div class="panel-body">
        <form class="row g-2 align-items-end" method="get" action="{{ route('admin.visits.index') }}">
            <div class="col-md-3"><label class="form-label">Từ ngày</label><input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control"></div>
            <div class="col-md-3"><label class="form-label">Đến ngày</label><input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control"></div>
            <div class="col-md-3 d-flex gap-2"><button class="btn btn-dark">Lọc</button><a href="{{ route('admin.visits.index') }}" class="btn btn-light border">Đặt lại</a></div>
        </form>
    </div>
</div>

<div class="panel overflow-hidden">
    <div class="panel-header">Danh sách theo ngày</div>
    <div class="panel-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead><tr><th>Ngày</th><th class="text-end">Lượt truy cập</th></tr></thead>
                <tbody>
                @forelse($visits as $visit)
                    <tr>
                        <td>{{ $visit->visit_date->format('d/m/Y') }}</td>
                        <td class="text-end fw-semibold">{{ number_format($visit->visit_count) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="text-center text-muted py-4">Chưa có dữ liệu truy cập</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-3">{{ $visits->links() }}</div>
@endsection
