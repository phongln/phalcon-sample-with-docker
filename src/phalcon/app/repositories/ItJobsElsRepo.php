<?php

class ItJobsElsRepo extends BaseElasticRepo
{
    public function getListByIndustryCode(int $industryCode)
    {
        $jobs = [];
        $industryCode = trim(strip_tags($industryCode));
        if (empty($industryCode)) {
            return $jobs;
        }

        $body = [
            'fields' => [
                'jobId',
                'jobTitle',
                'jobDescription',
                'skillExperience',
                'companyDesc',
                'address',
                'alias',
            ],
            'from' => 0,
            'size' => 10
        ];

        $params = $this->buildBasicParams($body);

        $jobs = $this->client->search($params);
        if (empty($jobs) || empty($jobs['hits'])) {
            return [];
        }

        $jobs = [
            'total' => $jobs['hits']['total'],
            'hits' => $jobs['hits']['hits'],
        ];

        $_jobs = [];
        foreach ($jobs['hits'] as $idx => $job) {
            $fields = $job['fields'];

            $_jobs[$fields['jobId'][0]] = $fields;
        }

        $jobs['hits'] = $_jobs;

        return $jobs;
    }
}