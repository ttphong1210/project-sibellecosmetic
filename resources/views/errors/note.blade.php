@if(Session::has('error'))
    <p class="alert alert-danger">{{Session::get('error')}}</p>
@endif
@if(Session::has('message'))
    <p class="alert alert-success">{{Session::get('message')}}</p>
@endif
@if(Session::has('status'))
    <p class="alert alert-success">{{Session::get('status')}}</p>
@endif
<!-- @foreach($errors->all() as $error)
    <p class="alert alert-danger">{{$error}}</p>
@endforeach  -->
