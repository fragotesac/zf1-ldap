<?php

declare(strict_types = 1);

if (version_compare(PHP_VERSION, '8.0', '>=')) {
    return array(
        'parameters' => array(
            'ignoreErrors' => array(
                // The signature for ob_implicit_flush changed from int to bool for this parameter in PHP 8
                array(
                    'message' => '#Function ldap_sort not found\.#',
                    'path'    => __DIR__ . '/src/Zend/Ldap.php',
                    'count'   => 1,
                ),
            )
        )
    );
} else {
    return array();
}
