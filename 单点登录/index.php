<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>sync login</title>
</head>
<body>

<?php if(empty($_SESSION['username'])):?>
    <p>hello,游客;请先<a href="login.php">登录</a></p>
    <p><a href="http://www.b.com/index.php">进入空间</a></p>
<?php else: ?>
    <p>hello,<?php echo $_SESSION['username']; ?>;<a href="http://www.b.com/index.php">进入空间</a></p>
<?php endif; ?>
<a href="http://www.a.com/index.php">home</a>
</body>
</html>

//login.php
<?php
session_start();
if(!empty($_POST['username'])){
    require './Des.php';
    $_SESSION['username'] = $_POST['username'];
    $redirect = 'http://www.a.com/index.php';
    header('Location:http://www.a.com/sync.php?redirect='.urlencode($redirect).'&code='.Des::encode($_POST['username'],'a'));
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>sync login</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="username" placeholder="用户名"/>
    <input type="text" name="password" placeholder="密码"/>
    <input type="submit" value="登录"/>
</form>
</body>
</html>

//sync.php
<?php
$redirect = empty($_GET['redirect']) ? 'www.a.com' : $_GET['redirect'];
if (empty($_GET['code'])) {
    header('Loaction:http://' . urldecode($redirect));
    exit;
}

$apps = array(
    'www.b.com/slogin.php'
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <?php foreach ($apps as $v): ?>
        <script type="text/javascript" src="http://<?php echo $v . '?code=' . $_GET['code'] ?>"></script>
    <?php endforeach; ?>
    <title>passport</title>
</head>
<body>
<script type="text/javascript">
    window.onload = function () {
        location.replace('<?php echo $redirect; ?>');
    }
</script>
</body>
</html>

