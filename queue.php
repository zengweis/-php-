<?php
// 读取日志文件
$log_file = __DIR__ . '/logs/print.log';
$tasks = file_exists($log_file) ? file($log_file, FILE_IGNORE_NEW_LINES) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>打印任务队列</title>
</head>
<body>
    <h1>当前打印任务队列</h1>
    <table border="1">
        <tr>
            <th>任务详情</th>
        </tr>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?php echo htmlspecialchars($task); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="index.php">返回上传页面</a>
</body>
</html>
