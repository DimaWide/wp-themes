<?php

/* Template Name: Websocket Test */

get_header();

?>

<!-- <div id="real-time-data">Waiting for updates...</div> -->

<?php
/*
$isDexPaid = checkDexPaid('AnM6bkqJy3D4douPgp1keUTmQNygP2KKiM7bVw9qpump');

if ($isDexPaid) {
    echo "Dex is paid<br><br>";
} else {
    echo "Dex is NOT paid<br><br>";
}



$tokenDetails = getTokenDetails('AnM6bkqJy3D4douPgp1keUTmQNygP2KKiM7bVw9qpump');

if ($tokenDetails) {
    echo "Token details fetched successfully:<br>";
    print_r($tokenDetails);
} else {
    echo "Failed to fetch token details after multiple attempts.<br>";
}
*/

?>


<style>
    /* .data-list-item-label {
        opacity: .25
    } */
</style>


<!-- <div class="data-container wcl-container">
    <div id="div-to-img" class="sct-10-product wcl-dex-paid-wrapper mod-generate">

        <h2 class="data-title">PUMP <span>.BLACK</span></h2>

        <div class="data-inner data-row">
            <div class="data-col">
                <div class="data-img">
                    <img src="https://ipfs.io/ipfs/QmWb5twSocSbaMCBxDBx13B6Ktb4x2CTdxWc37xyyRgFmk" alt="img">
                </div>
            </div>

            <div class="data-col" style="padding-left: 70px;">
                <div class="data-list">
                    <div class="data-list-item">
                        <div class="data-list-item-label">
                            Status:
                        </div>

                        <div class="data-list-item-value">
                            <div class="data-status">
                                <span>DEX PAID</span>
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/check-circle.svg'; ?>" alt="img">
                            </div>
                        </div>
                    </div>

                    <div class="data-list-item">
                        <div class="data-list-item-label">
                            Name:
                        </div>

                        <div class="data-list-item-value">
                            <div class="data-name">
                                GOONER
                            </div>
                        </div>
                    </div>

                    <div class="data-list-item">
                        <div class="data-list-item-label">
                            Marketcap:
                        </div>

                        <div class="data-list-item-value">
                            <div class="data-marketcap">
                                $3259.94
                            </div>
                        </div>
                    </div>

                    <div class="data-list-item">
                        <div class="data-list-item-label">
                            CA:
                        </div>

                        <div class="data-list-item-value">
                            <div class="data-name">
                                <div class="data-ca">
                                    <div class="data-ca-field">
                                        AnM6bkqJy3D4douP...pump
                                    </div>

                                    <div class="data-ca-btn">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/copy.svg'; ?>" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="data-links">
                    <div class="data-link">
                        <a href="#" class="cmp-button">
                            <span>CHECK OTHER TOKEN ON PUMP.BLACK</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<button id="capture-btn">Download Image</button>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
 -->

<script>

    //     const canvas = document.getElementById('maskedCanvas');
    //     const ctx = canvas.getContext('2d');
    //     const img = document.getElementById('sourceImg');

    //     // Используем изображение для маски
    //     img.onload = function() {
    //         const maskImg = new Image();
    //         maskImg.src = wcl_obj.template_url + '/img/sct10-product.png'; // Путь к изображению для маски

    //         maskImg.onload = function() {
    //             ctx.drawImage(maskImg, 0, 0, canvas.width, canvas.height);
    //             ctx.globalCompositeOperation = 'source-in';
    //             ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
    //         };
    //     };




    /*document.addEventListener('DOMContentLoaded', function(){

    //     // Сохранение изображения
        document.getElementById('capture-btn').addEventListener('click', function() {
            html2canvas(document.getElementById('div-to-img'), {
                useCORS: true, // Разрешить кросс-доменные изображения
                allowTaint: true // Разрешить таинственные изображения
            }).then(function(canvas) {
                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/jpeg');
              link.download = 'pump_black_image.jpg'; // Название сохраняемого файла
                link.click();

                document.body.appendChild(canvas);

            });

        });
    });*/
</script>



<?php

/*

// External database connection details
$db_host     = '192.145.239.202';      // e.g., '123.456.789.000' or 'db.example.com'
$db_name     = 'web3re5_f84aw48f';
$db_user     = 'web3re5_f4aw8411cc';
$db_password = 'Oi-M$;Pff{w4';
$db_charset  = 'utf8mb4';               // Optional, but recommended
$db_collate  = '';                      // Optional
// Database connection details
$db_port     = 3306;                   // Default MySQL port is 3306

// Create a connection
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name, $db_port);

// Check the connection
if ($mysqli->connect_error) {
    error_log('Connection Error (' . $mysqli->connect_errno . '): ' . $mysqli->connect_error);
    die('Database connection failed.');
}

// SQL query to list tables
$query = "SHOW TABLES";

if ($result = $mysqli->query($query)) {
    echo "<pre>";  // Start preformatted text for better readability in a browser
    echo "Tables in the database:\n\n";
    while ($row = $result->fetch_array()) {
        $table = $row[0];
        echo "<b>Table: $table </b>\n";
        echo str_repeat("=", strlen("Table: $table")) . "\n";

        // SQL query to get the first 10 rows from the current table
        $data_query = "SELECT * FROM `$table` LIMIT 5";

        if ($data_result = $mysqli->query($data_query)) {
            if ($data_result->num_rows > 0) {
                // Fetch and display each row
                while ($data_row = $data_result->fetch_assoc()) {
                    foreach ($data_row as $column => $value) {
                        echo "$column: $value\n";
                    }
                    echo str_repeat("-", 20) . "\n";  // Separator between rows
                }
            } else {
                echo "No data found in this table.\n";
            }
            $data_result->free();
        } else {
            error_log('Error retrieving data from table ' . $table . ': ' . $mysqli->error);
            echo "Error retrieving data from table $table.\n";
        }

        echo "\n"; // Add a newline for better readability between tables
    }
    $result->free();
    echo "</pre>";  // End preformatted text
} else {
    error_log('Error retrieving tables: ' . $mysqli->error);
    echo "Error retrieving tables.\n";
}

// Close the connection
$mysqli->close();

*/

echo '<script src="' . get_template_directory_uri() . '/js/yurii-websocket.js"></script>';

get_footer();

?>