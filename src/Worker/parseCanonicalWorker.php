<?php

namespace Worker;

use \Kicken\Gearman\Worker;

$worker = new Worker('gearmand:4730');
$worker
    ->registerFunction('rot13', function(WorkerJob $job){
        $workload = $job->getWorkload();
        echo "Running rot13 task with workload {$workload}\n";

        return str_rot13($workload);
    })
    ->work()
;