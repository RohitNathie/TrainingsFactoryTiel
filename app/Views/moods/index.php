<style>
    body{
        background: wheat;
    }
    /* Style for mood item */
    .mood-item {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }

    /* Style for mood name and date */
    .mood-name {
        font-size: 18px;
        font-weight: bold;
        margin: 0;
    }

    .mood-date {
        font-size: 14px;
        color: #666;
        margin: 0;
    }

    /* Style for mood content */
    .mood-content {
        margin-top: 10px;
        font-size: 16px;
    }

    /* Style for view link */
    .view-link {
        display: block;
        margin-top: 10px;
        text-align: right;
    }

    .view-link a {
        color: #009688;
    }

    .view-link a:hover {
        text-decoration: underline;
    }

    /* Style for no mood message */
    .no-mood {
        font-size: 18px;
        color: #666;
        margin-top: 20px;
        text-align: center;
    }

    .no-mood-message {
        font-size: 16px;
        color: #999;
        margin-top: 10px;
        text-align: center;
    }
</style>
<!DOCTYPE html>
<html>
<body>
<link href="<?= base_url(); ?>/public/assets/css/style.css" rel="stylesheet" type="text/css">
<script src="<?= base_url(); ?>js/script.js" type="text/javascript"></script>
<p>Laatste keer dat je verdrietig was: <?= $lastSadTime ? $lastSadTime['datum'] : 'Nog nooit' ?></p>
    <canvas id="myCanvas" width="300" height="150" style="border:1px solid #d3d3d3;">
    Your browser does not support the HTML5 canvas tag.</canvas>
</body>
</html>


<?php if (! empty($tft) && is_array($tft)): ?>
    <div class="grid-container">
    <?php foreach ($tft as $tft_item): ?>
        <div class="mood-item grid-item">
            <h4 class="mood-date"><?= esc($tft_item['datum']) ?></h4>
            <div class="mood-content"><?= esc($tft_item['mood']) ?></div> <br>
            <div class="mood-opmerking"><?=esc($tft_item['opmerking']) ?></div>
        </div>
        </div>
    <?php endforeach ?>
    <script type="text/javascript" src="<?php echo base_url('js/script.js'); ?>"></script>
<?php else: ?>
    <div class="no-mood">
        <h3>No tft</h3>
        <p class="no-mood-message">Unable to find any tft for you.</p>
    </div>
<?php endif ?>

<?php

// Berekent de totalen voor elke mood
// Init de variablen
$totalSad = 0;
$totalHappy = 0;
$totalExcited = 0;
$totalAngry = 0;
$totalRelaxed = 0;
 // loopt door de grafieken array
foreach ($grafieken as $row) {
    switch ($row['mood']) {
        case 'sad':
            $totalSad = $row['total'];
            break;
        case 'happy':
            $totalHappy = $row['total'];
            break;
        case 'excited':
            $totalExcited = $row['total'];
            break;
        case 'angry':
            $totalAngry = $row['total'];
            break;
        case 'relaxed':
            $totalRelaxed = $row['total'];
            break;
    }
}

$total = $totalSad + $totalHappy + $totalExcited + $totalAngry + $totalRelaxed;
// hoekwaardes
$sadAngle = ($totalSad / $total) * 2 * pi();
$happyAngle = ($totalHappy / $total) * 2 * pi();
$excitedAngle = ($totalExcited / $total) * 2 * pi();
$angryAngle = ($totalAngry / $total) * 2 * pi();
$RelaxedAngle = ($totalRelaxed / $total) * 2 * pi();

// var_dump($totalSad);
// Berekent de hoeken van elke Pizza ARC

// $data['totalAngle'] = $sadAngle + $happyAngle + $excitedAngle;
// echo view('public/js/script.js', $data);

?>
    <!-- <script type="text/javascript" src="<?php echo base_url('js/script.js'); ?>"></script> -->
<script>
var c = document.getElementById("myCanvas");
var ctx = c.getContext("2d");

// SAD sector
ctx.beginPath();
ctx.fillStyle = "#00ffaa";
ctx.moveTo(100,75);
ctx.arc(100, 75, 50, 0, <?php echo $sadAngle; ?>);
ctx.lineTo(100,75);
ctx.fill();

// HAPPY sector
ctx.beginPath();
ctx.fillStyle = "#00aaaa";
ctx.moveTo(100,75);
ctx.arc(100, 75, 50, <?php echo $sadAngle; ?>, <?php echo $sadAngle + $happyAngle; ?>);
ctx.lineTo(100,75);
ctx.fill();

// EXCITED sector
ctx.beginPath();
ctx.fillStyle = "#00ffff";
ctx.moveTo(100,75);
ctx.arc(100, 75, 50, <?php echo $sadAngle + $happyAngle; ?>, <?php echo $sadAngle + $happyAngle + $excitedAngle; ?>);
ctx.lineTo(100,75);
ctx.fill();

// ANGRY sector
ctx.beginPath();
ctx.fillStyle = "#ff0000";
ctx.moveTo(100,75);
ctx.arc(100, 75, 50, <?php echo $sadAngle + $happyAngle + $excitedAngle; ?>, <?php echo 2 * pi(); ?>);
ctx.lineTo(100,75);
ctx.fill();
</script>   