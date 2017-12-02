<?php
namespace AppBundle\Command;

use AppBundle\DTO\ParamRequestDTO;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SynchronizeNASADataCommand extends ContainerAwareCommand
{
    const DEFAULT_RANGE = 3;

    protected function configure()
    {
        $this
            ->setName('app:synchronize-nasa-data')
            ->setDescription('to request the data from the last (params or default) days from nasa api')
            ->setHelp('This command allows get data from the last days')
            ->addArgument('interval', InputArgument::OPTIONAL, 'count of day max range in one query is 7 days.')
            ->addArgument('detailed', InputArgument::OPTIONAL, 'get all detailed of neo');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $interval = $this->checkIsNotValidInterval($input->getArgument('interval')) ;
        $detailed = $input->getArgument('detailed') ? 'true' : 'false';
        $nasa = $this->getContainer()->get('nasa');

        if ($interval === false) {
            $io->getErrorStyle()->warning('your interval is not valid');
            return ;
        }

        $paramRequestDTO = $this->createdParamRequestDTO($interval, $detailed);
        $response = $nasa->getResponse($nasa->getRoute($paramRequestDTO));

        if (is_string($response)) {
            $io->getErrorStyle()->warning($response);
        }

        $nasa->synchronizeResponseNASA($response);

        $io->getErrorStyle()->success('Console command has been successfully executed');
    }

    /**
     * @param int       $interval
     * @param string    $detailed
     *
     * @return ParamRequestDTO
     */
    private function createdParamRequestDTO(int $interval, string $detailed)
    {
        $nowDate = new \DateTime();
        $paramRequestDTO = new ParamRequestDTO();
        $paramRequestDTO->setStartDate(date_modify(clone $nowDate,"-".$interval." days"))
                        ->setEndDate($nowDate)
                        ->setDetailed($detailed)
                        ->setApiKey($this->getContainer()->getParameter('nasa_api_key'));

        return $paramRequestDTO;

    }

    /**
     * @param $interval
     *
     * @return bool|int
     */
    private function checkIsNotValidInterval($interval)
    {
        if ($interval === null) {
            return self::DEFAULT_RANGE;
        }

        if ((int)$interval > 7) {
            return false;
        }

        if ((int)$interval === 0) {
            return false;
        }

        return (int) $interval;
    }
}