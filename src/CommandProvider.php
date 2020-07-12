<?php

namespace RoyGoldman\ComposerWhere;

use Composer\Plugin\Capability\CommandProvider as CapabilityCommandProvider;

use RoyGoldman\ComposerWhere\Command\WhereCommand;

/**
 * List of all commands provided by this package.
 */
class CommandProvider implements CapabilityCommandProvider {

  /**
   * {@inheritdoc}
   */
  public function getCommands() {
    return [
      new WhereCommand(),
    ];
  }

}
