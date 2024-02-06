<?php
/**
 * Author: Seyed Amir Khalifeh Soltani
 * Contact-Author: https://www.linkedin.com/in/amir-khalifehsoltani/
 * Time: 2/6/24 - 1:26 PM
 */

namespace App\Enums;

enum UserType: string
{
    case USER = 'user';
    case ADMIN = 'admin';
}