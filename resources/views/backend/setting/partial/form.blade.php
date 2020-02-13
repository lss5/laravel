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
        'placeholder' => 'secret_token'
    ]) }}
</div>
<div class="form-group">
    {{ Form::label('access_token', 'Ключ доступа сообщества') }}
    {{ Form::input('text', 'access_token', null, [
        'class' => 'form-control',
        'placeholder' => 'access_token'
    ]) }}
    <small class="form-text text-muted">При добавлении группы данное поле не заполняется</small>
</div>
<div class="form-group">
    {{ Form::label('vk_url_group', 'Ссылка на группу') }}
    {{ Form::input('text', 'vk_url_group', null, [
        'class' => 'form-control',
        'placeholder' => 'https://vk.com/your_group'
    ]) }}
</div>
{{ Form::button('Сохранить', ['class' => 'btn btn-success', 'type' => 'submit']) }}
