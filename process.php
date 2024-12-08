<?php
// 模拟打印逻辑（实际打印可用 Windows 的 print 命令或其他工具）
$log_file = __DIR__ . '/logs/print.log';
if (file_exists($log_file)) {
    $tasks = file($log_file, FILE_IGNORE_NEW_LINES);
    foreach ($tasks as $task) {
        echo "处理任务: " . htmlspecialchars($task) . "<br>";
        // 模拟打印时间
        sleep(1);
    }
    // 清空队列
    file_put_contents($log_file, '');
} else {
    echo "没有待处理任务。";
}
?>
