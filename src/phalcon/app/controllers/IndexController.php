<?php

class IndexController extends ControllerBase
{
    private $jobElsService;

    public function initialize()
    {
        $this->jobElsService = $this->getDi()->get(JobElsServices::class);
    }

    public function indexAction()
    {
        dd($this->jobElsService->getJobsByIndustryCode(35));
    }

}

