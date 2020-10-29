<?= partial("templates/header.php") ?>
<form action="mail" method="POST">
    <div>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email">
    </div>

    <div>
        <label for="message">Mensagem</label>
        <textarea name="message" id="message"></textarea>
    </div>

    <button>Enviar</button>
</form>
<?= partial("templates/footer.php")
?>
