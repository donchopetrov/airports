<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Vayant Task</title>
</head>
<body>
    <form name="airports" action="" method="post">
    	<input type="text" name="origin" placeholder="Enter origin airport code" value="<?= !empty($_POST['origin']) ? htmlspecialchars($_POST['origin']) : '' ?>">
    	<input type="submit" name="submit" value="submit">
    </form>

    <?php if(!empty($params)): ?>
        <?php if(!empty($params['errors'])): ?>

            <p style="color:red;">
                <?php foreach($params['errors'] as $key => $error): ?>
                    <?= $error ?>
                <?php endforeach; ?>
            </p>

        <?php else: ?>

            <?php if(!empty($params['filteredRecords'])): ?>
            <p>
                Destinations:
                <?php foreach($params['filteredRecords'] as $record): ?>
                    <?= $record->dest ?>, 
                <?php endforeach; ?>
            </p>
            <?php else: ?>
                No records found
            <?php endif; ?>

            <?php if(!empty($params['topRecords'])): ?>
            <p>
                Top 3:
                <?php foreach($params['topRecords'] as $key => $record): ?>
                    <?= $key ?> (<?= $record ?> times), 
                <?php endforeach; ?>
            </p>
            <?php endif; ?>

        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
