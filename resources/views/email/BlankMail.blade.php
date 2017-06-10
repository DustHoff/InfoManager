@component("email.component.layout")

    @slot("header")
        <h1>{{config("app.name")}}</h1>
    @endslot

    {{ Illuminate\Mail\Markdown::parse($message) }}

    @slot("footer")
    @endslot

@endcomponent