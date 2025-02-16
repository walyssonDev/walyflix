<style>
    .loader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: rgb(0, 0, 0);
        opacity: .8;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader img {
        width: 100px;
        height: 100px;
    }
</style>

<div id="loader" class="loader">
    <img src="../assets/img/loader.gif" alt="Carregando...">
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var loader = document.getElementById('loader');
        window.addEventListener('load', function() {
            loader.style.display = 'none';
        });
    });
</script>