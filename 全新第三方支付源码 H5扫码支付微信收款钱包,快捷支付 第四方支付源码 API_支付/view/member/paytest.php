<!doctype html>
<html>
    
    <head>
        <title>
            <?php echo $title ?>
        </title>
    </head>
    
    <body onload="document.pay.submit()">
        <form name="pay" action="/member/checkout" method="post">
            <?php foreach($data as $key=>
                $val):?>
                <input type="hidden" name="<?php echo $key?>" value="<?php echo $val?>">
                <?php endforeach;?>
        </form>
    </body>

</html>