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

    <label for="name">{{ __('Tag Name:') }}</label>
    <div class="mt-3">
        <input type="text" name="name" value="{{ old('name',$tag->name)}}" class="form-control @error('name') is-invalid @enderror"/>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group mt-2">
<button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
        

    </form> 