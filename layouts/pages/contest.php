    <div class="col-md-12">
        <?php
            $action = isset($_GET['action']) ? $_GET['action'] : 'index';
            $fileHanlder = dirname(__FILE__) . '/contest/' . $action . '.php';
            
            if (file_exists($fileHanlder))
                require_once($fileHanlder);
            else
                require_once(dirname(__FILE__) . '/error/404.php');
        ?>
    </div>
</div>
