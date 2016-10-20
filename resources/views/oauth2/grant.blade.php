<h2>Tom</h2>
<form method="post" action="{{route('oauth.authorize.post', $params)}}">
    {{ csrf_field() }}
    <input type="text" name="client_id" value="{{$params['client_id']}}">
    <input type="text" name="redirect_uri" value="{{$params['redirect_uri']}}">
    <input type="text" name="response_type" value="{{$params['response_type']}}">
    <input type="text" name="state" value="{{$params['state']}}">
    <input type="text" name="scope" value="{{$params['scope']}}">

    <button type="submit" name="approve" value="1">Approve</button>
    <button type="submit" name="deny" value="1">Deny</button>
</form>