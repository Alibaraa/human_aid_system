<?php

namespace Config;

use App\Validation\FormatRules;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain بthe
     * rules that are available.
     */
    public $ruleSets = [
        Rules::class,
        //FormatRules::class, // Custom FormatRules (must be before original)
        \App\Validation\FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        // Note: Original FormatRules is replaced by App\Validation\FormatRules
    ];
    //test

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
}
