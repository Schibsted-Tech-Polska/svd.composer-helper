<?php

namespace Svd\ComposerHelper\Parameters;

use Composer\Script\Event;
use InvalidArgumentException;

/**
 * Parameters
 */
class ScriptHandler
{
    public static function parseUrl(Event $event)
    {
        $extras = $event->getComposer()
            ->getPackage()
            ->getExtra();

        if (!isset($extras['svd-composer-helper'])) {
            throw new InvalidArgumentException(
                'The parameter handler needs to be configured through the extra.svd-composer-helper setting.'
            );
        }

        if (!isset($extras['svd-composer-helper']['parse-url'])) {
            throw new InvalidArgumentException(
                'The parameter handler needs to be configured through the extra.svd-composer-helper.parse-url setting.'
            );
        }

        $configs = $extras['svd-composer-helper']['parse-url'];

        if (!is_array($configs)) {
            throw new InvalidArgumentException('The extra.svd-composer-helper.parse-url setting must be an array.');
        }
        $io = $event->getIO();

        foreach ($configs as $key => $parameters) {
            $url = getenv($key);
            if (!$url) {
                $io->write(sprintf(
                    'Env variable \'%s\' does not exist on extra.svd-composer-helper.parse-url! Skip.',
                    $key
                ));
                continue;
            }

            $parts = parse_url($url);
            foreach ($parameters as $paramKey => $env) {
                if (empty($parts[$paramKey])) {
                    $io->write(sprintf(
                        'Parameter \'%s\' does not exist on extra.svd-composer-helper.parse-url.%s! Skip.',
                        $paramKey,
                        $key
                    ));
                    continue;
                }

                putenv($env . '=' . $parts[$paramKey]);

                $io->write(sprintf('Set parameter to %s', $env));
            }
        }
    }
}
