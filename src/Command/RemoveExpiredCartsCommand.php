<?php
declare(strict_types=1);

namespace App\Command;

use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RemoveExpiredCartsCommand extends Command
{
    protected static $defaultName = 'app:remove-expired-carts';

    private EntityManagerInterface $entityManager;
    private CommandeRepository $commandeRepository;

    public function __construct(EntityManagerInterface $entityManager, CommandeRepository $commandeRepository)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->commandeRepository = $commandeRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription('Removes carts that have been inactive for a defined period')
            ->addArgument('days', InputArgument::OPTIONAL, 'The number of days a cart can remain inactive', 2);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $days = (int) $input->getArgument('days');

        if ($days <= 0) {
            $io->error('The number of days should be greater than 0.');
            return Command::FAILURE;
        }

        $limitDate = new \DateTime("-$days days");
        $expiredCarts = $this->commandeRepository->findCartsNotModifiedSince($limitDate);
        $count = 0;

        foreach ($expiredCarts as $cart) {
            $this->entityManager->remove($cart);
            $count++;
        }

        $this->entityManager->flush();
        $io->success("$count cart(s) have been deleted.");
        return Command::SUCCESS;
    }
}
