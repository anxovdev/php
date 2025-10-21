<html>
    <body>
        <?php
            // GET
            // $date = new DateTime();
            // $dateUser = new DateTime($_GET["date"]);

            // $age = $date->diff($dateUser)-> y;

            // echo "<p>Tu tienes ",$age," años :)</p>";

            /**
             * POST
             */
            $date = new DateTime();
            $dateUser = new DateTime($_POST["date"]);

            $age = $date->diff($dateUser)-> y;

            echo "<p>Tu tienes ",$age," años :)</p>";
        ?>
    </body>
</html>