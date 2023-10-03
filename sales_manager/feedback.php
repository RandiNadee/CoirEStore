<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location:login.php");
}
include "../database.php";
?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
    <div class="row">

        <?php include "./templates/sidebar.php"; ?>

        <div class="row">
            <div class="col-10">
                <h2>Feedback List</h2>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody id="feedback_list">
                    <?php
                    $feedback_query = "SELECT * FROM feedback";
                    $run_query = mysqli_query($con, $feedback_query) or die(mysqli_error($con));
                    if (mysqli_num_rows($run_query) > 0) {
                        while ($row = mysqli_fetch_assoc($run_query)) {
                            echo "
                            <tr>
                                <td>#</td>
                                <td>$row[name]</td>
                                <td>$row[email]</td>
                                <td>$row[subject]</td>
                                <td>$row[message]</td>
                            </tr>
                        ";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </main>
    </div>
</div>

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/feedback.js"></script>