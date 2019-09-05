<?php

namespace RoyGoldman\ComposerWhere;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;

/**
 * Composer plugin to provide a `where` command.
 */
class Plugin implements PluginInterface, Capable {

  /**
   * {@inheritdoc}
   */
  public function getCapabilities() {
    echo "test";
    return [
      'Composer\Plugin\Capability\CommandProvider' => 'RoyGoldman\ComposerWhere\CommandProvider',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function activate(Composer $composer, IOInterface $io) {
    // Do nothing.
  }

}
