<?php

namespace MagentoHackathon\Composer\Magento;

abstract class MercatorParser implements Parser
{
    /** @var array Path prefixes that change due to Mercator's public directory. */
    protected $pathPrefixTranslations = array(
        'js/'       => 'public/js/',
        './js/'     => 'public/js/',
        'media/'    => 'public/media/',
        './media/'  => 'public/media/',
        'skin/'     => 'public/skin/',
        './skin/'   => 'public/skin/',
    );

    /**
     * Given a list of path mappings, check if any of the targets are for
     * directories that Mercator has moved under its public directory. If so,
     * update the target paths to include 'public/'. As no standard Magento
     * path mappings should ever start with 'public/', and Mercator-specific
     * path mappings should alwaus have js/skin/media paths starting with
     * 'public/', it should be safe to call multiple times on either.
     *
     * @param $mappings Array of path mappings
     * @return array Updated path mappings
     */
    public function translateMercatorPathMappings($mappings)
    {
        // each element of $mappings is an array with two elements; first is
        // the source and second is the target
        foreach($mappings as &$mapping) {
            foreach($this->pathPrefixTranslations as $prefix => $translate) {
                if(strpos($mapping[1], $prefix) === 0) {
                    // replace the old prefix with the translated version
                    $mapping[1] = $translate . substr($mapping[1], strlen($prefix));
                    // should never need to translate a prefix more than once
                    // per path mapping
                    break;
                }
            }
        }

        return $mappings;
    }
}