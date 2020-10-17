<?php
	session_start();

	require('../../../config/config.php');
    require('../../../config/db.php');

    // $_SESSION['admin'] = "super_admin";
    if(!$_SESSION['admin']){
        header("location: ./index.php");
        exit();
    }

    $query = 'SELECT * FROM greencash_bank ORDER BY merge_at DESC';
    $result = mysqli_query($conn, $query);
    $datas = array();
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $datas[] = $row;
        }
    }
/////////////////////////////////////////////////////////////////////////
    #####  SENDING ADMIN MESSAGE HERE ######
    $errMsg = '';
    $errMsgClass = '';

    if(filter_has_var(INPUT_POST, 'submit')){
        $name = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        if(!empty($name) && !empty($email) && !empty($subject) && !empty($message)){

            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                $errMsg = "Please use a vaild email";
                $errMsgClass = "alert-danger";
            }else{
                $toemail = $email;
                $title = $subject;
                $body = '<html><body>';
                $body .= '<h4>Dear '.$name.'</h4>
                        <p>'.$message.'</p>';
                $body .= '</body></html>';

                $header = "MIME-Version : 1.0" ."\r\n";
                $header .= "Content-Type: text/html;charset: UTF-8" ."\r\n";
                $header .= "Admin From Greencash: admin@greencash2020.com". "\r\n";

                if(mail($toemail, $title, $body, $header)){
                        $errMsg = "Hi Admin, Your Email to ".$name." was successful. Cheers!";
                        $errMsgClass = "alert-success";
                        $name = $email = $subject = $message = '';
                }else{
                        $errMsg = "Hi Admin, Your email was NOT successful. Try again later";
                        $errMsgClass = "alert-danger";
                }
            }
        } else{
            $errMsg = "Please fill all fields";
            $errMsgClass = "alert-danger";
        }
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////##########################################################
    ####       MERGING STARTS HERE
    $msg = "";
    $MsgClass = "";

