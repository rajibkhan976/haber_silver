<!-- Form -->
<div class="signup-form">

    {!! Form::open(['route' => 'user.reset.password']) !!}

    <div class="signup-text">
        <span>Enter Your Email</span>
    </div>

    <div class="form-group">
        {!! Form::email('email', null, ['class' => 'form-control input-lg','required','required'=>'required','title'=>'Enter Email Address']) !!}
    </div>

    <div class="form-actions">
        <input type="submit" value="Reset Password" class="btn btn-info bg-primary">
    </div>
    {!! Form::close() !!}
    <!-- / Form -->
</div>
