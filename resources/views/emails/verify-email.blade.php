{{--<x-email-layout>--}}
<div style="text-align: center;">
{{--    TODO: Add logo when we will have own domain--}}
{{--    <div style="margin-bottom: 20px;">--}}
{{--        <img src="{{ Vite::asset('resources/images/logo_nyev2.svg') }}" alt="Logo" style="max-width: 100%; height: auto; width: 150px;">--}}
{{--    </div>--}}

    <h1 style="font-size: 24px; margin-bottom: 16px;">Erősítse meg e-mail címét</h1>

    <p style="margin-bottom: 16px; font-size: 16px">
        Köszönjük, hogy regisztrált! Kérjük, erősítse meg e-mail címét az alábbi gombra kattintva.
    </p>

    <a href="{{ $url }}" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; font-size: 16px; margin-bottom: 16px;">
        E-mail cím megerősítése
    </a>

    <p style="font-size: 14px;">
        Ha nem hozott létre fiókot, nincs további teendője.
    </p>
</div>
{{--</x-email-layout>--}}
