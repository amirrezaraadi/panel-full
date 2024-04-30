<?php

namespace App\Models\RolePermission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{

    use HasFactory;

// categories
    const PERMISSION_MANAGE_CATEGORIES = 'categories all';
    const PERMISSION_MANAGE_CATEGORIES_INDEX = 'categories index';
    const PERMISSION_MANAGE_CATEGORIES_EDIT = 'categories edit';
    const PERMISSION_MANAGE_CATEGORIES_CREATE = 'categories create';
    const PERMISSION_MANAGE_CATEGORIES_UPDATE = 'categories update';
    const PERMISSION_TEACH = 'teach' ;
    const PERMISSION_MANAGE_CATEGORIES_STATUS = 'categories status';
    const PERMISSION_MANAGE_CATEGORIES_DELETE = 'categories delete';
    const PERMISSION_MANAGE_CATEGORIES_SHOW = 'categories show';
//    users
    const PERMISSION_MANAGE_USERS = 'users all';
    const PERMISSION_MANAGE_USERS_INDEX = 'users index';
    const PERMISSION_MANAGE_USERS_CREATE = 'users create';
    const PERMISSION_MANAGE_USERS_EDIT = 'users edit';
    const PERMISSION_MANAGE_USERS_UPDATE = 'users update';
    const PERMISSION_MANAGE_USERS_SHOW = 'users show';
    const PERMISSION_MANAGE_USERS_DELETE = 'users delete';
    const PERMISSION_MANAGE_USERS_STATUS = 'users status';
    const PERMISSION_MANAGE_USERS_STATUS_BAN = 'users status ban';
    const PERMISSION_MANAGE_USERS_STATUS_SUCCESS = 'users status success';
    const PERMISSION_MANAGE_USERS_STATUS_ACTIVE = 'users status active';
    const PERMISSION_MANAGE_USERS_STATUS_NO_SUCCESS = 'users status no success';
    const PERMISSION_MANAGE_USERS_STATUS_VERIFY_EMAIL = 'users verify email';
    const PERMISSION_USERS_VERIFY_EMAIL = ' users verify email';
    const PERMISSION_USERS_BAN = 'users ban';
    const PERMISSION_NO_VERIFY_EMAIL = 'users no verify email';
    const PERMISSION_USERS_ACTIVE = 'users active';
    const PERMISSION_USERS_AUTH = 'users auth';
    const PERMISSION_USERS_GUEST = 'users guest';


//    role
    const PERMISSION_MANAGE_ROLE_PERMISSION_ALL = 'role permission all';
    const PERMISSION_MANAGE_CREATE_ROLE = 'create role ';
    const PERMISSION_MANAGE_DELETE_ROLE = 'delete role';
    const PERMISSION_MANAGE_CREATE_PERMISSION = 'create permission';
    const PERMISSION_MANAGE_DELETE_PERMISSION = 'delete permission';
    const PERMISSION_MANAGE_UPDATE_PERMISSION = 'update permission';
    const PERMISSION_MANAGE_UPDATE_ROLE = 'update permission';
    const PERMISSION_MANAGE_SYNC_PERMISSION_ROLE = 'permission role';
    const PERMISSION_MANAGE_SYNC_ROLE_PERMISSION = 'role permission';
    const PERMISSION_MANAGE_SYNC_ROLE_USER = 'role user';
    const PERMISSION_MANAGE_SYNC_PERMISSION_USER = 'permission user';


//    discount
    const PERMISSION_MANAGE_DISCOUNT_ALL = 'discounts all';
    const PERMISSION_MANAGE_DISCOUNT_INDEX = 'discounts index';
    const PERMISSION_MANAGE_DISCOUNT_CREATE = 'discounts create';
    const PERMISSION_MANAGE_DISCOUNT_SHOW = 'discounts show';
    const PERMISSION_MANAGE_DISCOUNT_UPDATE = 'discounts update';
    const PERMISSION_MANAGE_DISCOUNT_DELETE = 'discounts delete';

//    article
    const PERMISSION_MANAGE_ARTICLE = 'article';
    const PERMISSION_MANAGE_ARTICLE_INDEX = 'article index';
    const PERMISSION_MANAGE_ARTICLE_CREATE = 'article create';
    const PERMISSION_MANAGE_ARTICLE_SHOW = 'article show';
    const PERMISSION_MANAGE_ARTICLE_UPDATE = 'article update';
    const PERMISSION_MANAGE_ARTICLE_DELETE = 'article delete';
    const PERMISSION_MANAGE_ARTICLE_STATUS = 'article status';

//    tags
    const PERMISSION_MANAGER_TAGE = 'tags';
    const PERMISSION_MANAGER_TAGE_INDEX = 'tags index';
    const PERMISSION_MANAGER_TAGE_CREATE = 'tags create';
    const PERMISSION_MANAGER_TAGE_SHOW = 'tags show';
    const PERMISSION_MANAGER_TAGE_UPDATE = 'tags update';
    const PERMISSION_MANAGER_TAGE_DELETE = 'tags delete';

