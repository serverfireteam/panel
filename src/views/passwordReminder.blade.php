

<form action="{{ action('Serverfireteam\Panel\RemindersController@postRemind') }}" method="POST">
    <input type="email" name="email">
    <input type="submit" value="Send Reminder">
</form>