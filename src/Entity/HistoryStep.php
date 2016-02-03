<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class HistoryStep
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity
 *
 * @ORM\Entity(repositoryClass="\OldTown\Workflow\Spi\Doctrine\EntityRepository\StepRepository")
 */
class HistoryStep extends AbstractStep
{

    /**
     * @param CurrentStep $step
     *
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(CurrentStep $step)
    {
        parent::__construct();

        $this->setId($step->getId());
        $this->setActionId($step->getActionId());
        $this->setCaller($step->getCaller());
        $this->setStatus($step->getStatus());
        $this->setFinishDate($step->getFinishDate());
        $this->setDueDate($step->getDueDate());
        $this->setEntry($step->getEntry());
        $this->setOwner($step->getOwner());
        $this->setStartDate($step->getStartDate());
        $this->setStepId($step->getStepId());
        $this->setPreviousSteps($step->getPreviousSteps());

    }

}
