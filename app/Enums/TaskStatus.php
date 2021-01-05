<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static TODO()
 * @method static DOING()
 * @method static DONE()
 */
final class TaskStatus extends Enum
{
    const TODO = 'to-do';
    const DOING = 'doing';
    const DONE = 'done';
}
