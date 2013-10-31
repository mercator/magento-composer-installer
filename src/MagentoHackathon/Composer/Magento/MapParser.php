<?php
/**
 * Composer Magento Installer
 */

namespace MagentoHackathon\Composer\Magento;

class MapParser extends MercatorParser {

    protected $_mappings = array();

    function __construct( $mappings )
    {
        $this->setMappings($mappings);
    }

    public function setMappings($mappings)
    {
        // translate public file mappings to use Mercator's 'public' directory
        $this->_mappings = $this->translateMercatorPathMappings($mappings);
    }

    public function getMappings()
    {
        return $this->_mappings;
    }

}
