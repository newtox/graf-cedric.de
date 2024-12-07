<?php
return [
    'title' => 'Users',
    'create' => 'Create User',
    'edit' => 'Edit User',
    'fields' => [
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
        'roles' => 'Roles',
        'language' => 'Language'
    ],
    'messages' => [
        'created' => 'User created successfully',
        'updated' => 'User updated successfully',
        'deleted' => 'User deleted successfully',
        'cant_delete_self' => 'You cannot delete your own account'
    ],
    'hints' => [
        'leave_blank' => 'Leave blank to keep the same password'
    ]
];
