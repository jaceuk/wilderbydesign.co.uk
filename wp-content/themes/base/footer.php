    <footer>

    </footer>

    <?php wp_footer(); ?>

    <!--
    Lazy Loading

    img example
    <img class="img-responsive lazy" src="images/placeholder.png" data-src="images/footer-logo-censeo.png" alt="" />

    css example
    .quote {
    background-image: url(images/placeholder.png);
    background-size: cover;
    background-position: 50% top;
    position: relative;
    }

    .quote.lazy-bg-loaded {
        background-image: url(images/quote.jpg);
    }
    -->

    <script src="js/yall.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            yall({
            observeChanges: true,
            idlyLoad: true
            });
        });
    </script>

    <?php if (file_exists('/Windows')) { ?>
        <div class="dev-alert">
            <p>Local Dev version of the site</p>
        </div>
    <?php } else { ?>
        <script type="text/javascript">
            // Google analytics
        </script>
    <?php } ?>

</body>
</html>