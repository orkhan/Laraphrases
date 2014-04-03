<?php namespace Orkhan\Laraphrases\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class LaraphraseCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'laraphrase:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Installs Laraphrases migrations, configs, views and assets.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $this->call('migrate', array('--package' => 'orkhan/laraphrases'));
        $this->info('Migrations has been migrated!');
        $this->call('config:publish', array('package' => 'orkhan/laraphrases'));
        $this->info('Configs are published!');
        $this->call('view:publish', array('package' => 'orkhan/laraphrases'));
        $this->info('Views are published!');
        $this->call('asset:publish', array('package' => 'orkhan/laraphrases'));
        $this->info('Assets are published!');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}

}
