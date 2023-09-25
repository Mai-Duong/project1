
<?php
include 'inc/header.php';
?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    body,
    html {
        height: 100%;
    }

    .contact-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50%;
        background-color: #f7f7f7;
    }

    .contact-box {
        padding: 20px;
        text-align: left;
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);

    }

    .contact-box i {
        padding-right: 10px;
    }

    .contact-title {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .contact-info {
        font-size: 17px;
        margin-bottom: 10px;
    }
</style>




<div class="contact-container">
    <div class="contact-box">
        <h1 class="contact-title">THÔNG TIN LIÊN HỆ</h1>
        <p class="contact-info">Mọi thắc mắc về sản phẩm hoặc dịch vụ của chúng tôi, vui lòng liên hệ với chúng tôi
            theo thông tin dưới đây:</p>

        <?php
        $con = new contact();
        $getContactInfo = $con->getContactInfo();
        if(isset($getContactInfo)){
            while($result = $getContactInfo->fetch_assoc()){
         ?>
        <p class="contact-info"><i class="fas fa-map-marker-alt"></i> <?php echo $result['address'] ?>
        </p>
        <p class="contact-info"><i class="fas fa-phone"></i> <?php echo $result['phone'] ?></p>
        <p class="contact-info"><i class="fas fa-envelope"></i> <?php echo $result['email'] ?></p>
        <p class="contact-info"><i class="fa-solid fa-truck"></i><?php echo $result['transport'] ?></p>
        <p class="contact-info"><i class="fa-solid fa-rotate-left"></i><?php echo $result['note'] ?></p>
        <?php
            }
        }
        ?>
    </div>
</div>
<?php include 'inc/footer.php'; ?>