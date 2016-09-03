<?php

class Model
{
    public function getAll()
    {
        //download data from the URL
        return json_decode(file_get_contents('https://www.vayant.com/php-task/airports.json'));
    }

    public function getByOrigin($origin)
    {
        $this->origin = $origin;
        $records = $this->getAll();

        $records = array_filter($records, array($this, 'filterByOrigin'));

        return $records;

    }

    private function filterByOrigin($record)
    {
        return $record->org == $this->origin;
    }

    public function getTop($howMany = 3)
    {
        $records = $this->getAll();
        $recordsCnt = [];

        foreach($records as $record) {
            if(!isset($recordsCnt[$record->org])) $recordsCnt[$record->org] = 0;
            if(!isset($recordsCnt[$record->dest])) $recordsCnt[$record->dest] = 0;
            $recordsCnt[$record->org]++;
            $recordsCnt[$record->dest]++;
        }
        asort($recordsCnt);
  
        $topRecords = array_slice(array_reverse($recordsCnt), 0, $howMany);

        return $topRecords;

    }
}
