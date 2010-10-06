<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <title><?php $view['slots']->output('title', 'Calendar Application') ?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>

    <?php echo $view['stylesheets'] ?>
    <?php echo $view['javascripts'] ?>
    
    
</head>
    <body>
      <div>
          <?php $view['slots']->output('_content') ?>
      </div>
    </body>
</html>
