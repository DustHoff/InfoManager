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

    'accepted' => ':attribute muss akzeptiert werden',
    'active_url' => ':attribute ist keine valide URL',
    'after' => ':attribute sollte ein Datum nach :date sein',
    'after_or_equal' => ':attribute sollte ein Datum gleich oder nach :date sein',
    'alpha' => ':attribute darf nur Buchstaben enthalten',
    'alpha_dash' => ':attribute darf nur Buchstaben, Nummern und Unterstriche enthalten',
    'alpha_num' => ':attribute darf nur Buchstaben und Nummern enthalten',
    'array' => ':attribute muss eine Liste sein',
    'before' => ':attribute muss ein Datum vor :date sein',
    'before_or_equal' => ':attribute muss ein Datum vor order gleich :date sein',
    'between' => [
        'numeric' => 'Die Zahl :attribute muss zwischen :min und :max.',
        'file' => 'Die Dateigr&ouml;&szlig;e von :attribute muss zwischen :min und :max kilobytes sein',
        'string' => 'Die L&auml;nge von :attribute muss zwischen :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => ':attribute muss ein boolescher Wert sein',
    'confirmed' => ':attribute stimmt nicht &uuml;berein',
    'date' => ':attribute ist kein valides Datum',
    'date_format' => 'Das Datumsformat für :attribute stimmt nicht mit :format &uuml;berein',
    'different' => ':attribute und :other m&uuml;ssen unterschiedlich sein',
    'digits' => ':attribute muss eine Zahl sein',
    'digits_between' => ':attribute muss zwischen :min und :max sein',
    'dimensions' => 'Das Bild :attribute hat eine falsche Aufl&ouml;sung',
    'distinct' => 'Die Liste :attribute enth&auml; doppelte Werte',
    'email' => ':attribute ist keine valide Email',
    'exists' => 'Der gew&auml;hlte Wert für :attribute existiert nicht',
    'file' => ':attribute muss eine Datei sein',
    'filled' => ':attribute darf nicht leer sein',
    'image' => ':attribute muss ein Bild sein',
    'in' => 'Der gew&auml;hte Wert f$uuml;r :attribute ist nicht erlaubt',
    'in_array' => 'Der gew&auml;hte Wert f$uuml;r :attribute ist nicht in :other vorhanden',
    'integer' => ':attribute muss eine Zahl sein',
    'ip' => ':attribute muss eine valide IP Adresse sein',
    'json' => ':attribute muss ein valider JSON Text sein',
    'max' => [
        'numeric' => ':attribute darf nicht größer sein als :max.',
        'file' => 'Die Datei :attribute darf nicht gr&ouml;&szlig;er sein als :max kilobytes',
        'string' => ':attribute darf nicht l&auml;nger sein als :max Zeichen',
        'array' => 'Die List :attribute darf nicht mehr als :max Elemente enthalten',
    ],
    'mimes' => ':attribute muss das Dateiformat :values haben',
    'mimetypes' => 'Der Type von :attribute muss eins von :values sein',
    'min' => [
        'numeric' => ':attribute muss mindestens :min sein',
        'file' => 'Die Datei :attribute muss gr&ouml;&szlig;er sein als :min kilobytes.',
        'string' => ':attribute muss mindestens :min Zeichen lang sein',
        'array' => ':attribute muss mindestens :min Elemente enthalten',
    ],
    'not_in' => 'der gew&auml;hte Wert f&uuml;r :attribute ist nicht erlaubt',
    'numeric' => ':attribute muss eine Nummer sein',
    'present' => 'Das Feld :attribute muss vorhanden sein',
    'regex' => 'The :attribute format is invalid.',
    'required' => ':attribute wird ben&ouml;tigt',
    'required_if' => ':attribute wird ben&ouml;tigt, wenn :other ist :value.',
    'required_unless' => ':attribute wird ben&ouml;tigt, wenn :other hat einen Wert von :values.',
    'required_with' => ':attribute wird ben&ouml;tigt, wenn :values vorhanden ist',
    'required_with_all' => ':attribute wird ben&ouml;tigt, wenn :values vorhanden ist',
    'required_without' => ':attribute wird ben&ouml;tigt, wenn :values nicht vorhanden ist',
    'required_without_all' => ':attribute wird ben&ouml;tigt, wenn :values are present.',
    'same' => ':attribute und :other sollten den gleichen Wert haben',
    'string' => ':attribute muss eine Zeichenkette sein',
    'timezone' => ':attribute muss eine valide Zeitzone sein',
    'unique' => ':attribute ist bereits vergeben',
    'uploaded' => 'Der Upload von :attribute ist fehlgeschlagen',
    'url' => ':attribute hat ein falsches Format',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
