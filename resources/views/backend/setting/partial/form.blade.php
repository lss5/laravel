<div class="form-group">
    {{ Form::label('confirmation_token', 'Строка, которую должен вернуть сервер') }}
    {{ Form::input('text', 'confirmation_token', null, [
        'class' => 'form-control',
        'placeholder' => 'confirmation'
    ]) }}
</div>
<div class="form-group">
    {{ Form::label('secret_key', 'Секретный ключ') }}
    {{ Form::input('text', 'secret_key', null, [
        'class' => 'form-control',
        'placeholder' => 'secret'
    ]) }}
</div>
<div class="form-group">
    {{ Form::label('access_token', 'Ключ доступа сообщества') }}
    {{ Form::input('text', 'access_token', null, [
        'class' => 'form-control',
        'placeholder' => 'access_token'
    ]) }}
</div>
<div class="form-group">
    {{ Form::label('vk_id_group', 'ID группы Вконтакте') }}
    {{ Form::input('text', 'vk_id_group', null, [
        'class' => 'form-control',
        'placeholder' => 'ID группы Вконтакте'
    ]) }}
</div>
{{ Form::button('Сохранить', ['class' => 'btn btn-success', 'type' => 'submit']) }}
