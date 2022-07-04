<div class="mb-3">
    <label for="{{ $name }}" class="form-label text-capitalize">{{ $label }}
    @if(isset($required) && $required == true)
        <span class="text-danger">*</span>
    @endif
    </label>
    <input type="{{ $type??'text' }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" value="{{ old($name,isset($value) ? $value : null) }}" placeholder="Masukkan {{ $label }}">
    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
