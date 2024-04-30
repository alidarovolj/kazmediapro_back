<x-mail::message>
    Команда KazMediaPro,
    Есть новая заявка от нового потенциального клиента. Пожалуйста, проверьте и свяжитесь:

    Направление: {{$direction}}
    Имя: {{$name}}
    Email: {{$email}}
    Телефон: {{$phone}}
    Описание: {{$note}}

<x-mail::button :url="'https://kazmpro.kz/'">
Перейти на сайт
</x-mail::button>

Спасибо, за ваше внимание!
</x-mail::message>
