<?php
// Annisya Riyan Wulandini
// 2440086041


    $pdo = new PDO('mysql:host=localhost:5500;dbname=slug', 'root', '');
    function generate_slug()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $slug = '';
    for ($i = 0; $i < 10; $i++)
    {
        $slug .= $characters[rand(0, strlen($characters)-1)];
    }
    return $slug;
}
function get_short_urls()
{
    global $pdo;
    $stmt=$pdo->query('SELECT * FROM short_urls');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
if(isset($_POST['long_url']) && isset($_POST['long_url']))
{
    $long_url=$_POST['long_url'];
    $custom_slug=$_POST['custom_slug'];
    if($custom_slug){
        $slug=$custom_slug;
    } 
    else
    {
        $slug = generate_slug();
    }
    $stmt = $pdo->prepare('INSERT INTO short_urls (long_url, slug) VALUES (?, ?)');
    $stmt->execute([$long_url, $slug]);
    $short_url = 'http://' . $domain . '/' . $slug;
    header('Location: redirect.php');
}
if(isset($_GET['l']))
{
        $slug=$_GET['l'];
        $stmt=$pdo->prepare('SELECT long_url FROM short_urls WHERE slug = ?');
        $stmt->execute([$slug]);
        $long_url=$stmt->fetchColumn();
            if($long_url){
        $stmt=$pdo->prepare('UPDATE short_urls SET visit_count = visit_count + 1 WHERE slug = ?');
        $stmt->execute([$slug]);
        header("Location: $long_url");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>URL Shortener PHP</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="background">
        <h1>URL Shortener PHP</h1>
        <form method="post">
            <div style="margin-top: 10px;">
                <label for="long_url" class="kolom">URL Longer:</label>
            </div>
            <input type="text" name="long_url" id="long_url"><br>
            <div style="margin-top: 10px;">
                <label for="custom_slug" class="kolom">URL Slug:</label>
            </div>
            <input type="text" name="custom_slug" id="custom_slug"><br>
            <div style="margin-top: 10px;">
                <input type="submit" name="submit" value="Create" class="btn"></input>
            </div>
        </form>
        <?php if(isset($short_url)) : 
          ?>
            <p>URL Shorter:</p>
            <a href="<?php echo $short_url; ?>" target="_blank"><?php echo $short_url; 
          ?></a>
        <?php endif;
        ?>
        <h2>a list of shortened URL</h2>
        <ul>
            <?php foreach (get_short_urls() as $url) : 
              ?>
                <li>
                    <a href="<?php echo '?l='.$url['slug']; 
                    ?>" target="_blank">
                        <?php echo 'http://frendy.com/' . $url['slug']; 
                        ?>
                    </a>
                    (<?php echo $url['visit_count']; ?> visit)
                </li>
            <?php 
            endforeach; 
            ?>
        </ul>
    </div>
</body>
</html>