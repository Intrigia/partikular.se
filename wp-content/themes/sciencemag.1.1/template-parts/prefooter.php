<?php
/**
 * Template part for the donate and about us part
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Science_Mag
 */

?>
<div class="sciencemag__prefooter">
  <div class="prefooter__aboutus">
    <h4>Vilka är vi och vad är vår vision?</h4>
    <a href="<?php echo esc_url( home_url( '/' ) ) . "om-oss"; ?>">utforska</a>
  </div>
  <div class="prefooter__donate">
    <h4>Stöd oss i vårt arbete!</h4>
    <a class="custom-dbox-popup">donera</a>
  </div>
  <script>
    document.querySelector(".custom-dbox-popup").onclick = function () {
      alert("Hejsan, ett meddelande från Karl här! Att donera är i nuläget inte möjligt, utan funktionen kommer snart.");
    }
  </script>
</div>
