@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-dismissible alert-danger">
            <center>{{$error}}</center>
        </div>
    @endforeach
@endif

@if(session('success'))
        <div class ="alert alert-dismissible alert-success">
           <center>{{session('success')}}</center>
        </div>
@endif

@if(session('error'))
        <div class ="alert alert-dismissible alert-warning">
            <center>{{session('error')}}</center>
        </div>
@endif