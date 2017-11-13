<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Самолеты</title>
</head>
<body>
<input type="hidden" id="<?= $this->security->get_csrf_token_name(); ?>" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
<h1>Миг</h1>
    <input type="submit" class="act" id="getTakeoff" data-id="mig" value="Взлет">
    <input type="submit" class="act" id="getLanding" data-id="mig" value="Посадка">
    <input type="submit" class="act" id="getAttack" data-id="mig" value="Атака">
    <h1>Ту154</h1>
    <input type="submit" class="act" id="getTakeoff" data-id="tu154" value="Взлет">
    <input type="submit" class="act" id="getLanding" data-id="tu154" value="Посадка">
    <br>
    <br>
    <br>
    <div class="action"></div>
</body>
</html>