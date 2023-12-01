<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ProblemCategoryStatus extends Enum
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
}
