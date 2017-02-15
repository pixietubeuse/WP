    <footer>
        <div class="content">
            <?php
            // get footer picture logo (signature picture)
            $signaturePod = pods('signature');
            if($signaturePod->exists()){
                $urlSignaturePicture = $signaturePod->display( 'image' );
            }
            ?>
            <img class="signature-footer" src="<?php print($urlSignaturePicture); ?>" alt="Pixietubeuse">
            <?php wp_nav_menu( array( 'theme_location' => 'reseauxSociaux' ) ); ?>
            <div class="copyright">Copyright 2017<br /> Développé par : Jérémy Young & Sandrine Martinez</div>
        </div>
    </footer>
<?php wp_footer(); ?>

</body>
</html>
