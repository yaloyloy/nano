<?php
    //include('search-conf.php');
    // include('admin/action/action.php');
    // $db=new Action;
    try{
        $cns = new PDO("mysql:host=localhost;dbname=nano_web","root","");
    }catch(Exception $e){
        die("ERROR :".$e->getMessage());
    }

if(isset($_POST['search']) && ($_POST['search']!="")){
    $sql = $cns->prepare("SELECT * FROM tbl_product WHERE name LIKE :name");
    $sql->execute(array(
        'name'=>'%'.$_POST['name'].'%'
    ));

    if($sql->rowCount()==0){
        echo 'No Product';
    }else{
        while($data=$sql->fetch()){
            ?>
            <div class="search-box">
                <img src="<?php echo $data['img']; ?>" alt="" class="search-img" />
                <span class="search-name"><?php echo $data['name']; ?></span><br>
                <span class="search-price"><?php echo $data['price_guest']; ?></span>

            </div>

        <?php
        }
    }
}


?>
