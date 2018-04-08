<?php

namespace App\Command;

use App\Entity\Job;
use App\Matcher\Loader\ConceptData;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class JmLoadConceptData extends Command
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var string
     */
    protected static $defaultName = 'jm:load:data';

    /**
     * JmMatchCommand constructor.
     *
     * @param null|string   $name
     * @param ObjectManager $em
     */
    public function __construct(?string $name = null, ObjectManager $em)
    {
        parent::__construct($name);

        $this->em = $em;
    }

    /**
     * Configure
     */
    protected function configure()
    {
        $this->setDescription('Load concept data');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Clearing old data.');
        $this->clearJobs();

        $io->title('Loading concept data.');
        $dataLoader = new ConceptData();
        $data = $dataLoader->getData();

        $io->title('Persisting new data to database.');
        /** @var Job $job */
        foreach ($data as $job) {
            $patterns = $job->getPatterns();
            foreach ($patterns as $pattern) {
                $this->em->persist($pattern);
            }

            $this->em->persist($job);
        }

        $this->em->flush();

        $io->success('New data loaded.');
    }

    /**
     * Remove jobs and patterns.
     */
    protected function clearJobs()
    {
        $repo = $this->em->getRepository(Job::class);
        /** @var Job[] $jobs */
        $jobs = $repo->findAll();
        foreach ($jobs as $job) {
            $patterns = $job->getPatterns();
            $job->setPatterns([]);
            $this->em->remove($job);
            foreach ($patterns as $pattern) {
                $this->em->remove($pattern);
            }

            $this->em->flush();
        }
    }
}
