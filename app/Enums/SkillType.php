<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SkillType extends Enum
{
    const JAVA = 'Java';
    const C = 'C';
    const C_PLUSPLUS = 'C++';
    const C_SHARP = 'C#';
    const JAVASCRIPT = 'javascript';
    const JQUERY = 'jQuery';
    const HTML = 'html';
    const CSS3 = 'css3';
    const PHP = 'php';
    const RUBY = 'ruby';
    const PYTHON = 'python';
    const OBJECTIVE_C = 'Objective C';
    const SWIFT = 'swift';
}
