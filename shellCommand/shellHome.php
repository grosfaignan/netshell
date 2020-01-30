<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>shell</title>
    <link rel="stylesheet" href="stdout.css">
</head>
<?php require 'shell.php';?>

<body>
    <section>
        <div class="body">
            <p>
                <div class="header">
                    <div class="c1">
                        <p ><code>$>:</code></p>
                    </div>
                    <div class="c2">
                        <p><?php echo ('<code>' . $cmd . '</code>'); ?></p>
                    </div>
                </div>
            </p>
            <p>
                <div class="content">
                    <div class="c1">
                        <pre><?php for($i=0;$i<count($parsed);$i++) echo($i.'<br/>');?></pre>
                    </div>
                    <div class="c2">
                        <pre ><?php display($parsed);?></pre>
                    </div>
                </div>
            </p>
        </div>
    </section>
</body>

</html>