<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Assignments</title>

    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="stylesheet" href="src/css/bootstrap.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/src/js/bootstrap-icons@1.9.1/font/src/js/bootstrap-icons.css" />

    <link rel="shortcut icon" href="assets/logo/HS-Black.png" type="image/x-icon" />

</head>

<body class="home">

    <div class="container-fluid d-flex flex-column">
        <div class="row justify-content-center">

            <?php include "header.php"; ?>

            <?php

            if (isset($_SESSION["teacher"])) {

                $teacher = $_SESSION["teacher"];
                $ghs_id = $teacher["grade_has_subject_id"];

                $ghs_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `id`='" . $ghs_id . "'");
                $ghs_data = $ghs_rs->fetch_assoc();

                $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $ghs_data["grade_id"] . "'");
                $grade_data = $grade_rs->fetch_assoc();

                $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $ghs_data["subject_id"] . "'");
                $subject_data = $subject_rs->fetch_assoc();

                ?>

                        <article class="col-12 p-3">
                            <div class="row justify-content-center">

                                <section class="col-12 text-center">
                                    <h2 class="h2 fw-bold text-primary">Add Assignment</h2>
                                </section>

                                <section class="col-12 rounded-3 p-2 p-lg-3 bg-body">
                                    <div class="row justify-content-center">

                                        <div class="col-12 col-lg-6 mt-3">
                                            <label class="form-label fs-5">Grade</label>
                                            <select id="grade" class="form-select" disabled>
                                                <option value="<?php echo ($grade_data['id']); ?>" selected>
                                                    <?php echo ($grade_data["grade"]); ?>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-3">
                                            <label class="form-label fs-5">Subject</label>
                                            <select class="form-select" id="subj" disabled>
                                                <option value="<?php echo ($ghs_data["id"]); ?>" selected>
                                                    <?php echo ($subject_data["name"]); ?>
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label  fs-5">Name</label>
                                            <input type="text" class="form-control" value="" id="txt"
                                                placeholder="Name should be contain between 15 to 100 characters" />
                                        </div>
                                        <div class="col-12 mb-4 mt-3">
                                            <label class="form-label  fs-5">Deadline</label>
                                            <input type="date" class="form-control" value="" id="deadline" />
                                        </div>

                                        <div class="col-11 mb-3">
                                            <hr />
                                        </div>

                                        <div class="col-10 col-lg-7 mb-3 d-grid">
                                            <!-- <input type="file" id="noteUpload" class="form-control d-none" accept=".xlsx, .xls, .doc, .docx, .ppt, .pptx, .txt, application/pdf"/> -->
                                            <!-- <input type="file" id="noteUpload" class="form-control d-none" accept=".txt, application/pdf, image/*"/> -->
                                            <input type="file" id="upload" class="form-control d-none"
                                                accept=".txt, application/pdf" />
                                            <label for="upload" class="btn btn-outline-primary fw-bold fs-5" onclick="view();"
                                                style="letter-spacing: 0.1rem;">Upload</label>
                                        </div>
                                        <div class="col-12 col-lg-6 text-center">
                                            <span class="fs-5 text-black-50">Please be kind to upload assignment as PDFs often as
                                                possible</span>
                                        </div>

                                        <div class="col-11">
                                            <hr />
                                        </div>

                                        <div class="col-12 text-center mt-3">
                                            <label class="form-label fs-5">Preview</label>
                                        </div>
                                        <div class="col-11 border border-2 rounded-2 mb-4">
                                            <iframe src="" class="frame" id="frame" style="width: 100%; height: 300px;"></iframe>
                                        </div>

                                        <div class="col-10 col-lg-6 d-grid p-3">
                                            <button class="btn btn-success p-2 fs-5" onclick="release_assignment();">Release
                                                Assignment</button>
                                        </div>

                                    </div>
                                </section>

                            </div>
                        </article>

                        <?php

            } else {
                ?>
                        <script>
                            window.onload = function () {
                                window.location = "home.php";
                            }
                        </script>
                        <?php
            }

            ?>

        </div>
    </div>

    <script src="src/js/script.js"></script>
    <script src="src/js/bootstrap.js"></script>
    <script src="src/js/bootstrap.bundle.js"></script>
</body>

</html>