<?php 
    if(isset($_POST['var_id'])) {
        foreach ($_POST['var_id'] as $variable) {
            echo '
            <script>
                console.log('.json_encode($variable).');
            </script>
            ';
        }
    }
?>