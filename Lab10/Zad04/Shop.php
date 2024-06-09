<?php
session_start();

if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array();
}

function addToBasket($chair_ID): void {
    if (isset($_SESSION['basket'][$chair_ID])) {
        $_SESSION['basket'][$chair_ID] += 1;
    } else {
        $_SESSION['basket'][$chair_ID] = 1;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addToCart'])) {
    $chair_ID = $_POST["chair_ID"];
    addToBasket($chair_ID);
}

?>


<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Shop</title>
    <link rel='stylesheet' href="Shop.css">
</head>
<body>
<header>
    <a href="Basket.php"><h2>Basket</h2></a>
    <h1>Shop</h1>
    <a href="Login.php"><h2>Login</h2></a>
</header>
<img src="mainBanner.jpg" alt="imgnoworky">
<div id="shopItemContainer">
    <form method="POST" action="">
        <div class="item">
            <img src="https://purepng.com/public/uploads/large/purepng.com-rolling-chairchairfurnitureluxurymodernbusinessobjectwheelofficeblackrollingleadershipequipmentarmchairobjectsrolling-chair-8215239878440aa1i.png"
                 alt="chair">
            <h3>Leather Chair</h3>
            <p>Leather Chair that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="1">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item">
            <img src="https://pngimg.com/d/chair_PNG6908.png" alt="chair">
            <h3>Yellow Chair</h3>
            <p>Yellow Chair that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="2">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item">
            <img src="https://png.pngtree.com/png-vector/20230906/ourmid/pngtree-orange-modern-chair-isolated-png-image_10008187.png"
                 alt="chair">
            <h3>Orange Ball Chair</h3>
            <p>Orange Ball that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="3">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/ed/Ball_chair.png" alt="chair">
            <h3>Red Half Ball Chair</h3>
            <p>Red Half Ball Chair that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="4">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item">
            <img src="https://parspng.com/wp-content/uploads/2022/10/chairpng.parspng.com-2.png" alt="chair">
            <h3>Leather Office Chair</h3>
            <p>Leather Office Chair that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="5">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item">
            <img src="https://pngfile.net/download/ghHflRhTaavmHr7BhXaIPKqhvGAsW9UDt3aPlyKtEHuLiHmiFuV98VvWbsZ7ai9r9YysCnOGk0qwX4ClAlN7RqdndjpyBal0ZO5TJpv1PLlifRagrHN0XNm30gKSGOM3rcx4yEgUxvGc7ApOGtNfLPNrHsUBPfziK2oWj6XjXrG2onREqRajKdof3Wndk4Hkp6eHIjyH/medium"
                 alt="chair">
            <h3>Brown Outside Chair</h3>
            <p>Brown Outside Chair that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="6">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item">
            <img src="https://png.pngtree.com/png-clipart/20220913/ourmid/pngtree-yellow-armchair-png-image_6149004.png"
                 alt="chair">
            <h3>Yellow Soft Chair</h3>
            <p>Yellow Soft Chair that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="7">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item">
            <img src="https://freepngimg.com/thumb/chair/4-2-chair-png-thumb.png" alt="chair">
            <h3>Round Outside Chair</h3>
            <p>Round Outside that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="8">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item">
            <img src="https://pngimg.com/d/chair_PNG6870.png" alt="chair">
            <h3>White Leather Office Chair</h3>
            <p>White Leather Office Chair that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="9">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item">
            <img src="https://images.squarespace-cdn.com/content/v1/5ed2dcd9bec96f17e7468fc9/1643638701787-FWV5DTF8402VHXGGGGN9/framed+green+armchair.png"
                 alt="chair">
            <h3>Green Chair</h3>
            <p>Green Chair that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="10">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item itemGoat">
            <img src="https://steamuserimages-a.akamaihd.net/ugc/2036237786885040687/95AC9545D822E8F5627A18A81397EE2A80D17E77/?imw=512&&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=false"
                 alt="chair">
            <div>
                <h3>THE GOAT OF ALL CHAIRS</h3>
                <p>I am the storm that is approaching
                    Provoking black clouds and isolation
                    I am reclaimer of my name
                    Born in flames, I have been blessed
                    My family crest is a demon of death
                    Forsakened, I am awakened
                    A phoenix's ash in dark divine
                    Descending misery
                    Destiny chasing time</p>
                <input type="hidden" name="chair_ID" value="11">
                <button type="submit" name="addToCart">Add to Cart</button>
            </div>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item">
            <img src="https://www.fermob.com/var/public/storage/images/_aliases/full_product/9/6/4/0/6230469-1-fre-FR/STUDIE_CHAISE_CHENE_CACTUS_SKU_692182.png"
                 alt="chair">
            <h3>Spine Breaking Chair</h3>
            <p>Spine Breaking Chair that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="12">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item">
            <img src="https://cdn3d.iconscout.com/3d/premium/thumb/chair-6219030-5087370.png" alt="chair">
            <h3>Silly Yellow Chair</h3>
            <p>Silly Yellow Chair that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="13">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
    <form method="POST" action="">
        <div class="item">
            <img src="https://www.violetvintage.com/wp-content/uploads/2021/01/Esmerelda-Chair-e1635639132223.png"
                 alt="chair">
            <h3>Velvet Chair</h3>
            <p>Pretty Velvet Chair that works when you sit on it. No way!</p>
            <input type="hidden" name="chair_ID" value="14">
            <button type="submit" name="addToCart">Add to Cart</button>
        </div>
    </form>
</div>
</body>