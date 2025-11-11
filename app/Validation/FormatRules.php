<?php

namespace App\Validation;

use CodeIgniter\Validation\FormatRules as BaseFormatRules;

/**
 * Custom FormatRules that fixes the valid_ip deprecation warning
 * for PHP 8.1+ when $which parameter is null
 */
class FormatRules extends BaseFormatRules
{
    /**
     * Validate an IP address (human readable format or binary string - inet_pton)
     *
     * @param string|null $ip    IP Address
     * @param string|null $which IP protocol: 'ipv4' or 'ipv6'
     */
    public function valid_ip(?string $ip = null, ?string $which = null): bool
    {
        if (empty($ip)) {
            return false;
        }

        // Fix for PHP 8.1+ deprecation: ensure $which is always a string before strtolower()
        if ($which === null || $which === '') {
            $which = 'ipv4';
        }

        // Ensure $which is a string to avoid any deprecation warnings
        $which = (string) $which;
        $whichLower = strtolower($which);

        switch ($whichLower) {
            case 'ipv4':
                $which = FILTER_FLAG_IPV4;
                break;

            case 'ipv6':
                $which = FILTER_FLAG_IPV6;
                break;

            default:
                $which = null;
                break;
        }

        return (bool) filter_var($ip, FILTER_VALIDATE_IP, $which) || (! ctype_print($ip) && (bool) filter_var(inet_ntop($ip), FILTER_VALIDATE_IP, $which));
    }
}

