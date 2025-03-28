<?php

namespace App\Command;

use App\Service\VoeuxAttributionService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'attribution:run', description: 'Exécute l\'attribution des voeux')]
class AttributionCommand extends Command
{
    private VoeuxAttributionService $voeuxAttributionService;

    public function __construct(VoeuxAttributionService $voeuxAttributionService)
    {
        parent::__construct();
        $this->voeuxAttributionService = $voeuxAttributionService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->voeuxAttributionService->attribuerProjets();
        $output->writeln('<info>Attribution terminée avec succès !</info>');
        return Command::SUCCESS;
    }
}
