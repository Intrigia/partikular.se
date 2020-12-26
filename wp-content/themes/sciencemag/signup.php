<!DOCTYPE html>
<?php
/**
 * Template Name: Sign up form
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
</head>
<body>
    <div class="partikular__signup__left">
        <div id="sciencemag_particles"></div>
        <div class="partikular__logo">
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
        </div>
        <div class="left__information">
            <h2>Sveriges största naturvetenskapliga tidning för unga.</h2>
            <ul>
                <li>Veckoliga publiceringar av intressanta artiklar.</li>
                <li>Snygg och enkel hemsida för största användarvänlighet.</li>
                <li>Ideellt arbete, gratis innehåll.</li>
            </ul>
        </div>
        <div class="left__vector">
            <img src="<?php echo get_template_directory_uri() . '/signup/vectorimage.png';?>" width="400">
        </div>
        </div>
        <span class="attribution_msg">Illustration av <a href="https://www.freepik.com/macrovector" target="_blank">Macrovector</a></span>
    </div>
    <div class="partikular__signup__right">
        <div id="mc_embed_signup">
            <form action="https://partikular.us5.list-manage.com/subscribe/post?u=6b46285289139ed51ecb621d1&amp;id=d99baed735" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                <div id="mc_embed_signup_scroll">
                <h1>Bli medlem i vår ideella förening</h1>
            <div class="mc_embed_page_1">
                <p>Som medlem får du ta del av artiklar före alla andra genom specialiserade mailutskick, du får möjligheten att engagera dig i vår förening och bli skribent.</p>
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
                <div class="mc-address-group">
                    <div class="mc-field-group">
                        <label for="mce-ADRESS-addr1">Gatuadress</label>
                    <input type="text" value="" maxlength="70" name="ADRESS[addr1]" id="mce-ADRESS-addr1" onblur="if (this.value !== '') {changelighten();}" required placeholder="Ange din gata och husnummer">
                    </div>
                    <div class="mc-field-group size1of2">
                        <label for="mce-ADRESS-city">Postort</label>
                        <input type="text" value="" maxlength="40" name="ADRESS[city]" id="mce-ADRESS-city" required placeholder="Ange postorten där du är bosatt">
                    </div>
                    <div class="twothirdwidth__container">
                        <div class="mc-field-group size1of2">
                            <label for="mce-ADRESS-state">Län</label>
                        <input type="text" value="" maxlength="20" name="ADRESS[state]" id="mce-ADRESS-state" required placeholder="I vilket län bor du?">
                        </div>
                        <div class="mc-field-group size1of2">
                            <label for="mce-ADRESS-zip">Postnummer</label>
                            <input type="text" value="" maxlength="10" name="ADRESS[zip]" id="mce-ADRESS-zip" required placeholder="Ange ditt postnummer">
                        </div>
                    </div>
                    <div class="mc-field-group size1of2">
                        <input type="hidden" name="ADRESS[country]" id="mce-ADRESS-country" required value="Sweden">
                    </div>
                </div>
                <div class="mc_policies">
                    <label class="checkbox_policies subfield" for="policies">Härmed godkänner jag föreningens <a href="<?php echo esc_url( home_url( '/' ) . 'integritetspolicy' ); ?>" target="_blank">integritetspolicy</a> och <a href="https://docs.google.com/document/d/1IT_yR_jy3recgfRuu7ELYsNzSCe3NLR-cRBMictZKV4/edit?usp=sharing" target="_blank">stadgar</a>.
                        <input type="checkbox" id="policies" name="policies" value="Y" class="av-checkbox " required>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="mc_embed_continuebtn" id="validation_load" onclick="validateForm()"><span id="continuetext">Fortsätt</span></div>
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
                        <div class="mc-field-group input-group category_choice" id="statecheck_display">
                        <ul>
                            <li>
                                <label for="mce-group[17189]-17189-0">Fysik<i>Partikelfysik, Aerodynamik...</i>
                                    <input type="checkbox" value="1" name="group[17189][1]" id="mce-group[17189]-17189-0" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label for="mce-group[17189]-17189-1">Teknik<i>Artificiell Intelligens...</i>
                                    <input type="checkbox" value="2" name="group[17189][2]" id="mce-group[17189]-17189-1" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label for="mce-group[17189]-17189-2">Matematik
                                    <input type="checkbox" value="4" name="group[17189][4]" id="mce-group[17189]-17189-2" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label for="mce-group[17189]-17189-3">Biologi<i>Hjärnan...</i>
                                    <input type="checkbox" value="8" name="group[17189][8]" id="mce-group[17189]-17189-3" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label for="mce-group[17189]-17189-4">Annat<i>Psykologi, Filosofi...</i>
                                    <input type="checkbox" value="16" name="group[17189][16]" id="mce-group[17189]-17189-4" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        </ul>
                        </div>
                        <p>Du kan avprenumerera på våra e-postutskick när som helst genom att klicka på länken längst ner i våra utskick. För att få mer information om hur vi hanterar din information, var snäll och besök vår hemsida.</p>
                    </div>
                    <div class="mc-field-group input-group">
                        <strong>Hur hörde du talas om oss?</strong>
                        <ul>
                            <li><label for="mce-REFERER-0">Sociala medier
                                <input type="radio" value="Sociala medier" name="REFERER" id="mce-REFERER-0">
                                <span class="circle_check"></span>
                            </label></li>
                            <li><label for="mce-REFERER-1">Googles sökresultat
                                <input type="radio" value="Googles sökresultat" name="REFERER" id="mce-REFERER-1">
                                <span class="circle_check"></span>
                            </label></li>
                            <li><label for="mce-REFERER-2">Vänner, familj eller släkt
                                <input type="radio" value="Vänner, familj eller släkt" name="REFERER" id="mce-REFERER-2">
                                <span class="circle_check"></span>
                            </label></li>
                            <li><label for="mce-REFERER-3">Min skola
                                <input type="radio" value="Min skola" name="REFERER" id="mce-REFERER-3">
                                <span class="circle_check"></span>
                            </label></li>
                            <li><label for="mce-REFERER-4">Annat
                                <input type="radio" value="Annat" name="REFERER" id="mce-REFERER-4">
                                <span class="circle_check"></span>
                            </label></li>
                        </ul>
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
                    <div class="signup__info">Vi använder Mailchimp som databas för att lagra medlemsinformation. Genom att klicka på "Bli medlem hos oss" ovan godkänner du Mailchimps <a href="https://mailchimp.com/legal/" target="_blank">sekretesspolicy</a>.</div>
            </div>    
            </div>
            </form>
        </div>
        <!--End mc_embed_signup-->
        <div class="successmsg" id="sucmsg" style="display:none;">
            <img src="<?php echo get_template_directory_uri() . '/icons/waving-hand.svg';?>" width="100">
            <h2>Välkommen!</h2>
            <h3>Tack för att du är med och stöttar vår förening.</h3>
            <p>Kontrollera din inkorg, du ska ha fått ett välkomstmeddelande av oss.</p>
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
    <script>

        var placeSearch, autocomplete;

        var componentForm = {
        street_number: {gl: 'short_name', fn: 'street_number'},
        route: {gl: 'long_name', fn: 'mce-ADRESS-addr1'},
        postal_town: {gl: 'long_name', fn: 'mce-ADRESS-city'},
        administrative_area_level_1: {gl: 'short_name', fn: 'mce-ADRESS-state'},
        postal_code: {gl: 'short_name', fn: 'mce-ADRESS-zip'}
        };

        function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'), {types: ['address'], componentRestrictions: {country: 'se'}});

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(['address_component']);

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var n = 0; n < componentForm.length; n++) {
            document.getElementById(componentForm[addressType]["fn"]).value = '';
        }
        var stradr = "";
        var strnum = "";

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]["gl"]];
            if (addressType == "route") {
                stradr = val;
            } else if (addressType == "street_number") {
                strnum = val;
            }
            document.getElementById(componentForm[addressType]["fn"]).value = val;
            }
        }
        document.getElementById('mce-ADRESS-addr1').value = stradr + ' ' + strnum;
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2_WWLRxLV7BuAJZlzOM528n1ompp-WRc&libraries=places&callback=initAutocomplete"
      async defer></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/signup/formvalidate.js';?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/particles.js';?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/app.js';?>"></script>
    <?php wp_footer(); ?>
</body>
</html>