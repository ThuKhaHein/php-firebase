<?php
session_start();
include('dbcon.php');

if(isset($_POST['register_btn']))
{
    $fullname = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userProperties = [
        'email' => $email,
        'emailVerified' => false,
        'phoneNumber' => '+91'.$phone,
        'password' => $password,
        'displayName' => $fullname,
    ];
    
    $createdUser = $auth->createUser($userProperties);
    
    if($createdUser)
    {
        $_SESSION['status'] = "User Created/Registered Successfully";
        header('Location: register.php');
        exit();
    }
    else
    {
        $_SESSION['status'] = "User Not Created/Registered";
        header('Location: register.php');
        exit();
    }
}





if(isset($_POST['delete_btn']))
{
    $del_id = $_POST['delete_btn'];

    $ref_table = 'contacts/'.$del_id;
    $deletequery_result = $database->getReference($ref_table)->remove();
    
    if($deletequery_result)
    {
        $_SESSION['status'] = "Contact Deleted Successfully";
        header('Location: index.php');
    }
    else
    {
        $_SESSION['status'] = "Contact Not Deleted";
        header('Location: index.php');
    }
}




if(isset($_POST['update-contact']))
{
    $key = $_POST['key'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $updateData = [
        'fname'=>$first_name,
        'lname'=>$last_name,
        'email'=>$email,
        'phone'=>$phone,
    ];

    $ref_table = 'contacts/'.$key;
    $updatequery_result= $database->getReference($ref_table)->update($updateData);

    if($updatequery_result)
    {
        $_SESSION['status'] = "Contact Updated Successfully";
        header('Location: index.php');
    }
    else
    {
        $_SESSION['status'] = "Contact Not Updated";
        header('Location: index.php');
    }
}






if(isset($_POST['save-contact']))
{
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $postData = [
        'fname'=>$first_name,
        'lname'=>$last_name,
        'email'=>$email,
        'phone'=>$phone,
    ];

    $ref_table = "contacts";
    $postRef_result= $database->getReference($ref_table)->push($postData);

    if($postRef_result)
    {
        $_SESSION['status'] = "Contact Added Successfully";
        header('Location: index.php');
    }
    else
    {
        $_SESSION['status'] = "Contact Not Added";
        header('Location: index.php');
    }
}

?>