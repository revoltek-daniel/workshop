<?php
define('TEMPLATE_DIR', 'templates');
define('TEMPLATE_EXTENSION', 'php');
define('TEXT_DIR', 'texts');
define('TEXT_EXTENSION', 'html');

define('DATABASE_PASSWORD', '');
define('DATABASE_HOST', '127.0.0.1');
define('DATABASE_USER', 'workshop');
define('DATABASE_DBNAME', 'workshop');

$pageId = (int) ($_GET['id'] ?? 0);

$texts = glob(TEXT_DIR . DIRECTORY_SEPARATOR .'*');

$numberedFile = [];
$i = 0;
foreach ($texts as $textFile) {
    $numberedFile[$i] = str_replace([TEXT_DIR, TEXT_EXTENSION], '', $textFile);
    $i++;
}
unset($i);

if (!isset($numberedFile[$pageId])) {
    exit;
}

$codeResult = '';

if (isset($_POST['phpCode'])) {
    $sqlQuery = trim($_POST['phpCode']);
    if (!empty($sqlQuery)) {
        try {
            ob_start();

            $mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DBNAME);

            /* Create table doesn't return a resultset */
            if (preg_match('%CREATE|ALTER|TRUNCATE|DROP|INSERT|UPDATE%i', $sqlQuery)) {
                if ($mysqli->query($sqlQuery) === true) {
                    printf("Query successfully executed.\n");
                } else {
                    echo $mysqli->error;
                }
            } elseif (strpos($sqlQuery, '*') !== false) {
                if ($result = $mysqli->query($sqlQuery, MYSQLI_USE_RESULT)) {
                    ?>
                    <table>
                    <?php
                    $firstRow = true;
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<tr>';
                        if ($firstRow) {
                            foreach ($row as $title => $item) {
                                echo '<th>' . $title . '</th>';
                            }
                            echo '</tr><tr>';
                            $firstRow = false;
                        }
                        foreach ($row as $title => $item) {
                            echo '<td>' . $item . '</td>';
                        }
                        echo '</tr>';
                    }
                    ?>
                    </table>
                    <?php
                    $result->close();
                } else {
                    echo $mysqli->error;
                }
            } else {
                /* Select queries return a resultset */
                if ($result = $mysqli->query($sqlQuery)) {
                    ?>
                                        <table>
                    <?php
                    $firstRow = true;
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo '<tr>';
                        if ($firstRow) {
                            foreach ($row as $title => $item) {
                                echo '<th>' . $title . '</th>';
                            }
                            echo '</tr><tr>';
                            $firstRow = false;
                        }
                        foreach ($row as $title => $item) {
                            echo '<td>' . $item . '</td>';
                        }
                        echo '</tr>';
                    }
                    ?>
                    </table>
                    <?php
                    $result->close();
                } else {
                    echo $mysqli->error;
                }
            }

            $mysqli->close();
            $codeResult = ob_get_contents();
            ob_end_clean();
        } catch (Throwable $e) {
            $codeResult = $e->getMessage();
        }
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <script src="/style/js/jquery-1.11.0.js"></script>
        <script src="/style/js/kickstart.js"></script> <!-- KICKSTART -->
        <script src="/style/js/ace/ace.js" charset="utf-8"></script>
        <script src="/style/js/ace/ext-language_tools.js"></script>
        <script src="/style/js/ace/ext-beautify.js"></script>
        <link rel="stylesheet" href="/style/css/kickstart.css" media="all" /> <!-- KICKSTART -->
        <style type="text/css" media="screen">
            #editor {
                position: relative;
                top: 0;
                right: 0;
                bottom: 0;
                min-height: 500px;
                left: 0;
            }
        </style>
        <title>Workshop</title>
    </head>
    <body>
    <div class="grid flex">
        <?php
            require_once(TEXT_DIR . DIRECTORY_SEPARATOR . $numberedFile[$pageId] . TEXT_EXTENSION);
        ?>
        <?php
        if ($pageId > 0) {
            ?>
            <a href="index.php?id=<?= $pageId-1;?>" class="btn">Vorherige Seite</a>
            <?php
        }
        ?>
        <a href="index.php?id=<?= $pageId+1;?>" class="btn">Nächste Seite</a>
        <hr/>
        <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" id="form">
            <div id="editor"><?php
                if (isset($_POST['phpCode'])) {
                    echo $_POST['phpCode'];
                } else {
                    if (is_file(TEMPLATE_DIR . DIRECTORY_SEPARATOR . $numberedFile[$pageId] . TEMPLATE_EXTENSION)) {
                        $code = file_get_contents(TEMPLATE_DIR . DIRECTORY_SEPARATOR . $numberedFile[$pageId] . TEMPLATE_EXTENSION);
                        $code = substr($code, 5);
                        echo trim($code);
                    }
                }
                ?></div>
            <input type="hidden" name="phpCode" id="phpCode"/>
            <br/>
            <input type="submit" name="submit" value="Ausführen">
        </form>

        <script>
            ace.require("ace/ext/language_tools");
            var editor = ace.edit("editor");
            editor.setTheme("ace/theme/monokai");
            editor.session.setMode("ace/mode/mysql");
            editor.setOptions({
                autoScrollEditorIntoView: false,
                copyWithEmptySelection: true,
                showPrintMargin: false,
                enableLiveAutocompletion: true,
                enableBasicAutocompletion: true
            });

            $('#form').on('submit', function() {
                $('#phpCode').val(editor.getValue());
            });
        </script>

        <div>
            <h3>Ausgabe:</h3>
            <pre><?= $codeResult; ?></pre>
        </div>


    </div>
    </body>
</html>
