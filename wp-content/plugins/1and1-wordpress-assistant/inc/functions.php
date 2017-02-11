<?php
function oneandone_is_managed() {

	if ( file_exists( ABSPATH.'/.managed' ) AND is_readable( ABSPATH.'/.managed' ) ) {
		return true;
	}

	return false;
}

function oneandone_is_logging_enabled() {
	if ( defined( ONEANDONE_MONITOR_ASSISTANT ) && ONEANDONE_MONITOR_ASSISTANT == false ) {
		return false;
	}

	return true;
}