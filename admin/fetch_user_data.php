<?php
include "../connect.php";

$userid = $_POST['userid'];

$sql = "SELECT * FROM `all_members` WHERE email_id = :userid";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="row">
        <div class="col-md-12 text-right">
            <button class="btn btn-primary edit-button">Edit</button>
            <button class="btn btn-success save-changes-button" style="display:none;">Save Changes</button>
        </div>

    </div>
    <form id="userForm" action="save_changes.php">
        <div class="form-row">
            <input type="hidden" id="userId" name="userId">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input disabled type="email" class="form-control" name="email_new" id="email_new" value="<?php echo $row['email_id'] ?>" disabled>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Mobile</label>
                <input disabled type="number" class="form-control" id="mobile_new" name="mobile_new" value="<?php echo $row['mobile'] ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputCity">First Name</label>
                <input disabled type="text" class="form-control" id="first_name_new" name="first_name_new" value="<?php echo $row['first_name'] ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Middle Name</label>
                <input disabled type="text" class="form-control" id="middle_name_new" name="middle_name_new" value="<?php echo $row['middle_name'] ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputZip">Last Name</label>
                <input disabled type="text" class="form-control" id="last_name_new" name="last_name_new" value="<?php echo $row['last_name'] ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Maiden Name</label>
                <input disabled type="email" class="form-control" id="maiden_name_new" name="maiden_name_new" value="<?php echo $row['maiden_name'] ?>">
            </div>
            <div class="form-group col-md-6 mb-3 mb-lg-0">
                <label for="inputPassword4">Nick Name</label>
                <input disabled type="text" class="form-control" id="nickname_new" name="nickname_new" value="<?php echo $row['nickname'] ?>">
            </div>
        </div>
    </form>

<?php
}
?>