    <script src="/public/assets/vendor/js/jquery-3.6.0.js"></script>
    <script src="/public/assets/vendor/js/materialize.js"></script>
    <script src="/public/assets/vendor/js/jquery.mask.js"></script>
    
    <?php if (isset($scripts)): ?>
    <?php foreach ($scripts as $script): ?>
        <script src="<?= $script?>"></script>
    <?php endforeach; ?>
    <?php endif; ?>

    <footer></footer>
</body>

</html>
