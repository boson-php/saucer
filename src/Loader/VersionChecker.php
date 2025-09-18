<?php

declare(strict_types=1);

namespace Boson\Component\Saucer\Loader;

use Boson\Component\Saucer\Exception\Environment\UnsupportedVersionException;

final readonly class VersionChecker
{
    /**
     * @var non-empty-string
     */
    private const string MINIMAL_REQUIRED_VERSION = '0.3.0';

    /**
     * @var non-empty-string
     */
    private const string MAXIMAL_SUPPORTED_VERSION = '1.0.0';

    public static function check(\FFI $saucer): void
    {
        try {
            /** @var string $version */
            $version = $saucer->boson_version();
        } catch (\Throwable) {
            throw UnsupportedVersionException::becauseVersionIsInvalid(
                version: 'unknown',
                min: self::MINIMAL_REQUIRED_VERSION,
                max: self::MAXIMAL_SUPPORTED_VERSION,
            );
        }

        $isSupported = \version_compare($version, self::MINIMAL_REQUIRED_VERSION, '>=')
            && \version_compare($version, self::MAXIMAL_SUPPORTED_VERSION, '<');

        if ($isSupported) {
            return;
        }

        throw UnsupportedVersionException::becauseVersionIsInvalid(
            version: $version,
            min: self::MINIMAL_REQUIRED_VERSION,
            max: self::MAXIMAL_SUPPORTED_VERSION,
        );
    }
}