if(isset($_POST['merge_A'])){
        $payee = mysqli_real_escape_string($conn, $_POST['payee']);
        $pay_acc_name = mysqli_real_escape_string($conn, $_POST['pay_acc_name']);
        $pay_acc_number = mysqli_real_escape_string($conn, $_POST['pay_acc_number']);
        $pay_bank_name = mysqli_real_escape_string($conn, $_POST['pay_bank_name']);
        $payer = mysqli_real_escape_string($conn, $_POST['payer']);
    if(!empty($payee) && !empty($pay_acc_name) && !empty($pay_acc_number) && !empty($pay_bank_name) && !empty($payer)){
        if($payee === $payer){
            $msg = 'You Can NOT Merge One Person Twice';
            $msgClass = "alert-danger";
        }else{
########## Admin will customise these variables himself ##############
        $sql_merge = "SELECT * FROM greencash_bank WHERE username = '$payee'";
        $result = mysqli_query($conn, $sql_merge);
        $post = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        $merge = "merge payment";
        $merge_at = "";
        $merge_details = "Account Name: ".$post['acc_name']."<br>"."Account Number: ".$post['acc_number']."<br>"."Bank Name: ".$post['acc_bank'];
        $image = "My pending image.jpg";
// $id = mysqli_real_escape_string($conn, $_GET['id']);
#### UPDATING PAYER'S ROW

    $query_payer = "UPDATE `greencash_bank` SET `merge` = '$merge', `merge_details` = '$merge_details', `merge_at` = CURRENT_TIME, `pay_acc_name` = '$pay_acc_name', `pay_acc_number` = '$pay_acc_number', `pay_bank_name` = '$pay_bank_name', `image` = '$image' WHERE `greencash_bank`.`username` = '$payer'";

        if(mysqli_query($conn, $query_payer)){
            $msg = 'Successfully Merged A'."<br>";
            $msgClass = "alert-success";
            // $payee = $pay_acc_name = $pay_acc_number = $pay_bank_name = $payer = "";
        }else{
            // echo 'ERROR: '.mysqli_error($conn);
            $msg = 'An Error occurred during the merge procees. Try Again';
            $msgClass = "alert-danger";
            }
        }
   }else{
    //   some fields are empty
    $msg = 'Please fill All fields To Continue';
    $msgClass = "alert-danger";
    }
}
//////   #    ///////    #   //////////  #    ////////////    #    //////////   #   ///////
#### UPDATING RECEIVER'S ROW
if(isset($_POST['merge_B'])){
        $payee = mysqli_real_escape_string($conn, $_POST['payee']);
        $pay_acc_name = mysqli_real_escape_string($conn, $_POST['pay_acc_name']);
        $pay_acc_number = mysqli_real_escape_string($conn, $_POST['pay_acc_number']);
        $pay_bank_name = mysqli_real_escape_string($conn, $_POST['pay_bank_name']);
        $payer = mysqli_real_escape_string($conn, $_POST['payer']);
    if(!empty($payee) && !empty($pay_acc_name) && !empty($pay_acc_number) && !empty($pay_bank_name) && !empty($payer)){
        if($payee === $payer){
            $msg = 'You Can NOT Merge One Person Twice';
            $msgClass = "alert-danger";
        }else{
    /// merge variable for just the RECEIVER
        // get acc_name, number, email
        $merge = "merged"; 
        $sql_merge = "SELECT * FROM greencash_bank WHERE username = '$payer'";
        $result = mysqli_query($conn, $sql_merge);
        $post = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    // adding payers details here ///
        $merge_details = "Name: ".$post['acc_name']."<br>";
        $merge_details .= "Number: ".$post['number']."<br>";
        $merge_details .= "Email: ".$post['email']."<br>";
        $merge_details .= "Amount: ".$post['amount'];

        $query_payee = "UPDATE `greencash_bank` SET `merge` = '$merge', `merge_details` = '$merge_details', `merge_at` = CURRENT_TIME WHERE `greencash_bank`.`username` = '$payee'";

        if(mysqli_query($conn, $query_payee)){
            $msg = 'Successfully Merged B';
            $msgClass = "alert-success";
            // $payee = $pay_acc_name = $pay_acc_number = $pay_bank_name = $payer = "";
        }else{
            // echo 'ERROR: '.mysqli_error($conn);
            $msg = 'Incomplete merge Process. Contact Webmaster';
            $msgClass = "alert-danger";
        }
    }
}else{
    //   some fields are empty
    $msg = 'Please fill All fields To Continue';
    $msgClass = "alert-danger";
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////######################################################
/// Admin confirm payments here
$png = "";
if(isset($_POST['confirm'])){
    $payment = mysqli_real_escape_string($conn, $_POST['payment']);
    $merge = "paid and confirmed";
    $merge_details = "Cheers!...Your Payment Has Been Confirmed";

    if(empty($payment)){
        $png = "<h5 style='color:red;'>ERROR!...You MUST select A Username to complete this action</h5>";
    }else{
        $query_payment = "UPDATE greencash_bank SET `merge` = '$merge', `merge_details` = '$merge_details' WHERE `username` = '$payment'";
        if(mysqli_query($conn, $query_payment)){
            $png = "<img src='../../../img/pass.png' width='80px' height='80px'>";
        }else{
            $png = "<img src='../../../img/error.png' width='80px' height='80px'>";
        }
    }
}

?>
<?php include('./inc/header.php'); ?>

<!-- //	SOME BOILER TEMPLETE -->
    <div id="form-wrapper2" class="container mt-3">
        <!-- custom div -->
    <table class="table table-bordered text-center bg-dark table-responsive">
        <h2 class="text-center display-5">Manage Users' Merging</h2>
        <thead>
            <tr class="text-white">
                <th>USERNAME</th>
                <th>PHONE NUMBER</th>
                <th>EMAIL ADDRESS</th>
                <th>ACCOUNT NAME</th>
                <th>ACCOUNT NUMBER</th>
                <th>BANK NAME</th>
                <th>AMOUNT</th>
                <th style="background-color: #0f0;">MERGE?</th>
                <th style="background-color: #0f0;">MERGE_DETAILS</th>
                <th>MERGE DATE/TIME</th>
                <th>PAY TO: ACCOUNT NAME</th>
                <th>PAY TO: ACCOUNT NUMBER</th>
                <th>PAY TO: BANK NAME</th>
                <th>RECEIPT IMAGE</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datas as $data) : ?>
                <tr class="text-white">
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['number']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['acc_name']; ?></td>
                    <td><?php echo $data['acc_number']; ?></td>
                    <td><?php echo $data['acc_bank']; ?></td>
                    <td><?php echo $data['amount']; ?></td>
                    <td><?php echo $data['merge']; ?></td>
                    <td><?php echo $data['merge_details']; ?></td>
                    <td><?php echo $data['merge_at']; ?></td>
                    <td><?php echo $data['pay_acc_name']; ?></td>
                    <td><?php echo $data['pay_acc_number']; ?></td>
                    <td><?php echo $data['pay_bank_name']; ?></td>
                    <td><?php echo $data['image']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- Admin will confirm payments here -->
<div id="form-wrapper2" class="container mt-3">
    <h3>Admin will confirm payments here</h3>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group">
        <select name="payment" class="form-control">
        <option selected disabled> -- Select Username to Confirm Payment -- </option>
        <?php foreach($datas as $data) : ?>
            <option value="<?php echo $data['username']; ?>"><?php echo $data['username']; ?></option>
        <?php endforeach; ?>       
    </select>
    <input type="submit" name="confirm" value="Confirm Payment" class="btn btn-success mt-3" style="background-color: green; font-weight: bold;"><span style="min-width: 50px;min-height: 50px;margin: 20px 0 0 10px;"><?php echo $png; ?></span>
    </form>
</div>
<!-- Editing mode from here -->
    <div id="form-wrapper2" class="container mt-3">
    <div class="container">
    <h1>Create Merge Box</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="alert <?php echo $msgClass; ?> mt-3">
                <?php echo $msg; ?>
            </div>
             <div>
                <label>Payee / Pay To:</label>
                <input type="text" name="payee" id="merge" class="form-control" value="<?php echo isset($_POST['payee']) ? "$payee" : "" ?>" placeholder="Payee's Username">
            </div>
            <div class="form_group">
                <label>Paid To: Account Name</label>
                <input type="text" name="pay_acc_name" class="form-control" value="<?php echo isset($_POST['pay_acc_name']) ? "$pay_acc_name" : "" ?>" placeholder="Account Name You Credited">
            </div>
            <div class="form_group">
                <label>Paid To: Account Number</label>
                <input type="text" name="pay_acc_number" class="form-control" value="<?php echo isset($_POST['pay_acc_number']) ? "$pay_acc_number" : "" ?>" placeholder="Account Number You Credited">
            </div>
            <div class="form_group">
                <label>Paid To: Bank Name</label>
                <input type="text" name="pay_bank_name" class="form-control" value="<?php echo isset($_POST['pay_bank_name']) ? "$pay_bank_name" : "" ?>" placeholder="Name Of BAnk You Credited">
            </div>
            <hr>
            <div>
                <label>Merged To: / Payer</label>
                <input type="text" name="payer" id="merge" class="form-control" value="<?php echo isset($_POST['payer']) ? "$payer" : "" ?>" placeholder="Username Of The Payer">
            </div>
            <br>
<!--    Multiple Merging using Javascript to  -->
            <aside id="add_multiple" onclick="show_hide_payers();">
                <input type="button" name="" id="show_hide" value="SHOW MORE PAYERS" class="btn btn-secondary" style="background-color: #000; font-weight: bold;">
            </aside>
            <section id="multiple" style="display: none;">
                <div>
                    <label>Multiple Payer | MP1</label>
                    <input type="text" name="payer_one" id="merge" class="form-control" value="" placeholder="Add Second Payer">
                </div>
                <div>
                    <label>Multiple Payer | MP2</label>
                    <input type="text" name="payer_two" id="merge" class="form-control" value="" placeholder="Add Third Payer">
                </div>
                <div>
                    <label>Multiple Payer | MP3</label>
                    <input type="text" name="payer_three" id="merge" class="form-control" value="" placeholder="Add Fourth Payer">
                </div>
            </section>
            <br>
            <b>NOTE: To complete a merge process, you MUST merge A and merge B Respectively. If they are successful...cool!, after clicking Merge A and Merge B, Then click on Refresh to see that the merge was properly added. Then before you merge another person or set of persons, click on Reset button to clear the fields, then repeat the process again. Contact Webmaster if any issues</b>
            <br>
            <input type="submit" name="merge_A" value="Merge A" class="btn btn-success" style="background-color: #0f0;">
            <input type="reset" name="reset" value="Reset" class="btn btn-danger" style="background-color: #f00;">
            <a href="./admin_ufuoma.php" class="btn btn-primary" style="background-color: #00f;">Refresh</a>
            <input type="submit" name="merge_B" value="Merge B" class="btn btn-success" style="background-color: #0f0;">
        </form>
    </div>
</div>
<!-- //////////////// Admin contacting users Gateway \\\\\\\\\\\\\\\\\\ -->

    <div id="form-wrapper2" class="container mt-3">
        <div class="container">
            <h2 class="text-center display-5 mt-3">Send Private Messages to Your User's Email Address</h2>
            <div class="alert <?php echo $errMsgClass; ?> mt-3">
                <?php echo $errMsg; ?>
            </div>
            <form method="POST" class="form-group" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div>
                    <label>Enter Their Username</label>
                    <input type="text" name="username" value="<?php echo isset($_POST['username']) ? "$name" : "" ?>"  class="form-control">
                </div>
                <div>
                    <label>Enter Their Email</label>
                    <input type="text" name="email" value="<?php echo isset($_POST['email']) ? "$email" : "" ?>"  class="form-control">
                </div>
                <div>
                    <label>Enter The Title of Admin Message</label>
                    <input type="text" name="subject" value="<?php echo isset($_POST['subject']) ? "$subject" : "" ?>"  class="form-control">
                </div>
                <div>
                    <label>Write Your Message Here</label>
                    <textarea class="form-control" name="message"><?php echo isset($_POST['message']) ? "$message" : ''; ?></textarea>
                </div>
                <br>
                <div>
                    <input type="submit" name="submit" value="send" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
<!-- ///////// start  Admin Block Users Here -->
<?php
    $msgBlock = '';
    $msgBlockClass = '';
    if(isset($_POST['block'])){
        $user_block = mysqli_real_escape_string($conn, $_POST['user_block']);
        if(empty($user_block)){
             $msgBlock = 'You Must Select A Username To Continue';
             $msgBlockClass = 'alert-danger';
        }else{
            $query_user = "DELETE FROM `greencash_table` WHERE `greencash_table`.`username` = '$user_block'";
            if(mysqli_query($conn, $query_user)){
                $query_user_again = "DELETE FROM `greencash_bank` WHERE `greencash_bank`.`username` = '$user_block'";
                if(mysqli_query($conn, $query_user_again)){
                    $msgBlock = 'User Has Been Deleted';
                    $msgBlockClass = 'alert-success';
                }
            }else{
                $msgBlock = 'Command Failed. User Not Deleted';
                $msgBlockClass = 'alert-danger';
            }
        }
    }
?>
    <div id="form-wrapper2" class="container mt-3">
       <h3>Admin will Block User here</h3>
       <div class="alert <?php echo $msgBlockClass; ?>"><?php echo $msgBlock; ?></div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group">
        <select name="user_block" class="form-control">
        <option selected disabled> -- Select Username to Block User -- </option>
        <?php foreach($datas as $data) : ?>
            <option value="<?php echo $data['username']; ?>"><?php echo $data['username']; ?></option>
        <?php endforeach; ?>       
    </select>
    <input type="submit" name="block" value="Block A User" class="btn btn-success mt-3" style="background-color: red; font-weight: bold;" title="This action will permanently remove a user from the database" onclick="confirm('This User will be permanently deleted. Do you wish to continue?');"><span style="min-width: 50px;min-height: 50px;margin: 20px 0 0 10px;"><?php echo $png; ?></span>
    </form>
    </div>
<!-- ///////// End  Admin Block Users Here -->

<!-- custom js -->
<script type="text/javascript">
    //////  JAVASCRPTING HERE
    function show_hide_payers(){
        var add_multiple = document.getElementById('add_multiple');
        var multiple = document.getElementById('multiple');
        var show_hide = document.getElementById('show_hide');

        if(multiple.style.display === "none"){
            multiple.style.display = "block";
            show_hide.value = "HIDE EXTRA PAYERS";
        }else{
            multiple.style.display = "none";
            show_hide.value = "SHOW EXTRA PAYERS";
        }
    }
</script>

<!-- footer -->
<?php include("./inc/footer.php"); ?>
        
</body>
</html>
