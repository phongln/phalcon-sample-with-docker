<?php

use Elasticsearch\ClientBuilder;

abstract class BaseElasticRepo
{
    const MAX_SIZE = 10000;

    protected $client;

    private $hosts;
    private $index;
    private $type;

    public function __construct($hosts = [], $index = '', $type = '')
    {
        $this->setHosts($hosts);
        $this->setIndex($index);
        $this->setType($type);

        $this->client = $this->getClient();
    }

    public function setHosts(array $hosts = [])
    {
        $this->hosts = $hosts;
    }

    public function getHosts()
    {
        return $this->hosts ?? [];
    }

    public function setIndex(string $index)
    {
        $this->index = $index;
    }

    public function getIndex()
    {
        return $this->index ?? null;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type ?? null;
    }

    public function getClient()
    {
        if (!empty($this->hosts)) {
            $this->client = ClientBuilder::create()->setHosts($this->hosts)->build();
        }

        return $this->client ?? null;
    }

    protected function buildBasicParams(array $body = [])
    {
        return [
            'index' => $this->getIndex(),
            'type' => $this->getType(),
            'body' => $body
        ];
    }
}