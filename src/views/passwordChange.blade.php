@if(Session::has('message'))
    <div class="alert-box success">
        <h2>{{ Session::get('message') }}</h2>
    </div>
@endif

<form action="{{ action('Serverfireteam\Panel\RemindersController@postChangePassword') }}" method="POST">    
    <input type="email" name="email">
   Current: <input type="password" name="current_password"><br />
   Password: <input type="password" name="password"><br />
   Re-Type PAssword: <input type="password" name="password_confirmation"><br />
    <input type="submit" value="Reset Password">
</form>