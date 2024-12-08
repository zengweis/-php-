<?php
// 配置上传目录
$upload_dir = __DIR__ . '/uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// 检查是否有上传文件
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $allowed_types = ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', // Word
                          'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];      // Excel
        $file_type = mime_content_type($file['tmp_name']);
        if (in_array($file_type, $allowed_types)) {
            $target_file = $upload_dir . basename($file['name']);
            move_uploaded_file($file['tmp_name'], $target_file);

            // 保存打印任务到日志
            $log_file = __DIR__ . '/logs/print.log';
            file_put_contents($log_file, "任务加入队列: 文件 {$file['name']} 范围 {$_POST['start_page']}-{$_POST['end_page']}\n", FILE_APPEND);

            echo "文件上传成功，已加入打印队列。";
        } else {
            echo "不支持的文件类型。";
        }
    } else {
        echo "未选择文件。";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>打印任务管理</title>
</head>
<body>
    <h1>上传文件并设置打印范围</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">选择文件（Word/Excel）：</label>
        <input type="file" name="file" id="file" required><br><br>

        <label for="start_page">打印起始页：</label>
        <input type="number" name="start_page" id="start_page" min="1" required><br><br>

        <label for="end_page">打印结束页：</label>
        <input type="number" name="end_page" id="end_page" min="1" required><br><br>

        <button type="submit">提交打印任务</button>
    </form>
    <br>
    <a href="queue.php">查看队列</a>
</body>
</html>
