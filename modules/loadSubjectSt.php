<?php

// echo ("Load Subject");

session_start();

require "db/connection.php";

if (isset($_GET["grade"])) {

    $grade_id = $_GET["grade"];
    $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $grade_id . "'");
    $grade_data = $grade_rs->fetch_assoc();

    $gh_subject_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `grade_id`='" . $grade_id . "'");
    $gh_subject_count = $gh_subject_rs->num_rows;

    if (isset($_SESSION["admin"])) {

        ?>
        <label class="form-label">Assign Subject</label>
        <div class="row p-3">
            <div class="col-12 border rounded-3 p-3 ps-4 pt-4">
                <div class="row">

                    <?php

                    if ($gh_subject_count > 0) {

                        for ($x = 0; $x < $gh_subject_count; $x++) {
                            $gh_subject_data = $gh_subject_rs->fetch_assoc();

                            $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $gh_subject_data["subject_id"] . "'");
                            $subject_data = $subject_rs->fetch_assoc();

                            ?>
                            <div class="col-6">
                                <input class="form-check-inline" id="subject<?php echo ($x); ?>" type="checkbox"
                                    value="<?php echo ($gh_subject_data["id"]); ?>" />
                                <label class="form-label">
                                    <?php echo ($subject_data["name"]); ?>
                                </label>
                            </div>
                            <?php

                        }

                        ?>

                        <div class="d-none col-6">
                            <input type="text" id="scount" value="<?php echo ($gh_subject_count); ?>">
                        </div>

                        <?php

                    } else {

                        echo ("Something went wrong. System cannot find any relavant subjects reserved for the selected grade in the Database. Please contact Database Administrator");
                    }

                    ?>

                </div>
            </div>
        </div>

        <?php

    }
}

?>