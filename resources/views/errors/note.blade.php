@if(Session::has('error'))
    <p style="text-align: center;
    font-size: 20px;
    margin-top: 15px;
    color: red;" class="alert alert-danger">{{Session::get('error')}}</p>
@endif
@if(Session::has('message'))
    <p style="text-align: center;
    font-size: 20px;
    margin-top: 15px;
    color: green;" class="alert alert-success">{{Session::get('message')}}</p>
@endif
@if(Session::has('status'))
    <p style="text-align: center;
    font-size: 20px;
    margin-top: 15px;
    color: green;" class="alert alert-success">{{Session::get('status')}}</p>
@endif
