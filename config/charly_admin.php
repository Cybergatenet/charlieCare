<?php
    require('./db.php');

    $username = "Charly_Admin";
    $email = "charlycareclasic@gmail.com";
    $phone = '+23323-865-1493';
    $address = '190/B Castle Road, Accra | Ghana';
    $state = 'Accra';
    $country = 'Ghana';
    $bio_data = 'No Bio-data Avaliable. Bio data is a brief description of yourself. Go to settings, and add your Bio-data. OR contact webmaster for more details';
    $avatar = 'defaultAvatar.png'; // sanitize pics before uplaod
    $date = date('Y/m/d H:i:s');
    $userTime = $date;
    $token = md5('AC252320BF');
    $pwd = 'Charly_ADMIN2020';

    $pwd = password_hash($pwd, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `charlycare_users` (`username`, `email`, `pwd`, `token`, `phone`, `address`, `state`, `country`, `bio_data`, `avatar`, `userTime`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssss', $username, $email, $pwd, $token, $phone, $address, $state, $country, $bio_data, $avatar, $userTime);

    // if($stmt->execute()){
    //     echo "Admin data Inserted successfully";
    // }else{
    //     echo "NOT successful".'<br>'.mysqli_error($conn);
    // }

?>

