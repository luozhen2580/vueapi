<?php
namespace Paper\Domain\Model;

use Paper\Domain\Remote\Assembler\PaperDTOAssembler;
use Paper\Domain\Remote\Assembler\PaperDataDTOAssembler;
use Paper\Domain\Remote\PaperRemote;
use Paper\Domain\Remote\PaperDataRemote;
use Infrastructure\Http\HttpAPIException;

class PaperFactory
{
    private $paperRemtoe;
    private $paperDataRemote;
    private $answerDAO;

    public function __construct(
        PaperRemote $paperRemote,
        PaperDataRemote $paperDataRemote)
    {
        $this->paperRemote = $paperRemote;
        $this->paperDataRemote = $paperDataRemote;
    }

    public function findPaperData($studentId, $paperDataId, $attributes)
    {
        $paperAssembler = new PaperDTOAssembler();
        $paperDataAssembler = new PaperDataDTOAssembler();

        $paperDataDTO = $this->paperDataRemote->findPaperData(
            $studentId,
            $paperDataId,
            $attributes
        );

        $paperData = $paperDataAssembler->fromDTO($paperDataDTO);
        $paper = $paperAssembler->fromDTO(
            $paperDataAssembler->createPaperDTO($paperDataDTO)
        );
        $paperData->setPaper($paper);

        return $paperData;
    }

    /**
     *
     * @param int $paperId
     * @return PaperData
     */
    public function createPaperData($studentId, $paperId, $attributes)
    {
        $paperAssembler = new PaperDTOAssembler();
        $paperDataAssembler = new PaperDataDTOAssembler();

        try {
            $paperDataDTO = $this->paperDataRemote->createPaperData(
                $studentId,
                $paperId,
                $attributes
            );
        } catch (HttpAPIException $exception) {
            if (11013004 == $exception->getCode()) {
                
                $papers = $this->paperRemote->fetchPaper($studentId, $paperId);
                $paper = $paperAssembler->toDTO($papers[0]);

                $this->paperDataRemote->destroyPaperData(
                    $studentId,
                    $paperId,
                    $paper->paperDataId());

                $paperDataDTO = $this->paperDataRemote->createPaperData(
                    $studentId,
                    $paperId,
                    $attributes
                );
            } else
                throw $exception;
        }

        
        $paperData = $paperDataAssembler->fromDTO($paperDataDTO);

        $paper = $paperAssembler->fromDTO(
            $paperDataAssembler->createPaperDTO($paperDataDTO)
        );
        $paperData->setPaper($paper);

        // $this->paperDataDAO->store($paperData);

        return $paperData;
        // $paperDataAssembler = new PaperDataDTOAssembler();
        // $questionAssembler = new PaperDataDTOAssembler();
        // $paperData = $paperDataAssembler->fromDTO($paperDataDTO);

        // $answerDAO = new AnswerDAO();
        // $mapper = new AnswerMapper(
        //     $studentId,
        //     $paperDataId,
        //     $answerDAO
        // );

        // foreach ($paperDataDTO->questions() as $questionDTO) {
        //     $question = $questionAssembler->fromDTO($questionDTO);
        //     $question->setAnswer($mapper->getAnswer($question->id()));
        //     $paperData->setQuestion($question);
        // }
        // return $paperData;
    }

    public function handPaper(
        $studentId,
        $paperDataId,
        $answers,
        $handPaperState)
    {
        $this->paperDataRemote->handPaper(
            $studentId,
            $paperDataId,
            $answers,
            $handPaperState
        );
    }
}