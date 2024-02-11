<?php
/**
 * Author: Seyed Amir Khalifeh Soltani
 * Contact-Author: https://www.linkedin.com/in/amir-khalifehsoltani/
 * Time: 2/10/24 - 10:35 PM
 */

namespace App\Enums;

enum PublicationStatus: string
{
    case PUBLISHED = 'published';
    case DRAFT = 'draft';
}