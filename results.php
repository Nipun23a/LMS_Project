<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Results</title>

    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="stylesheet" href="src/css/bootstrap.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/src/js/bootstrap-icons@1.9.1/font/src/js/bootstrap-icons.css" />

    <link rel="shortcut icon" href="assets/logo/HS-Black.png" type="image/x-icon" />

</head>

<body class="homex2">

    <div class="container-fluid">
        <div class="row justify-content-center">

            <?php include "header.php"; ?>

            <div class="col-12 p-3">
                <div class="row justify-content-center">

                    <div class="col-12 p-3 px-lg-4 rounded-3 home">
                        <div class="row justify-content-center">

                            <div class="col-12 text-center">
                                <span class="fs-1 text-warning">Check Results</span>
                            </div>
                            <div class="col-12 mb-3">
                                <hr />
                            </div>

                            <div class="col-12">
                                <label class="form-label">Grade</label>
                                <select class="form-select" id="grade">
                                    <option value="0" selected>Select Grade</option>
                                    <?php

                                    $grade_rs = Database::search("SELECT * FROM `grade` ORDER BY `id` ASC");
                                    $grade_count = $grade_rs->num_rows;

                                    for ($x = 0; $x < $grade_count; $x++) {

                                        $grade_data = $grade_rs->fetch_assoc();

                                        ?>
                                        <option value="<?php echo ($grade_data["id"]); ?>">
                                            <?php echo ($grade_data["grade"]); ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-8 mt-3">
                                <input type="text" class="form-control" placeholder="email" id="email" />
                            </div>
                            <div class="col-12 col-lg-4 mt-3 d-grid">
                                <button class="btn btn-primary" onclick="search_result();">Search</button>
                            </div>

                            <div class="col-12 mt-3">
                                <hr />
                            </div>

                        </div>
                    </div>

                    <div class="col-12 mb-3 mt-3 p-3">
                        <div class="row justify-content-center">

                            <div class="col-12" id="result">
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <footer class="col-12 header-bg p-3">
                <div class="row justify-content-center">

                    <div class="col-lg-5 col-12 text-center">
                        <span class="text-black-50 fs-6">
                            2024 &copy; SJ ACADEMY | Developed by Shanu Jayasinghe &trade;
                        </span>
                    </div>

                </div>
            </footer>

        </div>
    </div>

    <script src="src/js/script.js"></script>
    <script src="src/js/bootstrap.js"></script>
    <script src="src/js/bootstrap.bundle.js"></script>
</body>

</html>