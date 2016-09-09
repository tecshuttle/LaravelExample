@forelse ($users as $name)
    <li>{{$name}}</li>
@empty
    <p>没有用户</p>
@endforelse