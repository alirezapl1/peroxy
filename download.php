<?php
// فایل JSON که تنظیمات تبلیغات و لینک‌ها در آن ذخیره شده است
$config_file = 'config.json';

// اگر فایل JSON موجود است، آن را بارگذاری می‌کنیم
if (file_exists($config_file)) {
    $config = json_decode(file_get_contents($config_file), true);
} else {
    $config = [
        'image' => 'your-ad-image.jpg',
        'font' => 'Tahoma',
        'movie_name' => '',
        'buttons' => [],
        'ads' => [
            'top_left' => ['image' => '', 'link' => '', 'visible' => true],
            'top_right' => ['image' => '', 'link' => '', 'visible' => true]
        ]
    ];
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دانلود ویدیو</title>
    <style>
        @font-face {
            font-family: 'Aban';
            src: url('fonts/Aban.ttf');
        }
        @font-face {
            font-family: 'BYekan';
            src: url('fonts/BYekan.ttf');
        }
        body {
            font-family: '<?php echo $config['font']; ?>', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            background-image: url('<?php echo $config['image']; ?>'); /* تصویر تبلیغ از فایل JSON*/
            background-size: cover;
            background-position: center;
        }
        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
        h1 {
            margin-bottom: 20px;
        }
        .button {
            display: block;
            margin: 10px 0;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .ad {
            position: absolute;
            z-index: 100;
        }
        .ad.top-left {
            top: 10px;
            left: 10px;
        }
        .ad.top-right {
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1><?php echo htmlspecialchars($config['movie_name']); ?></h1>

    <!-- نمایش دکمه‌های دانلود -->
    <?php foreach ($config['buttons'] as $button): ?>
        <?php if ($button['visible']): ?>
            <a class="button" href="<?php echo htmlspecialchars($button['link']); ?>" target="_blank">
                <?php echo htmlspecialchars($button['text']); ?>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<!-- نمایش تبلیغات -->
<?php if ($config['ads']['top_left']['visible']): ?>
    <a class="ad top-left" href="<?php echo htmlspecialchars($config['ads']['top_left']['link']); ?>" target="_blank">
        <img src="<?php echo htmlspecialchars($config['ads']['top_left']['image']); ?>" alt="تبلیغ">
    </a>
<?php endif; ?>

<?php if ($config['ads']['top_right']['visible']): ?>
    <a class="ad top-right" href="<?php echo htmlspecialchars($config['ads']['top_right']['link']); ?>" target="_blank">
        <img src="<?php echo htmlspecialchars($config['ads']['top_right']['image']); ?>" alt="تبلیغ">
    </a>
<?php endif; ?>

</body>
</html>
