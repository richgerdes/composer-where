<?php

namespace RoyGoldman\ComposerWhere\Command;

use Composer\Command\BaseCommand;
use Composer\Installer;
use Composer\Plugin\CommandEvent;
use Composer\Plugin\PluginEvents;

use DrupalComposer\PreservePaths\PluginWrapper;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * The "where" command class.
 *
 * Downloads scaffold files and generates the autoload.php file.
 */
class WhereCommand extends BaseCommand {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    parent::configure();
    $this
      ->setName('where')
      ->setDescription('Locate package install path.')
      ->addArgument('packages', InputArgument::IS_ARRAY, 'Packages to locate.')
      ->addOption('installer-info', 'i', InputOption::VALUE_OPTIONAL, 'Use APCu to cache found/not-found classes.', true)
      ->addOption('apcu-autoloader', null, InputOption::VALUE_NONE, 'Use APCu to cache found/not-found classes.')
      ->addOption('verbose', 'v|vv|vvv', InputOption::VALUE_NONE, 'Shows more details including new commits pulled in when updating packages.')
    ;
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $io = $this->getIO();
    $package_list = $input->getArgument('packages');
    
    $show_installer_info = $input->getOption('installer-info');

    $repo_manager = $composer->getRepositoryManager();
    $install_manager = $composer->getInstallationManager();

    foreach ($package_list as $package) {
      $package_instance = $repo_manager->findPackage($package, '*');
      if (empty($package_instance)) {
        $io->writeError('<warning>Warning unknown package `' . $package . '`.</warning>');
        return 1;
      }
      else {
        $packages[] = $package_instance;
      }
      $install_path = realpath($install_manager->getInstallPath($package_instance));
      $io->write($package_instance->getPrettyName() . ' is installed at ' . $install_path);
    }

    return 0;
  }

}
