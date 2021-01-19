<!DOCTYPE html>
<?php
/**
 * Template Name: Donate template
 */
get_header();
	 ?>
    <div class="content">
        <div class="row divided">
            <div class="col">
                <h1>
                    <?php the_title(); ?>
                </h1>
                <h2>Dina donationer går bland annat till:</h2>
                <div class="use">
                    <div>
                        <img src="<?php echo get_template_directory_uri() . '/assets/laptop.png';?>"/>
                        <span>Att betala för våra digitala tjänster</span>
                    </div>
                    <div>
                        <img src="<?php echo get_template_directory_uri() . '/assets/pen.png';?>"/>
                        <span>Rekryteringen av nya skribenter</span>
                    </div>
                    <div>
                        <img src="<?php echo get_template_directory_uri() . '/assets/books.png';?>"/>
                        <span>Tryckkostnader för fysiska tidningar</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="pay">
                    <h2>Donera via Swish</h2>
                    <form name="donate-form" id="donate-form">
                        <div class="amounts">
                            <a amount="50">50 SEK</a>
                            <a amount="100" class="selected top">100 SEK</a>
                            <a amount="150">150 SEK</a>
                            <div><input id="custom" type="number"></input>SEK</div>
                        </div>
                        <button type="submit">Donera</button>
                        <input type="hidden" id="amount" value="100">
                    </form>
                    <span class="info">Vi generar en QR-kod åt dig som du kan skanna och sedan betala med.</span>
                </div>
                <div id="confirm">
                    <div class="hero">
                        <video autoplay muted loop id="myVideo">
                            <source src="<?php echo get_template_directory_uri() . '/assets/swish.mp4';?>" type="video/mp4">
                        </video>
                    </div>
                    <div class="body">All right! Öppna Swish-appen och skanna följande QR-kod:</div>
                    <img id="qr">
                    </div>
                </div>
            </div>
            <div class="info">Ikoner skapade av <a href="https://www.freepik.com" rel="nofollow">Freepik</a></div>
        </div>
        <?php get_footer(); ?>
        <?php wp_footer(); ?>
        <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/donate.js';?>"></script>
</body>

</html>