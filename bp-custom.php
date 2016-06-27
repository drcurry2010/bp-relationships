<?php

`pre type=”php”`
function bbg_change_profile_tab_order() {
global $bp;
$bp->bp_nav[‘profile’][‘position’] = 10;
$bp->bp_nav[‘activity’][‘position’] = 20;
$bp->bp_nav[‘friends’][‘position’] = 30;
$bp->bp_nav[‘groups’][‘position’] = 40;
$bp->bp_nav[‘blogs’][‘position’] = 50;
$bp->bp_nav[‘messages’][‘position’] = 60;
$bp->bp_nav[‘settings’][‘position’] = 70;
}
add_action( ‘bp_setup_nav’, ‘bbg_change_profile_tab_order’, 999 );
`/pre`

?>
