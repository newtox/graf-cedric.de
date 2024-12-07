<?php
return [
    'title' => 'Benutzer',
    'create' => 'Benutzer erstellen',
    'edit' => 'Benutzer bearbeiten',
    'fields' => [
        'name' => 'Name',
        'email' => 'E-Mail',
        'password' => 'Passwort',
        'password_confirmation' => 'Passwort bestätigen',
        'roles' => 'Rollen',
        'language' => 'Sprache'
    ],
    'messages' => [
        'created' => 'Benutzer erfolgreich erstellt',
        'updated' => 'Benutzer erfolgreich aktualisiert',
        'deleted' => 'Benutzer erfolgreich gelöscht',
        'cant_delete_self' => 'Sie können Ihren eigenen Account nicht löschen'
    ],
    'hints' => [
        'leave_blank' => 'Leer lassen, um aktuelles Passwort beizubehalten'
    ]
];
