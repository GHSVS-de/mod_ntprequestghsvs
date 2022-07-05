<?php
defined('_JEXEC') or die;
?>
<h3>NTP-Request</h3>
        <h4>unixTime</h4>
        <p>
					<?php echo $result->unixTime; ?>
				</p>
        <h4>utc</h4>
        <p>
					<?php echo $result->utc; ?>
				</p>


        <h4>zoneTime (DateTime Object)</h4>
        <p>
					<?php $zoneTime = (array) $result->zoneTime;?>
					date-Property: <?php echo (string) $zoneTime['date']; ?><br>
					timezone_type-Property: <?php echo (string) $zoneTime['timezone_type']; ?><br>
					timezone-Property: <?php echo (string) $zoneTime['timezone']; ?>
				</p>
