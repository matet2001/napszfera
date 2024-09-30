<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Az :attribute el kell legyen fogadva.',
    'active_url' => 'A(z) :attribute nem érvényes URL.',
    'after' => 'A(z) :attribute dátumnak későbbinek kell lennie, mint :date.',
    'after_or_equal' => 'A(z) :attribute dátumnak későbbinek vagy egyenlőnek kell lennie :date-dal.',
    'alpha' => 'A(z) :attribute csak betűket tartalmazhat.',
    'alpha_dash' => 'A(z) :attribute csak betűket, számokat, kötőjeleket és aláhúzásokat tartalmazhat.',
    'alpha_num' => 'A(z) :attribute csak betűket és számokat tartalmazhat.',
    'array' => 'A(z) :attribute egy tömbnek kell lennie.',
    'before' => 'A(z) :attribute dátumnak korábbinak kell lennie, mint :date.',
    'before_or_equal' => 'A(z) :attribute dátumnak korábbinak vagy egyenlőnek kell lennie :date-dal.',
    'between' => [
        'numeric' => 'A(z) :attribute :min és :max között kell lennie.',
        'file' => 'A(z) :attribute mérete :min és :max kilobájt között kell legyen.',
        'string' => 'A(z) :attribute :min és :max karakter között kell legyen.',
        'array' => 'A(z) :attribute :min és :max elem között kell legyen.',
    ],
    'boolean' => 'A(z) :attribute mező csak igaz vagy hamis lehet.',
    'confirmed' => 'A(z) :attribute megerősítése nem egyezik.',
    'date' => 'A(z) :attribute nem érvényes dátum.',
    'date_equals' => 'A(z) :attribute dátumnak meg kell egyeznie ezzel: :date.',
    'date_format' => 'A(z) :attribute nem egyezik a következő formátummal: :format.',
    'different' => 'A(z) :attribute és :other különböző kell, hogy legyen.',
    'digits' => 'A(z) :attribute :digits számjegyből kell álljon.',
    'digits_between' => 'A(z) :attribute :min és :max számjegy között kell legyen.',
    'dimensions' => 'A(z) :attribute érvénytelen képméretekkel rendelkezik.',
    'distinct' => 'A(z) :attribute mezőnek duplikált értéke van.',
    'email' => 'A(z) :attribute érvényes email címnek kell lennie.',
    'exists' => 'A kiválasztott :attribute érvénytelen.',
    'file' => 'A(z) :attribute fájlnak kell lennie.',
    'filled' => 'A(z) :attribute mező nem lehet üres.',
    'image' => 'A(z) :attribute képnek kell lennie.',
    'in' => 'A kiválasztott :attribute érvénytelen.',
    'in_array' => 'A(z) :attribute mező nem létezik itt: :other.',
    'integer' => 'A(z) :attribute egész számnak kell lennie.',
    'ip' => 'A(z) :attribute érvényes IP címnek kell lennie.',
    'ipv4' => 'A(z) :attribute érvényes IPv4 címnek kell lennie.',
    'ipv6' => 'A(z) :attribute érvényes IPv6 címnek kell lennie.',
    'json' => 'A(z) :attribute érvényes JSON karakterláncnak kell lennie.',
    'max' => [
        'numeric' => 'A(z) :attribute nem lehet nagyobb, mint :max.',
        'file' => 'A(z) :attribute nem lehet nagyobb, mint :max kilobájt.',
        'string' => 'A(z) :attribute nem lehet több, mint :max karakter.',
        'array' => 'A(z) :attribute nem tartalmazhat több mint :max elemet.',
    ],
    'mimes' => 'A(z) :attribute az alábbi fájltípusok egyike kell legyen: :values.',
    'mimetypes' => 'A(z) :attribute az alábbi fájltípusok egyike kell legyen: :values.',
    'min' => [
        'numeric' => 'A(z) :attribute legalább :min kell legyen.',
        'file' => 'A(z) :attribute legalább :min kilobájt kell legyen.',
        'string' => 'A(z) :attribute legalább :min karakter kell legyen.',
        'array' => 'A(z) :attribute legalább :min elemet kell tartalmazzon.',
    ],
    'not_in' => 'A kiválasztott :attribute érvénytelen.',
    'not_regex' => 'A(z) :attribute formátuma érvénytelen.',
    'numeric' => 'A(z) :attribute számnak kell lennie.',
    'password' => 'A jelszó helytelen.',
    'present' => 'A(z) :attribute mezőnek jelen kell lennie.',
    'regex' => 'A(z) :attribute formátuma érvénytelen.',
    'required' => 'A(z) :attribute mező kitöltése kötelező.',
    'required_if' => 'A(z) :attribute mező kitöltése kötelező, ha a(z) :other értéke :value.',
    'required_unless' => 'A(z) :attribute mező kitöltése kötelező, kivéve, ha a(z) :other értéke a következő: :values.',
    'required_with' => 'A(z) :attribute mező kitöltése kötelező, ha a következő jelen van: :values.',
    'required_with_all' => 'A(z) :attribute mező kitöltése kötelező, ha a következő jelen van: :values.',
    'required_without' => 'A(z) :attribute mező kitöltése kötelező, ha a következő nincs jelen: :values.',
    'required_without_all' => 'A(z) :attribute mező kitöltése kötelező, ha egyik :values sincs jelen.',
    'same' => 'A(z) :attribute és :other meg kell egyezzen.',
    'size' => [
        'numeric' => 'A(z) :attribute :size kell legyen.',
        'file' => 'A(z) :attribute :size kilobájt kell legyen.',
        'string' => 'A(z) :attribute :size karakter kell legyen.',
        'array' => 'A(z) :attribute :size elemet kell tartalmazzon.',
    ],
    'starts_with' => 'A(z) :attribute a következőkkel kell kezdődjön: :values.',
    'string' => 'A(z) :attribute karakterláncnak kell lennie.',
    'timezone' => 'A(z) :attribute érvényes időzónának kell lennie.',
    'unique' => 'A(z) :attribute már létezik.',
    'uploaded' => 'A(z) :attribute feltöltése nem sikerült.',
    'url' => 'A(z) :attribute formátuma érvénytelen.',
    'uuid' => 'A(z) :attribute érvényes UUID-nak kell lennie.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'email' => 'email cím',
        'password' => 'jelszó',
        'phone' => 'telefonszám',
        // Add more attributes here
    ],

];
