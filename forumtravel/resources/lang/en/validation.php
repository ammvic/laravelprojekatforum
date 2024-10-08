<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Sledeći jezički redovi sadrže podrazumevane poruke o greškama koje koristi
    | klasa validatora. Neke od ovih pravila imaju više verzija, kao što su
    | pravila o veličini. Slobodno prilagodite svaku od ovih poruka ovde.
    |
    */

    'accepted' => 'Polje :attribute mora biti prihvaćeno.',
    'active_url' => 'Polje :attribute nije validan URL.',
    'after' => 'Polje :attribute mora biti datum posle :date.',
    'after_or_equal' => 'Polje :attribute mora biti datum posle ili jednak :date.',
    'alpha' => 'Polje :attribute može sadržati samo slova.',
    'alpha_dash' => 'Polje :attribute može sadržati samo slova, brojeve, crte i donje crte.',
    'alpha_num' => 'Polje :attribute može sadržati samo slova i brojeve.',
    'array' => 'Polje :attribute mora biti niz.',
    'before' => 'Polje :attribute mora biti datum pre :date.',
    'before_or_equal' => 'Polje :attribute mora biti datum pre ili jednak :date.',
    'between' => [
        'numeric' => 'Polje :attribute mora biti između :min i :max.',
        'file' => 'Polje :attribute mora biti između :min i :max kilobajta.',
        'string' => 'Polje :attribute mora biti između :min i :max karaktera.',
        'array' => 'Polje :attribute mora imati između :min i :max stavki.',
    ],
    'boolean' => 'Polje :attribute mora biti tačno ili netačno.',
    'confirmed' => 'Potvrda polja :attribute se ne podudara.',
    'date' => 'Polje :attribute nije validan datum.',
    'date_equals' => 'Polje :attribute mora biti datum jednak :date.',
    'date_format' => 'Polje :attribute se ne podudara sa formatom :format.',
    'different' => 'Polje :attribute i :other moraju biti različiti.',
    'digits' => 'Polje :attribute mora biti :digits cifara.',
    'digits_between' => 'Polje :attribute mora biti između :min i :max cifara.',
    'dimensions' => 'Polje :attribute ima nevažeće dimenzije slike.',
    'distinct' => 'Polje :attribute ima duplu vrednost.',
    'email' => 'Polje :attribute mora biti validna email adresa.',
    'ends_with' => 'Polje :attribute mora završiti sa jednim od sledećih: :values.',
    'exists' => 'Izabrano polje :attribute nije validno.',
    'file' => 'Polje :attribute mora biti datoteka.',
    'filled' => 'Polje :attribute mora imati vrednost.',
    'gt' => [
        'numeric' => 'Polje :attribute mora biti veće od :value.',
        'file' => 'Polje :attribute mora biti veće od :value kilobajta.',
        'string' => 'Polje :attribute mora biti veće od :value karaktera.',
        'array' => 'Polje :attribute mora imati više od :value stavki.',
    ],
    'gte' => [
        'numeric' => 'Polje :attribute mora biti veće ili jednako :value.',
        'file' => 'Polje :attribute mora biti veće ili jednako :value kilobajta.',
        'string' => 'Polje :attribute mora biti veće ili jednako :value karaktera.',
        'array' => 'Polje :attribute mora imati :value stavki ili više.',
    ],
    'image' => 'Polje :attribute mora biti slika.',
    'in' => 'Izabrano polje :attribute nije validno.',
    'in_array' => 'Polje :attribute ne postoji u :other.',
    'integer' => 'Polje :attribute mora biti ceo broj.',
    'ip' => 'Polje :attribute mora biti validna IP adresa.',
    'ipv4' => 'Polje :attribute mora biti validna IPv4 adresa.',
    'ipv6' => 'Polje :attribute mora biti validna IPv6 adresa.',
    'json' => 'Polje :attribute mora biti validan JSON string.',
    'lt' => [
        'numeric' => 'Polje :attribute mora biti manje od :value.',
        'file' => 'Polje :attribute mora biti manje od :value kilobajta.',
        'string' => 'Polje :attribute mora biti manje od :value karaktera.',
        'array' => 'Polje :attribute mora imati manje od :value stavki.',
    ],
    'lte' => [
        'numeric' => 'Polje :attribute mora biti manje ili jednako :value.',
        'file' => 'Polje :attribute mora biti manje ili jednako :value kilobajta.',
        'string' => 'Polje :attribute mora biti manje ili jednako :value karaktera.',
        'array' => 'Polje :attribute ne sme imati više od :value stavki.',
    ],
    'max' => [
        'numeric' => 'Polje :attribute ne sme biti veće od :max.',
        'file' => 'Polje :attribute ne sme biti veće od :max kilobajta.',
        'string' => 'Polje :attribute ne sme biti veće od :max karaktera.',
        'array' => 'Polje :attribute ne sme imati više od :max stavki.',
    ],
    'mimes' => 'Polje :attribute mora biti datoteka tipa: :values.',
    'mimetypes' => 'Polje :attribute mora biti datoteka tipa: :values.',
    'min' => [
        'numeric' => 'Polje :attribute mora biti najmanje :min.',
        'file' => 'Polje :attribute mora biti najmanje :min kilobajta.',
        'string' => 'Polje :attribute mora biti najmanje :min karaktera.',
        'array' => 'Polje :attribute mora imati najmanje :min stavki.',
    ],
    'not_in' => 'Izabrano polje :attribute nije validno.',
    'not_regex' => 'Format polja :attribute nije validan.',
    'numeric' => 'Polje :attribute mora biti broj.',
    'password' => 'Lozinka je neispravna.',
    'present' => 'Polje :attribute mora biti prisutno.',
    'regex' => 'Format polja :attribute nije validan.',
    'required' => 'Polje :attribute je obavezno.',
    'required_if' => 'Polje :attribute je obavezno kada je :other :value.',
    'required_unless' => 'Polje :attribute je obavezno osim ako je :other u :values.',
    'required_with' => 'Polje :attribute je obavezno kada je :values prisutno.',
    'required_with_all' => 'Polje :attribute je obavezno kada su :values prisutni.',
    'required_without' => 'Polje :attribute je obavezno kada :values nije prisutno.',
    'required_without_all' => 'Polje :attribute je obavezno kada nijedan od :values nije prisutan.',
    'same' => 'Polje :attribute i :other moraju biti jednaki.',
    'size' => [
        'numeric' => 'Polje :attribute mora biti :size.',
        'file' => 'Polje :attribute mora biti :size kilobajta.',
        'string' => 'Polje :attribute mora biti :size karaktera.',
        'array' => 'Polje :attribute mora sadržati :size stavki.',
    ],
    'starts_with' => 'Polje :attribute mora početi sa jednim od sledećih: :values.',
    'string' => 'Polje :attribute mora biti string.',
    'timezone' => 'Polje :attribute mora biti validna zona.',
    'unique' => 'Polje :attribute već postoji.',
    'uploaded' => 'Polje :attribute nije uspelo da se otpremi.',
    'url' => 'Format polja :attribute nije validan.',
    'uuid' => 'Polje :attribute mora biti validan UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Ovde možete navesti prilagođene poruke za validaciju atributa koristeći
    | konvenciju "attribute.rule" da biste imenovali linije. Ovo nam omogućava
    | da brzo navedemo određenu prilagođenu jezičku liniju za dato pravilo atributa.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Sledeći jezički redovi se koriste za zamenu naših placeholder-a atributa
    | nečim razumljivijim, kao što je "Email Adresa" umesto "email". Ovo jednostavno
    | nam pomaže da naše poruke učinimo izražajnijim.
    |
    */

    'attributes' => [],

];