    //    products
    const PERMISSION_MANAGER_PRODUCT = 'products';
    const PERMISSION_MANAGER_PRODUCT_INDEX = 'products index';
    const PERMISSION_MANAGER_PRODUCT_CREATE = 'products create';
    const PERMISSION_MANAGER_PRODUCT_SHOW = 'products show';
    const PERMISSION_MANAGER_PRODUCT_UPDATE = 'products update';
    const PERMISSION_MANAGER_PRODUCT_DELETE = 'products delete';
    const PERMISSION_MANAGER_PRODUCT_STATUS = 'products status';

    //    membership
    const PERMISSION_MANAGER_MEMBERSHIP = 'memberships';
    const PERMISSION_MANAGER_MEMBERSHIP_INDEX = 'memberships index';
    const PERMISSION_MANAGER_MEMBERSHIP_CREATE = 'memberships create';
    const PERMISSION_MANAGER_MEMBERSHIP_SHOW = 'memberships show';
    const PERMISSION_MANAGER_MEMBERSHIP_UPDATE = 'memberships update';
    const PERMISSION_MANAGER_MEMBERSHIP_DELETE = 'memberships delete';
    const PERMISSION_MANAGER_MEMBERSHIP_STATUS = 'memberships status';


    //    ticket
    const PERMISSION_MANAGER_TICKET = 'ticket';
    const PERMISSION_MANAGER_TICKET_INDEX = 'ticket index';
    const PERMISSION_MANAGER_TICKET_CREATE = 'ticket create';
    const PERMISSION_MANAGER_TICKET_SHOW = 'ticket show';
    const PERMISSION_MANAGER_TICKET_DELETE = 'ticket delete';
    const PERMISSION_MANAGER_TICKET_STATUS = 'ticket status';

//comments
    const PERMISSION_MANAGE_COMMENTS = "comments all";
    const PERMISSION_MANAGE_COMMENTS_INDEX = "comments index";
    const PERMISSION_MANAGE_COMMENTS_CREATE = "comments create";
    const PERMISSION_MANAGE_COMMENTS_REJECT = "comments reject";

// payment
    const PERMISSION_MANAGE_PAYMENTS_ALL = 'payments all';

//    transaction
    const USER_PAYMENT_INDEX = 'transaction';

//   free
    const PERMISSION_MANAGE = 'manager';
    const PERMISSION_ADMIN = 'admin';
    const PERMISSION_AUTHOR = 'author';
    const PERMISSION_ARTICLE = 'article';
    const PERMISSION_PROFILE = 'profile';
    const PERMISSION_USER = 'user';
    const GO_TO_VERIFY_EMAIL = 'go to verify email';

    // landing
    const PERMISSION_LANDING_COMMENTS = "comments all";
    const PERMISSION_LANDING_COMMENTS_INDEX = "comments index";
    const PERMISSION_LANDING_COMMENTS_CREATE = "comments create";
    const PERMISSION_LANDING_COMMENTS_REJECT = "comments reject";

