@extends('layouts.app')

@section('title', 'Edit Coupon - Kabby Admin')

@section('content')
<div class="position-relative iq-banner">
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1>Edit Coupon</h1>
                            <p>Update coupon details.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="iq-header-img">
            <img src="{{asset('images/dashboard/top-header.png')}}" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
        </div>
    </div>
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Edit Coupon</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('coupons.update', $coupon) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $coupon->title) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="type">Type</label>
                                    <select class="form-select" id="type" name="type" required onchange="updateAmountLabel()">
                                        <option value="">Select Type</option>
                                        <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                        <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" id="amountLabel" for="amount">{{ old('type', $coupon->type) == 'percentage' ? 'Percentage' : 'Amount' }}</label>
                                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount', $coupon->amount) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="coupon_code">Coupon Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="{{ old('coupon_code', $coupon->coupon_code) }}" required>
                                        <button type="button" class="btn btn-secondary" onclick="generateCouponCode()">Generate</button>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validity">Validity</label>
                                    <input type="date" class="form-control" id="validity" name="validity" value="{{ old('validity', $coupon->validity ? $coupon->validity->format('Y-m-d') : '') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="is_enabled" id="is_enabled" value="1" {{ old('is_enabled', $coupon->is_enabled) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_enabled">Enabled</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_public" id="is_public" value="1" {{ old('is_public', $coupon->is_public) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_public">Public</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button class="btn btn-primary" type="submit">Update</button>
                                <a href="{{ route('coupons.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function generateCouponCode(length = 10) {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let code = '';
    for (let i = 0; i < length; i++) {
        code += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    document.getElementById('coupon_code').value = code;
}
function updateAmountLabel() {
    const type = document.getElementById('type').value;
    const label = document.getElementById('amountLabel');
    if (type === 'percentage') {
        label.textContent = 'Percentage';
        document.getElementById('amount').setAttribute('max', '100');
        document.getElementById('amount').setAttribute('min', '0');
    } else {
        label.textContent = 'Amount';
        document.getElementById('amount').removeAttribute('max');
        document.getElementById('amount').setAttribute('min', '0');
    }
}
// Set initial label on page load
updateAmountLabel();
</script>
@endpush 