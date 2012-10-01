<?php

namespace TMG\Twig;

use Silex\Application;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class VersionedAssetsRoutingExtension extends \Twig_Extension {
    protected $app;

    public function __construct(Application $app) {
        $this->app = $app;
    }

    public function getFunctions() {
        return array(
            'versioned_asset' => new \Twig_Function_Method($this, 'getAssetPath'),
        );
    }

    protected function getVersionString() {
        if (isset($app['version_string']) && $app['version_string']) {
            return $app['version_string'];
        } else {
            return null;
        }
    }

    public function getAssetPath($name, $parameters = array()) {
        if ($version = $this->getVersionString()) {
            return str_replace("/assets/", "/assets/v{$this->getVersionString()}/", $name);
        } else {
            return $name;
        }
    }

    public function getName() {
        return 'asset_routing';
    }
}
