<!DOCTYPE html>
<?php
/**
 * Template Name: Sign up template
 */
?>
<!--



      _.-'''-._
     .'   .-'``|'.
    /    /    -*- \
   ;   <{      |   ;
   |    _\ |       |
   ;   _\ -*- |    ;
    \   \  | -*-  /
     '._ '.__ |_.'
        '-----'

Website developed by Karl Sellergren. Check out my LinkedIn profile: https://www.linkedin.com/in/karlsellergren/



-->
<html <?php language_attributes(); ?></html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
	    if ( is_user_logged_in() ) { ?>
            <style>
            .sciencemag__navigation {transform: translateY(32px);}
            #wpadminbar {background-color: black !important;}
            .sciencemag__mobile__menu {top: 32px !important;}
            #menu-categories-for-mobile-menu:first-child {border-top: 1px solid #555;}
            @media screen and (max-width: 782px) {
                .sciencemag__navigation {transform: translateY(46px);}
                #wpadminbar {position: fixed !important;}
                .sciencemag__mobile__menu {top: 46px !important;}
            }
            </style>
	<?php }
	wp_head(); ?>
	<meta name="msapplication-TileColor" content="#000000">
    <meta name="theme-color" content="#ffffff">
    <style>
    .partikular__signup__left {background-image: url('<?php echo get_template_directory_uri() . "/assets/signupvector.jpg";?>');}
    </style>
</head>
<body>
    <div class="partikular__signup__left">
        <div id="sciencemag_particles"></div>
        <div class="partikular__logo">
            <a href="<?php echo home_url();?>">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="200" height="50.587" viewBox="0 0 200 50.587">
                    <defs>
                    <clipPath id="clip-svglogo">
                        <rect width="200" height="50.587"/>
                    </clipPath>
                    </defs>
                    <g id="svglogo" clip-path="url(#clip-svglogo)">
                    <text id="partikular" transform="translate(-3 32)" fill="#fff" font-size="41.5" font-family="Poppins-Medium, Poppins" font-weight="500"><tspan x="0" y="0">partikular</tspan></text>
                    <text id="vetenskaplig_ungdomstidning" data-name="vetenskaplig ungdomstidning" transform="translate(14 47)" fill="#fff" font-size="12.3" font-family="Poppins-Medium, Poppins" font-weight="500"><tspan x="0" y="0">vetenskaplig ungdomstidning</tspan></text>
                    </g>
                </svg>
            </a>
        </div>
        <div class="left__information">
            <h2>Sveriges största naturvetenskapliga tidning för unga.</h2>
        </div>
    </div>
    <div class="partikular__signup__right">
        <div id="mc_embed_signup">
            <form action="https://partikular.us5.list-manage.com/subscribe/post?u=6b46285289139ed51ecb621d1&amp;id=d99baed735" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                <div id="mc_embed_signup_scroll">
                    <div class="partikular__logo__mobile">
                        <a href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri() . '/assets/mobilelogo.gif';?>" alt="Partikular logotyp"  width=200/></a>
                    </div>
                    <h1>Bli medlem i vår ideella förening</h1>
            <div class="mc_embed_page_1">
                <div class="halfwidth__container">
                    <div class="mc-field-group">
                        <label for="mce-FNAME">Förnamn</label>
                        <input type="text" value="" name="FNAME" required id="mce-FNAME" placeholder="Vad är ditt förnamn?">
                    </div>
                    <div class="mc-field-group">
                        <label for="mce-LNAME">Efternamn</label>
                        <input type="text" value="" name="LNAME" required id="mce-LNAME" placeholder="Vad är ditt efternamn?">
                    </div>
                </div>
                <div class="mc-field-group fullwidth">
                    <label for="mce-EMAIL">E-postadress</label>
                    <input type="email" value="" name="EMAIL" class="email" required id="mce-EMAIL" placeholder="Vad är din e-postadress?">
                </div>
                <div class="mc-field-group">
                    <fieldset class="agequest">
                        <div class="agequest-title"><legend>Hur gammal är du?</legend></div>
                        <div class="yesnoquestion">
                            <div class="altone">
                                <input type="radio" value="1" name="group[17286]" id="mce-group[17286]-17286-0">
                                <label for="mce-group[17286]-17286-0" class="after_radio">20 eller under</label>
                            </div>
                            <div class="alttwo">
                                <input type="radio" value="2" name="group[17286]" id="mce-group[17286]-17286-1">
                                <label for="mce-group[17286]-17286-1" class="after_radio">Över 20</label>
                            </div>
                        </div>
                        <div class="agequest-help">
                            <div class="agequest-help-info">För att kunna söka verksamhetsbidrag som ungdomsförening behöver vi veta hur gammal du är.</div>
                        </div>
                    </fieldset>
                </div>
                <div class="mc_policies">
                    <label class="checkbox_policies subfield" for="policies">Genom att bli medlem hos oss godkänner jag föreningens <a href="<?php echo esc_url( home_url( '/' ) . 'integritetspolicy' ); ?>" target="_blank">integritetspolicy</a> och <a href="https://docs.google.com/document/d/1VXkAOdN85rzaWINpFhQLVklAMTdCAxIh0g6A6tGLMXY/edit?usp=sharing" target="_blank">stadgar</a>.
                        <input type="checkbox" id="policies" name="policies" value="Y" class="av-checkbox " required>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="mc_embed_continuebtn" id="validation_load" onclick="validateForm()"><span id="continuetext">Fortsätt</span></div>
                <div class="signup__info">Vi använder Mailchimp för att lagra medlemsinformation.<br>När du blir medlem godkänner du Mailchimps <a href="https://mailchimp.com/legal/" target="_blank">sekretesspolicy</a>.</div>
            </div>
            <div class="mc_embed_page_2">
                <div id="mergeRow-gdpr" class="mergeRow gdpr-mergeRow content__gdprBlock mc-field-group">
                    <div class="content__gdpr">
                        <strong>E-postutskick</strong>
                        <p>Var snäll och välj vilken typ av utskick du vill motta av oss.</p>
                        <fieldset class="mc_fieldset gdprRequired mc-field-group" name="interestgroup_field">
                            <label class="checkbox subfield" for="gdpr_10321">
                                <input type="checkbox" id="gdpr_10321" name="gdpr[10321]" value="Y" class="av-checkbox " checked>
                                <span class="slider"></span>
                                <span>Nyhetsbrev</span>
                            </label>
                            <label class="checkbox subfield" for="gdpr_10325">
                                <input type="checkbox" id="gdpr_10325" name="gdpr[10325]" value="Y" class="av-checkbox " checked onclick="statecheck(this)">
                                <span class="slider"></span>
                                <span>Notifikationer om nya artiklar</span>
                            </label>
                        </fieldset>
                        <p>Du kan avprenumerera på våra e-postutskick när som helst genom att klicka på länken längst ner i våra utskick. För att få mer information om hur vi hanterar din information, var snäll och besök vår hemsida.</p>
                    </div>
                </div>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"><div><span id="error-response-header">Hoppsan!</span><span id="mce-error-response-msg"></span></div></div>
                        <div class="response" id="mce-success-response" style="display:none"><span id="mce-success-response-msg"></span></div>
                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_6b46285289139ed51ecb621d1_d99baed735" tabindex="-1" value=""></div>
                    <input type="hidden" value="" maxlength="70" name="ADRESS[addr2]" id="mce-ADRESS-addr2">
                    <input type="hidden" value="" name="LINKID" id="mce-LINKID">
                    <input type="hidden" value="" id="street_number">
                    <div class="clear submitbtn"><input type="submit" value="Bli medlem" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>    
            </div>
            </form>
        </div>
        <!--End mc_embed_signup-->
        <div class="successmsg" id="sucmsg" style="display:none;">
            <img src="<?php echo get_template_directory_uri() . '/assets/waving-hand.svg';?>" width="100">
            <h2>Välkommen!</h2>
            <h3>Tack för att du är med och stöttar vår förening.</h3>
            <p>Kontrollera din inkorg, du kommer snart att få ett välkomstmeddelande av oss.</p>
        </div>
    </div>
</div>
    <script type="text/javascript">
        var urlParams = new URLSearchParams(window.location.search);
        var submitted = urlParams.get('success');
        if (submitted == "true") {
            document.getElementById("mc_embed_signup").style.display = "none";
            document.getElementById("sucmsg").style.display = "block";
        }


        function statecheck(element) {
            if (! element.checked) {
                document.getElementById("statecheck_display").style.display = "none";
            } else {
                document.getElementById("statecheck_display").style.display = "block";
            }
        }
        document.getElementById("mce-LINKID").value = Date.now() * Math.floor(Math.random() * 100);

        function changelighten() {
            document.getElementById('container_autocomplete').style.display = 'none';
            var el = document.getElementsByClassName("lighten");
            for (i = 0; i < el.length; i++) {
                el[i].style.opacity = "1";
            }
        }


        var currenttab = 0;
        
        function validateForm() {
            var par = document.getElementsByClassName("mc_embed_page_1");
            var chi = par[0].getElementsByTagName("input");
            var v = true;
            
            for (i = 0; i < chi.length; i++) {
                if (chi[i].classList.contains("invalid")) {
                    chi[i].classList.remove("invalid");
                }
                var terms = document.getElementsByClassName("checkmark")[0];
                if (terms.classList.contains("invalid")) {
                    terms.classList.remove("invalid");
                }
                // If a field is empty...
                if (! chi[i].checkValidity()) {
                    chi[i].classList.add("invalid");
                    if (chi[i].getAttribute("type") == "checkbox") {
                        document.getElementsByClassName("checkmark")[0].classList.add("invalid");
                    }
                    v = false;
                }
            }
            if (document.getElementById('mce-group[17286]-17286-0').checked || document.getElementById('mce-group[17286]-17286-1').checked) {
                document.querySelector('.agequest').classList.remove("invalid");
            } else {
                document.querySelector('.agequest').classList.add("invalid");
                v = false;
            }
            if (v) {
                document.getElementById("validation_load").classList.add("loader");
                document.getElementById("continuetext").innerHTML = "Laddar...";
                var timeout = setTimeout(function proceed() {
                    document.getElementsByClassName("mc_embed_page_1")[0].style.display = "none";
                    document.getElementsByClassName("mc_embed_page_2")[0].style.display = "block";
                }, 3000);
            }
        }
    </script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/formvalidate.js';?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/particles.js';?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/js/app.js';?>"></script>
    <?php wp_footer(); ?>
</body>
</html>