<?php
$directories = glob('*', GLOB_ONLYDIR);

?>
<!DOCTYPE html>
<html>
    <head>
        <script src="/style/js/jquery-1.11.0.js"></script>
        <script src="/style/js/kickstart.js"></script> <!-- KICKSTART -->
        <link rel="stylesheet" href="/style/css/kickstart.css" media="all" /> <!-- KICKSTART -->
        <title>Workshop</title>
    </head>
    <body>
    <div class="grid flex">
        <h2>Kurs auswählen</h2>
        <?php
        foreach ($directories as $directory) {
            if ($directory === 'style') {
                continue;
            }

            echo '<li><a href="/' . $directory . '/">' . str_replace('_', ' ', $directory) . '</a></li>';
        }

        ?>

    </div>
    </body>
</html>

