@if ($errors->has($column))
  <p style="color: tomato">{{ $errors->first($column) }}</p>
@endif
