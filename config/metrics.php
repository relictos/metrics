<?php

return [
  'current_folder' => 'metrics',
  'current_list' => 'default',
  'current_rec' => 'default',
  'list_providers' => [
    'default' => \App\Workers\Metrics\MetricsList::class
  ],
  'rec_providers' => [
    'default' => \App\Workers\Metrics\MetricsFile::class
  ]
];