    @if ($errors->any())
        <div class="alert alert-danger">
<ul>
    @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
    @endforeach
</ul>

        </div>
    @endif
    <form action="{{ $action }}" method="post">
        @csrf
        @if ($update)
@method('put')
        @endif
<div class="form-group mp-3">

    <label for="name">{{ __('Role Name:') }}</label>
    <div class="mt-3">
        <input type="text" name="name" value="{{ old('name',$role->name)}}" class="form-control @error('name') is-invalid @enderror"/>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
<div class="mt-2">
@foreach (config('abilities') as $code =>$label)

    <div class="form-check">
  <input class="form-check-input" type="checkbox" value="{{ $code }}" name="abilities[]" @if(in_array($code,$role->abilities ?? []))checked @endif>
  <label class="form-check-label" >
{{ $label }}
</label>
</div>

@endforeach
</div>

 
    <div class="form-group mt-2">
<button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
        
    </form> 