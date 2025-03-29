<?php $datasetPath = __DIR__ . '/dataset';
$labels = [];
if (is_dir($datasetPath)) {
    $folders = scandir($datasetPath);
    foreach ($folders as $folder) {
        if ($folder !== '.' && $folder !== '..' && is_dir("$datasetPath/$folder")) {
            $labels[] = $folder;
        }
    }
}
header('Content-Type: application/json');
echo json_encode($labels);
