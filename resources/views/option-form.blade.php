<form action="{{$url}}" method="{{$nativeMethod}}">
    @foreach($parameters as $name=>$value)
        <input type="hidden" name="{{$name}}" value="{{$value}}" >
    @endforeach
    {{ method_field($method) }}
    {{ csrf_field() }}
    <button type="submit" class="btn {{$isPrimary?'btn-primary':'btn-default'}}">{{$title}}</button>
</form>