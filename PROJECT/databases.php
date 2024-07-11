<?php

$dbhost = "localhost";
$dbuser = "Marcel";
$dbpass = "wahoo";

try {
    $pdo = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS PROJECT");
    $pdo->exec("USE PROJECT");

    $userTable = "CREATE TABLE IF NOT EXISTS users (
                  user_id INT PRIMARY KEY AUTO_INCREMENT,
                  username VARCHAR(30) NOT NULL,
                  password VARCHAR(100) NOT NULL,
                  email VARCHAR(50) NOT NULL);";

    $pdo->exec($userTable);

    $menuTable = "CREATE TABLE IF NOT EXISTS food (
    food_id          INT PRIMARY KEY AUTO_INCREMENT,
    food_name        VARCHAR(30),
    food_image       VARCHAR(255)  NOT NULL,
    food_description TEXT,
    food_price       DECIMAL(5, 2),
    food_category    VARCHAR(20) );";

    $pdo->exec($menuTable);

    // Check if the food table is empty
    $checkTableEmpty = $pdo->query("SELECT COUNT(*) FROM food")->fetchColumn();

// If the food table is empty, insert the data
    if ($checkTableEmpty == 0) {
        $foodInsert = $pdo->prepare("INSERT INTO food (food_name, food_image, food_description, food_price, food_category) VALUES (?, ?, ?, ?, ?)");

        $foodData = [
        #   Appetizers
        ['Beary Delightful Burger', 'Food/Appetizers-Bear_Mini_Borgir.webp', 'A whimsical burger featuring a bun shaped like an adorable bear face, filled with fresh veggies and a juicy patty. Served with a side of smiles.', 9.95, 'Appetizers'],
        ['Bee-licious Sushi Rolls', 'Food/Appetizers-Bee_Sushi.webp', 'A delightful assortment of sushi rolls crafted to resemble buzzing bees, featuring fresh fish, crisp veggies, and sticky rice wrapped in nori sheets for a sweet and savory treat.', 18.50, 'Appetizers'],
        ['Hoppy Bao Bunnies', 'Food/Appetizers-Bunny_Dumplings_Small.webp', 'Adorable steamed dumplings shaped like little bunnies, complete with cute facial expressions. These plump, handcrafted bao buns feature delicate \"ears\" and charming faces drawn with edible ink. Served on a stylish pink and teal marbled plate, these whimsical treats are as visually delightful as they are tasty. Perfect for adding a touch of fun to your dim sum experience or as a playful appetizer for any meal.', 12.99, 'Appetizers'],
        ['Chicken Littles', 'Food/Appetizers-Chicken_Chicken_Nuggies.webp', 'These plump, golden-fried chicken bites have been transformed into an irresistible flock of feathered friends! With their candy corn beaks and raspberry pompadours, they\'re clucking adorable. Served with a side of sweet-and-tangy dipping sauce.', 7.95, 'Appetizers'],
        ['Dinosaur Nuggies', 'Food/Appetizers-Dino_Nuggies.webp', 'Crispy, dinosaur-shaped chicken nuggets that will have you roaring with delight! These prehistoric morsels are perfect for letting out your inner child or keeping the kids happily munching. Served with a side of bold, savory dipping sauce.', 5.95, 'Appetizers'],
        ['Shiba Inu Shrimp Tempura', 'Food/Appetizers-Doge_Shrimp.webp', 'Delightfully crispy tempura shrimp artfully crafted to resemble adorable Shiba Inu dogs. Each golden-brown piece is shaped into a curled, crescent form reminiscent of a Shiba\'s distinctive tail, with cleverly placed details to create ears, paws, and facial features. Served on a sleek black slate plate, these whimsical creations are accompanied by a manga-inspired placemat featuring Japanese onomatopoeia, adding a playful touch of pop culture to the presentation. Perfect for anime fans, dog lovers, or anyone looking for an Instagram-worthy appetizer that\'s as cute as it is delicious.', 15.99, 'Appetizers'],
        ['Kawaii Koi Nigiri', 'Food/Appetizers-Fish_Nigiri_Sushi.webp', 'A playful twist on traditional sushi, these charming nigiri pieces are artfully crafted to resemble adorable koi fish. Each piece features a base of seasoned rice shaped like a fish body, topped with various ingredients to create unique characters. The nigiri are arranged on a textured ceramic plate, accompanied by a small dish of soy sauce. This whimsical presentation transforms a classic Japanese dish into a delightful, Instagram-worthy experience that\'s sure to bring smiles to diners of all ages.', 22.99, 'Appetizers'],
        ['Meow Mix Popcorn Chicken', 'Food/Appetizers-Kitty_Popcorn_Chicken.webp', 'Adorable bite-sized pieces of crispy chicken nuggets shaped like cute cat faces. Each golden-brown \"kitty\" features a perfectly crisp exterior with hand-drawn facial features using edible ink. These whimsical treats come in a playful cartoon-decorated box labeled \"Chicken Popcorn,\" creating a fun play on words. The box design showcases various fast food items, adding to the overall theme. Perfect for kids\' meals, fun family dinners, or as a quirky appetizer for cat lovers and food enthusiasts alike. These Meow Mix Popcorn Chicken bites offer a delightful combination of tasty comfort food and Instagram-worthy presentation.', 8.99, 'Appetizers'],
        ['Purr-fect Prawn Pops', 'Food/Appetizers-Kitty_Shrimp.webp', 'Adorable deep-fried shrimp skewers artfully crafted to resemble playful cats. Each large prawn is coated in a crispy, colorful breadcrumb mixture and cleverly shaped into a cat\'s curvy silhouette.Each cat features cute facial details made with edible ink, including whiskers, eyes, and a smiling mouth. The shrimp tails are left exposed, cleverly doubling as the cats\' tails. These whimsical treats are served on wooden skewers, making them easy to handle and perfect for dipping. Ideal for seafood lovers, cat enthusiasts, or anyone looking for an Instagram-worthy appetizer that combines culinary creativity with a touch of whimsy.', 14.99 , 'Appetizers'],
        ['Leo the Lunch Lion', 'Food/Appetizers-Lion_Fruit.webp', 'Dive into an adventurous meal with Leo the Lunch Lion! This delightful creation features a charming lion made from whole grain bread, cheese, and fresh vegetables. The lion’s mane is crafted from crisp carrot sticks, with cucumber slices forming the eyes and ears. Cheerful butterflies made from cucumber and red pepper slices flutter around, adding a playful touch. Perfect for encouraging kids to enjoy their veggies, Leo the Lunch Lion is as fun to look at as it is to eat!', 8.99, 'Appetizers'],
        #   Desserts
        ['Honeybear Pancake Stack', 'Food/Desserts-Bear_Pancakes.webp', 'A towering stack of golden pancakes sculpted into an enchanting bear design, drizzled with honey and garnished with edible flowers and candy chicks for a sweet breakfast delight.', 11.95, 'Desserts'],
        ['Capybara Cousins Biscuits', 'Food/Desserts-Capybara_Macaroon.webp', 'These plump, capybara-shaped biscuits have the most adorably expressive faces! From their whimsical snouts to their rotund bodies, each one has been delightfully crafted. Stuffed with savory fillings, these baked buddies look like they wandered right out of the rainforest and onto your plate.', 12.50, 'Desserts'],
        ['Purrfect Mochi Kitties', 'Food/Desserts-Kitty_Balls.webp', 'Meet the Purrfect Mochi Kitties, a delightful dessert that\'s almost too cute to eat! These soft, chewy mochi balls are shaped like adorable kittens, each with its own unique expression and color. Filled with a variety of sweet fillings such as red bean, matcha, and chocolate, they are a treat for both the eyes and the taste buds. Served in a light, sweet syrup, these little kitties are the perfect way to end any meal on a playful and delicious note.', 6.99, 'Desserts'],
        ['Kitty Cottage Delight', 'Food/Desserts-Kitty_Cottage.webp', 'Step into a whimsical world with the Kitty Cottage Delight! This enchanting dessert features a cozy cottage made entirely of soft, fluffy bread, intricately decorated with adorable cat characters and vibrant, edible details. The cottage is surrounded by a garden of fresh broccoli and charming miniatures, creating a delightful scene straight out of a fairy tale. Perfect for parties or special occasions, this dessert combines creativity and flavor, making it a memorable centerpiece that will delight both children and adults alike.', 18.99, 'Desserts'],
        ['Lucky Ladybird Cupcake', 'Food/Desserts-Ladybird_Cupcakes.webp', 'Indulge in the charm of our Lucky Ladybird Cupcake, a sweet symphony of flavors with a golden biscuit base, topped with a cloud of vanilla frosting. Each cupcake is adorned with a handcrafted fondant ladybird, complete with playful spots and chocolate antennae—a treat that’s as lucky as it is luscious!', 3.99, 'Desserts'],
        ['Lion & Bunny Duo Cone', 'Food/Desserts-Lion_Rabbit_Ice_Cream _Duo.webp', 'Our Lion & Bunny Duo Cone is a whimsical masterpiece! On one side, you\’ll find a golden scoop of ice cream with a cereal mane, while the other side features a light pink scoop with adorable bunny ears. It\’s a sweet safari adventure in every bite!', 4.99 , 'Desserts'],
        ['Whimsical Owl Treats', 'Food/Desserts-Owl_Dessert.webp', 'Savor the magic of our Whimsical Owl Treats, where each cookie is a delightful blend of sweetness and creativity. With almond beaks and ears, and eyes that seem to follow you, these cookies are a hoot at any gathering!', 3.50, 'Desserts'],
        ['Serpentine Savory Delight', 'Food/Desserts-Snake_Dessert.webp', 'Experience the thrill of our Serpentine Savory Delight, a delectable pastry creation that slithers its way into your taste buds. With a herb-infused green dough and playful edible eyes and tongue, this culinary serpent is sure to be the talk of any table.', 5.25, 'Desserts'],
        ['Choco Ladybird Cupcake', 'Food/Desserts_Ladybird_Dessert.webp', 'Dive into the delightful world of our Choco Ladybird Cupcake, where rich chocolate frosting meets a sprinkle of red sweetness. With blackberry eyes and a licorice smile, this cupcake is a cheerful treat that’s sure to enchant!', 3.75, 'Desserts'],
        #   Drinks
        ['Purr-fect Latte', 'Food/Drinks-Kitty_Latte.webp', 'Delight in the artistry of our Purr-fect Latte, where every sip is accompanied by the adorable presence of frothy feline friends. Crafted with care, this latte is not just a drink, but a masterpiece in a cup.', 4.25, 'Drinks'],
        #   Main Course
        ['The Pepperoni Pal Pizza', 'Food/MainCourse-Bear_Pizza.webp', 'A playful pizza creation shaped like an adorable pup, featuring a crispy crust covered in melty cheese and topped with pepperoni slices, tomatoes, and basil for a flavor-packed bite.', 14.95, 'MainCourse'],
        ['Shark Attack Sushi', 'Food/MainCourse-Blahaj_Shrimp.webp', 'Beware the fierce-looking sushi roll with its blue rice \"shark\" fin and menacing glare! Served with tangy shrimp and a sunny-side up \"life preserver\" egg, this dish is a thrilling oceanic adventure for your taste buds.', 18.95, 'MainCourse'],
        ['Hoppy Bunny Dumplings', 'Food/MainCourse-Bunny_Dumplings.webp', 'Embrace the joy with our Hoppy Bunny Dumplings, where each bite is a blend of savory goodness and adorable design. Perfectly browned and shaped like little bunnies, they’re sure to bring a smile to your day.', 4.50 , 'MainCourse'],
        ['Happy Cappy Burger', 'Food/MainCourse-Capybara_Borgir.webp', 'This adorable burger is too cute to eat! A soft, golden-brown bun forms the cuddly capybara\'s face, while itty bitty crispy nugget capybaras snuggle up next to it. The burger\'s lettuce and tomato bedding provides a cozy nest for this heartwarming meal.', 18.50, 'MainCourse'],
        ['Happy Stacky Capys', 'Food/MainCourse-Capybara_Hug_Rice.webp', 'These playful little guys love to stack! Enjoy fluffy brown rice molded into adorable capybaras stacked on top of each other. Perfect for a side dish or a light lunch.', 7.99, 'MainCourse'],
        ['Crabby Patty Paradise', 'Food/MainCourse-Crab_Shrimp.webp', 'A whimsical take on a classic!  This dish features white rice formed into a delightful crab holding a patty made of minced shrimp.  Enjoy the delightful textures and flavors of the sea.', 14.99, 'MainCourse'],
        ['The Wagging Wagyu Burger', 'Food/MainCourse-Doge_Borgir.webp', 'This burger is sure to get your tail wagging! A juicy all-beef patty nestled in a fluffy brioche bun shaped like an adorable dog. Topped with your choice of cheese, lettuce, tomato, and onion.', 14.99, 'MainCourse'],
        ['Pompompurin’s Purrfect Dish', 'Food/MainCourse-Doge_Rice_Full_Meal.webp', 'This adorable dish features fluffy white rice molded into the shape of the popular Sanrio character, Pompompurin the dog. Perfect for any Pompompurin fan or dog lover!', 9.99, 'MainCourse'],
        ['The Ducky Bunch Donburi', 'Food/MainCourse-Duck_Family_Rice.webp', 'A fun and flavorful twist on a classic Japanese dish!  Savory rice balls molded into a mama duck and her ducklings served over a bed of fluffy white rice.', 12.99, 'MainCourse'],
        ['The Ribbiting Rib-Eye', 'Food/MainCourse-Frog_Borgir.webp', ' This burger is sure to jump for joy in your mouth! A juicy rib-eye steak nestled in a fluffy green pea flour bun shaped like a cheerful frog. Topped with your choice of cheese, lettuce, tomato, and onion.', 15.99, 'MainCourse'],
        ['Kitty Cuddle Claypot', 'Food/MainCourse-Kitty_Rice_Chicken.webp', 'Warm your heart with this comforting dish!  Fluffy white rice molded into a cute kitty cat curled up in a traditional claypot.  Fill it with your favorite stew or soup for a satisfying meal.', 10.99, 'MainCourse'],
        ['Panda Playful Picnic', 'Food/MainCourse-Panda_Rice_Omelette.webp', 'This adorable dish features two scoops of black and white rice molded into playful pandas enjoying a picnic! Perfect for a fun lunch or creative side dish.', 7.99, 'MainCourse'],
        ['Pen Pals on a Plate', 'Food/MainCourse-Penguin_Omurice.webp', 'These adorable pen pals are ready to join you for lunch!  A bed of fluffy white rice topped with a friend-shaped omelette decorated with seaweed and a tomato for a playful penguin.', 9.99, 'MainCourse'],
        ['Burrowing Bunny Bao', 'Food/MainCourse-Rabbit_Dessert_Omelette.webp', 'This adorable dish features a steamed bun molded into the shape of a burrowing bunny. Filled with your choice of savory or sweet ingredients, it\'s the perfect way to enjoy a delicious and fun meal!', 5.99 , 'MainCourse'],
        ['Terrific Turtle Terrine', 'Food/MainCourse-Turtle_Borgir.webp', 'Dive into deliciousness with this delightful terrine! Layers of colorful vegetables and savory fillings molded into a charming turtle. Perfect for a light lunch or an impressive appetizer.', 12.99, 'MainCourse'],
        #   Salads
        ['Tropical Birdie Bowl', 'Food/Salads-Bird_Fruit.webp', 'This festive fruit salad is sure to brighten your day! A colorful mix of fruits like strawberries, blueberries, oranges, and banana slices arranged into a charming bird. Perfect for a party appetizer or a fun after-school snack.', 8.99, 'Salads'],
        ['Sleepy Sloth Surfer', 'Food/Salads-Fish_Fruit.webp', 'This adorable dish features sweet brown rice molded into the shape of a sloth surfing on a wave. Perfect for a snack or a light dessert!', 5.99 , 'Salads'],
        ['Flamboyantly Fruity Flamingo', 'Food/Salads-Flamingo_Fruit.webp', 'This vibrant dish is sure to turn heads! Layers of colorful fruits like watermelon, cantaloupe, and honeydew topped with a majestic flamingo made of kiwi and apple slices. Perfect for a refreshing summer dessert or a festive party centerpiece.', 12.99, 'Salads'],
        ['The Peacock Parade Plate', 'Food/Salads-Peackock_Fruit.webp', 'his showstopping dish features sushi rice dyed vibrant colors and meticulously molded into a stunning peacock. Perfect as a centerpiece for a special occasion or a delightful appetizer to share.', 24.99, 'Salads'],
        ['Rainbow Fruit Fantasia', 'Food/Salads-Snake_Fruit.webp', 'Dive into a spectrum of flavors with our Rainbow Fruit Fantasia! This dish features succulent slices of ripe strawberries and tangy kiwis artistically layered to create an edible rainbow, accompanied by plump raspberries for an extra burst of freshness. Perfectly arranged on a pristine porcelain canvas and served with our signature whimsical cutlery, this delightful treat is sure to tantalize your taste buds while adding a splash of color to your day.', 7.99, 'Salads'],
        #   Soups
        ['Woolly Warm Soup', 'Food/Soups-Bear_Omurice.webp', 'A comforting, sheep-themed soup bowl brimming with nourishing broth, tender vegetables, and fluffy sheep-shaped dumplings to keep you cozy.', 7.50, 'Soups'],
        ['Bear-y Good Soup', 'Food/Soups-Bear_Candy_Soup.webp', 'Warm up with our delightful Bear-y Good Soup! This comforting bowl features a hearty broth filled with tender corn, bean sprouts, and savory slices of meat or tofu. But the real stars of the show? Three adorable bear-shaped creations, lovingly crafted from dough or rice, float on the surface, adding a touch of whimsy to your meal. Served in our exclusive “Regent” bowl, this soup is a hug in edible form, perfect for chilly days or when you need a little extra bear-y goodness.', 9.99, 'Soups'],
        ['Capybara Cradle Soup', 'Food/Soups-Capybara_Bath_Soup.webp', 'A delightful soup served in an artisanal bread bowl, where the bread itself is a cozy cradle for the soup. But what makes this dish truly enchanting are the edible capybara figurines gently swimming within the golden broth. These adorable creatures add a touch of playfulness to every spoonful.', 29.95, 'Soups'],
        ['Octopus Soup', 'Food/Soups-Octopus_Bread_Soup.webp', 'Behold the enchanting Octopus Soup! Picture a round bread roll, its top cut off and hollowed out to cradle a tomato-based soup. But wait, it’s no ordinary soup! The bread roll transforms into an adorable octopus, its body plump and inviting. Eight breadstick tentacles extend outward, playfully dipping into the flavorful broth. And those eyes? Two black olive slices, gazing curiously from the octopus’s head. Dive into this delightful dish, where taste meets imagination.', 19.95, 'Soups'],
        ['Penguinius Noodle Delight', 'Food/Soups-Penguin_Soup.webp', 'Behold the enchanting Penguinius Noodle Delight! Imagine a cozy bowl of ramen, its broth clear and fragrant. But wait, it’s no ordinary ramen! The bowl itself transforms into a delightful penguin named Penguinius. His plump body is crafted from a round bread roll, while eight breadstick tentacles extend outward like flippers. The soup, a tomato-based delight, swirls around Penguinius, carrying with it noodles, slices of tomato, and a leafy green vegetable. And those eyes? Two black olive slices, gazing curiously from Penguinius’s head. Dive into this playful dish, where flavor meets imagination.', 19.95, 'Soups']];

        foreach ($foodData as $food) {
            $foodInsert->execute($food);
        }
    }


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}