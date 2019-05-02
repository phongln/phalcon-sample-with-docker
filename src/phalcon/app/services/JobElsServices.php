<?php

class JobElsServices
{
    private $jobsElsRepo;

    public function __construct(
        ItJobsElsRepo $jobsElsRepo
    ) {
        $this->jobsElsRepo = $jobsElsRepo;
    }

    public function getJobsByIndustryCode(int $industryCode)
    {
        $result = [
            'meta' => [
                'total' => 0,
            ],
            'data' => [],
        ];

        if ($industryCode < 1) {
            throw new \Exception('INVALID INDUSTRY CODE', 400);
        }

        $jobs = $this->jobsElsRepo->getListByIndustryCode($industryCode);
        if (empty($jobs)) {
            return $result;
        }

        $result['meta']['total'] = $jobs['total'];
        $result['data'] = $jobs['hits'];

        return $result;
    }
}