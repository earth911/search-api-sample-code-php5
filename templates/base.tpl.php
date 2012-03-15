<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title><?php echo isset($title) ? $title : 'Recycling Center Search' ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="styles/base.css" type="text/css" />
    <link rel="stylesheet" href="styles/search.css" type="text/css" />
</head>
<body>
    <div class="container">
        <div class="search-header">
            Your Image<br />
            or HTML goes here
        </div>
    
        <form class="search-form" action="search.php" method="get">
            <label for="what">Find recycling centers for</label>
            <label for="where">Near</label>
            <br class="clear" />
            <input type="text" class="text" name="what" id="what" value="<?php echo htmlspecialchars($searchArgs->what) ?>" />
            <input type="text" class="text" name="where" id="where" value="<?php echo htmlspecialchars($searchArgs->where) ?>" />
            <input type="submit" class="submit" value="Search" />
            <br class="clear" />
            <div class="example">aluminum cans, computers, paint</div>
            <div class="example">zip code</div>
            <br class="clear" />
        </form>

        <?php include $content; ?>
        
        <div class="search-footer">
            Powered by <a href="http://earth911.com/">Earth911.com</a>
        </div>
    </div>
</body>
</html>
