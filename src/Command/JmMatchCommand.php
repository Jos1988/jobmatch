<?php

namespace App\Command;

use App\Matcher\MatchingProcessor;
use App\Matcher\Model\Profile;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class JmMatchCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'jm:match';

    /**
     * @var array
     */
    protected static $candidateProfile = [
        'IE' => 5,
        'SN' => 5,
        'TF' => 5,
        'PJ' => 5,
        'TS' => 5,
        'MHW' => 2
    ];

    /**
     * @var MatchingProcessor
     */
    protected $matchingProcessor;

    /**
     * JmMatchCommand constructor.
     *
     * @param null|string       $name
     * @param MatchingProcessor $matchingProcessor
     */
    public function __construct(?string $name = null, MatchingProcessor $matchingProcessor)
    {
        parent::__construct($name);

        $this->matchingProcessor = $matchingProcessor;
    }

    /**
     * Configure
     */
    protected function configure()
    {
        $this->setDescription('Test command for matching algorithm');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Searching for match with target profile: '.$this->writeOutProfile(self::$candidateProfile));

        $this->matchingProcessor->setProfile(self::$candidateProfile);
        if (1 === $this->matchingProcessor->startProcess()) {
            $io->success('Found at least one match.');
            foreach ($this->matchingProcessor->getMatches() as $jobMatch) {
                $io->text('- '.$jobMatch->getName());
            }
        }
    }

    /**
     * Render a candidate profile as string.
     *
     * @param array $profile
     *
     * @return string
     */
    protected function writeOutProfile(array $profile): string
    {
        $targetProfile = '';
        $count = 0;
        foreach (self::$candidateProfile as $name => $value) {
            $count++;
            $targetProfile .= $name.': '.$value;
            if (count($profile) !== $count) {
                $targetProfile .= ', ';
            }
        }

        return $targetProfile;
    }
}
