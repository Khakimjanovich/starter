@props([
    'type' => 'email',
    'name'=>'email',
    'placeholder' =>'Email',
    'span' => 'fas fa-envelope'
])

<div class="input-group mb-3">
    <input type="{{$type}}"
           name="{{$name}}"
           value="{{ old($name) }}"
           placeholder="{{$placeholder}}"
           class="form-control @error($name) is-invalid @enderror">
    <div class="input-group-append">
        <div class="input-group-text"><span class="{{$span}}"></span></div>
    </div>
    @error($name)
    <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>
