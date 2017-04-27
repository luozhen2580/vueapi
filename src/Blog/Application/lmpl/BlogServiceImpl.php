<?php
namespace Blog\Application\Impl;

use Blog\Application\BlogService;
use Blog\Domain\Model\BlogFactory;
use Blog\Domain\Remote\BlogDataRemote;

class PaperServiceImpl implements PaperService
{
    private $paperFactory;

    public function __construct(PaperFactory $paperFactory)
    {
        $this->paperFactory = $paperFactory;
    }

    public function findPaperData($studentId, $paperDataId, $attributes)
    {
        $paperData = $this->paperFactory->findPaperData(
            $studentId,
            $paperDataId,
            $attributes
        );
        return $paperData;
    }

    public function createPaperData($studentId, $paperId, $attributes)
    {
        $paperData = $this->paperFactory->createPaperData(
            $studentId,
            $paperId,
            $attributes
        );
        return $paperData;
    }

    public function handPaper(
        $studentId,
        $paperDataId,
        $answers,
        $handPaperState)
    {
        $this->paperFactory->handPaper(
            $studentId,
            $paperDataId,
            $answers,
            $handPaperState
        );
    }
}