    static $permissions = [
        self::PERMISSION_MANAGE_CATEGORIES,
        self::PERMISSION_MANAGE_CATEGORIES_INDEX,
        self::PERMISSION_MANAGE_CATEGORIES_EDIT,
        self::PERMISSION_MANAGE_CATEGORIES_CREATE,
        self::PERMISSION_MANAGE_CATEGORIES_STATUS,
        self::PERMISSION_MANAGE_CATEGORIES_DELETE,
        self::PERMISSION_MANAGE_CATEGORIES_SHOW,
        self::PERMISSION_MANAGE_USERS,
        self::PERMISSION_MANAGE_USERS_INDEX,
        self::PERMISSION_MANAGE_USERS_CREATE,
        self::PERMISSION_MANAGE_USERS_EDIT,
        self::PERMISSION_MANAGE_USERS_SHOW,
        self::PERMISSION_MANAGE_USERS_DELETE,
        self::PERMISSION_MANAGE_USERS_STATUS,
        self::PERMISSION_MANAGE_USERS_STATUS_BAN,
        self::PERMISSION_MANAGE_USERS_STATUS_SUCCESS,
        self::PERMISSION_MANAGE_USERS_STATUS_ACTIVE,
        self::PERMISSION_MANAGE_USERS_STATUS_NO_SUCCESS,
        self::PERMISSION_MANAGE_USERS_STATUS_VERIFY_EMAIL,
        self::PERMISSION_MANAGE_ROLE_PERMISSION_ALL,
        self::PERMISSION_MANAGE_CREATE_ROLE,
        self::PERMISSION_MANAGE_DELETE_ROLE,
        self::PERMISSION_MANAGE_CREATE_PERMISSION,
        self::PERMISSION_MANAGE_DELETE_PERMISSION,
        self::PERMISSION_MANAGE_UPDATE_PERMISSION,
        self::PERMISSION_MANAGE_UPDATE_ROLE,
        self::PERMISSION_MANAGE_SYNC_PERMISSION_ROLE,
        self::PERMISSION_MANAGE_SYNC_ROLE_PERMISSION,
        self::PERMISSION_MANAGE_SYNC_ROLE_USER,
        self::PERMISSION_MANAGE_SYNC_PERMISSION_USER,
        self::PERMISSION_MANAGE_DISCOUNT_ALL,
        self::PERMISSION_MANAGE_DISCOUNT_INDEX,
        self::PERMISSION_MANAGE_DISCOUNT_CREATE,
        self::PERMISSION_MANAGE_DISCOUNT_SHOW,
        self::PERMISSION_MANAGE_DISCOUNT_UPDATE,
        self::PERMISSION_MANAGE_DISCOUNT_DELETE,
        self::PERMISSION_MANAGE_ARTICLE,
        self::PERMISSION_MANAGE_ARTICLE_INDEX,
        self::PERMISSION_MANAGE_ARTICLE_CREATE,
        self::PERMISSION_MANAGE_ARTICLE_SHOW,
        self::PERMISSION_MANAGE_ARTICLE_UPDATE,
        self::PERMISSION_MANAGE_ARTICLE_DELETE,
        self::PERMISSION_MANAGE_ARTICLE_STATUS,
        self::PERMISSION_MANAGER_TAGE,
        self::PERMISSION_MANAGER_TAGE_INDEX,
        self::PERMISSION_MANAGER_TAGE_CREATE,
        self::PERMISSION_MANAGER_TAGE_SHOW,
        self::PERMISSION_MANAGER_TAGE_UPDATE,
        self::PERMISSION_MANAGER_TAGE_DELETE,
        self::PERMISSION_MANAGER_PRODUCT,
        self::PERMISSION_MANAGER_PRODUCT_INDEX,
        self::PERMISSION_MANAGER_PRODUCT_CREATE,
        self::PERMISSION_MANAGER_PRODUCT_SHOW,
        self::PERMISSION_MANAGER_PRODUCT_UPDATE,
        self::PERMISSION_MANAGER_PRODUCT_DELETE,
        self::PERMISSION_MANAGER_PRODUCT_STATUS,
        self::PERMISSION_MANAGER_MEMBERSHIP,
        self::PERMISSION_MANAGER_MEMBERSHIP_INDEX,
        self::PERMISSION_MANAGER_MEMBERSHIP_CREATE,
        self::PERMISSION_MANAGER_MEMBERSHIP_SHOW,
        self::PERMISSION_MANAGER_MEMBERSHIP_UPDATE,
        self::PERMISSION_MANAGER_MEMBERSHIP_DELETE,
        self::PERMISSION_MANAGER_MEMBERSHIP_STATUS,
        self::PERMISSION_MANAGER_TICKET,
        self::PERMISSION_MANAGER_TICKET_INDEX,
        self::PERMISSION_MANAGER_TICKET_CREATE,
        self::PERMISSION_MANAGER_TICKET_SHOW,
        self::PERMISSION_MANAGER_TICKET_DELETE,
        self::PERMISSION_MANAGER_TICKET_STATUS,
        self::PERMISSION_MANAGE_COMMENTS,
        self::PERMISSION_MANAGE_COMMENTS_INDEX,
        self::PERMISSION_MANAGE_COMMENTS_CREATE,
        self::PERMISSION_MANAGE_COMMENTS_REJECT,
        self::PERMISSION_MANAGE,
        self::PERMISSION_ADMIN,
        self::PERMISSION_AUTHOR,
        self::PERMISSION_ARTICLE,
        self::PERMISSION_PROFILE,
        self::PERMISSION_USER,
        self::PERMISSION_NO_VERIFY_EMAIL,
        self::PERMISSION_USERS_GUEST,
        self::PERMISSION_MANAGE_USERS_UPDATE,
        self::PERMISSION_MANAGE_PAYMENTS_ALL,
        self::PERMISSION_LANDING_COMMENTS,
        self::PERMISSION_LANDING_COMMENTS_INDEX,
        self::PERMISSION_LANDING_COMMENTS_CREATE,
        self::PERMISSION_LANDING_COMMENTS_REJECT,
    ];

}
