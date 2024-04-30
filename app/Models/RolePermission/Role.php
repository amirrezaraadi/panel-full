<?php

namespace App\Models\RolePermission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    const ROLE_MANAGER = 'manager';
    const ROLE_AUTHORIZE_MANAGER = 'authorize_manager';
    const ROLE_SUPER_MANAGER = 'super_manager';
    const USER = 'user';
    const ROLE_REGISTER_USER = 'register_user';
    const ROLE_AUTHOR = 'author';
    const ROLE_SUPER_ADMIN = 'super admin';
    const ROLE_SUBSCRIBER = 'subscriber';
    const ROLE_CUSTOMER = 'customer';
    static $roles = [
        self::ROLE_AUTHORIZE_MANAGER => [
            self::ROLE_MANAGER,
            self::ROLE_SUPER_MANAGER,
            self::ROLE_REGISTER_USER,
            self::ROLE_AUTHOR,
            self::ROLE_SUPER_ADMIN,
            self::ROLE_SUBSCRIBER,
            self::USER
        ],

        self::ROLE_SUPER_MANAGER => [
            self::ROLE_MANAGER,
            self::ROLE_REGISTER_USER,
            self::ROLE_AUTHOR,
            self::ROLE_SUPER_ADMIN,
            self::ROLE_SUBSCRIBER,
        ],

        self::ROLE_MANAGER => [
            Permission::PERMISSION_MANAGE_USERS,
            Permission::PERMISSION_MANAGE_USERS_INDEX,
            Permission::PERMISSION_MANAGE_USERS_SHOW,
            Permission::PERMISSION_MANAGE_USERS_STATUS_BAN,
            Permission::PERMISSION_MANAGE_COMMENTS_REJECT,
            Permission::PERMISSION_MANAGE_ARTICLE_STATUS,
        ],

        self::USER => [
            Permission::PERMISSION_MANAGE_USERS,
            Permission::PERMISSION_MANAGE_USERS_INDEX,
            Permission::PERMISSION_MANAGE_USERS_CREATE,
            Permission::PERMISSION_MANAGE_USERS_EDIT,
            Permission::PERMISSION_MANAGE_USERS_SHOW,
            Permission::PERMISSION_MANAGE_USERS_DELETE,
            Permission::PERMISSION_MANAGE_USERS_STATUS,
            Permission::PERMISSION_MANAGE_USERS_STATUS_BAN,
            Permission::PERMISSION_MANAGE_USERS_STATUS_SUCCESS,
            Permission::PERMISSION_MANAGE_USERS_STATUS_ACTIVE,
            Permission::PERMISSION_MANAGE_USERS_STATUS_NO_SUCCESS,
            Permission::PERMISSION_MANAGE_USERS_STATUS_VERIFY_EMAIL,
            self::ROLE_MANAGER,
        ],

        self::ROLE_AUTHOR => [
            Permission::PERMISSION_MANAGE_ARTICLE,
            Permission::PERMISSION_MANAGE_ARTICLE_INDEX,
            Permission::PERMISSION_MANAGE_ARTICLE_CREATE,
            Permission::PERMISSION_MANAGE_ARTICLE_SHOW,
            Permission::PERMISSION_MANAGE_ARTICLE_UPDATE,
            Permission::PERMISSION_MANAGE_ARTICLE_DELETE,
            Permission::PERMISSION_MANAGE_USERS_INDEX,
            Permission::PERMISSION_MANAGE_COMMENTS_INDEX,
            Permission::PERMISSION_MANAGE_COMMENTS_CREATE,
//            like , chart ,
            self::ROLE_MANAGER,
        ],
        self::ROLE_REGISTER_USER => [
            Permission::PERMISSION_PROFILE,
            Permission::USER_PAYMENT_INDEX,
            Permission::GO_TO_VERIFY_EMAIL,
//            todo landing areticle get
        ],
        self::ROLE_CUSTOMER => [
            Permission::PERMISSION_USERS_AUTH,
            Permission::PERMISSION_USERS_ACTIVE,
            ! Permission::PERMISSION_USERS_BAN,
            Permission::PERMISSION_USERS_VERIFY_EMAIL
        ],
        self::ROLE_SUBSCRIBER => [],
    ];
}
